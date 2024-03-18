<?php

namespace Stegback\RetailShop\Models;

use Illuminate\Database\Eloquent\Model;
use Stegback\RetailShop\Traits\HaveUser;

class Wallet extends Model
{
    use HaveUser;

    protected $fillable = [
        'activity', 'debit', 'credit', 'user_id', 'status'
    ];
}
