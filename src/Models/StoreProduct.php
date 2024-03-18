<?php

namespace Stegback\RetailShop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stegback\RetailShop\Traits\HaveUser;

class StoreProduct extends Model
{
    use HaveUser;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'sku',
        'quantity'
    ];
}
