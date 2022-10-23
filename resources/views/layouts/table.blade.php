<div class="row mb-2">
    <div class="col-md-12 mt-1">
        <form method="" action="">
            <div class="d-flex flex-row">
                <input class="form-control me-2 p-0" disabled type="text"  placeholder="From" style="border: 0px;background: #fff ">
                <input class="form-control me-2 p-0" disabled  type="text"  placeholder="To" style="border: 0px;background: #fff; ">
                <input  type="submit" style="visibility: hidden;"  value="search" class="btn btn-primary">
            </div>
        </form>
    </div>
    <!--
        search_route = route('lab.pending')
        details_route = lab.pending_details
    -->
    <div class="col-md-12 mt-1">
        <form method="post" action="{{$search_route}}">
            @csrf
            <div class="d-flex flex-row">
                <input class="form-control me-2 border border-success justify-content-center mr-1" type="date" name="from" placeholder="From">
                <input class="form-control me-2 border border-success justify-content-center mr-1" type="date" name="to" placeholder="To">
                <input  type="submit"  value="Search" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-2 mb-2">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Appointment id</th>
                <th scope="col">Type</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $request)
                <tr>
                    <td><a href="{{route($details_route ,['id'=>$request->id,'pid'=>$request->user_id, 'confirm'=> $report_confirm])}}">{{$request->id}}</a></td>
                    <td>Regular</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
