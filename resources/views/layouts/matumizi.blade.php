@include('includes/header')
@include('includes/nav')
@section('bidhaa', 'active')
@include('sweetalert::alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- alert -->

                <!-- /alert -->
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fa fa-th"></i> Expenses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Expenses Product</li>
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
            <!-- Display filter options -->
            <form method="GET" action="{{ route('expenses.filter') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="filter">Filter:</label>
                            <select name="filter" id="filter" class="form-control">
                                <option value="">All</option>
                                <option value="daily">Daily</option>
                                <option value="monthly">Monthly</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" id="start_date_container" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" >
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" id="end_date_container" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="filter"><br></label>
                            <button type="submit" class="btn btn-primary form-control">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fa fa-th"></i> Expenses</h3>
                @can('ongeza-bidhaa')
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-lg1">
                    <span class="fa fa-plus"></span> Add Expense</button>
                @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Total Amount </th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $expense->description }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->created_at }}</td>
                            <td>

                                <a type="button" class="btn btn-sm btn-primary" style="color:white;" data-toggle="modal"
                                    data-target="#modal-secondaryy{{ $expense->id }}"><i class="fas fa-edit"></i></a>

                                <a type="button" class="btn btn-sm btn-danger" style="color:white;" data-toggle="modal"
                                    data-target="#modal-danger{{ $expense->id }}"><i class="fa fa-trash"></i></a>

                            </td>

                        </tr>
                        <div class="modal fade" id="modal-danger{{ $expense->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Futa Bidhaa</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="matumizi/delete/{{ $expense->id }}">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="id" value="{{ $expense->id }}">
                                            <p>
                                                </b></p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light"
                                            data-dismiss="modal">Funga</button>
                                        <button type="submit" name="remove" class="btn btn-outline-light">Futa</button>

                                    </div>
                                    </form>


                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <div class="modal fade" id="modal-secondaryy{{ $expense->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title"><span class="fa fa-edit"></span>Edit Epenses</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="matumizi/edit/{{ $expense->id }}">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="id" value="{{ $expense->id }}">
                                            <div class="row">
                                                <div class="col col-md-12">
                                                    <label>Description</label>
                                                    <textarea id="description" name="description" rows="4"
                                                        cols="104">{{ $expense->description }}</textarea>
                                                </div>

                                                <div class="col col-md-12">
                                                    <label>Amount</label>
                                                    <input type="number" name="amount" class="form-control"
                                                        value="{{ $expense-> amount}}">
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
                        @endforeach

                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>


        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<form method="post" action="matumizi/create">
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
                        <div class="col col-md-12">
                            <label>Description</label>
                            <textarea id="description" name="description" rows="4" cols="104"></textarea>
                        </div>

                        <div class="col col-md-12">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control" placeholder="Weka kiasi..."
                                required>
                        </div>
                    </div>
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button name="addproduct" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>


@include('includes/footer')