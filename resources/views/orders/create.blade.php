@extends('layouts.app')

@section('content')
  <form action="{{ route('order.store') }}" method="POST">
  	@csrf
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Title</label>
          <input type="text" name="title" class="form-control" value="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Description</label>
          <input type="text" name="description" class="form-control" value="">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Cost</label>
          <input type="number" name="cost" class="form-control" value="">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Tags</label>
          <select class="js-example-basic-multiple" name="tag_ids[]" multiple="multiple">
          	@foreach($tags as $tag)
      			  <option value="{{$tag->id}}">{{$tag->name}}</option>
      			  @endforeach
			</select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-control">
          <label>Asign to Customer</label>
          <select name="customer_id" >
          	@foreach($customers as $customer)
			  <option value="{{$customer->id}}">{{$customer->first_name}}</option>
			  @endforeach
			</select>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
  </form>

  
@stop
