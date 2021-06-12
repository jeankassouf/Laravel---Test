<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Orders extends Model
    {
        protected $fillable=[
            'order_number',
            'user_id',
            'total_amount',
            'quantity',
            'first_name',
            'last_name',
            'email',
            'phone',
            'country',
            'post_code',
            'address1',
            'address2'
        ];
        
        public static function countAllOrders(){
            $data=Orders::count();
            if($data){
                return $data;
            }
            return 0;
        }
        public function ordersDetails(){
            return $this->hasMany('App\Models\OrdersDetails','order_id');
        }
        
       
        public function user()
        {
            return $this->belongsTo('App\Models\User', 'user_id');
        }
    }
