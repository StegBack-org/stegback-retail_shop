@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card" >
                <div class="card-body">
                  <h6 class="card-title text-muted">Total Stores</h6>
                  <p class="card-text">{{DB::table('stores')->count()}}</p>
                  <a href="#" class="card-link">View All</a>
                </div>
              </div>
            </div>
        <div class="col-md-3">
            <div class="card" >
                <div class="card-body">
                  <h6 class="card-title text-muted">Total Goods SKU</h6>
                  <p class="card-text">{{DB::table('store_products')->count()}}</p>
                  <a href="#" class="card-link">View All</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" >
                <div class="card-body">
                <h6 class="card-title text-muted">Total Orders</h6>
                <p class="card-text">{{DB::table('store_orders')->count()}}</p>
                  <a href="#" class="card-link">View Orders</a>
                </div>
              </div>
        </div>
        <div class="col-md-3">
            <div class="card" >
                <div class="card-body">
                <h6 class="card-title text-muted">Total Commission earned</h6>
                <p class="card-text">${{DB::table('wallets')->sum('credit')}}</p>
                  <a href="#" class="card-link">View wallet</a>
                </div>
              </div>
        </div>
    </div>

</div>

@endsection