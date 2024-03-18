@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
    <div>
        @if($product_data)
            <p>Product Name: {{ $product_data->name }}</p>
            <p>SKU: {{ $product_data->sku }}</p>
            <p>Quantity: {{ $product_data->quantity }}</p>
        @else
            <p>No order data available.</p>
        @endif
    </div>
</div>
@endsection