<div class="row mt-5">
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
</div>
