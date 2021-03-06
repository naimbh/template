@extends('backend.layout')

@section('content')

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h5>Bulk Users Upload</h5>
                        </div>

                        <div class="card-body">
                            <form method="post" action="{{route('bulkUpload')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="excelUp">Upload Excel file
                                            <a href="{{asset('files/sample_excel.xlsx')}}"
                                               class="btn btn-sm btn-outline-info rounded ml-4 d-inline">Sample
                                                Excel <i class="fas fa-download"></i></a>
                                        </label>
                                        <input name="excel" type="file" class="form-control-file"
                                               accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" id="excelUp" required>
                                    </div>

                                    <div class="col-md-6">
                                        <button class="btn btn-info mt-3" type="submit">Add New Users
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h5>Users</h5>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="add-btn-group-padding">
                                        <button type="button" class="btn btn-primary btn-md" data-toggle="modal"
                                                data-target="#form"><i class="fa fa-plus fa-sm"></i> Add An User
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users->where('role', 'user') as $item)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->role}}</td>
                                            <td>
                                                <a href="{{route('showUser', $item->id)}}">
                                                    <span class="btn-sm bg-primary"><i class="fas fa-pencil-alt"></i></span>
                                                </a>
                                                <a href="{{route('dltUser', $item->id)}}">
                                                    <span class="btn-sm bg-danger"><i class="fas fa-trash"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{--modal add User--}}
        <div class="modal fade" id="form">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form method="post" action="{{route('addUser')}}">
                        @csrf
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-gradient-primary">
                                <h4 class="modal-title text-center">Add An User</h4>
                                <button type="button" class="close" data-dismiss="modal">??</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="{{old('name')}}"
                                           name="name"
                                           placeholder="Enter Name" required>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="{{old('email')}}" name="email"
                                           placeholder="Enter Email" required>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Enter Password" required>
                                </div>

                                <input type="hidden" name="role" value="user">

                            </div>


                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(function () {
                $('#datatable').DataTable();
            });
        </script>
    @endpush


@endsection

