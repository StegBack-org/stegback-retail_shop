<?php

namespace Stegback\RetailShop\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Stegback\RetailShop\Models\Store;
use Stegback\RetailShop\Models\Wallet;
use Stegback\RetailShop\Models\StoreOrder;
use Stegback\RetailShop\Models\StoreProduct;
use App\Http\Controllers\PushkarController;

class StoreDashboard extends Controller
{
    public $orderTable, $order_product_table, $orderModel, $productModel;
    public $productTable;
    public $orderProductTable;
    public function __construct()
    {
        $this->orderModel = config('retailshop.OrderModel');
        $this->productModel = config('retailshop.ProductModel');

        $this->orderTable = config('retailshop.order_table');
        $this->order_product_table = config('retailshop.order_product_table');
        $this->productTable = config('retailshop.product_table');
        $this->orderProductTable = config('retailshop.order_product_table');
    }
    private function status()
    {
        return ['completed', 'pending', 'on-hold'];
    }

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
        $orderNumberColumn = config('retailshop.order_number_column');
        $data = StoreOrder::pluck('order_no');
        $data = $this->orderModel::whereIn($orderNumberColumn, $data)->get();
        // $data = DB::table($this->orderTable)->whereIn($orderNumberColumn, $data)->get();
        return view('RetailShop::dashboard.orders.order_list', compact('data'));
    }

    public function order_create()
    {
        $Skus = DB::table('store_products')->where('user_id', auth()->id())->select('id', 'sku')->get()->toArray();

        return view('RetailShop::dashboard.orders.order_create', [
            'all_skus' => $Skus,
            'status_arr' => $this->status(),
        ]);
    }
    public function order_store(Request $request)
    {

        $order_validation = request()->validate([

            'order_date' => 'required|date',
            'payment_type' => 'nullable|string',
            'status' => 'required|string',
            'order_note' => 'nullable|string',
            'shipping_first_name' => 'nullable|string',
            'shipping_last_name' => 'nullable|string',
            'shipping_company_name' => 'nullable|string',
            'shipping_email' => 'nullable|email',
            'shipping_phone' => 'nullable|string',
            'shipping_street_1' => 'nullable|string',
            'shipping_street_2' => 'nullable|string',
            'shipping_street_3' => 'nullable|string',
            'shipping_country' => 'nullable|string',
            'shipping_city' => 'nullable|string',
            'shipping_pincode' => 'nullable|string',
            'shipping' => 'nullable|string',
        ]);
        $order_product_validation = request()->validate([
            'wc_esd_date' => 'required|array',
            'wc_esd_date.*' => 'required|date',
            'sku' => 'required|array',
            'sku.*' => 'required|string',
            'product_name' => 'required|array',
            'product_name.*' => 'required|string',
            'quantity' => 'required|array',
            'quantity.*' => 'required|numeric',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
        ]);

        // Insert the validated data into the orders table
        $orderId = DB::table($this->orderTable)->insertGetId($order_validation);

        // Iterate through each product in the order and insert it into the order products table
        foreach ($order_product_validation['sku'] as $index => $sku) {
            $orderProductData = [
                'order_id' => $orderId,
                'wc_esd_date' => $order_product_validation['wc_esd_date'][$index],
                'sku' => $order_product_validation['sku'][$index],
                // 'product_name' => $order_product_validation['product_name'][$index],
                'quantity' => $order_product_validation['quantity'][$index],
                'price' => $order_product_validation['price'][$index],
                // Add any other fields you want to insert into the order products table
            ];

            // Insert the order product data into the order products table
            DB::table($this->orderProductTable)->insert($orderProductData);

            return redirect('retail-shop/order-list')->with('success', 'Order created successfully !');
        }
    }


    public function order_view($order_no)
    {
        if (!$order_no) return redirect()->back()->with('error', 'invalid access');
        $orderNumberColumn = config('retailshop.order_number_column');
        $data = $this->orderModel::where($orderNumberColumn, $order_no)->with('gconfigoods')->first();
        return view('RetailShop::dashboard.orders.order_view', compact('data'));
    }

    public function product_list()
    {
        $ProductTable = $this->productTable;    

        $store_products = json_decode(DB::table('store_products')
            ->join($ProductTable, 'store_products.product_id', '=', "$ProductTable.id")
            ->select('store_products.*', "$ProductTable.*")
            ->where('user_id', auth()->user()->id)->get(),true);
       
        return view('RetailShop::dashboard.products.list', compact('store_products'));
    }
    public function product_view($product_id = null)
    {
        if (!$product_id) return redirect()->back()->with('error', 'invalid access');

        $product = $this->productModel::where('id', $product_id)->first();
        // $PushkarController = new PushkarController;
        // $not_send_data = $PushkarController->get_open_order(@$product['sku']);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        return view('RetailShop::dashboard.products.view', compact('product'));
    }
}
