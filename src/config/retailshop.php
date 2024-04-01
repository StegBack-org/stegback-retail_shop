<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Order table Detail
    |--------------------------------------------------------------------------
    |
    */
    'OrderModel' => App\Models\Order::class,
    'ProductModel' => App\Models\Good::class,

    'order_table' => 'orders',
    'order_product_table' => 'order_products',

    'order_number_column' => 'order_no', // to find order details

    /*
    |--------------------------------------------------------------------------
    | Product table Detail
    |--------------------------------------------------------------------------
    |
    */
    'product_table' => 'goods',

    'product_id' => '', // Primary Key

    'product_sku' => 'sku', // column
    'order_history_type' => 'store_order',
    'product_history_type' => 'store_product',


];
