@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row mt-4">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Store</th>
                <th scope="col">Owner</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Active Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php $serial = 1; @endphp
                @foreach ($store_list as $store)
                <tr>
                    <th scope="row">{{$serial}}</th>
                    <td>{{$store->storeName ?? '-'}}</td>
                    <td>{{$store->name ?? '-'}}</span></td>
                    <td>{{$store->email ?? '-'}}</span></td>
                    <td>{{$store->address ?? '-'}}</td>
                    <td><span class="badge bg-{{$store->active ? 'success' : 'danger'}}">{{$store->active ? 'Active' : ' Inactive'}}</span></td>
                    <td>
                        <a href="{{route('RetailShop.store_view',['i' => base64_encode($store->id),'s' => base64_encode($store->storeName) ])}}">View</a>
                    </td>
                </tr>
                @php $serial ++ ; @endphp
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection