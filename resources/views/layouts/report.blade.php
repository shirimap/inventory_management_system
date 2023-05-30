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
                    <h1 class="m-0 text-dark"><span class="fa fa-file-text-o"></span> Report </h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home </a></li>
                        <li class="breadcrumb-item active">Report</li>
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
                                    <!-- /.form group -->
                                    <div class="col-3">
                                        <!-- Date and time range -->
                                        <div class="form-group">
                                            <label>Date From:</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                                <input type="date" class="form-control float-right"
                                                    name="fromDate"  />
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.form group -->
                                    <div class="col-3">
                                        <!-- Date and time range -->
                                        <div class="form-group">
                                            <label>Date To:</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                                <input type="date" class="form-control float-right" id="toDate"
                                                    name="toDate"  />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <!-- Date and time range -->
                                        <div class="form-group">
                                            <label>Other:</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                                <select name="other" id="" class="form-control float-right" >
                                                <option value="">...</option>
                                                    @foreach($bidhaa as $p)
                                                    
                                                    <option value="{{$p->id}}" >{{$p->name}}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for=""><br></label>
                                        <button type="submit" class="btn btn-primary form-control" name="search"
                                            title="Search">Search</button>
                                        <!-- <a type="submit" href="{{route('reportPrint')}}" class="btn btn-warning form-control"
                                            >Print</a> -->
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-3 float-right">
                                        <label for="">Mauzo</label>
                                        <h1><b>{{$pius}}/=</b></h1>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Faida</label>
                                        <h1><b>{{$sikup}}/=</b></h1>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>

                </div>

            </div><!-- /.col -->
        </div><!-- /.row -->
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
                                            <th>Product</th>
                                            <th>Type</th>
                                            <th>Qunatity</th>
                                            <th>Price</th>
                                            <th>Total Amount</th>
                                            <th>Profit</th>                                            
                                            <th>Branch</th>
                                            <th>Category</th>
                                            
                                     
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($query as $q)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><b>{{ $q->product->sbidhaa->name }}</b></td>
                                            <td>{{ $q->product->sbidhaa->type}}</td>
                                            <td> {{ $q->quantity }} </td>
                                            <td>{{ $q->amount }}</td>
                                            <td><b>{{$q->amount}}</b></td>
                                            <td><b>{{$q->profit}}</b></td>
                                            <td> {{ $q->product->branch->name }}</td>
                                            <td>{{ $q->product->category->name }}</td>
                                            <td></td>
                                            
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
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

</div>
<!-- /.content-wrapper -->

<!-- ./wrapper -->

@include('includes/footer')