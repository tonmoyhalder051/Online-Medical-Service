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
                @if($report_confirm == 1)
                <th scope="col">Action</th>
                @endif
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
                @if($report_confirm == 1)
                <td>
                    @if($test->report == "Not Available")
                        <i class="fa fa-upload link_p mr-2 upload" title="Upload" data-service-id="{{$test->id}}" data-toggle="modal" data-target="#upload_modal"></i>
                    @else
                        <a href="{{route('lab.delete', ['id'=> $test->id])}}"><i class="fa fa-trash link_p" title="Delete"></i></a>
                    @endif
                </td>
                @endif
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right"><b>Total Price:</b></td>
                <td colspan="2"><b>{{$total}}.00 Taka</b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col text-right">
        @if($report_confirm == 1)
        <a class="btn btn-primary" href="{{route('lab.confirm', ['id' => $order_details->id])}}">Confirm</a>
        @endif
    </div>
</div>
