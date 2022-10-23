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

                @include('layouts.table', ['report_confirm'=> 1,
                        'search_route' => route('lab.pending'),
                        'details_route'=> 'lab.pending_details'])
            </div>
        </div>
    </div>
@endsection
