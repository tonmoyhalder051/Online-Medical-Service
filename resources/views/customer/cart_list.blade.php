@extends('layouts.app')
@section('menu')
    @include('customer.menu.menu')
@endsection
@section('content')
<div class="container shadow">
    <div class="col-md-12 mt-5">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Test name</th>
                <th scope="col">Type</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Cancel</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $row=1; $total=0;
                foreach($cart_item as $item){
                    $total += $item->price;

            ?>
            <tr>
                <th scope="row">{{$row++}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->service_type}}</td>
                <td>{{$item->price}}.00 Taka</td>
                <td><a href="{{route('delete_item',['id'=>$item->id])}}"><i class="fa fa-trash" style="font-size: 18px"></i></a></td>
            </tr>
            <?php  } ?>
            <tr>
                <td colspan="3" class="text-right"><b>Total Price:</b></td>
                <td colspan="2"><b>{{$total}}.00 Taka</b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2 mb-4" style="text-align: end;">
            <a href="{{route('confirmation')}}" class="btn btn-primary btn-lg active" role="button">Confirm</a>
        </div>
    </div>
</div>


@endsection
