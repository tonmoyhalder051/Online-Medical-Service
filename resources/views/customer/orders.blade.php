@extends('layouts.app')
@section('menu')
    @include('customer.menu.menu')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <table class="table table-striped table-success">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hospital</th>
                        <th scope="col">Applied Date</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>@php($cnt=1)
                    @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{$cnt++}}</th>
                        <td><a href="{{route('order.details',['id'=>$order->id])}}">{{$order->name}}</a></td>
                        <td>{{\carbon\carbon::parse($order->created_at)->format('d M Y')}}</td>
                        <td>{{\carbon\carbon::parse($order->appointment_date)->format('d M Y')}}</td>
                        <td>
                            @if($order->status==0)
                                <b><span class="text-success">Pending</span></b>
                            @endif
                                @if($order->status==1 || $order->status==2 )
                                    <b><span class="text-success">Approved</span></b>
                                @endif
                                @if($order->status==3)
                                    <b><span class="text-success">Complete</span></b>
                                @endif
                                @if($order->status==-1)
                                    <b><span class="text-danger">Cancel</span></b>
                                @endif


                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </div>
@endsection
