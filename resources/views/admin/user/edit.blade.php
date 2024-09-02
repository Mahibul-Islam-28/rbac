@extends('admin.layout.main')

@section('content')
@php $role = Session::get('admin')->role @endphp
<section class="main-content">
    <div class="container">

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

        <h3 class="text-center mt-5">Edit {{$user->name}}</h3>

        <form method="post" id="editForm" class="mx-4 my-2 needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            <div class="form-group my-2">
                <label for="type">Role</label>
                <select name="role" id="role" class="form-select mt-2" required>
                    <option value="-1" disabled selected>-- select one ---</option>
                    @if($role == 'admin')
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}> Admin
                    </option>
                    <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}> Manager
                    </option>
                    @endif
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}> User </option>
                </select>
                <div class="invalid-feedback">Please User Role!</div>
            </div>

            <div class="form-group my-2">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control mt-1" required>
                <div class="invalid-feedback">Please Enter Your Name!</div>
            </div>

            <div class="form-group my-2">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{$user->email}}" id="email" class="form-control mt-1" required>
                <div class="invalid-feedback">Please Enter Your Email!</div>
            </div>

            <div class="my-4">
                <input type="submit" value="Update" class="btn btn-dark px-5">
            </div>

        </form>
    </div>
</section>

@endsection


@section('js')
<script>
    (() => {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()

</script>
@endsection
