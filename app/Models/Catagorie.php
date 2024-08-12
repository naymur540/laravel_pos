<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagorie extends Model
{
    use HasFactory;

    protected $table ='catagories';
    protected $fillable=['catagorie_name','status'];
}
