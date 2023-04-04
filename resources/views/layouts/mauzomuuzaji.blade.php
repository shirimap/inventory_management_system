@include('includes/header')
@include('includes/nav')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- alert -->
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fa  fa-bar-chart"></i></i> Mauzo</h1>
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

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Mauzo Yaliyofanyika</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/no</th>
                                <th>Jina la bidhaa</th>
                                <th>Idadi</th>
                                <th>Bei</th>
                                <th>jumla ndogo</th>
                                <th>Jumla</th>
                                <th>punguzo</th>
                                <th>Jumla Bei</th>
                                <th>VAT % </th>
                                <th>Kiasi Halisi </th>
                                <th>Namba ya mauzo</th>
                                <th>Tarehe</th>
                                <th>Mteja</th>
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
                                    {{--  <?php $quantity += $q['quantity'] ?>  --}}
                                    {{ $loop->iteration }}. {{ $q['product'] ['name']}}
                                    {{ $q['product'] ['type']}}<br><br>

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
                                    {{ $q['amount'] }} <br><br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($p as $q)
                                    {{ $q['amount'] * $q['quantity'] }} <br><br>
                                    @endforeach
                                </td>

                                {{--  <?php $total += $q['order']['total_amount'] ?>  --}}
                                <td>{{ $q['order']['org_amount']+$q['order']['discount']}}</td>
                                <td>{{ $q['order']['discount'] }}</td>
                                <td>{{ $q['order']['org_amount']}}</td>
                                <td>{{ $q['order']['vat'] }}</td>
                                <td>{{ $q['order']['total_amount'] }}</td>
                                <td>INV-{{ str_pad( $q['order']['id'],5,'0',STR_PAD_LEFT )}}</td>
                                <td>{{ $q['order']['created_at']->format('d/m/Y') }}<br>{{ $q['order']['created_at']->format('h:m a') }}
                                </td>
                                <td>{{ $q['order']['customer_name']}}</td>
                                <td>{{ $q['order']['user']['first_name']}}</td>

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