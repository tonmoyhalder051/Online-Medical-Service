@extends('layouts.app')
@section('menu')
    @include('hospital.menu.menu')
@endsection
@section('content')
    <div class="container">
        <!-- upload modal -->
        <div class="modal fade" id="upload_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('lab.upload')}}" enctype="multipart/form-data">

                    <div class="modal-body">
                            @csrf
                            <input type="hidden" value="" name="order_service_id" id="order_service_id">
                            <input type="file" value="Upload" class="form-control" name="report">
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
         @include('layouts.report_table', ['report_confirm'=> $report_confirm])
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

