@extends('layouts.app')
@section('menu')
    @include('hospital.menu.menu')
@endsection
@section('content')
    <div class="container">
        <div class="row shadow">
            <div class="col-md-12 mb-3">
                <h2 style="text-align: center;">{{auth()->user()->name}}</h2>
                <h6 style="text-align: center;">{{$user->address}}</h6>
                <h6 style="text-align: center;"><b>Mob: </b>{{$user->mobile}}</h6>
                <h6 style="text-align: center;"><b>Email: </b>{{auth()->user()->email}}</h6>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h4><b>Test list</b></h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Test name</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Test Update</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($row=1)
                      @foreach($tests as $test)
                      <tr>
                          <th scope="row">{{$row++}}</th>
                          <td>{{$test->name}}</td>
                          <td>{{$test->price}}.00 Taka</td>
                          <td>{{$test->discount}}%</td>
                          <td><button type="button" class="btn btn-primary btn-sm">Toggle</button></td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 mt-2 mb-4" style="text-align: end;">
                <a href="{{route('hospital.test.create')}}" class="btn btn-primary btn-lg active" role="button">Add Test</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <h4><b>Staff list</b></h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Password</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Category</th>
                        <th scope="col">Remove Staff</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($row=1)
                    @foreach($staffs as $staff)
                        @if($staff->id != auth()->id())
                    <tr>
                        <th scope="row">{{$row++}}</th>
                        <td>{{$staff->name}}</td>
                        <td>{{substr($staff->password,0,10)}}</td>
                        <td>{{substr($staff->address,0,10)}}</td>
                        <td>{{$staff->email}}</td>
                        <td>{{$staff->role}}</td>
                        <td><a href="{{route('hospital.staff.delete',['id'=>$staff->id])}}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                       @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 mt-2 mb-4" style="text-align: end;">
                <a href="{{route('hospital.staff.create')}}" class="btn btn-primary btn-lg active" role="button">Add Staff</a>
            </div>
        </div>

    </div>
@endsection
