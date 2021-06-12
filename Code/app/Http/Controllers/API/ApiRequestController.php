<?php
    
    namespace App\Http\Controllers\API;
    
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Orders;
    use App\Models\OrdersDetails;
    use App\Models\Country;
    use App\Models\Product;
    use App\Models\User;
    
    class ApiRequestController extends Controller
    {
        public function get_all_orders(){
            
            $orders = User::with('orders','orders.ordersDetails','orders.ordersDetails.product')
                        ->where('role','=','user')->get();
            
            return response()->json($orders,200);
        }
    }
