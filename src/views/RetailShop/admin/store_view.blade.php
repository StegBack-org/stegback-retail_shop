@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
<ul>
    <li>{{$storeDetails->name}}</li>
    <li>{{$storeDetails->storeName}}</li>
    <li>{{$storeDetails->address ?? '-'}}</li>
    <li>{{$storeDetails->pincode}}</li>
    </ul>
</div>
@endsection