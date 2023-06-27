@include('includes/header')
@include('includes/nav')
@include('sweetalert::alert')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- alert -->
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="fa fa-th"></span> Debt</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Debt</li>
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
                <div class="card-header">
                    <h3 class="card-title"><span class="fa fa-th"></span> Debits Available</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment No</th>
                                <th>Customer</th>
                                <th>Phone number</th>
                                <th>Quantity</th>
                                <th>Debt Amount</th>                               
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($loan as $q)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$q->order_id}}</td>
                                <td>{{ $q['order']['customer_name'] }}</td>
                                <td>{{ $q['order']['phonenumber'] }}</td>                                
                                <td><b>{{ $q['order']['total_amount'] }}</b></td>
                                <td>{{ $q->amount }}</td>
                                <td>{{$q->created_at}}</td>

                                <td>
                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#modal-md">History</button>
                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#modal-md{{$q->order_id}}">Payment</button>
                                </td>

                                <!-- /.content -->
                                <!-- /.content-wrapper -->

                                <div class="modal fade" id="modal-md{{$q->order_id}}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Debits for {{ $q['order']['customer_name'] }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="payment" method="POST">
                                                   @csrf                                                   
                                                    <input type="hidden" name="order_id" value="{{$q->order_id}}">
                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>Total Price</label>
                                                        </div>
                                                        <div class="col col-md-8">
                                                            <input type="text" class="form-control" value="{{ $q['order']['total_amount'] }}" readonly>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>Quantity</label>
                                                        </div>
                                                        <div class="col col-md-8">
                                                            <input type="text" min="0" class="form-control" value="{{ $q['order']['total_quantity'] }}"
                                                                readonly>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>Amount</label>
                                                        </div>
                                                        <div class="col col-md-8">
                                                            <input type="number" min="0" class="form-control"
                                                                name="paid_amount" placeholder="enter amount paid">
                                                        </div>
                                                    </div><br>

                                                    </p>

                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" 
                                                    class="btn btn-primary">Save</button>
                                            </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                               
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>

@include('includes/footer')