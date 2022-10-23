@extends('layouts.app')
@section('menu')
    @guest
        @include('customer.menu.menu')
    @else
        @if(auth()->user()->role==0)
            @include('customer.menu.menu')
        @endif
      @if(auth()->user()->role==1)
            @include('hospital.menu.menu')
      @endif
    @endguest

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{session()->get('success')}}
            </div>
            @endif
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-7 mt-lg-5">
            <h1 class="mb-3 justify-content-center" style="font-size:55px; "> Good health is not something we can buy,<br>
                It has to be created. </h1>
            <p class="justify-content-center" style="font-size:23px; ">As we say,we came up with  the idea of developing
                a Medical services through online, Where people will easily get tested their desired medical tests through
                various hospital in a reasonable fee  by our online platform without suffering any kind of long queue.</p>
        </div>
        <div class="col-md-5">
            <img class="mt-lg-5 ml-lg-5 " src="{{asset('images/1.jpg')}}">
        </div>
    </div>

    <div class="row mt-lg-5">
        <div class="col-md-4 shadow bg-light rounded">
            <div class="card border-success mb-3 mt-4 ml-4" style="max-width: 18rem;border-width: 5px;">
                <div class="card-header text-success"><h3>More Secure</h3></div>
                <div class="card-body text-dark">
                    <p class="card-text">It is Guaranteed that you can get more security when doing payment.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 shadow bg-light rounded">
            <div class="card border-success mb-3 mt-4 ml-4 " style="max-width: 18rem;border-width: 5px;">
                <div class="card-header text-success"><h3>More Accurate</h3></div>
                <div class="card-body text-dark">
                    <p class="card-text">we will provide you more accurate result. We give best afford on it.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 shadow bg-light rounded">
            <div class="card border-success mb-3 mt-4 ml-4" style="max-width: 18rem;border-width: 5px;">
                <div class="card-header text-success"><h3>More Believable</h3></div>
                <div class="card-body text-dark">
                    <p class="card-text">It is the most important part in our policy that we work for. </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6 mt-3">
            <img src="{{asset('images/2.jpg')}}">
        </div>
        <div class="col-md-6">
            <h1 style="font-size:50px; "> Our Goals </h1>
            <p class="justify-content-center" style="font-size: 22px;"> we want to give medical services by our website through various hospital. From us people can take many medical
                services in a cheapest price anytime from any place in our country. Mainly we are associated with various
                famous hospital, by us people take services in a low cost anytime from any place in our country such as.
                People do all types of lab test from those hospital in a cheapest price from our website.</p>
        </div>
    </div>

    <div class="row mt-5 mb-1">
        <div class="col-md-12"><h1 class="ml-lg-5"style="text-align: center;font-size: 50px;">Our Activities</h1></div>
    </div>
    <div class="container mt-2">
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="embed-responsive embed-responsive-21by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/0TptE98a2KE" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
