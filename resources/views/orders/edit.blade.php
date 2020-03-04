@extends('layouts.app')
@section('content')
  <form action="{{ route('orders.update', $order) }}" method="POSt">
    @csrf
    @include('orders.form')
    <div class="row">
    	<div class="col-lg-12">
        <div class="form-group">
          <label>Tags</label>
          <select class="js-example-basic-multiple" name="tag_ids[]" multiple="multiple">
          	@foreach($tagidss as $tag)
      			  <option value="{{$tag->id}}"  @if(in_array($tag->id, $myTags)) selected @endif>{{$tag->name}}</option>
      			  @endforeach
			</select>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
  </form>
@stop