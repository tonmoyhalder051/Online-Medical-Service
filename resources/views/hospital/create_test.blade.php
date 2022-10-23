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
                <form class="row g-3 mt-3" action="{{route('hospital.test.save')}}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <label  class="form-label">Test name</label>
                        <input type="text" name="name" class="form-control" placeholder="test name" aria-label="test name">
                    </div>
                    <div class="col-md-12">
                        <label  class="form-label">Unit Price</label>
                        <input type="text"  name="price" class="form-control" placeholder="price" aria-label="price">
                    </div>
                    <div class="col-md-12">
                        <label for="inputdiscount" class="form-label">Discount</label>
                        <input type="number" name="discount" class="form-control" id="inputdiscount" placeholder="discount" aria-label="discount">
                    </div>
                    <div class="col-md-12 mt-3 mb-3" style="text-align: end;">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
