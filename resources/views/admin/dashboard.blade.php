@extends('admin.layout.main')
@section('css')
<link rel="stylesheet" href="{{asset('')}}css/admin/dashboard.css">
@endsection
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

        </div>

        <h3 class="text-center mt-5">User List</h3>

        <div class="container p-2 p-lg-5">

            @if($role == 'admin')
                <a class="create-button" href="{{route('userCreate')}}">Create +</a>
            @else
                <?php
                $permission = '';
                if(Session::get('admin')->permission != null)
                {
                    $permission = explode(", ", Session::get('admin')->permission);
                }
                if(!empty($permission)){
                    foreach($permission as $per)
                    {
                        if($per == 'All' || $per == 'Create')
                        {
                    ?>
                        <a class="create-button" href="{{route('userCreate')}}">Create +</a>
                    <?php
                        }
                    }
                }
                ?>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped pt-3" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Create Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <!-- Set Permission -->
                                @if($role == 'admin')
                                    @if($user->role != 'admin' && $user->role != 'user')
                                        <a class="button" href="{{route('setPermission', $user->id)}}">Set Permision</a>
                                    @endif
                                @endif

                                <!-- Edit -->
                                @if($role == 'admin')
                                    <a class="button" href="{{route('userEdit', $user->id)}}">Edit</a>
                                @else
                                    <?php
                                    $permission = '';
                                    if(Session::get('admin')->permission != null)
                                    {
                                        $permission = explode(", ", Session::get('admin')->permission);
                                    }
                                    if(!empty($permission)){
                                        foreach($permission as $per)
                                        {
                                            if($per == 'All' || $per == 'Edit')
                                            {
                                        ?>
                                            <a class="button" href="{{route('userEdit', $user->id)}}">Edit</a>
                                        <?php
                                            }
                                        }
                                    }
                                    ?>
                                @endif

                                <!-- Delete -->
                                @if($role == 'admin')
                                    <form action="{{route('userDelete', $user->id)}}" method="post">
                                        <input class="button" type="submit" value="Delete" />
                                        @method('delete')
                                        @csrf
                                    </form>
                                @else
                                    <?php
                                    $permission = '';
                                    if(Session::get('admin')->permission != null)
                                    {
                                        $permission = explode(", ", Session::get('admin')->permission);
                                    }
                                    if(!empty($permission)){
                                        foreach($permission as $per)
                                        {
                                            if($per == 'All' || $per == 'Delete')
                                            {
                                        ?>
                                            <form action="{{route('userDelete', $user->id)}}" method="post">
                                                <input class="button" type="submit" value="Delete" />
                                                @method('delete')
                                                @csrf
                                            </form>
                                        <?php
                                            }
                                        }
                                    }
                                    ?>
                                @endif
                                
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        
    </div>
</section>
@endsection
