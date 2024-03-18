@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row mt-4">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">SKU</th>
                <th scope="col">type</th>
                <th scope="col">Quantiy</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php $serial = 1; @endphp
                @foreach ($store_products as $product)
                <tr>
                    <th scope="row">{{$serial}}</th>
                    <td><a href="{{route('RetailShop.product_view',[$product->product_id])}}">{{$product->name ?? '-'}}</a></td>
                    <td>{{$product->sku}}</td>
                    <td>{{$product->product_categ}}</td>
                    <td>{{$product->quantity}}</td>
                    <td></td>
                </tr>
                @php $serial ++ ; @endphp
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection