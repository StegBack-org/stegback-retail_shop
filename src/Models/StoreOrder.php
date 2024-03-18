<?php

namespace Stegback\RetailShop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stegback\RetailShop\Traits\HaveUser;

class StoreOrder extends Model
{
    use HaveUser;
    use HasFactory;
}
