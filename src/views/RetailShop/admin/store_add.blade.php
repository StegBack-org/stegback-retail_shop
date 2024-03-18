@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">

    <form class="row g-3" action="" method="POST">
        @csrf
        <div class="col-md-6">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="inputName">
          </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label">Address</label>
          <textarea type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St"></textarea>
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Store Name</label>
          <input type="text" name="storeName" class="form-control" id="inputCity">
        </div>
       
        <div class="col-md-6">
          <label for="inputZip" class="form-label">Zip</label>
          <input type="text" name="pincode" class="form-control" id="inputZip">
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
      </form>


</div>
@endsection