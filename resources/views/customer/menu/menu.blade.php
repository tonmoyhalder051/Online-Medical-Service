<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link active font-weight-bolder " aria-current="page" style="color: #0056b3; font-size:16px; "  href="{{route('home')}}">Home</a>
    </li>
    <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle font-weight-bolder " style="color: #0056b3;font-size:16px;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hospitals</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach(config('app.users')::where('role',1)->get() as $hospital)
                <a class="nav-link active font-weight-bold" href="{{route('services',['id'=>$hospital->id])}}">
                    {{$hospital->name}}

                </a>
            @endforeach

        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link active font-weight-bolder" style="color: #0056b3;font-size:16px;"  href="#">News & Events</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active font-weight-bolder" style="color: #0056b3;font-size:16px;" href="#">Contact us</a>
    </li>
</ul>
