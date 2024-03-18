@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card" >
                <div class="card-body">
                  <h6 class="card-title text-muted">Total Inventry</h6>
                  <p class="card-text">320</p>
                  <a href="#" class="card-link">View All</a>
                </div>
              </div>
            </div>
        <div class="col-md-3">
            <div class="card" >
                <div class="card-body">
                  <h6 class="card-title text-muted">Total Goods SKU</h6>
                  <p class="card-text">120</p>
                  <a href="#" class="card-link">View All</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" >
                <div class="card-body">
                <h6 class="card-title text-muted">Total Orders</h6>
                  <p class="card-text">980</p>
                  <a href="#" class="card-link">View Orders</a>
                </div>
              </div>
        </div>
        <div class="col-md-3">
            <div class="card" >
                <div class="card-body">
                <h6 class="card-title text-muted">Total Commission Received</h6>
                  <p class="card-text">$7890</p>
                  <a href="#" class="card-link">View wallet</a>
                </div>
              </div>
        </div>
    </div>

    <div class="mt-5 ">

    </div>
</div>
@endsection