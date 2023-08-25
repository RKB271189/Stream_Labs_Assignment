<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchSale extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'item_name',
        'amount',
        'price'
    ];
}
