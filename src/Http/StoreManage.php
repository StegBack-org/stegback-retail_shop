<?php

namespace Stegback\RetailShop\Http;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Stegback\RetailShop\Models\Store;
use Illuminate\Support\Facades\Validator;
use Stegback\RetailShop\Traits\LogActivity;
use Stegback\RetailShop\Models\StoreHistory;
use Stegback\RetailShop\Models\StoreProduct;
use Stegback\RetailShop\Helpers\CommonHelper;
use Stegback\RetailShop\Mail\PasswordResetEmail;

class StoreManage extends Controller
{

    protected $history_type;
    public function __construct()
    {
        $this->history_type = CommonHelper::HistoryType();
    }
    public function admin_dashbboard()
    {
        return view('RetailShop::admin.dashboard');
    }

    public function store_list()
    {
        $store_list = Store::get(); // User table 
        return view('RetailShop::admin.store_list', compact('store_list'));
    }

    public function store_add(Request $request)
    {
        return view('RetailShop::admin.store_add');
    }

    public function store_save(Request $request)
    {
        $user = Store::create([
            'name' => $request->name,
            'storeName' => $request->storeName,
            'email' => $request->email,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'role' => 'store',
            'active' => 0,
            'remember_token' => Str::uuid(),
        ]);

        if ($user) {
            $token = Str::random(60);
            $user->password_reset_token = $token;
            $user->save();
            Mail::to($request->email)->send(new PasswordResetEmail($token));

            return redirect()->route('RetailShop.store_list')->with('success', 'User created successfully. Check your email for password reset instructions.');
        } else {
            return back()->withInput()->with('error', 'Failed to create user.');
        }
        return redirect()->route('RetailShop.store_list');
    }
    public function assign_product_store(Request $request)
    {
        $data = explode(',', $request->sku);

        $id = $data[0];
        $sku = $data[1];

        // Validate the incoming request data
        $validator = Validator::make(array_merge(['id' => $id], $request->all()), [
            'user_id' => 'required|integer|exists:stores,id',
            'quantity' => 'required|integer',
            'id' => 'required|integer|exists:goods,id',
        ]);

        // If validation fails, return the validation errors
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput()->setStatusCode(422);
        }

        $existingRecord = DB::table('store_products')
            ->where('user_id', $request->input('user_id'))
            ->where('product_id', $id)
            ->first();


        if ($existingRecord) {
            // If the combination already exists, increment the quantity
            DB::table('store_products')
                ->where('user_id', $request->input('user_id'))
                ->where('product_id', $id)
                ->increment('quantity', $request->input('quantity'));
            $history = [
                'text' => 'added product quantity',
                'quantity' => $request->input('quantity'),
            ];


            StoreHistory::saveHistory($request->input('user_id'), $existingRecord->id, $this->history_type['store_product'], $history);
        } else {
            // If the combination doesn't exist, create a new entry
            $data = [
                'user_id' => $request->input('user_id'),
                'product_id' => $id,
                'quantity' => $request->input('quantity'),
                'sku' => $sku,
            ];

            // Perform insert and get the ID of the inserted record
            $insertedId = DB::table('store_products')->insertGetId($data);

            $history = [
                'text' => 'added product ',
                'quantity' => $request->input('quantity'),
            ];

            StoreHistory::saveHistory($request->input('user_id'), $insertedId, $this->history_type['store_product'], $history);
        }

        return back()->with('success', 'Product assigned successfully.');
    }

    public function assign_product()
    {
        $store_users = DB::table('stores')->select('id', 'name')->get();
        return view('RetailShop::admin.assign_product', ['store_users' => $store_users]);
    }

    public function store_view(Request $request)
    {
        $id = base64_decode($request['i']);
        $storeDetails = Store::findOrFail($id);
        $storeDetails['products'] = DB::table('store_products')->where('user_id', $storeDetails->id)->get();
        return view('RetailShop::admin.store_view', compact('storeDetails'));
    }

    public function get_sku_list(Request $request, $id = null)
    {

        try {
            $query = DB::table('goods');

            if ($id) {
                $data = $query->where('id', $id)->select('id', 'name', 'buying_price', 'sku')->first();
            } else {
                $data = $query->select('id', 'sku')->get()->toArray();
            }
            return response()->json(['status' => 200, 'data' => $data, 'message' => 'Skus fetched successfully !'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 501, 'message' => 'Something went wrong ! ' . $th->getMessage(), 'trace' => $th->getTrace()], 200);
        }
    }

    public function getHistory()
    {
        return 'sgdh';
    }
}
