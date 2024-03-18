<?php

namespace Stegback\RetailShop\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stegback\RetailShop\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Stegback\RetailShop\Mail\PasswordResetEmail;

class StoreManage extends Controller
{
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

    public function assign_product()
    {
        return view('RetailShop::admin.assign_product');
    }

    public function store_view(Request $request)
    {
        $id = base64_decode($request['i']);
        $storeDetails = Store::findOrFail($id);
        return view('RetailShop::admin.store_view', compact('storeDetails'));
    }
}
