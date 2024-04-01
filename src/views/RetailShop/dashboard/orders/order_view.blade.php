@extends('RetailShop::layouts.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
    .my_tooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .my_tooltip .cstm_tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: #000000;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s;
        font-size: 12px;

    }

    .my_tooltip .cstm_tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: black transparent transparent transparent;
    }


    body {
        background-color: #f0f0f1;
    }

    div.container {
        width: 100%;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100% !important;
        border: 1px solid #ddd;
    }

    .table>:not(caption)>*>* {
        border-bottom-width: 0px;
    }

    .variation_td {
        border-top: none !important;
        padding-top: 0px;
        position: relative;
        top: -8px;
    }

    .breadcrumb {
        display: flex;
        flex-wrap: wrap;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        list-style: none;
        background-color: #e9ecef;
        border-radius: 0.25rem;
    }

    input.largerCheckbox {
        transform: scale(2) !important;
    }
</style>
<?php

use App\Helpers\FrontHelper;
$address = json_decode(@$data->customer_address, true);

?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">

                <nav aria-label="breadcrumb" style="bs-breadcrumb-divider: '>'">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" style="color:black">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/orders')}}" style="color:black">{{__('Orders')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/orders')}}" style="color:black">{{__('Order')}}</a></li>
                    </ol>
                </nav>
            </div>
            {{-- @include('includes.elements.order_no_single') --}}
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="col-lg-12 border p-3 bg-light">
                            <div class="invoice-title">

                                {{-- @include('admin.orders.elements.ticket_section') --}}

                                <h4>{{__('Order')}} #
                                    <a href="javascript:void(0);" style="text-decoration: none;color: black;" class="my_tooltip" onclick="order_no_copy('#copy_order_text')" id="copy_order_text">
                                        {{ @$data->order_no }}
                                        <span class="cstm_tooltiptext" id="my_tooltip">Copied !</span></a> -
                                    <small class="text-secondary">{{ @$data->channel->name }}</small>
                                </h4>
                                <p class="m-0">{{__('PaymentMethod')}}: {{ @$data->payment_type }}</p>
                                <p class="m-0">{{__('OrderDate')}} : {{ @$data->order_date }} @if(!empty(@$data->order_time)){{ @$data->order_time }} @endif</p>

                                <!--invoice no-->
                                {{-- @include('includes.elements.invoice_detail') --}}
                                <!---->

                                <div style="display: block; text-align: end" class="mt-2">

                                    @if(@$data->call_back_date && @$data->call_back_status == 1)
                                    <a class="btn btn-primary m-1 ">Call back Date: ( {{ @$data->call_back_date }} )</a>
                                    @endif

                                    @if(@$data->schedule_date && @$data->schedule == 1)
                                    <a class="btn btn-primary m-1 ">schedule Date: ( {{ @$data->schedule_date }} )</a>
                                    @endif

                                    <a class="btn btn-outline-primary m-1 " href="https://sellercentral.amazon.de/orders-v3/order/<?= $data->order_no; ?>" target="_blank">View on channel</a>

                                    {{-- @include('admin.orders.easy_bill_button',compact('data',@$data)) --}}
                                   


                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- @if(count(@$data->track_order) > 0) --}}
                                            {{-- @include('includes.elements.print_label') --}}
                                            {{-- @endif --}}
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                {{-- @include('includes.elements.add_discount_order') --}}
                                @if(@$data->status_dis == 1)
                                @if(!empty(@$data->adjustment_amount))
                                <label class="btn btn-outline-dark" for="yousendit2discount"> <input type="checkbox" class="largerCheckbox mx-2" name="yousendit2discount" onclick="return yousendit2discount();" id="yousendit2discount" value="1" @if(@$data->discount_status==1) {{ "checked" }} @endif /> Discount Paid </label>
                                <script>
                                    function yousendit2discount() {
                                        if (document.getElementById('yousendit2discount').checked) {
                                            ajaxurl("{{ url('/discount_status/'.@$data->id.'/1') }}");
                                        } else {
                                            iziToast.error({
                                                title: '',
                                                message: 'Discount Status Allready Updated',
                                                position: 'topRight',
                                                timeout: 5000
                                            });
                                            $('#yousendit2discount').prop('checked', true);
                                        }
                                    }
                                </script>
                                @endif
                                @endif
                                {{-- @include('includes.elements.extra_payout') --}}
                                @if(@$data->payout_status == 1)
                                <label class="btn btn-outline-dark" for="yousendit2payout"> <input type="checkbox" class="largerCheckbox mx-2" name="yousendit2payout" onclick="return yousendit2payout();" id="yousendit2payout" value="1" @if(@$data->extra_payment_status==1) {{ "checked" }} @endif /> Extra Payment Receive</label>
                                <script>
                                    function yousendit2payout() {
                                        if (document.getElementById('yousendit2payout').checked) {
                                            ajaxurl("{{ url('/extra_payment_status/'.@$data->id.'/1') }}");
                                        } else {
                                            iziToast.error({
                                                title: '',
                                                message: 'Extra Payment Status Allready Updated',
                                                position: 'topRight',
                                                timeout: 5000
                                            });
                                            $('#yousendit2payout').prop('checked', true);
                                        }
                                    }
                                </script>
                                @endif

                                <br>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    {{-- @include('includes.elements.get_easybill_button') --}}

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <address style="word-break: break-word;word-wrap: break-word;">
                                        <strong>{{__('BillingTo')}}:</strong>
                                        
                                        <br>
                                        {{-- @include('includes.elements.address_change',['type'=>'billing']) --}}
                                        <strong>Buyer Name:</strong> {{ @$address['buyer_name']}}<br>
                                        <strong>Recipient Name:</strong> {{ @$address['name']}}<br>
                                        <strong>Address:</strong> {{ @$address['address_1'] }} , {{ @$address['address_2'] }} , {{ @$address['address_3'] }}<br>
                                        <strong>City :</strong> {{ @$address['city'] }}<br>
                                        <strong>Postcode:</strong> {{ @$address['postcode'] }} <br>
                                        <strong>Country:</strong> {{@$address['country']}} <br>
                                        <strong>Email:</strong> {{ @$data->customer_email }}<br>
                                        <strong>Phone Number:</strong> {{ @$data->customer_number }} <br>
                                        <strong>Ship Phone Number :</strong> {{ @$address['shiping_phone_number'] }}
                                        <br>

                                        @if(isset($similarEmails_shippingAddress['email']) && !empty($similarEmails_shippingAddress['email']))
                                        <a href="{{ url('admin/orders?customer_email='.$data->customer_email) }}" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Similar email orders count" style="text-decoration:none">Email ({{ $similarEmails_shippingAddress['email'] }})</a>
                                        @endif
                                    </address>
                                </div>
                                <div class="col-lg-4">
                                    <address style="word-break: break-word;word-wrap: break-word;">
                                        <strong>{{__('ShippedTo')}}:</strong>
                                        <span><i class="btn btn-sm   fa fa-pencil" data-toggle="modal" data-target="#exampleModashipping{{@$data->id}}"></i></span>
                                        <br>
                                        {{-- @include('includes.elements.address_change',['type'=>'shipping']) --}}
                                        <strong>Buyer Name:</strong> {{ @$address['buyer_name']}}<br>
                                        <strong>Recipient Name:</strong> {{ @$address['name']}}<br>
                                        <strong>Address:</strong> {{ @$address['address_1'] }} , {{ @$address['address_2'] }} , {{ @$address['address_3'] }}<br>
                                        <strong>City :</strong> {{ @$address['city'] }}<br>
                                        <strong>Postcode:</strong> {{ @$address['postcode'] }} <br>
                                        <strong>Country:</strong> {{@$address['country']}} <br>
                                        <strong>Email:</strong> {{ @$data->customer_email }}<br>
                                        <strong>Phone Number:</strong> {{ @$data->customer_number }} <br>
                                        <strong>Ship Phone Number :</strong> {{ @$address['shiping_phone_number'] }}
                                        <br>
                                        @if(isset($similarEmails_shippingAddress['shipping_address']) && !empty($similarEmails_shippingAddress['shipping_address']))
                                        <a href="{{ url('admin/orders?shipping_address='.$data->shipping_address) }}" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Similar address orders count" style="text-decoration:none">Shipping Address ({{ $similarEmails_shippingAddress['shipping_address'] }})</a>
                                        @endif
                                    </address>
                                </div>
                                <div class="col-lg-4">
                                    {{-- @include('includes.elements.order_note_list') --}}
                                </div>
                                {{-- @include('includes.elements.new_added_billing_address') --}}
                                
                                <div class="col-lg-6 p-0">

                                    <form action="{{url('admin/update-order-status-amz')}}" method="post">
                                        @csrf
                                        <div class="col-lg-6 " style="text-align:left">
                                            <label class="font-weight-bold">Order Status Change</label><br>
                                            <input type="hidden" name="id" value="{{@$data->id}}">
                                            <select name="status" class="form-control">
                                                <option value=" "> select status </option>

                                            </select><br>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="submit" class="btn btn-dark" name="submit" value="submit">
                                        </div>
                                    </form>

                                </div>
                               
                            </div>
                        </div>


                        <div class="col-lg-12 border p-3 bg-light mt-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="font-weight-bold">{{__('Ordersummary')}}</p>
                                    <table class="table table-condensed border-0">
                                        <thead>
                                            <tr>
                                                <td><strong>{{__('Item')}}</strong></td>
                                                <td><strong>{{__('Price')}}</strong></td>
                                                <td><strong>{{__('Quantity')}}</strong></td>
                                                <td><strong>{{__('Totals')}}</strong></td>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $total = 0; ?>
                                            <?php foreach ($data->goods as $items) {
                                                @$total += @$items['quantity'] * @$items['price']; ?>
                                                <tr>
                                                    <td> <a href="" target="_blank">
                                                            <p class="m-0">{{ @$items['name'] }}<span class=" ml-1 bg-dark badge">{{@$items['shipping_provider_data']['name']}}</span></p>
                                                        </a>

                                                        <p class="m-0">{{__('EstimateDeliveryDate')}} : {{ @$items['wc_esd_date'] }}</p>
                                                        <p class="m-0">{{__('Sku')}} : <a href="{{ url('admin/products?exact_sku=1&sku='.@$items['sku']) }}" target="_blank">{{ @$items['sku'] }}</a>
                                                            @if(@auth()->user()->read_only_status != 1)<span><i class="btn btn-sm  fa fa-pencil" data-toggle="modal" data-target="#exampleModalSku{{@$items['id']}}"></i></span>@endif
                                                            @if(count(@$data->goods) > 1)
                                                            <br>
                                                            {{-- @include('includes.elements.delivery_product_filter',compact('items')) --}}
                                                            @endif
                                                        </p>
                                                        <p style="">@if(!empty(@$items['attributes']))
                                                            <?php $attributes = json_decode($items['attributes'], true); ?>
                                                            @foreach($attributes as $at)
                                                            <span class="text-muted">{{$at['name'] }} : </span>{{$at['option']}} <br>
                                                            @endforeach
                                                            @endif
                                                        </p>
                                                        @if(!empty(@$items['delivery_note']))
                                                        <div style="white-space:pre-wrap;color:#666"><small><?php echo @$items['delivery_note']; ?></small></div>

                                                        @endif

                                                        <!--<button type="button" class="btn btn-sm btn-outline-primary mt-3 mr-2" data-toggle="modal" data-target="#exampleModalSku{{@$items['product_id']}}">Edit Sku</button>-->
                                                        @if(@auth()->user()->read_only_status != 1)
                                                        @if(empty(@$items['delivery_note']))
                                                        <button type="button" class="btn btn-sm btn-outline-primary mt-3" data-toggle="modal" data-target="#exampleModal{{@$items['id']}}">{{__('Add1')}} {{__('Product')}} {{__('Description')}}</button>
                                                        @else
                                                        <button type="button" class="btn btn-sm btn-outline-primary mt-3" data-toggle="modal" data-target="#exampleModal{{@$items['id']}}">{{__('Edit')}}</button>
                                                        @endif
                                                        @endif

                                                        {{-- @include('includes.elements.product_type_button',compact('items')) --}}
                                                    </td>
                                                    <td></td>
                                                    <td>{{ @$items['quantity'] }}</td>
                                                    <td></td>

                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{@$items['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">@if(empty(@$items['delivery_note'])) {{__('Add1')}} @else {{__('Edit')}} @endif {{__('Product')}} {{__('Description')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{url('admin/update-delivery-note')}}" method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="hidden" name="id" value="{{@$items['id']}}">
                                                                            <textarea class="form-control" style="white-space:normal;" rows="5" name="delivery_note"><?php echo @$items['delivery_note']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="submit" class="btn btn-success" value="{{__('Submit')}}">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- sku change Modal -->
                                                {{-- @include('includes.elements.change_sku_order_product') --}}

                                            <?php } ?>

                                            @if(@$data->adjustment_amount)
                                            <tr>
                                                <!--<td class="no-line"></td>-->
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-left">
                                                    <strong>{{__('Rabatt')}}</strong>
                                                    @if(!empty(@$data->discount_category))
                                                    <br>
                                                    <span class="font-weight-bold" style="font-size: small; white-space: nowrap;" id="dis_category" data-toggle="tooltip" data-placement="left" title="Note: {{ @$data->discount_note }}">
                                                        ({{ @$data->discount_category }})
                                                    </span>
                                                    @endif
                                                </td>
                                                <td class="no-line text-left"><?= (new FrontHelper)->price(@$data->adjustment_amount) ?></td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <!--<td class="no-line"></td>-->
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-left"><strong>{{__('Shipping')}}</strong></td>
                                                <td class="no-line text-left"></td>
                                            </tr>
                                            @if(!empty($data->credit_note_total))
                                            <tr>
                                                <!--<td class="no-line"></td>-->
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-left"><strong>{{__('Credit Note Amount')}}</strong></td>
                                                <td class="no-line text-left"></td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <!--<td class="no-line"></td>-->
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-left"><strong>{{__('Total')}}</strong></td>
                                                <td class="no-line text-left"><?= '';//FrontHelper::price(@$data->earning)?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- @include('admin.orders.elements.order_credit_note')
                        @include('includes.elements.multicompents')
                        @include('includes.elements.stock_status') --}}

                    </div>
                    <div class="col-lg-3">

                        {{-- @include('includes.elements.status') --}}

                        <div class="col-lg-12 border p-3 mt-3  mb-2 bg-light" style="max-height: 350px;overflow: auto;">
                            @if(@auth()->user()->read_only_status != 1)
                            <p class="panel-title font-weight-bold">

                                <span class="btn btn-primary btn-block add_tracking_no" data-toggle="modal" data-target="#exampleModaltrack"> Add tracking no </span>

                            </p>
                            <hr>
                            @endif

                            {{-- <!-- @include('admin.orders.elements.tracking_numbers') --> --}}

                        </div>

                        {{-- <!-- @include('includes.elements.order_notes') --> --}}




                        <!-- <div class="col mt-3" id="order_histroy_render">
                            {{-- @include('includes.elements.order_history') --}}
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- <!-- @include('includes.elements.tracking_form') --> --}}



@endsection