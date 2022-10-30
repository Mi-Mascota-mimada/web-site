<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateProduct extends Model
{
    use HasFactory;
    
    protected $table = "rate_product";

    protected $fillable = [
        'user_id',
        'product_id',
        'rate'
    ];
}
