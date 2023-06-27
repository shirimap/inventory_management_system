@include('includes/header')
@include('includes/nav')
@section('bidhaa', 'active')
@include('sweetalert::alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- /.content-header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Register Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Register Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fa fa-th"></i> Registered Products</h3>
                @can('ongeza-bidhaa')
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-lg1">
                    <span class="fa fa-plus"></span> Register Product</button>
                @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Threshold</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $p)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><b>{{$p->name}}</b></td>
                            <td>{{$p->type}}</td>
                            <td>{{$p->threshold}}</td>
                            <td>{{$p->created_at}}</td>
                            <td>
                                @can('hariri-bidhaa')
                                <a type="button" class="btn btn-sm btn-primary" style="color:white;" data-toggle="modal"
                                    data-target="#modal-secondaryy{{ $p->id }}"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('futa-bidhaa')
                                <a type="button" class="btn btn-sm btn-danger" style="color:white;" data-toggle="modal"
                                    data-target="#modal-danger{{ $p->id }}" id="delete"><i class="fa fa-trash"></i></a>
                                @endcan

                            </td>
                            <div class="modal fade" id="modal-danger{{ $p->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Registered Product</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="sajilbidhaa/delete/{{ $p->id }}">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="proid" value="{{ $p->id }}">
                                                <p>This Product <b>{{ $p->name }} with this type {{ $p->type }} will be
                                                        deleted
                                                    </b></p>
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

                            <div class="modal fade" id="modal-secondaryy{{ $p->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title"><span class="fa fa-edit"></span>Edit Registered
                                                Product</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="sajilbidhaa/edit/{{ $p->id }}">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="proid" value="{{ $p->id }}">

                                                <div class="row">
                                                    <div class="col col-md-6">
                                                        <label>Product Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $p->name }}" required>
                                                    </div>
                                                    <div class="col col-md-6">
                                                        <label>Type</label>
                                                        <input type="text" name="type" class="form-control"
                                                            value="{{ $p->type }}" required>
                                                    </div>
                                                    <div class="col col-md-12">
                                                        <label>Stock Level</label>
                                                        <input type="number" name="threshold" class="form-control"
                                                            value="{{ $p->threshold }}" required>
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="remove" class="btn btn-primary">Update</button>

                                        </div>
                                        </form>


                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.content -->
        <form method="post" action="sajilbidhaa/add">
            @csrf
            <div class="modal fade" id="modal-lg1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title"><span class="fa fa-plus"></span> Register New Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label>Product Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Weka Jina la bidhaa...">
                                </div>
                                <div class="col col-md-6">
                                    <label>Type</label>
                                    <input type="text" name="type" class="form-control"
                                        placeholder="Weka aina ya bidhaa...">
                                </div>
                                <div class="col col-md-12">
                                    <label>Stock Level</label>
                                    <input type="number" name="threshold" class="form-control"
                                        placeholder="Weka idadi Inayotakiwa..." required>
                                </div>
                            </div>
                            </p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button name="addproduct" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </form>
    </section>




    @include('includes/footer')