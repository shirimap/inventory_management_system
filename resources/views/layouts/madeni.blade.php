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
                    <h1 class="m-0 text-dark"><span class="fa fa-th"></span> Madeni</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
                        <li class="breadcrumb-item active">Madeni</li>
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
                                <th>Customer</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Small Price</th>
                                <th>Discount</th>
                                <th>Total Price</th>
                                <th>VAT % </th>
                                <th>Net Price</th>
                                <th>INvoice Number</th>
                                <th>Date</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($group as $sel=> $sell)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                @foreach ($sell as $p)
                                <td> @foreach ($p as $q)
                                    {{ $q['order']['customer_name'] }}
                                    @endforeach
                                </td>

                                <td> @foreach ($p as $q)
                                    {{ $q['order']['total_quantity'] }}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($p as $q)
                                    {{ $q['product']['amount'] }} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($p as $q)
                                    {{ $q['product']['amount']* $q['quantity'] }} <br><br>
                                    @endforeach
                                </td>


                                <td>{{ $q['order']['discount'] }}</td>
                                <td>{{ $q['order']['org_amount']}}</td>
                                <td>{{ $q['order']['vat'] }}</td>
                                <td>{{ $q['order']['total_amount'] }}</td>
                                <td>INV-{{ str_pad( $q['order']['id'],5,'0',STR_PAD_LEFT )}}</td>
                                <td>{{ $q['order']['created_at']->format('d/m/Y') }}<br>{{ $q['order']['created_at']->format('h:m a') }}
                                </td>


                                @endforeach

                                <td>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#modal-md"><span class="fa fa-minus"></span> Hariri Deni</button>

                                    <a href="{{ route('viewPDF',$sel) }}" target="" class="btn btn-sm btn-warning"><i
                                            class="fas fa-print"></i></a>

                                </td>

                                <!-- /.content -->
                                <form action="checkout" method="POST">
                                    @csrf
                                    <div class="modal fade" id="modal-md">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Debits</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>Customer</label>
                                                        </div>
                                                        <div class="col col-md-8">
                                                            <input type="text" class="form-control" name="customer_name"
                                                                value="{{ $q['order']['customer_name'] }}">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>Total Price</label>
                                                        </div>
                                                        <div class="col col-md-8">
                                                            <input type="text" name="total_amount" class="form-control"
                                                                value=" {{ $q['order']['total_amount'] }}" readonly>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>Quantity</label>
                                                        </div>
                                                        <div class="col col-md-8">
                                                            <input type="number" min="0" name="total_quantity"
                                                                class="form-control"
                                                                value="{{ $q['order']['total_quantity'] }}" readonly>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>Payment</label>
                                                        </div>
                                                        <div class="col col-md-8">
                                                            <select name="status" id="" class="form-control">
                                                                <option value="">...</option>
                                                                <option value="IMEUZWA">Cash</option>
                                                                <option value="MKOPO">Loan</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Cancel</button>

                                                    <button type="submit" name="sell"
                                                        class="btn btn-primary">Save</button>
                                                </div>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </form>
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
<!-- /.content-wrapper -->
@include('includes/footer')