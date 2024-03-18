@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
    

    <div class="row mt-4">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Order Number</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Status</th>
                <th scope="col">Order Placed</th>
                <th scope="col">Amount</th>
                <th scope="col">Order date</th>
              </tr>
            </thead>
            <tbody>
                @php $serial = 1; @endphp
                @foreach ($store_order as $orders)
                <tr>
                    <th scope="row">{{$serial}}</th>
                    <td><a href="{{route('RetailShop.order_view',[$orders->order_no])}}">{{$orders->order_no ?? 'undefined'}}</a></td>
                    <td>{{$orders->debit ?? '-'}}</span></td>
                    <td>{{$orders->credit ?? '-'}}</span></td>
                    <td>{{$orders->status ?? '-'}}</td>
                    <td>{{$orders->amount}}</td>
                    <td>{{$orders->created_at}}</td>
                </tr>
                @php $serial ++ ; @endphp
                @endforeach
            </tbody>
          </table>
    </div>


</div>

@endsection