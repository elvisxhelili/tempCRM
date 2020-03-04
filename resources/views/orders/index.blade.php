@extends('layouts.app')

@section('content')
<div class="row">
  <div class="offset-md-10 col-md-2">
    <a href="{{ route('order.create') }}" class="btn btn-primary btn-block">+ New order</a>
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
          <th scope="col" colspan="3" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
          <tr>
            <th scope="row">{{ $order->id }}</th>
            <td>{{ $order->title }}</td>
            <td>{{ $order->description}}</td>
            <td>{{ $order->cost }}</td>
            <td><a href="{{ route('order.edit', $order->id) }}">[Edit]</a></td>
            <td><a href="{{ route('order.assign.view', $order->id) }}">[Assign]</a></td>
            <td><a href="{{ route('order.delete', $order->id) }}">[Delete]</a></td>
            {{-- <td><a href="#" onclick="event.preventDefault(); document.getElementById('delete-customer-{{ $order->id }}-form').submit();">[Delete]</a></td>

            <form id="delete-customer-{{ $order->id }}-form" action="{{ route('order.delete', $order) }}" method="POST" style="display: none;">
                @method('DELETE')
                @csrf
            </form> --}}
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- <div class="row">
  <div class="col-md-12">
    {{ $orders->links() }}
  </div>
</div>
 --}}
@stop
