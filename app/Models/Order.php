<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    

    protected $table ='orders';
    protected $fileable=['name','address'];

    // In your Order model
    public function orderDetails()
    {
        return $this->hasMany(Order_Detail::class);
    }
    

}
