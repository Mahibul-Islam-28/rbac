@extends('admin.layout.main')
@section('css')
<link rel="stylesheet" href="{{asset('')}}css/admin/login.css">
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
    </div>

    <div class="form-section">
        <div class="form-control" id="sign-form">
            <form method="post">
                @csrf
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">

                <div class="button-section">
                    <input type="submit" class="login-btn" value="login">
                </div>
            </form>
        </div>

        <div class="forgot-password">
            
        </div>

    </div>


</section>
@endsection