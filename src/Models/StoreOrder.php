<?php

namespace Stegback\RetailShop\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Stegback\RetailShop\Traits\HaveUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreOrder extends Model
{
    use HaveUser;
    use HasFactory;

    public static function stegback_orders()
    {
        $orders = DB::table('store_orders')
            ->join('orders', 'store_orders.order_no', '=', 'orders.order_no')
            // ->where('store_orders.user_id', auth()->id())
            ->select('orders.*')
            ->get()
            ->toArray();

        // Convert each object to associative array
        $ordersArray = array_map(function ($order) {
            return json_decode(json_encode($order), true);
        }, $orders);

        return $ordersArray;
    }
}
