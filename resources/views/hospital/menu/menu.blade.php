<ul class="navbar-nav ml-auto">
    @if(auth()->user()->role == 2)
        <li class="nav-item">
            <a class="nav-link active font-weight-bolder " aria-current="page" style="color: #0056b3; font-size:16px; "  href="{{route('onestop.home')}}">Home</a>
        </li>
    @endif

    @if(auth()->user()->role == 3)
        <li class="nav-item">
            <a class="nav-link active font-weight-bolder " aria-current="page" style="color: #0056b3; font-size:16px; "  href="{{route('lab.pending')}}">Home</a>
        </li>
    @endif
        @if(auth()->user()->role == 1)
    <li class="nav-item">
        <a class="nav-link active font-weight-bolder " aria-current="page" style="color: #0056b3; font-size:16px; "  href="{{route('hospital.home')}}">Home</a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link active font-weight-bolder" style="color: #0056b3;font-size:16px;" href="#">Check profit</a>
    </li>
    <li class="nav-item">
        <a class="font-weight-bold btn btn-secondary" style="font-size: 16px;" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>
