<?php

namespace Stegback\RetailShop\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Stegback\RetailShop\Models\Store;
use Stegback\RetailShop\Models\StoreOrder;
use Stegback\RetailShop\Models\StoreProduct;
use Stegback\RetailShop\Models\Wallet;

class StoreDashboard extends Controller
{
    public function store_dashboard()
    {
        $user = Store::whereId(auth()->user()->id)
            ->with('commission', 'products', 'orders')
            ->first();

        return view('RetailShop::dashboard.index', compact('user'));
    }

    public function wallet()
    {
        $wallet = Wallet::get();
        return view('RetailShop::dashboard.wallet', compact('wallet'));
    }

    public function order_list()
    {
        $store_order = StoreOrder::get();
        return view('RetailShop::dashboard.orders.order_list', compact('store_order'));
    }

    public function order_view($order_no)
    {
        if (!$order_no) return redirect()->back()->with('error', 'invalid access');
        $orderTable = config('retailshop.order_table');

        $orderNumberColumn = config('retailshop.order_number_column');

        $order_data = DB::table($orderTable)->where($orderNumberColumn, $order_no)->first();

        return view('RetailShop::dashboard.orders.order_view', compact('order_data'));
    }

    public function product_list()
    {
        $ProductTable = config('retailshop.product_table');
        $store_products = DB::table('store_products')
            ->join($ProductTable, 'store_products.product_id', '=', "$ProductTable.id")
            ->select('store_products.*', "$ProductTable.*")
            ->where('user_id', auth()->user()->id)->get();
        return view('RetailShop::dashboard.products.list', compact('store_products'));
    }
    public function product_view($product_id = null)
    {
        if (!$product_id) return redirect()->back()->with('error', 'invalid access');

        $ProductTable = config('retailshop.product_table');
        $product_data = DB::table($ProductTable)
            ->where("$ProductTable.id", $product_id)
            ->join('store_products', "$ProductTable.id", '=', "store_products.product_id")
            ->first();

        if (!$product_data) {
            return redirect()->back()->with('error', 'Product not found');
        }
        return view('RetailShop::dashboard.products.view', compact('product_data'));
    }
}
