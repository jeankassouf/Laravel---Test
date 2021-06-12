@extends('layouts.app')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Order</h5>
    <div class="card-body">
		<form method="post" action="{{route('order-update',$order->id)}}">
			{{csrf_field()}}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="user_id" class="col-form-label">User <span class="text-danger">*</span></label>
						<select name="user_id" id="user_id" class="form-control">
							@foreach($users as $key=>$user)
							<option value='{{$user->id}}'  {{$order->user_id == $user->id ? "selected":""}}>{{$user->name}}</option>
							@endforeach
						</select>
					</div>
				</div>	
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="first_name" class="col-form-label">First Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="first_name" name="first_name" value="{{$order->first_name}}">{{old('first_name')}}</text>
					@error('first_name')
					<span class="text-danger">{{$message}}</span>
					@enderror
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="last_name" class="col-form-label">Last Name <span class="text-danger">*</span></label>
				<input type="text" class="form-control" id="last_name" name="last_name" value="{{$order->last_name}}">{{old('last_name')}}</text>
				@error('last_name')
				<span class="text-danger">{{$message}}</span>
				@enderror
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
			<input type="text" class="form-control" id="email" name="email" value="{{$order->email}}">{{old('email')}}</text>
			@error('email')
			<span class="text-danger">{{$message}}</span>
			@enderror
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="phone" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
		<input type="number" class="form-control" id="phone" name="phone" value="{{$order->phone}}">{{old('phone')}}</text>
		@error('phone')
		<span class="text-danger">{{$message}}</span>
		@enderror
	</div>
</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="country">Country <span class="text-danger">*</span></label>
			<select name="country" id="country" class="form-control">
				@foreach($countries as $key=>$country)
				<option value='{{$country->code}}' {{$order->country == $country->code ? "selected":""}}>{{$country->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="post_code" class="col-form-label">Post Code <span class="text-danger">*</span></label>
		<input type="number" class="form-control" id="post_code" name="post_code" value="{{$order->post_code}}">{{old('post_code')}}</text>
		@error('post_code')
		<span class="text-danger">{{$message}}</span>
		@enderror
	</div>
</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label for="address1" class="col-form-label">First Address</label>
			<textarea class="form-control" id="address1" name="address1">{{$order->address1}}</textarea>
			@error('address1')
			<span class="text-danger">{{$message}}</span>
			@enderror
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label for="address2" class="col-form-label">Second Address</label>
			<textarea class="form-control" id="address2" name="address2">{{$order->address2}}</textarea>
			@error('address2')
			<span class="text-danger">{{$message}}</span>
			@enderror
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label for="producst">Products</label>
			<select name="products[]" class="form-control selectpicker"  multiple data-live-search="true">				
				@foreach($products as $key=>$product)
				<option value='{{$product->id}}' {{in_array( $product->id , $client_products) ? "selected" : ""}} >{{$product->title}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>	

<div class="form-group mb-3">
	<button type="reset" class="btn btn-warning">Reset</button>
	<button class="btn btn-success" type="submit">Submit</button>
</div>
</form>
</div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endpush											