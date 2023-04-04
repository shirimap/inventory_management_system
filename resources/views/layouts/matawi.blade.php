@include('includes/header')
@include('includes/nav')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="fa fa-map-marker"></span> Matawi</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
                        <li class="breadcrumb-item active">Matawi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p color="white">{{ session()->get('error') }}
        </div>
        @endif
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            <p color="white">{{ session()->get('message') }}
        </div>
        @endif
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="card card-secondary card-outline">
                @can('ongeza-tawi')
                <div class="card-header">
                    <h3 class="card-title">Matawi yaliyopo</h3>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                        data-target="#modal-md"> <span class="fa fa-plus"></span> Ongeza tawi</button>
                </div>
                @endcan
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>

                            <tr>
                                <th>S/no</th>
                                <th>Jina la tawi</th>
                                <th>Eneo</th>
                                <th>Anuani</th>
                                <th>Namba ya simu</th>
                                <th>Parua Pepe</th>

                                <th>Idadi ya wauzaji</th>
                                <th>Kitendo</th>
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
                                    <a type="button" class="btn btn-sm btn-danger" style="color:white;"
                                        data-toggle="modal" data-target="#modal-danger{{ $branch->id }}"><span
                                            class="fa fa-trash"></span></a>
                                    @endcan
                                </td>
                                <!-- modal -->
                                <div class="modal fade" id="modal-danger{{ $branch->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ondoa Tawi</h4>
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
                                                    <p>Tawi hili Litafutwa </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-light"
                                                    data-dismiss="modal">Funga</button>
                                                <button type="submit" name="remove"
                                                    class="btn btn-outline-light">Ondoa</button>

                                            </div>
                                            </form>


                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>


                                <div class="modal fade" id="modal-secondary{{ $branch->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hariri Tawi</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="matawi/edit/{{ $branch->id }}">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="proid" value="{{ $branch->id }}">
                                                    <p>Tawi hili Litafutwa </p>

                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Jina la Tawi</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ $branch->name }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Eneo la Tawi</label>
                                                            <input type="text" name="location" class="form-control"
                                                                value="{{ $branch->location }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col col-md-6">
                                                            <label>Anuani la Tawi</label>
                                                            <input type="text" name="address" class="form-control"
                                                                value="{{ $branch->address }}">
                                                        </div>

                                                        <div class="col col-md-6">
                                                            <label>Namba ya simu Tawi</label>
                                                            <input type="text" name="phone" class="form-control"
                                                                value="{{ $branch->phoneNumber }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Barua Pepe</label>
                                                            <input type="text" name="email" class="form-control"
                                                                value="{{ $branch->email }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-light"
                                                    data-dismiss="modal">Funga</button>
                                                <button type="submit" name="remove"
                                                    class="btn btn-outline-light">Hariri</button>

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
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ongeza Tawi</h4>
                        <button type="button" class="close" data-dismiss="modal-body" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                        <div class="row">
                            <div class="col col-md-12">
                                <label>Jina la Tawi</label>
                                <input type="text" name="branchname" class="form-control"
                                    placeholder="Weka jina la tawi...">
                            </div>
                        </div>
                        </p>
                        <p>
                        <div class="row">
                            <div class="col col-md-12">
                                <label>Eneo la Tawi</label>
                                <input type="text" name="location" class="form-control"
                                    placeholder="Weka eneo la tawi...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <label>Anuani la Tawi</label>
                                <input type="text" name="address" class="form-control" placeholder="Weka anuani">
                            </div>

                            <div class="col col-md-6">
                                <label>Namba ya simu Tawi</label>
                                <input type="text" name="phone" class="form-control"
                                    placeholder="Weka namba ya simu ya tawi...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <label>Barua Pepe</label>
                                <input type="text" name="email" class="form-control" placeholder="Weka parua pepe">
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" class="btn btn-default" value="Funga" data-dismiss="modal">
                        <input type="submit" class="btn btn-primary" value="Ongeza">
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