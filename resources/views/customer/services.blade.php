@extends('layouts.app')
@section('menu')
    @include('customer.menu.menu')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session()->Has('cart_success'))
                <div class="alert alert-success" role="alert">
                   {{session()->get('cart_success')}}
                </div>
                @endif
            </div>
        </div>
        <div class="row text-center mb-4 shadow">
            <div class="col-md-12 p-3 mt-2 mb-2">
                <h3>{{$hospital_title->name}}</h3>
                <h6 class="m-0">{{$hospital_details->address}}</h6>
                <h6 class="m-0">{{$hospital_details->mobile}}</h6>



            </div>
        </div>

        <div class="row mt-2 shadow-lg">
            @foreach($services as $service)
            <div class="col-md-4 mx-0 px-0 mt-3 mb-3">
                <div class="card-group">
                    <div class="card mr-2 ml-2">
                        <div class="card-body">
                            <h4  class="card-title font-weight-bold" style="text-align: center;">{{$service->name}}</h4>
                            <h5  class="card-text text-success font-weight-bold"  style="text-align: center;">{{$service->service_type}}</h5>
                            <h5  class="card-text m-0 " style="text-align: center;">{{substr($service->description,0,20)}}</h5>
                            <h5  class="card-text" style="text-align: center;"><b>Price: </b>{{$service->price}}.00 Taka</h5>
                            <div class="col-md-12 text-center mt-3">
                                <a href="{{route('add_to_cart',['id'=>$service->id])}}" class="btn btn-primary text-center">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="row mt-1">
            <div class="col-md-12 mb-3 mt-2"  style="text-align: end;">
                <a href="{{route('cart')}}" class="btn btn-secondary btn-lg" role="button">Confirm</a>
            </div>
        </div>

    </div>
@endsection
