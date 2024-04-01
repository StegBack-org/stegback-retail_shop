@extends('RetailShop::layouts.app')
@section('content')

<main>
  <div class="container mt-4">
    <div class="row">

      <div class="col-xl-12">

       

        <h1 class="pb-2" style="font-size:28px">{{ __('AllOrder') }}</h1>

        <nav aria-label="breadcrumb" style="bs-breadcrumb-divider: '>'">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" style="color:black">{{ __('Home') }}</a>
            </li>
            <li class="breadcrumb-item">{{ __('Orders') }} </li>
          </ol>
        </nav>
        <a class="btn btn-outline-dark mb-2" href="{{url('/admin/add_amazon_order')}}?order_type=offline">Add New
          Order</a>
        <a class="btn btn-outline-success mb-2" href="{{url('/admin/add_amazon_order')}}?order_type=offline&offer=1">Add
          Offer</a>
      </div>

      <div class="col-md-12">

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-separate table-head-custom table-checkable  no-footer dtr-inline" style="width:100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{ __('Channel') }}</th>
                  <th>{{ __('OrderDate') }}</th>
                  <th>{{ __('OrderNumber') }}</th>
                  <th>{{ __('CustomerName') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Invoice') }}</th>
                  <th>{{ __('OrderPlaced') }}</th>
                  <th>{{ __('Amount') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (@$_GET['page'] > 1) {
                  if (@$_GET['paginate']) {
                    $i = (@$_GET['page'] - 1) * @$_GET['paginate'] + 1;
                  } else {
                    $i = (@$_GET['page'] - 1) * 20 + 1;
                  }
                } else {
                  $i = 1;
                }
                ?>

                @foreach ($data as $key1 => $orders)
                  <tr class="remove_tr_">
                    <td>{{ $i++ }}</td>
                    <td style="white-space: nowrap;"> {{ @$orders->channel->name ?? 'Offline' }}</td>
                    <td> {{ @$orders->order_date }}
                    </td>
                    <td>
                      <a href="javascript:;">{{ @$orders->order_no }}</a>
                    </td>
                    <td>
                      {{ @$orders->customer_name }}
                      @if(@$orders->billing_company_name)
                      <br>
                      <span class="badge bg-secondary">{{ @$orders->billing_company_name }}</span>
                      @elseif(@$orders->company_name)
                      <br>
                      <span class="badge bg-secondary">{{ @$orders->company_name }}</span>
                      @elseif(@$orders->shipping_company_name)
                      <br>
                      <span class="badge bg-secondary">{{ @$orders->shipping_company_name }}</span>
                      @endif
                    </td>
                    <td>
                      <span class="p-2 text-capitalize badge bg-warning ">
                        {{ __(@$orders->status) }}
                      </span>
                     
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                    </td>
                    <td style="display: flex; align-items: center;">
                      <a class="btn btn-outline-primary" href="{{route('RetailShop.order_view',[$orders->order_no])}}"><i class="bi bi-eye px-2"></i></a>
                    </td>
                  </tr>
				@endforeach
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