@extends('RetailShop::layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card" >
                <div class="card-body">
                  <h6 class="card-title text-muted">Total Earning</h6>
                  <p class="card-text">320</p>
                  <a href="#" class="card-link">View All</a>
                </div>
              </div>
            </div>
        <div class="col-md-4">
            <div class="card" >
                <div class="card-body">
                  <h6 class="card-title text-muted">Total Reffral</h6>
                  <p class="card-text">120</p>
                  <a href="#" class="card-link">View All</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card" >
                <div class="card-body">
                <h6 class="card-title text-muted">Total Commission Received</h6>
                  <p class="card-text">$7890</p>
                  <a href="#" class="card-link">View wallet</a>
                </div>
              </div>
        </div>
    </div>

    <div class="row mt-4">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Activity</th>
                <th scope="col">Debit</th>
                <th scope="col">Credit</th>
                <th scope="col">status</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
                @php $serial = 1; @endphp
                @foreach ($wallet as $commission)
                <tr>
                    <th scope="row">{{$serial}}</th>
                    <td>{{$commission->activity ?? 'undefined'}}</td>
                    <td><span  class="badge bg-warning">{{$commission->debit ?? '-'}}</span></td>
                    <td><span  class="badge bg-primary">{{$commission->credit ?? '-'}}</span></td>
                    <td>{{$commission->status}}</td>
                    <td>{{$commission->created_at}}</td>
                </tr>
                @php $serial ++ ; @endphp
                @endforeach
            </tbody>
          </table>
    </div>


</div>

@endsection