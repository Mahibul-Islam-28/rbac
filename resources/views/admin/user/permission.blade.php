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

        <h4 class="mt-5">Set Permission for {{$user->name}}</h4>

        <form method="post" id="permissionForm" class="my-2 needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            @if($role == 'admin')
            <div class="form-group mt-3">
                <label for="adminPermission" class="form-label">Permission:</label>
                <div class="input-group">
                    <div class="checkbox check-label">
                        <div class="checkbox-inline me-3">
                            <input type="checkbox" id="allPermission" name="permission[]" value="All" <?php 
                            if(!empty($permission)){
                            foreach($permission as $per)
                            {
                                if($per == 'All')
                                {
                                    echo "checked='checked'";
                                }
                            }}?>> All
                        </div>
                    </div>
                    <div class="checkbox check-label">
                        <div class="checkbox-inline me-3">
                            <input type="checkbox" class="otherPermission" name="permission[]" value="View" <?php if(!empty($permission)){
                                foreach($permission as $per)
                                {
                                    if($per == 'View')
                                    {
                                        echo "checked='checked'";
                                    }
                                }}?>> View
                        </div>
                    </div>
                    <div class="checkbox check-label">
                        <div class="checkbox-inline me-3">
                            <input type="checkbox" class="otherPermission" name="permission[]" value="Create" <?php if(!empty($permission)){
                                foreach($permission as $per)
                                {
                                    if($per == 'Create')
                                    {
                                        echo "checked='checked'";
                                    }
                                } }?>> Create
                        </div>
                    </div>
                    <div class="checkbox check-label">
                        <div class="checkbox-inline me-3">
                            <input type="checkbox" class="otherPermission" name="permission[]" value="Edit" <?php if(!empty($permission)){
                                foreach($permission as $per)
                                {
                                    if($per == 'Edit')
                                    {
                                        echo "checked='checked'";
                                    }
                                }}?>> Edit
                        </div>
                    </div>
                    <div class="checkbox check-label">
                        <div class="checkbox-inline me-3">
                            <input type="checkbox" class="otherPermission" name="permission[]" value="Delete" <?php if(!empty($permission)){
                            foreach($permission as $per)
                            {
                                if($per == 'Delete')
                                {
                                    echo "checked='checked'";
                                }
                            }}?>> Delete
                        </div>
                    </div>
                </div>
            </div>

            @endif

            <div class="my-4">
                <input type="submit" value="Set Permission">
            </div>

        </form>
    </div>
</section>

@endsection


@section('js')
<script>
    // Admin
    $('#allPermission').change(function () {
        const isChecked = $("#allPermission").is(":checked");
        if (isChecked) {
            $('.otherPermission').prop("checked", false);
            $('.otherPermission').attr("disabled", true);
        } else {
            $('.otherPermission').attr("disabled", false);
        }
    });


</script>
@endsection
