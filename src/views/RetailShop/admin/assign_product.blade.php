@extends('RetailShop::layouts.app')
@section('content')
<main>
    <style>
        input.largerCheckbox {
            transform: scale(2);
        }
    </style>
    <div class="mx-5 ">
        <div class="row">
            <div class="col-xl-12">
                <h1 class="pb-2" style="font-size:22px"></h1>
                <nav aria-label="breadcrumb" style="bs-breadcrumb-divider: '>'">
                    <ol class="breadcrumb">
                    </ol>
                </nav>
            </div>
            <form class="form-horizontal" action="{{ route('RetailShop.assign_product_store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h4>Assign Product </h4><br>
                                </div>

                                <div class="validation-errors">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>

                                <div class="col-6 " id="product-fields-container">
                                    <div class="row mx-1">
                                        <div class="col-3">
                                            <label class="control-label font-weight-bold my-3" for="sku">Store User</label><br>
                                            <select class="form-control" name="user_id" required>
                                                <option value="">Select user</option>
                                                @foreach($store_users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mx-1 product-fields">
                                        <div class="col-3">
                                            <label class="control-label font-weight-bold my-3" for="sku">Sku</label><br>
                                            <select class="form-control sku" name="sku" required>
                                                <option value="">Select sku</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="control-label font-weight-bold my-3" for="product_name">Product Name</label><br>
                                            <input class="form-control product-name" type="text" name="product_name" readonly>
                                        </div>
                                        <div class="col-3">
                                            <label class="control-label font-weight-bold my-3" for="single_product_price">Single Product Price</label><br>
                                            <input class="form-control single-product-price" type="text" name="single_product_price" readonly>
                                        </div>
                                        
                                          
                                           
                                     
                                        <div class="col-3">
                                            <label class="control-label font-weight-bold my-3" for="quantity">Quantity</label><br>
                                            <input class="form-control" type="text" name="quantity">
                                        </div>
                                    </div>
                                </div>

                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" style="background-color: #37517e; color: #fff;">{{__('Submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    

    // Function to fetch sku list via AJAX
    function fetchSkuList(selectElement) {
        $.ajax({
            url: "{{ route('RetailShop.get_sku_list') }}",
            type: 'GET',
            success: function(data) {
                // Populate the select element with options
                var select = selectElement;
                select.find('option').remove();

                select.append($('<option>').text('Select sku').attr('value', ''));
                $.each(data.data, function(id, sku) {

                    select.append($('<option>').text(sku.sku).attr('value', sku.id+','+sku.sku));
                });
            }
        });
    }

    // Function to fetch product details based on selected SKU
    function fetchProductDetails(selectElement) {
        var sku = selectElement.val();
        var row = selectElement.closest('.product-fields');

        $.ajax({
            url: "{{ route('RetailShop.get_sku_list', ['id' => ':id']) }}".replace(':id', sku),
            type: 'GET',

            success: function(data) {
                // Populate product name and single product price fields

                row.find('.product-name').val(data.data.name);
                row.find('.single-product-price').val(data.data.buying_price);
             
            }
        });
    }

    $(document).ready(function() {
        // Fetch SKU list for the first row
        fetchSkuList($('.sku').first());

        // Add change event listener to dynamically created select elements
        $(document).on('change', '.sku', function() {
            fetchProductDetails($(this));
        });
    });
</script>
@endsection