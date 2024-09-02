@extends('layout.main')
@section('css')
<link rel="stylesheet" href="{{asset('')}}css/index.css">
@endsection
@section('content')
<section class="main-content">
    <div class="container">

        <div class="profile-section">
            <div class="row data-column">
                <div class="col-md-6 col-4">Name</div>
                <div class="col-md-6 col-8">{{$user->name}}</div>
            </div>
            <div class="row data-column">
                <div class="col-md-6 col-4">Email</div>
                <div class="col-md-6 col-8">{{$user->email}}</div>
            </div>
            <div class="row data-column">
                <div class="col-md-6 col-4">Role</div>
                <div class="col-md-6 col-8">{{$user->role}}</div>
            </div>
        </div>

    </div>
</section>
@endsection
