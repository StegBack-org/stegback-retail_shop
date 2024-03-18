<?php

namespace Stegback\RetailShop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Store extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'role', 'storeName', 'active', 'address', 'pincode', 'remember_token'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
    protected $guarded = [];

    public function commission()
    {
        return $this->hasMany(Wallet::class, 'user_id');
    }
    public function products()
    {
        return $this->hasMany(StoreProduct::class, 'user_id');
    }
    public function orders()
    {
        return $this->hasMany(StoreOrder::class, 'user_id');
    }
}
