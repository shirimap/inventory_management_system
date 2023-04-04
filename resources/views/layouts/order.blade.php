@include('includes/header')
@include('includes/nav')



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @if(session()->has('error'))
<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h5><i class="icon fas fa-check"></i> Error!</h5>
               <p color="white">{{ session()->get('error') }}
             </div>
@endif
@if(session()->has('message'))
   <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Taarifa!</h5>
                  <p color="white">{{ session()->get('message') }}
                </div>
@endif
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
                        <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Mauzo Yaliyofanyika</h3>

            </div>
            <!-- /.card-header -->
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S/no</th>

                            <th>Namba ya Order</th>
                            <th>Idadi ya Bidhaa</th>
                            <th>Bei(Jumla)</th>
                            <th>Mteja</th>
                            <th>Muuzaji</th>
                            <th>Tawi</th>
                            <th>Terehe</th>
                            <th>Kitendo</th>
                  </tr>
                  </thead>

                  <tbody>
                    @foreach ($o as $o)


<tr>
    <td>{{ $loop->iteration }}</td>
    <td>PINV-{{ str_pad( $o->id,5,'0',STR_PAD_LEFT )}}</td>
    <td>{{ $o->total_quantity}}</td>
    <td>{{ $o->total_amount}}</td>
    <td>{{ ucwords($o->customer_name)}}</td>
    <td>{{ ucwords(Auth::user()->first_name)}}</td>
    <?php $shop = App\Models\ShopInfo::all() ?>
    @if(empty(Auth::user()->branch->name))
    @foreach ($shop as $shop)


    <td>{{ ucwords($shop->MainBranch)}}</td>
    @endforeach
     @else
    <td>{{ ucwords(Auth::user()->branch->name)}}</td>
    @endif
    <td>{{ $o['created_at']->format('d/m/Y') }}<br>{{ $o['created_at']->format('h:m a') }}</td>
    <td>
        @can('tengeneza-preInvoice')

            <a href="{{ route('previewPDF',$o->id) }}" target="" class="btn btn-warning"><i class="fas fa-print"></i></a>


@endcan
@can('hariri-order')
        <a href="{{ route('editorder',$o->id) }}" target="" class="btn btn-warning"><i class="fas fa-edit"></i></a>
        @endcan
        @can('futa-order')
        <a href="delete/{{$o->id}}" onclick="return confirm('Are you sure to want to delete it?')"><button type="button" class="btn btn-small btn-danger"><span class="fa fa-trash" aria-hidden="true" style="color: black;font-size:16px;"></span></button></a>
    @endcan
    </td>

</tr>
@endforeach

                    </tbody>
                  <tfoot>
                    <tr>
                        <th>S/no</th>
                        <th>Namba ya Order</th>
                        <th>Idadi ya Bidhaa</th>
                        <th>Bei(Jumla)</th>
                        <th>Mteja</th>
                        <th>Muuzaji</th>
                        <th>Tawi</th>
                        <th>Terehe</th>
                        <th>Kitendo</th>
                      </tr>
                  </tfoot>
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
@include('includes/footer')
