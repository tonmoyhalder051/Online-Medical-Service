<div class="col-md-2 bg-dark d-none d-md-block sidebar rounded-left ">
    @if(auth()->user()->role == 2)
    <a href="{{route('onestop.request')}}" class="btn btn-dark btn-sm active w-100 mt-3" role="button" aria-pressed="true">Requested</a>
    <a href="{{route('onestop.pending')}}" class="btn btn-dark btn-sm active w-100 mt-2" role="button" aria-pressed="true">Pending</a>
    <a href="{{route('onestop.complete')}}" class="btn btn-dark btn-sm active w-100 mt-2 mb-3" role="button" aria-pressed="true">Completed</a>
    @endif

    @if(auth()->user()->role == 3)
    <a href="{{route('lab.pending')}}" class="btn btn-dark btn-sm active w-100 mt-3" role="button" aria-pressed="true">Requested</a>
    <a href="{{route('lab.completed')}}" class="btn btn-dark btn-sm active w-100 mt-2 mb-3" role="button" aria-pressed="true">Completed</a>
    @endif
</div>
