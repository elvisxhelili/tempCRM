@extends('layouts.app')

@section('content')
<div class="row">
  <div class="offset-md-10 col-md-2">
    {{-- <a href="{{ route('customers.create') }}" class="btn btn-primary btn-block">+ New Customer</a> --}}
    <p>Orders of : {{ $customer->first_name }}</p>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Cost</th>
          <th scope="col">Contract</th>
          <th scope="col">Created at</th>
        </tr>
      </thead>
      <tbody>
        @foreach($customer->orders as $order)
          <tr>
            <th scope="row">{{ $order->id }}</th>
            <td>{{ $order->title }}</td>
            <td>{{ $order->description }}</td>
            <td>{{ $order->cost }}</td>
           <td><a href="{{ route('order.contracts.view', $order->id) }}">[Contract]</a></td>
            <td>{{ $order->created_at }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- <div class="row">
  <div class="col-md-12">
    {{ $customers->links() }}
  </div>
</div> --}}

@stop
