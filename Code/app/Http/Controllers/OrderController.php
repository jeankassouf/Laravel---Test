<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Models\Orders;
    use App\Models\OrdersDetails;
    use App\Models\Country;
    use App\Models\Product;
    use App\Models\User;
    use Illuminate\Support\Str;
    use App\Exports\OrdersExport;
    use Maatwebsite\Excel\Facades\Excel;
    
    class OrderController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }
        
        public function index()
        {
            $orders=Orders::orderBy('id','DESC')->get();
            return view('order.index')->with('orders',$orders);
        }
        
        
        public function create()
        {
            $countries = Country::orderBy('id','ASC')->get();
            $products = Product::orderBy('id','ASC')->get();
            $users = User::where('role','=','user')->get();
            return view('order.create',compact('countries','products','users'));
        }
        
        public function store(Request $request)
        {
            $this->validate($request,[
            'first_name'=>'string|required',
            'last_name'=>'string|required',
            'email'=>'string|required',
            'phone'=>'numeric|required',
            'country'=>'string|required',
            'post_code'=>'string|required',
            'address1'=>'string|required',
            'address2'=>'string|nullable',
            ]);
            
            $order=new Orders();
            $order_data=$request->all();
            $order_data['order_number']='ORD-'.strtoupper(Str::random(10));
            $order_data['user_id']=$request->user_id;
            
            
            $order->fill($order_data);
            $status=$order->save();
            $total_amount = 0;
            $total_qty = 0;
            if($order){
                OrdersDetails::where('order_id','=',$order->id)->delete();
                foreach($order_data['products'] as $product  ){
                    $order_detail = new OrdersDetails();
                    $prd_data['product_id']= $product;
                    $prd_data['order_id']=$order->id;
                    $product_detail = Product::where('id','=',$product)->first();
                    $prd_data['price']= $product_detail->price;
                    //Generate a random number to fill the quantity of a product(It is a simple way for a simple test)
                    //In real projects we get the product list from the cart of the client
                    $qty = rand(1,10);
                    $prd_data['quantity']= $qty;
                    $prd_data['amount']= $product_detail->price*$qty;
                    $total_amount += $product_detail->price*$qty;
                    $total_qty += $qty;
                    $order_detail->fill($prd_data);
                    $status=$order_detail->save();
                }
            }
            Orders::where('id', '=' , $order->id)->update(['quantity' => $total_qty, 'total_amount' => $total_amount]);
            
            
            request()->session()->flash('success','Your order successfully placed');
            
            return redirect()->route('order-index');
        }
        
        
        public function show($id)
        {
            $order = Orders::where('id','=',$id)->first();
            $client_products = OrdersDetails::where('order_id','=',$id)
            ->join('products','orders_details.product_id','=','products.id')->get();
            
            return view('order.show',compact('order','client_products'));
        }
        
        public function edit($id)
        {
            $countries = Country::orderBy('id','ASC')->get();
            $products = Product::orderBy('id','ASC')->get();
            $users = User::where('role','=','user')->get();
            $order = Orders::where('id','=',$id)->first();
            $client_products = OrdersDetails::where('order_id','=',$id)->select('product_id')->pluck('product_id')->toArray();
            
            return view('order.edit',compact('countries','products','users','order','client_products'));
        }
        
        
        public function update(Request $request, $id)
        {
            $order = Orders::find($id);
            $this->validate($request,[
            'first_name'=>'string|required',
            'last_name'=>'string|required',
            'email'=>'string|required',
            'phone'=>'numeric|required',
            'country'=>'string|required',
            'post_code'=>'string|required',
            'address1'=>'string|required',
            'address2'=>'string|nullable',
            ]);
            
            
            $order_data=$request->all();
            $order_data['order_number']='ORD-'.strtoupper(Str::random(10));
            $order_data['user_id']=$request->user_id;
            
            
            $order->fill($order_data);
            $status=$order->save();
            $total_amount = 0;
            $total_qty = 0;
            if($order){
                OrdersDetails::where('order_id','=',$order->id)->delete();
                foreach($order_data['products'] as $product  ){
                    $order_detail = new OrdersDetails();
                    $prd_data['product_id']= $product;
                    $prd_data['order_id']=$order->id;
                    $product_detail = Product::where('id','=',$product)->first();
                    $prd_data['price']= $product_detail->price;
                    //Generate a random number to fill the quantity of a product(It is a simple way for a simple test)
                    //In real projects we get the product list from the cart of the client
                    $qty = rand(1,10);
                    $prd_data['quantity']= $qty;
                    $prd_data['amount']= $product_detail->price*$qty;
                    $total_amount += $product_detail->price*$qty;
                    $total_qty += $qty;
                    $order_detail->fill($prd_data);
                    $status=$order_detail->save();
                }
            }
            Orders::where('id', '=' , $order->id)->update(['quantity' => $total_qty, 'total_amount' => $total_amount]);
            
            
            request()->session()->flash('success','Your order successfully placed');
            
            return redirect()->route('order-index');
        }
        
        public function destroy($id)
        {
            $order=Orders::find($id);
            if($order){
                OrdersDetails::where('order_id','=',$id)->delete();
                $status=$order->delete();
                if($status){
                    request()->session()->flash('success','Order Successfully deleted');
                }
                else{
                    request()->session()->flash('error','Order can not deleted');
                }
                return redirect()->route('order-index');
            }
            else{
                request()->session()->flash('error','Order can not found');
                return redirect()->back();
            }
        }
        
        public function export() 
        {
            return Excel::download(new OrdersExport, 'Orders.xlsx');
        }
    }
