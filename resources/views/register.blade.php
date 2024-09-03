@extends('layout.main')
@section('css')
<link rel="stylesheet" href="{{asset('')}}css/register.css">
@endsection

@section('content')
<section class="main-content">

    <div class="alert-section">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="form-section">

        <h2>Role-Based Access Control System</h2>

        <div class="form-control" id="register-form">
            <form method="post">
                @csrf

                <div class="form-geoup">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                </div>

                <div class="form-geoup">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                </div>
                
                <div class="form-geoup">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required minlength="5">
                </div>
                

                <div class="button-part">
                    <input type="submit" class="login-btn" value="Register">
                </div>
            </form>

            <div class="bottom-part">
                <a href="{{route('userLogin')}}">Already Registered?</a>
            </div>
        </div>

    </div>


</section>
@endsection