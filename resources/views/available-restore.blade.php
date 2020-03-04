@extends('layouts.app')

@section('content')

<div class="row">
  <p>Deleted Customers</p>
  <div class="col-md-12">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Company</th>
          <th scope="col" colspan="2" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($customers as $customer)
          <tr>
            <th scope="row">{{ $customer->id }}</th>
            <td>{{ $customer->first_name }}</td>
            <td>{{ $customer->last_name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->company }}</td>
            <td><a href="{{ route('customers.restore', $customer->id) }}">[Restore]</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<br>
<div class="row">
  <p>Deleted Orders</p>
  <div class="col-md-12">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Cost</th>
          <th scope="col">Created At</th>
          <th scope="col" colspan="2" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
          <tr>
            <th scope="row">{{ $order->id }}</th>
            <td>{{ $order->title }}</td>
            <td>{{ $order->description }}</td>
            <td>{{ $order->cost }}</td>
            <td>{{ $order->created_at }}</td>
            <td><a href="{{ route('orders.restore', $order->id) }}">[Restore]</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


@stop
