@extends('layouts.app')

@section('title','Order Detail')

@section('main-content')
<div class="card">
    <h5 class="card-header">Order</h5>
    <div class="card-body">
        @if($order)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Order No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{number_format($order->total_amount,2)}}</td>
                    <td>
                        <a href="{{route('order-edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    </td>
                    
                </tr>
            </tbody>
        </table>
        
        <section class="confirmation_part section_padding">
            <div class="order_boxes">
                <div class="row">
                    <div class="col-lg-6 col-lx-4">
                        <div class="order-info">
                            <h4 class="text-center pb-4">Products</h4>
                            <table class="table">
                                <thead>
                                    <tr >
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($client_products as $prd)  
                                    <tr>
                                        <td>{{$prd->title}}</td>
                                        <td>{{number_format($prd->price,2)}}</td>
                                        <td>{{$prd->quantity}}</td>
                                        <td>${{number_format($prd->amount,2)}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-lx-4">
                        <div class="shipping-info">
                            <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
                            <table class="table">
                                <tr >
                                    <td>Full Name</td>
                                    <td> : {{$order->first_name}} {{$order->last_name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td> : {{$order->email}}</td>
                                </tr>
                                <tr>
                                    <td>Phone No.</td>
                                    <td> : {{$order->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td> : {{$order->address1}}, {{$order->address2}}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td> : {{$order->country}}</td>
                                </tr>
                                <tr>
                                    <td>Post Code</td>
                                    <td> : {{$order->post_code}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        
    </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
    background:#ECECEC;
    padding:20px;
    }
    .order-info h4,.shipping-info h4{
    text-decoration: underline;
    }
    
</style>
@endpush                                                                                                                                            