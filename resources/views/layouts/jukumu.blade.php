@include('includes/header')
@include('includes/nav')
@include('sweetalert::alert')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="fa fa-th"></span> Role</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content pb-3">
        <div class="container-fluid h-100">
            <div class="row">
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title"><span class="fa fa-th"></span> Add Role</div>
                        </div>
                        <div class="card-body">

                            <form action="addrole" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Role Name:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Permissions:</label>
                                    <div class="row">
                                        @foreach($permission as $permissions)
                                        <div class="col-4">
                                            <input type="checkbox" name="permission[ ]" value="{{$permissions->id}}">
                                            {{$permissions->name}}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-primary float-right">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="card-title "><span class="fa fa-th"></span>Roles List

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-sm  table-hover">
                                <thead>
                                    <th>Name</th>
                                    <th>Idadi</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($role as $r)
                                    <tr>
                                        <td>{{$r->name}}</td>
                                        <td>{{ $r->getPermissionNames()->count() }}</td>
                                        <td>{{$r->created_at}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#modal-defaultt{{ $r->id }}"> <span
                                                    class="fa fa-edit"></span>Edit</button>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#modal-danger{{ $r->id }}"><span
                                                    class="fa fa-trash"></span>Delete</button>

                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-defaultt{{ $r->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header  bg-primary">
                                                    <h4 class="modal-title">Edit Role</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="editRole/{{ $r->id }}">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col col-md-12">
                                                                <label>Role Name</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $r->name }}">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Permissions</label>
                                                                   
                                                                    <div class="row">
                                                                    @foreach($permission as $p)
                                                                        <div class="col-4">
                                                                            <input type="checkbox" id="p-{{$p->id}}"
                                                                                name="permission[]" value="{{$p->id}}"
                                                                                @if($r->permissions->Contains($p->id))
                                                                                checked
                                                                                @endif
                                                                            >
                                                                            {{$p->name}}
                                                                        </div>
                                                                     @endforeach
                                                                    </div>
                                                                   
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modal-danger{{ $r->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Role</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="deleterole/{{$r->id}}">
                                                        @csrf
                                                        <input type="hidden" name="proid" value="">
                                                        <p>Role will be deleted</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-light"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="remove"
                                                        class="btn btn-outline-light">Delete</button>

                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


    </section>


</div>
<!-- /.row -->

<!-- /.row -->
</div>
<!-- /.content-wrapper -->
@include('includes/footer')
{{-- @include('includes/script') --}}