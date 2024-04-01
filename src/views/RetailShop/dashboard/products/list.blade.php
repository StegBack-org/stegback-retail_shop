@extends('RetailShop::layouts.app')
@section('content')
<style>
  div.container {
    width: 100%;
  }

  table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100% !important;
    border: 1px solid #ddd;
  }

  input.largerCheckbox {
    transform: scale(2);
  }

  .select2-container--default {
    width: 100% !important;
  }

  .select2-container .select2-selection--multiple {
    border: solid #ced4da 1px !important;
    outline: 0 !important;
    min-height: 38px !important;
  }

  .select2-container--default.select2-container--focus {
    border: solid #ced4da 1px !important;
  }
</style>

<main>
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <h1 class="pb-2" style="font-size:22px">{{__('AllProduct')}}</h1>
        <nav aria-label="breadcrumb" style="bs-breadcrumb-divider: '>'">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" style="color:black">{{__('Home')}}</a>
            </li>
            <li class="breadcrumb-item">{{__('Products')}}</li>
          </ol>
        </nav>
      </div>

      <!--dashboard notification-->


      <div class="col-md-12">
        <div class=" mb-4">


          <div class="ml-4">Total Products : <strong>{{@count($store_products)}}</strong></div>

          <div class="mt-2">
            <div class="table-responsive">
              <table class="table table-separate table-head-custom table-checkable no-footer dtr-inline" cellspacing="0">
                <thead>
                  <tr>
                    <th>
                      #{{__('id')}}


                    </th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Type')}}</th>
                    <th>{{__('Sku')}}</th>
                    <th>{{__('Weight')}}</th>
                    <th>{{__('Quantity')}}</th>

                    <th>{{__('Action')}}</th>

                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php


                  if (@$_GET['page'] > 1) {
                    if (@$_GET['paginate']) {
                      $count = (@$_GET['page'] - 1) * @$_GET['paginate'] + 1;
                    } else {
                      $count = (@$_GET['page'] - 1) * 20 + 1;
                    }
                  } else {
                    $count = 1;
                  }

                  foreach ($store_products as $product) {
                  ?>

                    <tr>
                      <td>
                        <?= $count++ ?>


                      </td>
                      <td>

                        {{$product['name']}}


                      </td>
                      <td>

                        <?php
                        if (@$product['checkproduct']['type'] == 'variation') {
                          $type = 'variable';
                        } else {
                          $type = @$product['checkproduct']['type'];
                        }

                        ?>


                        @if(@$product['checkproduct']['type'])
                        <span class="badge bg-dark" style="">
                          <?= @$type ?>
                        </span>
                        @endif

                        @if(@$product['single_sku_product_status'] == 1)
                        <span class="badge bg-dark" style="">
                          single sku </span>
                        @elseif(@$product['group_sku_status'] == 1)
                        <span class="badge bg-dark" style="">
                          group sku </span>
                        @endif
                      </td>
                      <td>

                        <span>
                          Buying price: {{ @$product['buying_price'] }}
                        </span>


                      </td>

                      <td>
                        <small>
                          <?= @$product['sku'] ?>
                        </small>

                        @if(@$product['shipping_provider'])
                        <br>
                        <span class="badge bg-secondary" style="color: black;line-height: 1;border-radius: 0.25rem;background-color: #ffffff;border: 1px solid black;">
                          <?= @$product['shipping_provider_data']['name'] ?>
                        </span>
                        @endif

                        @if(@$product['avaiablity_date_check'])
                        <br>
                        <span class="badge bg-secondary" style="color: black;line-height: 1;border-radius: 0.25rem;background-color: #ffffff;border: 1px solid black;">
                          <?php echo $plusFive = date('Y-m-d', strtotime('+' . $product['est_days'] . ' weekday')); ?>
                        </span>

                        @endif

                      </td>
                      <td>{{ $product['quantity']}}</td>



                      <td class="">
                        <a class="btn btn-outline-dark m-1" href="{{route('RetailShop.product_view',$product['id'])}}"><i class="bi bi-eye px-2"></i></a>
                      </td>
                    </tr>
                  <?php      } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>



  </div>
</main>

















@endsection