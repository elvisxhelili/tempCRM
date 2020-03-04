@extends('layouts.app')

@section('content')
<div class="row">
  <div class="offset-md-10 col-md-2">
    {{-- <a href="{{ route('customers.create') }}" class="btn btn-primary btn-block">+ New Customer</a> --}}
    <p>Contract of : {{ $order->title }}</p>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Customer</th>
          <th scope="col">Cost</th>
          <th scope="col">Description</th>
          <th scope="col">Order</th>
          <th scope="col">Tags</th>
          <th scope="col">Created at</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->contracts as $contract)

          <tr>
            <th scope="row">{{ $contract->id }}</th>
            <td>{{ $contract->customer->first_name }} {{ $contract->customer->last_name }}</td>
            <td>{{ $order->cost }}</td>
            <td>{{ $order->description }}</td>
            <td>{{ $order->title }}</td>
            <td>
                <ul>
                  @foreach($order->orderTags as $t)
                  <li>{{ $t->tags->name}}</li>
                  @endforeach
                </ul>
            
            </td>
            <td>{{ $contract->created_at }}</td>
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
