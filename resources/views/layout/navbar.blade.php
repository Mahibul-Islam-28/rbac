<nav class="navbar navbar-expand-md">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">RBAC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="userNavbar">
            <ul class="navbar-nav ms-auto">
                @if(Session::has('user'))
                <li class="nav-item">
                    <a class="nav-link {{Request::path() === '/' ? 'active' : '' }}" href="{{route('index')}}"><i class="fa-solid fa-house"></i> Home</a>
                </li>

                @php $role = Session::get('user')->role @endphp
                @if($role == 'manager' || $role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('adminLogin')}}"><i class="fa-solid fa-users-gear"></i> Admin Panel</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{route('userLogout')}}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('index')}}"><i class="fa-solid fa-circle-user"></i></i> @php echo Session::get('user')->name @endphp </a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('userLogin')}}"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
