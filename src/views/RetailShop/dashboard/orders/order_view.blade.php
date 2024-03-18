@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
    <div>
        @if($order_data)
            <p>Order Number: {{ $order_data->order_no }}</p>
            <p>Customer Name: {{ $order_data->customer_name }}</p>
            <!-- Add more properties as needed -->
        @else
            <p>No order data available.</p>
        @endif
    </div>
</div>

@endsection