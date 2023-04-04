
@include('includes/header')
<head>

    <link href="{{URL::to('assets1/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('assets1/css/style.css')}}" rel="stylesheet">
</head>
@include('includes/nav')

    {{--  <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Home</a></li>
                <li class="breadcrumb-item active">Data / Table</li>
            </ul>
        </div>
    </div>
    <br>  --}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><i class="nav-icon fa  fa-bar-chart"></i> Historia ya mauzo</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
                <li class="breadcrumb-item active">Ripoti</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    <section class="content">
        <div class="container-fluid">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            {{--  <button  class="btn btn-success"><a href="{{route('form/employee/new')}}"><i class="fa fa-plus"></i></a> Add New</button>  --}}
            <form  action="{{route('search')}}" method ="POST">
                @csrf
                <br>
                <div class="container">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="form-group row">
                                <label for="date" class="col-form-label col-sm-2">Date Of Birth From</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" required/>
                                </div>
                                <label for="date" class="col-form-label col-sm-2">Date Of Birth To</label>
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
                                    <button type="submit" class="btn" name="search" title="Search"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </form>
            <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                <?php $total=0 ?>
                <?php $quantity=0 ?>
                <thead>
                    <tr>
                        <th>sn</th>
                        <th>Tarehe ya Mauzo</th>
                        <th>Bidhaa</th>
                        <th>Idadi</th>
                        <th>Punguzo</th>
                        <th>Bei</th>
                        <th>Kiasi</th>
                        <th>Muuzaji</th>
                        <th>Tawi</th>
                        {{--  <th aria-hidden="true">Kitendo</th>  --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($query as $value)
                    <tr>
                        <td class="id">{{$loop->iteration}}</td>
<?php $total+=($value->quantity * $value->amount) ?>
<?php $quantity+=$value->quantity ?>
                        <td class="email">{{$value->created_at}}</td\
                                                    <td class="name">{{$value->product->name}}-{{$value->product->type}}</td>
                        <td class="sex">{{$value->quantity}}</td>
                        <td class="discount">{{$value->product->discount}}%</td>
                        <td class="dateOfBirth">{{$value->amount}}</td>
                        <td class="salary">Tsh {{$value->quantity * $value->amount}}</td>
                        <td class="phone">{{$value->order->user->first_name}} {{$value->order->user->last_name}}</td>
                        <td class="jobPosition">{{$value->product->branch->name}}-{{$value->product->branch->location}}</td>




                        {{--  <td class="text-center">

                            <button type="submit" class="btn btn-small btn-warning"><span class="fa fa-print" aria-hidden="true"></span></button>


                            <a href="delete/{{$value->id}}" onclick="return confirm('Are you sure to want to delete it?')"> <i class="fa fa-trash" aria-hidden="true" style="color: red;font-size:16px;"></i></a>

                        </td>  --}}
                    </tr>
                    @endforeach
{{--  <tr>
    <td colspan="7" class="id">TOTAL</td>
    <td class="id">{{ $quantity }}</td>
    <td class="id">{{ $total }}</td>
    <td class="id">jh</td>
</tr>  --}}
                </tbody>

                    <b> JUMLA YA BIDHAA <em>{{ $quantity }}</em>
                     JUMLA YA MAPATO <em>{{ $total }}</em> </b>

            </table>

        </div>
    </section>

    <!-- Modal Update-->
    <div class="modal fade" id="update" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                    </button>
                </div>
                {{--  <form action="{{route('update')}}" method = "post"><!-- form delete -->
                    {{ csrf_field() }}  --}}
                    <input type ="text"hidden class="col-sm-9 form-control" id="id" name="id" value="" />
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" ="e_name"name="name" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sex</label>
                            <div class="col-sm-9">
                                <input type="text" ="e_sex"name="sex" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date Of Birth</label>
                            <div class="col-sm-9">
                                <input type="date" ="e_dateOfBirth"name="dateOfBirth" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" ="e_email"name="email" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" ="e_phone"name="phone" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Job Position</label>
                            <div class="col-sm-9">
                                <input type="text" ="e_jobPosition"name="jobPosition" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Salary</label>
                            <div class="col-sm-9">
                                <input type="text" ="e_salary"name="salary" class="form-control" value="" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
                        <button type="submit" id=""name="" class="btn btn-success  waves-light"><i class="icofont icofont-check-circled"></i>Update</button>
                    </div>
                </form><!-- form delete end -->
            </div>
        </div>
    </div> <!-- End Modal Delete-->


    <!-- JavaScript files-->

    <script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::to('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::to('assets/js/grasp_mobile_progress_circle-1.0.0.min.js')}}"></script>
    <script src="{{URL::to('assets/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{URL::to('assets/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{URL::to('assets/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{URL::to('assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{URL::to('assets/js/charts-home.js')}}"></script>

    <!-- for export all -->
    <script src="{{URL::to('assets1/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{URL::to('assets1/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        // select update js
        $(document).on('click', '.edit', function()
        {
            var _this = $(this).parents('tr');
            $('#id').val(_this.find('.id').text());
            $('#e_name').val(_this.find('.name').text());
            $('#e_sex').val(_this.find('.sex').text());
            $('#e_dateOfBirth').val(_this.find('.dateOfBirth').text());
            $('#e_email').val(_this.find('.email').text());
            $('#e_phone').val(_this.find('.phone').text());
            $('#e_jobPosition').val(_this.find('.jobPosition').text());
            $('#e_salary').val(_this.find('.salary').text());
            $('#e_discount').val(_this.find('.discount').text());
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable({
                pageLength: 50,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Report Mauzo'},
                    {extend: 'pdf', title: 'Report Mauzo'},

                    {extend: 'print',
                     customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    }
                    }
                ]
            });
        });

    </script>
    <!-- Main File-->
    <script src="{{URL::to('assets/js/front.js')}}"></script>
