<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   

    protected $table='products';
    protected $fileable=['product_name','product_brand','product_catagorie','sell_price','price','quantity','alert_stock'];


    public function orderdetails(){
        return $this->hashMany('App\Models\Order_Detail');
    }
}
