@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
    <ul>
        <li>{{$storeDetails->name}}</li>
        <li>{{$storeDetails->storeName}}</li>
        <li>{{$storeDetails->address ?? '-'}}</li>
        <li>{{$storeDetails->pincode}}</li>
    </ul>

    <div class="row mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sku</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $serial = 1; @endphp
                @foreach ($storeDetails['products'] as $product)
                <tr>
                    <th scope="row">{{$serial}}</th>
                    <td>{{$product->sku ?? '-'}}</td>
                    <td>{{$product->quantity ?? '-'}}</span></td>

                    <td>
                    </td>
                </tr>
                @php $serial ++ ; @endphp
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection