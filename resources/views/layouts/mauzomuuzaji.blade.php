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
                    <h1 class="m-0 text-dark"><span class="fa fa-th"></span> Sales</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sales</li>
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
                    <h3 class="card-title"><span class="fa fa-th"></span> Sales List</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Profit</th>
                                <th>Small Price</th>
                                <th>Total</th>
                                <th>Disc</th>
                                <th>Total Price</th>
                                <th>VAT % </th>
                                <th>Net Price</th>
                                <th>Invoice</th>                                
                                <th>Seller</th>
                                <th>Created_at</th>
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

                                <td>
                                    @foreach ($p as $q)
                                    {{--  <?php $quantity += $q['quantity'] ?>  --}}
                                    <b> {{ $loop->iteration }}. {{ $q['product']['sbidhaa']['name']}}</b> <br><br>

                                    @endforeach

                                </td>
                                {{--  <td> {{ $p->sum('quantity') }}</td> --}}
                                <td>
                                    @foreach ($p as $q)
                                    {{ $q['quantity'] }}<br><br>
                                    @endforeach

                                </td>
                                <td>
                                    @foreach ($p as $q)
                                    {{ $q['total_amount'] }} <br><br>
                                    @endforeach
                                </td>
                                <td>
                                @foreach ($p as $q)
                                    {{ $q['profit'] }} <br><br>
                                    @endforeach
                                </td>


                                <td>
                                    @foreach ($p as $q)
                                    <b> {{ $q['total_amount'] * $q['quantity'] }}</b> <br><br>
                                    @endforeach
                                </td>

                                {{--  <?php $total += $q['order']['total_amount'] ?>  --}}
                                <td>{{ $q['order']['org_amount']+$q['order']['discount']}}</td>
                                <td>{{ $q['order']['discount'] }}</td>
                                <td><b>{{ $q['order']['org_amount']}}</td>
                                <td>{{ $q['order']['vat'] }}</td>
                                <td><b>{{ $q['order']['total_amount'] }}</b></td>
                                <td>INV-{{ str_pad( $q['order']['id'],5,'0',STR_PAD_LEFT )}}</td>
                                {{--<td>{{ $q['order']['customer_name']}}</td>--}}
                                <td>{{ $q['order']['user']['first_name']}}</td>
                                <td>{{ $q['order']['created_at']->format('d/m/Y') }}<br>{{ $q['order']['created_at']->format('h:m a') }}
                                </td>


                                @endforeach


                                <td>
                                    @can('tengeneza-invoive')
                                    <a href="{{ route('viewPDF',$sel) }}" target="" class="btn btn-warning"><i
                                            class="fas fa-print"></i></a>
                                    @endcan
                                    @can('futa-mauzo')
                                    {{--  <a href="{{ route('risiti',$sel) }}" target="" class="btn btn-warning"><i
                                        class="fas fa-print"></i></a> --}}
                                    <a href="delete/{{$sel}}"
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
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@include('includes/footer')