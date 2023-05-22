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
                    <h1 class="m-0 text-dark"><span class="fa fa-file-text-o"></span> Ripoti </h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nyumbani </a></li>
                        <li class="breadcrumb-item active">Ripoti</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('report')}}" method="">
                                @csrf
                                <div class="row">
                                    <div class="col-3">
                                        <label for="date" class="col-form-label">Tarehe ya
                                            kuanzia</label>
                                        <input type="date" class="form-control input-sm" id="fromDate" name="fromDate"
                                            required />
                                    </div>

                                    <div class="col-3">
                                        <label for="date" class="col-form-label">Tarehe ya
                                            kuishia</label>
                                        <input type="date" class="form-control input-sm" id="toDate" name="toDate"
                                            required />
                                    </div>
                                    
                                    <div class="col-3">
                                        
                                        <button  type="submit" class="btn btn-primary form-control" name="search"
                                            title="Search">Search</button>
                                        <a type="submit" href="{{route('reportPrint')}}" class="btn btn-warning form-control"
                                            >Print</a>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Mauzo</label>
                                        <h1><b>{{$pius}}/=</b></h1>
                                    </div>



                                </div>

                            </form>
                        </div>

                    </div>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><span class="fa fa-file-text-o"></span> Report</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jina</th>
                                        <th>Aina</th>
                                        <th>idadi</th>
                                        <th>kiasi</th>
                                        <th>Jumla</th>
                                        <th>Tawi</th>
                                        <th>Kipengele</th>
                                        <th>Mfanyakazi</th>
                                        <th>Tarehe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $q)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $q->product->sbidhaa->name }}</td>
                                        <td>{{ $q->product->sbidhaa->type }}</td>
                                        <td> {{ $q->quantity }} </td>
                                        <td>{{ $q->amount }}</td>
                                        <td>{{$q->amount }}</td>
                                        <td> {{ $q->product->branch->name }}</td>
                                        <td>{{ $q->product->category->name }}</td>
                                        <td></td>
                                        <td>{{ $q->created_at }}</td>
                                    </tr>

                                    @endforeach

                                </tbody>


                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div><!-- /.col -->
                </div><!-- /.row -->


                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ./wrapper -->
@include('includes/footer')