@extends('layouts.app')
@section('menu')
    @include('hospital.menu.menu')
@endsection
@section('content')
    <div class="container">
        @include('layouts.hospital_info')
        <div class="row">
            @include('layouts.left_menu')
            <div class="col-md-10 shadow-lg bg-light">
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{session()->get('error')}}
                            </div>
                        @endif
                    </div>
                </div>
                @include('layouts.table', ['report_confirm'=> 0,
                        'search_route' => route('onestop.request'),
                        'details_route'=> 'onestop.details'])
            </div>
        </div>
    </div>
@endsection
