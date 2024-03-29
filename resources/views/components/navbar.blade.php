
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{route('welcome')}}">
            <img src="{{asset('images/logo.png')}}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mentor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Business</a>
                </li>
            </ul>



            <div class="d-flex">
                @auth
                    <div class="d-flex user-logged nav-item dropdown no-arrow">
                        <a id="dropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><b class="caret"></b>

                        Halo, {{Auth::user()->name}}!

                        {{-- kita buat kondisi dia disini kalau gak ada avatar --}}
                        @if (Auth::user()->avatar)

                        <img src="{{Auth::user()->avatar}}" class="user-photo" alt="" style="border-radius: 50%">
                        @else
                        <img src="https://ui-avatars.com/api/?name=Admin" class="user-photo" alt="" style="border-radius: 50%">
                        @endif



                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="right: 0; left: auto">
                            <li><a href="{{ route('dashboard') }}" class="dropdown-item">My Dashboard</a></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{route('login')}}" class="btn btn-master btn-secondary me-3">
                        Sign In
                    </a>
                    <a href="{{route('login')}}" class="btn btn-master btn-primary">
                        Sign Up
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
