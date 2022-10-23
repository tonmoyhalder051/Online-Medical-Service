@extends('layouts.app')
@section('menu')
    @include('customer.menu.menu')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @foreach($errors->all() as $error )
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        {{$error}}
                    </div>
                </div>

            @endforeach
        </div>

        <form class="row g-3 shadow-sm" method="post" action="{{route('submit_user_confirmation')}}">
            @csrf
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email" value="{{auth()->user()->email}}">
            </div>
            <div class="col-md-12">
                <label  class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="name" aria-label="name" name="name" value="{{auth()->user()->name}}">
            </div>
            <div class="col-md-8">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress"  name="address" value="{{$profile_data->address}}">
            </div>
            <div class="col-md-4">
                <label for="inputAge">Age</label>
                <input type="number" class="form-control" id="inputAge" name="age">
            </div>
            <div class="col-md-6">
                <label  class="form-label">Mobile no</label>
                <input type="tel" class="form-control" id="mbl" name="mobile" value="{{$profile_data->mobile}}">

            </div>
            <div class="col-md-3">
                <label  class="form-label">Gender</label>
                <select id="inputGender" class="form-control" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="col-md-3">
                <label  class="form-label">Blood Group</label>
                <select id="type" class="form-control" name="blood_group">
                    <option value="Not Define">Default</option>
                    <option value="O+">O+</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                    <option value="AB+">AB+</option>
                    <option value="O-">O-</option>
                    <option value="A-">A-</option>
                    <option value="B-">B-</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Appointment Date</label>
                <input type="date" class="form-control" id="adate" name="appointment_date">
            </div>
            <div class="col-md-6">
                <label class="form-label">Appointment type</label>
                <select id="type" class="form-control">
                    <option value="1">Regular</option>
                    <option value="2">Home Service</option>
                </select>
            </div>
            <div class="col-md-12 mt-3 mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
