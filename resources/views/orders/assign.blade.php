@extends('layouts.app')
@section('content')

{{$order->title}}
{{$order->description}}
{{$order->cost}}
  <form action="{{ route('order.assign', $order) }}" method="POSt">
    @csrf
    <div class="row">
    <div class="col-lg-12">
      <div class="form-control">
        <label for="customers">Assign to customer:</label>

            <select  name="customer_id">
              <option value="">Choose from the list</option>
              @foreach($customers as $customer)
              <option value="{{$customer->id}}">{{$customer->first_name}}</option>
              @endforeach
            </select>
      </div>
      
    </div>
  </div>
    <button type="submit" class="btn btn-warning">Update</button>
  </form>
  
@stop