@extends('layouts.app')
@section('menu')
    @include('hospital.menu.menu')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session()->Has('success'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('success')}}
                    </div>
                @endif
            </div>
            @foreach($errors->all() as $error)
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        {{$error}}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-lg-5 justify-content-center">
            <div class="col-md-4 shadow-sm bg-light border border-success">
                <form class="row g-3 mt-3" action="{{route('hospital.staff.save')}}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <label  class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="First name" aria-label="First name">
                    </div>
                    <div class="col-md-12">
                        <label  class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                    </div>
                    <div class="col-md-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-12">
                        <label  class="form-label">Category</label>
                        <select id="inputCategory" class="form-control" name="role">
                            <option value="2">One Stop User</option>
                            <option value="3">Lab User</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-3 mb-3" style="text-align: end;">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
