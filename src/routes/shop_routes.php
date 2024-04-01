<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stegback\RetailShop\Http\StoreAuth;
use Stegback\RetailShop\Http\StoreManage;
use Stegback\RetailShop\Http\StoreDashboard;

Route::get('/retail-shop', [StoreAuth::class, 'loginView'])->name('RetailShop.loginView');
Route::post('/retail-shop/login', [StoreAuth::class, 'login'])->name('RetailShop.login');

Route::get('/retail-shop/password-reset', [StoreAuth::class, 'password_reset'])->name('RetailShop.password_reset');
Route::POST('/retail-shop/reset', [StoreAuth::class, 'reset'])->name('RetailShop.reset');


Route::middleware(['auth'])->prefix('/retail-shop/manage/')->middleware('auth')->name('RetailShop.')->group(function () {
    Route::get('/dashboard', [StoreManage::class, 'admin_dashbboard'])->name('admin-dashboard');
    Route::get('/store-list', [StoreManage::class, 'store_list'])->name('store_list');
    Route::get('/store_add', [StoreManage::class, 'store_add'])->name('store_add');
    Route::POST('/store_add', [StoreManage::class, 'store_save'])->name('store_save');
    Route::get('/assign-product', [StoreManage::class, 'assign_product'])->name('assign_product');
    Route::post('/assign-product-store', [StoreManage::class, 'assign_product_store'])->name('assign_product_store');
    Route::get('/sku/list/{id?}', [StoreManage::class, 'get_sku_list'])->name('get_sku_list');

    Route::get('/store-view', [StoreManage::class, 'store_view'])->name('store_view');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('RetailShop.loginView');
    })->name('admin.logout'); // 
});

Route::middleware(['auth:retail_shop'])->prefix('/retail-shop')->middleware('auth:stores')->name('RetailShop.')->group(function () {

    Route::get('/logout', [StoreAuth::class, 'logout'])->name('logout');
    Route::get('/dashboard', [StoreDashboard::class, 'store_dashboard'])->name('store-dashboard');
    Route::get('/wallet', [StoreDashboard::class, 'wallet'])->name('store-wallet');

    /**
     * order routes
     */

    Route::get('/order-list', [StoreDashboard::class, 'order_list'])->name('order_list');
    Route::get('/order-create', [StoreDashboard::class, 'order_create'])->name('order_create');

    Route::post('/order-store', [StoreDashboard::class, 'order_store'])->name('order_store');
    Route::get('/order-view/{order_id}', [StoreDashboard::class, 'order_view'])->name('order_view');

    /**
     * Product routes
     */
    Route::get('/product-list', [StoreDashboard::class, 'product_list'])->name('product_list');
    Route::get('/product-view/{product_id?}', [StoreDashboard::class, 'product_view'])->name('product_view');

    // Route::get('/get-history', [StoreManage::class, 'getHistory']);
});
