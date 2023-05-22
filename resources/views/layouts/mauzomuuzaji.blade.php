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
                    <h1 class="m-0 text-dark"><span class="fa fa-th"></span> Mauzo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
                        <li class="breadcrumb-item active">Mauzo</li>
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
                    <h3 class="card-title"><span class="fa fa-th"></span> Mauzo Yaliyofanyika</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bidhaa</th>
                                <th>Idadi</th>
                                <th>Bei</th>
                                <th>jumla Ndogo</th>                                
                                <th>punguzo</th>
                                <th>Jumla Bei</th>
                                <th>VAT % </th>
                                <th>Kiasi Halisi </th>
                                <th>Namba ya Mauzo</th>
                                <th>Tarehe</th>
                                <th>Muuzaji</th>
                                <th>Kitendo</th>
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
                                   <b>{{ $q['product'] ['sbidhaa'] ['name']}}</b> 
                                    @endforeach

                                </td>
                              
                                <td>
                                    @foreach ($p as $q)
                                    {{ $q['quantity'] }}<br><br>
                                    @endforeach

                                </td>
                                <td>
                                    @foreach ($p as $q)
                                    {{ $q['amount'] }} <br><br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($p as $q)
                                    {{ $q['amount'] * $q['quantity'] }} <br><br>
                                    @endforeach
                                </td>

                                
                                <td>{{ $q['order']['discount'] }}</td>
                                <td>{{ $q['order']['org_amount']}}</td>
                                <td>{{ $q['order']['vat'] }}</td>
                                <td>{{ $q['order']['total_amount'] }}</td>
                                <td>INV-{{ str_pad( $q['order']['id'],5,'0',STR_PAD_LEFT )}}</td>
                                <td>{{ $q['order']['created_at']->format('d/m/Y') }}<br>{{ $q['order']['created_at']->format('h:m a') }}
                                </td>
                                <td>{{ $q['order']['user']['first_name']}}</td>

                                @endforeach

                                <td>
                                    @can('tengeneza-invoive')
                                    <a href="{{ route('viewPDF',$sel) }}" target="" class="btn btn-sm btn-warning"><i
                                            class="fas fa-print"></i></a>
                                    @endcan
                                    @can('futa-mauzo')
                                    {{--  <a href="{{ route('risiti',$sel) }}" target="" class="btn btn-sm
                                    btn-warning"><i class="fas fa-print"></i></a> --}}
                                    <a href="delete/{{$sel}}"
                                        onclick="return confirm('Are you sure to want to delete it?')"><button
                                            type="button" class="btn btn-sm btn-danger"><span class="fa fa-trash"
                                                aria-hidden="true"></span></button></a>
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