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
                    <h1 class="m-0 text-dark"><span class="fa fa-th"></span>Branch</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Branch</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="card card-primary">
                @can('ongeza-tawi')
                <div class="card-header">
                    <h3 class="card-title"><span class="fa fa-th"></span> Branch Lists</h3>
                    <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal"
                        data-target="#modal-md"> <span class="fa fa-plus"></span> Add Branch</button>
                </div>
                @endcan
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example3" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Area</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>users</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($branch as $branch)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }} </td>
                                <td> {{ $branch->name }}</td>
                                <td> {{ $branch->location }}</td>
                                <td> {{ $branch->address }}</td>
                                <td> {{ $branch->phoneNumber }}</td>
                                <td> {{ $branch->email }}</td>
                                <td> {{ $branch->user->count()}}</td>
                                <td>
                                    @can('hariri-tawi')
                                    <a type="button" class="btn btn-sm btn-primary" style="color:white;"
                                        data-toggle="modal" data-target="#modal-secondary{{ $branch->id }}"><span
                                            class="fa fa-edit"></span></a>
                                    @endcan
                                    @can('futa-tawi')
                                    <button  onclick="deleteConfirmation({{ $branch->id }})"
                                        class="btn btn-danger btn-sm"><span
                                            class="fa fa-trash"> </button>
                                    <form id="delete-form-{{ $branch->id }}" action="matawi/edit/{{ $branch->id }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>                                  
                                    @endcan
                                </td>
                                <!-- modal -->
                                <div class="modal fade" id="modal-danger{{ $branch->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Branch</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="matawi/delete/{{ $branch->id }}">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                    <input type="hidden" name="proid" value="{{ $branch->id }}">
                                                    <p>This Branch will be deleted</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-light"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="remove"
                                                    class="btn btn-outline-light">Delete</button>

                                            </div>
                                            </form>


                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="modal-secondary{{ $branch->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h4 class="modal-title"><span
                                            class="fa fa-edit"></span> Edit Branch</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="matawi/edit/{{ $branch->id }}">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="proid" value="{{ $branch->id }}">
                                                    
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Branch Name</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ $branch->name }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Area</label>
                                                            <input type="text" name="location" class="form-control"
                                                                value="{{ $branch->location }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col col-md-6">
                                                            <label>Adress</label>
                                                            <input type="text" name="address" class="form-control"
                                                                value="{{ $branch->address }}">
                                                        </div>

                                                        <div class="col col-md-6">
                                                            <label>Phone Number</label>
                                                            <input type="text" name="phone" class="form-control"
                                                                value="{{ $branch->phoneNumber }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Email</label>
                                                            <input type="text" name="email" class="form-control"
                                                                value="{{ $branch->email }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="remove"
                                                    class="btn btn-primary">Update</button>

                                            </div>
                                            </form>


                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                </td>
                            </tr>

                        </tbody>

                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <form method="POST" action="{{ route('matawi.add') }}">
        {{ csrf_field() }}
        <div class="modal fade" id="modal-md">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title"><span  class="fa fa-plus"></span> Add Branch</h4>
                        <button type="button" class="close" data-dismiss="modal-body" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                        <div class="row">
                            <div class="col col-md-12">
                                <label>Branch Name</label>
                                <input type="text" name="branchname" class="form-control"
                                    placeholder="Weka jina la tawi...">
                            </div>
                        </div>
                        </p>
                        <p>
                        <div class="row">
                            <div class="col col-md-12">
                                <label>Area</label>
                                <input type="text" name="location" class="form-control"
                                    placeholder="Weka eneo la tawi...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Weka anuani">
                            </div>

                            <div class="col col-md-6">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control"
                                    placeholder="Weka namba ya simu ya tawi...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Weka parua pepe">
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" class="btn btn-danger" value="Cancel" data-dismiss="modal">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

    @if(session()->has('error'))
    <script>
    toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    </script>
    @endif
</div>


<!-- /.content-wrapper -->
@include('includes/footer')
{{-- @include('includes/script') --}}