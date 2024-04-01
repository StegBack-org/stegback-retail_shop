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
        <h1 class="pb-2" style="font-size:22px">Add Order</h1>
        <nav aria-label="breadcrumb" style="bs-breadcrumb-divider: '>'">
          <ol class="breadcrumb">


          </ol>
        </nav>
      </div>
      <form class="form-horizontal" action="{{route('RetailShop.order_store')}}" method="post" enctype='multipart/form-data'>
        @csrf
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <h4>Add Order Details </h4><br>
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




                <div class="col-6 " id="order_noo">

                  <div class="row mx-1">
                    <label class="control-label font-weight-bold my-3" for="pwd">Order Date</label><br>
                    <input class="form-control" type="date" name="order_date" required>
                  </div>
                  <div class="row mx-1">
                    <label class="control-label font-weight-bold my-3" for="pwd">Payment Type</label><br>
                    <input class="form-control" type="text" name="payment_type" value="Amazon Payment">
                  </div>
                  <div class="row mx-1">
                    <label class="control-label font-weight-bold my-3" for="pwd">Order Status</label><br>
                    <select class="form-control" name="status" required>
                      <option value=" ">Select Status </option>
                      @if(!empty($status_arr))
                      @foreach($status_arr as $status)
                      <option value="{{ $status }}">{{ $status }}</option>
                      @endforeach
                      @endif
                    </select>

                  </div>
                </div>





                <div class="col-6">
                  <label class="control-label font-weight-bold my-3" for="pwd">Order Note</label><br>
                  <textarea class="form-control" name="order_note" rows="13"></textarea>
                </div>

              </div>
              <br>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <h4>Shipping Address </h4><br>
                </div>
                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="pwd">Customer First Name</label><br>
                  <input class="form-control" type="text" name="shipping_first_name">
                </div>
                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="pwd">Customer Last Name</label><br>
                  <input class="form-control" type="text" name="shipping_last_name">
                </div>
                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="pwd">Comapny Name</label></label><br>
                  <input class="form-control" type="text" name="shipping_company_name">
                </div>
                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="email1">{{__('CustomerEmail')}}</label><br>
                  <input type="email" id="email1" class="form-control" name="shipping_email">
                </div>
                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="pwd">{{__('CustomerPhone')}}</label><br>
                  <input class="form-control" id="phone1" type="text" name="shipping_phone">
                </div>
                <div class="col-8">
                  <label class="control-label font-weight-bold my-3" for="pwd">Address 1</label><br>
                  <input type="text" class="form-control" name="shipping_street_1">
                </div>
                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="pwd">Address 2</label><br>
                  <input type="text" class="form-control" name="shipping_street_2">
                </div>
                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="pwd">Address 3</label><br>
                  <input type="text" class="form-control" name="shipping_street_3">
                </div>

                <div class="col-4">
                  <label class="control-label font-weight-bold my-3">{{ __('Country') }}</label>
                  <select name="shipping_country" class="form-control" required>
                    <?php //$countries = ['DE','AT','NL','GB','CH','IT','GR','FR','HU','ES','NO','BG','DK','SE','FI','IE','EE','BE']; 
                    ?>
                    <?php $countries = ['DE' => 'Germany', 'AT' => 'Austria', 'NL' => 'Netherlands', 'GB' => 'United Kingdom', 'CH' => 'Switzerland', 'LU' => 'Luxemburg', 'IT' => 'Italy', 'GR' => 'Greece', 'FR' => 'France', 'HU' => 'Hungary', 'ES' => 'Spain', 'NO' => 'Norway', 'BG' => 'Bulgaria', 'DK' => 'Denmark', 'SE' => 'Sweden', 'FI' => 'Finland', 'IE' => 'Ireland', 'EE' => 'Estonia', 'BE' => 'Belgium'] ?>
                    <option value="">Select Country</option>
                    @foreach($countries as $key=>$value)
                    <option value="{{@$key}}">{{@$value}}</option>
                    @endforeach
                  </select>

                </div>


                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="pwd">{{__('City')}}</label><br>
                  <input class="form-control" name="shipping_city">
                </div>
                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="pwd">{{__('Pincode')}}</label><br>
                  <input class="form-control" name="shipping_pincode">
                </div>
              </div>
              <br>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="alert alert-danger" role="alert">Use german format for prices, for example 1.299,99 </div>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <label class="control-label font-weight-bold my-3" for="pwd">Shipping price</label><br>
                  <input class="form-control" type="text" min='0' name="shipping" placeholder="0" value="0">
                </div>
              </div>
              <div class="row p-2">
                <span class="orderss w-100">

                  <div class="row orderss_data mb-3">
                    <div class="col-lg-2">
                      <label class="control-label font-weight-bold my-3" for="pwd">{{__('EstDeliveryDate')}}</label><br>
                      <input class="form-control" type="date" name="wc_esd_date[]" required>
                    </div>


                    <div class="col-lg-3">
                      <label class="control-label font-weight-bold my-3" for="pwd">{{__('Sku')}}</label><br>
                      <!--<input class="form-control" type="text" name="sku[]"  required>-->

                      <select class="form-select w-100" name="sku[]" onchange="getskuvalue(this,1)">
                        <option value=""> {{__('choosesku')}} </option>
                        @foreach($all_skus as $a_sku)
                        <option value="{{ @$a_sku->sku }}">{{ @$a_sku->sku  }}</option>
                        @endforeach
                      </select>

                    </div>

                    <div class="col-lg-3">
                      <label class="control-label font-weight-bold my-3" for="pwd">{{__('ProductName')}}</label><br>
                      <input class="form-control" id="product-name-1" type="text" name="product_name[]" required>
                    </div>

                    <div class="col-lg-2">
                      <label class="control-label font-weight-bold my-3" for="pwd">{{__('Quantity')}}</label><br>
                      <input class="form-control" type="number" value="1" name="quantity[]" required>
                    </div>
                    <div class="col-lg-2">
                      <label class="control-label font-weight-bold my-3" for="pwd">{{__('TotalPrice')}}<small>(Ex:Price * Qty)</small></label><br>
                      <input id="product-price-1" class="form-control product-price" type="text" name="price[]" required>
                    </div>
                    <div class="col-lg-2">

                    </div>
                  </div>
                </span>
                <div onclick="addmore()" class="btn btn-primary w-25 mt-3">{{__('AddMoreProducts')}}</div>
              </div>
              <br>
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
  var count = 2;

  function addmore() {
    var i = count++;
    $('.orderss').append('<div id="order-product-' + i + '" class="row orderss_data mt-3"><div class="col-lg-2"><input class="form-control" type="date"  name="wc_esd_date[]" required> </div> <div class="col-lg-2"><select class="form-select w-100" name="sku[]" onchange="getskuvalue(this,' + i + ')"> <option value="">Choose</option> @foreach($all_skus as $a_sku) <option value="{{@$a_sku->id}}">{{@$a_sku->sku}}</option> @endforeach </select> </div> <div class="col-lg-3"><input class="form-control" type="text" placeholder="Product Name" id="product-name-' + i + '" name="product_name[]" required> </div> <div class="col-lg-2"><input class="form-control" type="number"  value="1" name="quantity[]" required> </div><div class="col-lg-2"><input class="form-control product-price" type="text" id="product-price-' + i + '" placeholder="Product Price" name="price[]" required> </div><div class="col-lg-1"> <a class="remove-btn btn btn-danger" href="javascript:;" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash-fill"></i></a> </div></div>')
    $('.group_sku_select').select2();


  }
  $("body").on("click", ".remove-btn", function(e) {
    $(this).parents('.orderss_data').remove();
  });
</script>
<script>
  $('#channel_change').on('change', function() {
    if (this.value == 'offline') {
      $('#order_noo').html('<label class="control-label font-weight-bold my-3" for="pwd">Order No</label><br><input class="form-control" type="text" name="order_no">');
      $('#order_noo').hide();
    } else {
      $('#order_noo').show();
      $('#order_noo').html('<label class="control-label font-weight-bold my-3" for="pwd">Order No</label><br><input class="form-control" type="text" name="order_no" required>');

    }
  });
</script>

<script>
  function getskuvalue(e, id) {

    $.ajax({
      dataType: 'json',
      type: 'POST',
      url: "{{ url('/test_sku_data') }}",
      data: {
        '_token': '{{ csrf_token() }}',
        'sku': e.value
      },
      success: function(data) {
        $('#product-price-' + id).val(data.regular_price);
        $('#product-name-' + id).val(data.name);

      }
    });

  }
</script>

<script>
  $(document).ready(function() {
    $('.group_sku_select').select2();

  });
</script>
<script>
  $('#tv_taken').change(function() {
    window.location = "{{url('/')}}/admin/add_amazon_order?order_type=" + $(this).val();
  });
</script>
@endsection