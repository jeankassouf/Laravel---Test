<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersDetails extends Model
{
    protected $fillable=['user_id','product_id','order_id','quantity','amount','price'];
    
   
    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function order(){
        return $this->belongsTo(Orders::class,'order_id');
    }
}
