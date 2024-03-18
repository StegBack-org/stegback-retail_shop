
@extends('RetailShop::layouts.app')
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">

            <div class="col-md-3" style="text-align: center;margin-top:100px">
                <div class="card">
                    <h3 class="card-header text-center">{{__('Login')}}</h3>
                    <div class="card-body">
                        <form method="POST" action="{{route('RetailShop.login')}}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="{{__('Email')}}" id="email" class="form-control" value="kartik@stegpearl.com" name="email" required autofocus>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="{{__('Password')}}" id="password" class="form-control" value="Admin@123$#@!" name="password" >
                            </div>
                            <div class="form-group mb-3">
                                <a class="mt-4" href="#">Forget Password</a>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block" style="background-color:#36517f;border-color: #36517f;">{{__('Login')}}</button>
                            </div>
                        </form>
                        @if(session('errors'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach(session('errors') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

