@include('includes/header')
@include('includes/nav')
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
                    <div>
                        {{--  <div class="input-group">  --}}
                            <label style="margin-top: 7px; padding-right:4px;">Chagua Muda wa Ripoti:</label>
                            {{--  <button type="button" class="btn btn-default float-right" id="daterange-btn">
                                <i class="far fa-calendar-alt"></i> Kiteua Muda
                                <i class="fas fa-caret-down"></i>
                            </button>  --}}
                            <form  action="{{route('report')}}" method ="">
                                @csrf
                                <br>
                                <div class="container">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="form-group row">
                                                <label for="date" class="col-form-label col-sm-2">Tarehe ya kuanzia</label>
                                                <div class="col-sm-3">
                                                    <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" required/>
                                                </div>
                                                <label for="date" class="col-form-label col-sm-2">Tarehe ya kuishia</label>
                                                <div class="col-sm-3">
                                                    <input type="date" class="form-control input-sm" id="toDate" name="toDate" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date" class="col-form-label col-sm-2">Other</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control input-sm" id="other" name="other"placeholder="Search other..." />
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-primary" name="search" title="Search">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </form>
                        {{--  </div>  --}}
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

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Report</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>JIna</th>
                      <th>Aina</th>
                      <th>idadi</th>
                      <th>kiasi</th>
                      <th>Tawi</th>
                      <th>Kipengele</th>
                      <th>Tarehe</th>
                      <th>Mfanyakazi</th>
                      <th>Mteja</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($query as $q)


                    <tr>
                      <td>{{ $q->product->name }}</td>
                      <td>{{ $q->product->type }}</td>
                      <td>
                        {{ $q->quantity }}
                      </td>
                      <td>{{ $q->amount }}</td>
                      <td> {{ $q->product->branch->name }}</td>
                      <td>{{ $q->product->category->name }}</td>
                      <td>{{ $q->created_at->format('d/m/Y') }}</td>
                      <td>{{ $q->order->user->first_name }}</td>
                      <td>{{ $q->order->customer_name }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>JIna</th>
                        <th>Aina</th>
                        <th>idadi</th>
                        <th>kiasi</th>
                        <th>Tawi</th>
                        <th>Kipengele</th>
                        <th>Tarehe</th>
                        <th>Mfanyakazi</th>
                        <th>Mteja</th>
                    </tr>
                    </tfoot>
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
{{--  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>  --}}
  </div>


<!-- ./wrapper -->



@include('includes/footer')
