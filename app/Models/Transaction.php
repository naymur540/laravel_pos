<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   

    protected $table ='transactions';
    protected $fileable=['order_id','paid_amount','balance','payment_method','user_id','transac_date','transac_amount'];
}
