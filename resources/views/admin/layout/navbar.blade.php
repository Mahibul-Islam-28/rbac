<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('dashboard')}}">RBAC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto">
                @if(session()->has('admin'))
                <li class="nav-item">
                    <a class="nav-link  {{Request::path() === 'adminPanel' ? 'active' : '' }}"
                        href="{{route('dashboard')}}"><i class="fa-solid fa-house"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('adminLogout')}}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard')}}"><i class="fa-solid fa-circle-user"></i></i> @php echo Session::get('admin')->name @endphp </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
    </div>
</nav>
