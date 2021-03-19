@extends('backend.layout')

@section('content')

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h5>Update Details</h5>
                        </div>

                        <div class="card-body">
                            <div class="container">

                                <div class="col-sm-12">

                                    <form method="post" action="{{route('editUser', $user->id)}}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="{{$user->name}}"
                                                   name="name"
                                                   placeholder="Enter Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" value="{{$user->email}}"
                                                   name="email"
                                                   placeholder="Enter Email" required>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h5>Change Password</h5>
                        </div>

                        <div class="card-body">
                            <div class="container">

                                <div class="col-sm-12">

                                    <form method="post" action="{{route('editUser', $user->id)}}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                   placeholder="Enter New Password" required>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-warning" type="submit">Change Password</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
