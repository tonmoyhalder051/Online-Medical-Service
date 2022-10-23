@extends('layouts.app')
@section('menu')
    @include('hospital.menu.menu')
@endsection
@section('content')
    <div class="container">
        <!-- upload modal -->
        <div class="modal fade" id="update_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('onestop.update_payment')}}" enctype="multipart/form-data">

                        <div class="modal-body">
                            @csrf
                            <input type="number" name="amount" placeholder="Amount" class="form-control">
                            <input type="hidden" name="order_id" value="{{$order_details->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.hospital_info')
        @include('layouts.patient_info')
        @foreach($errors->all() as $error)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        {{$error}}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session()->get('error')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('success')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-5">
                <table class="table table-striped justify-content-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Test name</th>
                        <!-- <th scope="col">Type</th> -->
                        <th scope="col">Unit Price</th>
                        <th scope="col">Report</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($row=1)
                    @php($total = 0)
                    @foreach($tests as $test)
                        @php($total+=$test->price)
                        <th scope="row">{{$row++}}</th>
                        <td>{{$test->name}}</td>
                        <!-- <td>Home service</td> -->
                        <td>{{$test->price}}.00 Taka</td>
                        <td>
                            @if($test->report == "Not Available")
                                {{$test->report}}
                            @else
                                <a href="{{route('lab.download', ['id'=> $test->id])}}">Download</a>
                            @endif
                        </td>

                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right"><b>Total Price:</b></td>
                            <td colspan="2"><b>{{$total}}.00 Taka</b></td>
                        </tr>
                    <tr>
                        <td colspan="3" class="text-right"><b>Total Paid:</b></td>
                        <td colspan="2">{{$order_details->payment}}.00 <i class="ml-4 link_p fa fa-plus-square" style="font-size: 20px;"
                          title="Payment" data-service-id="{{$test->id}}" data-toggle="modal" data-target="#update_payment"></i></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><b>Total Due:</b></td>
                        <td colspan="2"><b>{{($total-$order_details->payment)}}.00 Taka</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col text-right">
                <a class="btn btn-primary" href="{{route('onestop.request_confirm', ['id' => $order_details->id])}}">Confirm</a>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script>
            jQuery(document).ready(function(){
                $('.upload').click(function () {
                    $('#order_service_id').val($(this).attr('data-service-id'))
                })
            });
        </script>

    </div>
@endsection

