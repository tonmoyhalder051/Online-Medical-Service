@extends('layouts.app')
@section('menu')
    @include('customer.menu.menu')
@endsection
@section('content')
    <div class="container border border-success mt-3 mb-3">
      <div class="row justify-content-center">
          <div class="col-md-12 mt-3 mb-5 text-success">
              <h1 class="text-center">{{$hospital->name}}</h1>
          </div>
          <div class="col-md-6 mt-4">
              <h6><b>Patient Name: </b>{{$order_details->name}}</h6>
              <h6><b>Appointment id: </b>{{$order_details->id}}</h6>
              <h6><b>Address: </b>{{$order_details->address}}</h6>

          </div>
          <div class="col-md-6 mt-4">
              <h6 style="text-align: end;"><b>Age: </b>{{$order_details->age}}</h6>
              <h6 style="text-align: end;"><b>Gender: </b>{{$order_details->gender}}</h6>
              <h6 style="text-align: end;"><b>Mobile: </b>{{$order_details->mobile}}</h6>

          </div>
          <div class="col-md-12 mt-3">
              <table class="table table-striped table-success">
                  <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Test name</th>
                      <th scope="col">Type</th>
                      <th scope="col">Price</th>
                      <!--                    <th scope="col">Paid Status</th>-->
                      <th scope="col"> Report</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                     $row = 1;
                     $total = 0;
                     foreach($tests as $test){
                         $total += $test->price
                  ?>
                  <tr>
                      <th scope="row">{{$row++}}</th>
                      <td>{{$test->name}}</td>
                      <td>{{$test->service_type}}</td>
                      <td>{{$test->price}}.00 Taka</td>
                      <!--                    <td>Paid</td>-->
                      <td>
                          @if($order_details->status <= 2)
                              {{'Not Available'}}
                          @else
                              <a href="{{route('report.download', ['test_id'=> $test->order_service_id])}}" class="btn btn-secondary btn-sm" role="button" aria-disabled="true">View Report</a>
                          @endif
                      </td>
                  </tr>
                  <?php } ?>

                  </tbody>
              </table>
          </div>
          <div class="col-md-6 mt-3">
              <h6><b>Payable Amount:</b></h6>
              <h6><b>Paid Amount:</b></h6>
          </div>
          <div class="col-md-6 mt-3">
              <h6 style="text-align: center;">{{$total}}.00 Taka</h6>
              <h6 style="text-align: center;">{{$order_details->payment}}.00 Taka</h6>
          </div>
          <div class="col-md-6 mt-3 ">
              <h6><b>Total Dues:</b></h6>
          </div>
          <div class="col-md-6 mt-3">
              <h6 style="text-align: center;">{{$total-$order_details->payment}}.00 Taka</h6>
          </div>
      </div>
    </div>
@endsection
