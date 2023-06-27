@include('includes/header')
@include('includes/nav')



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- alert -->

                <!-- /alert -->
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fa  fa-bar-chart"></i></i>Order</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">

        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


        </div>
        <!-- /.content-header -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Order List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Number</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Customer</th>
                                <th>Seller</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($o as $o)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><b> PINV-{{ str_pad( $o->id,5,'0',STR_PAD_LEFT )}}</b></td>
                                <td>{{ $o->total_quantity}}</td>
                                <td><b>{{ number_format($o->total_amount)}}</b></td>
                                <td>{{ ucwords($o->customer_name)}}</td>
                                <td>{{ ucwords(Auth::user()->first_name)}}</td>

                                <td>{{ $o['created_at']->format('d/m/Y') }}<br>{{ $o['created_at']->format('h:m a') }}
                                </td>
                                <td>
                                    @can('tengeneza-preInvoice')

                                    @endcan
                                    @can('hariri-order')
                                    <a href="{{ route('previewPDF',$o->id) }}" target="" class="btn btn-warning"><i
                                            class="fas fa-download"></i></a>
                                    @endcan
                                    @can('futa-order')
                                    <a href="delete/{{$o->id}}"
                                        onclick="return confirm('Are you sure to want to delete it?')"><button
                                            type="button" class="btn btn-small btn-danger"><span class="fa fa-trash"
                                                aria-hidden="true"
                                                style="color: black;font-size:16px;"></span></button></a>
                                    @endcan
                                </td>

                            </tr>
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

</div>

<!-- /.content-wrapper -->
<!-- /.content-wrapper -->
@include('includes/footer')