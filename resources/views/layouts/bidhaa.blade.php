@include('includes/header')
@include('includes/nav')
@section('bidhaa', 'active')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- alert -->

                <!-- /alert -->
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fa fa-product-hunt"></i> Bidhaa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
                        <li class="breadcrumb-item active">Bidhaa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @if(session()->has('error'))
        <div class="alert alert-danger alert-sm alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <!-- <h5><i class="icon fas fa-check"></i> Error!</h5> -->
            <p color="white">{{ session()->get('error') }}
        </div>
        @endif
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible" style="height:5;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <!-- <h5><i class="icon fas fa-check"></i> Taarifa!</h5> -->
            <p color="white">{{ session()->get('message') }}
        </div>
        @endif
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            {{--  <div class="card-body text-center text-bold ">
                JUMLA YA BIDHAA : <i class="text-success"></i><br>
                BIDHAA <i class="text-danger"></i> ZIPO CHINI YA 5
            </div>  --}}

        </div>
        <div class="card card-secondary card-outline">
            <div class="card-header">
                <h3 class="card-title">Bidhaa zilizopo</h3>
                @can('ongeza-bidhaa')
                <button type="button" class="btn btn-secondary pull-right" data-toggle="modal"
                    data-target="#modal-lg-file">
                    <span class="fa fa-file"></span> Weka File la Bidhaa mpya</button>
                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-lg1">
                    <span class="fa fa-plus"></span> Weka Bidhaa Mpya</button>
                @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-sm  table-striped">
                    <thead>
                        <tr>
                            <th>S/no</th>
                            <th>Bidhaa</th>
                            <th>Aina</th>
                            <th>kununua</th>
                            <th>Kuuza</th>
                            <th>Idadi</th>
                            <th>Faida</th>
                            <th>Punguzo %</th>
                            <th>Jumla</th>
                            <th>Tawi</th>
                            <th>Tarehe</th>
                            <th>Vitendo</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $p)
                        <tr>
                            <td>{{ $loop->iteration }} </td>
                            <td>{{ $p->name }} </td>
                            <td>{{ $p->type }}</td>
                            <td>{{$p->bprice}}</td>
                            @if ($p->discount > 0 )
                            <td><strike
                                    style="text-decoration-thickness: 2px; text-decoration-color: red">{{ $p->amount }}</span></strike>
                                <br>

                                {{ $p->net_amount }}
                            </td>

                            @else
                            <td>{{ $p->net_amount }}<br>
                                @if(!@empty($p->sub_amount))
                                {{  $p->sub_amount}}
                                @endif

                            </td>

                            @endif
                            <td>
                                @if($p->quantity <= 10) 
                                <b style="color:red;">{{ $p->quantity }}</b>
                                @else
                                <b style="color:green;">{{ $p->quantity }}</b>
                                @endif

                            </td>
                            <td>
                                @if($p->pprofit <= 0)
                                <b style="color:red;">{{ $p->pprofit }}</b>
                                @else
                                {{ $p->pprofit }}
                                @endif
                            
                            </td>
                            <td>{{ $p->discount }}%</td>
                            <td>{{ $p->capital }}</td>
                            <td>{{ $p->branch->name }}</td>

                            <td>{{$p->created_at->format('D, d-m-Y h:i A') }}</td>
                            <td>
                                @can('hariri-bidhaa')
                                <a type="button" class="btn btn-sm btn-primary" style="color:white;" data-toggle="modal"
                                    data-target="#modal-secondaryy{{ $p->id }}"><i class="fas fa-pencil-alt"></i></a>
                                @endcan
                                @can('futa-bidhaa')
                                <a type="button" class="btn btn-sm btn-danger" style="color:white;" data-toggle="modal"
                                    data-target="#modal-danger{{ $p->id }}"><i class="fa fa-trash"></i></a>
                                @endcan
                            </td>
                            <div class="modal fade" id="modal-danger{{ $p->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Futa Bidhaa</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="bidhaa/delete/{{ $p->id }}">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="proid" value="{{ $p->id }}">
                                                <p>Bidhaa Hii itafutwa <b>{{ $p->name }} yenye aina hii {{ $p->type }}
                                                    </b></p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-light"
                                                data-dismiss="modal">Funga</button>
                                            <button type="submit" name="remove"
                                                class="btn btn-outline-light">Futa</button>

                                        </div>
                                        </form>


                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            <div class="modal fade" id="modal-secondaryy{{ $p->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hariri Bidhaa</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="bidhaa/edit/{{ $p->id }}">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="proid" value="{{ $p->id }}">
                                                <p>Hariri Muuzaji </p>

                                                <p>
                                                <div class="row">
                                                    <div class="col col-md-6">
                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $p->name }}" required>
                                                    </div>
                                                    <div class="col col-md-6">
                                                        <label>Type</label>
                                                        <input type="text" name="type" class="form-control"
                                                            value="{{ $p->type }}" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col col-md-6">
                                                        <label>Buying Price</label>
                                                        <input type="number" name="bprice" class="form-control"
                                                            value="{{ $p->bprice }}" required>
                                                    </div>
                                                    <div class="col col-md-6">
                                                        <label>Selling Price</label>
                                                        <input type="number" name="amount" class="form-control"
                                                            value="{{ $p->amount }}" required>
                                                    </div>
                                                    <div class="col col-md-6">
                                                        <label>Quantity</label>
                                                        <input type="number" name="quantity" min="0" step="0.25"
                                                            class="form-control" value="{{ $p->quantity }}" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col col-md-6">
                                                        <label>Tawi</label>
                                                        <select class="form-control" name="branch">
                                                            <option>{{ $p->branch->name }}</option>
                                                            @foreach ($branch as $role)
                                                            @if ($role->id == $p->branch->id)
                                                            <option value="{{ $p->branch->id }}" selected>
                                                                {{ $p->branch->name }}-{{ $p->branch->location }}
                                                            </option>
                                                            @else
                                                            <option value="{{ $role->id }}">
                                                                {{ $role->name }}-{{ $role->location }}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    @if(!@empty($p->sub_amount))
                                                    <div class="col col-md-6">
                                                        <label>bei kipimo</label>
                                                        <input type="number" name="sub_amount" min="0" step="0.25"
                                                            class="form-control" value="{{ $p->sub_amount }}" required>
                                                    </div>

                                                    @can('ongeza-punguzo')
                                                    <div class="col col-md-6">
                                                        <label>punguzo</label>
                                                        <input type="number" name="discount" class="form-control"
                                                            value="{{ $p->discount }}" required>
                                                    </div>
                                                    @else
                                                    <div class="col col-md-6">
                                                        <label>punguzo</label>
                                                        <input type="number" name="discount" class="form-control"
                                                            value="{{ $p->discount }}" required>
                                                    </div>
                                                    @endif
                                                    @endcan
                                                </div>

                                                </p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-light"
                                                data-dismiss="modal">Funga</button>
                                            <button type="submit" name="remove"
                                                class="btn btn-outline-light">Hariri</button>

                                        </div>
                                        </form>


                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </tr>
                        @endforeach

                    </tbody>
                    <!-- <tr>
                        <th colspan="7">Jumla</th>
                        <th colspan="2">
                        </th>
                    </tr> -->
                </table>
            </div>
            <!-- /.card-body -->
        </div>


        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<form method="post" action="bidhaa/create">
    @csrf
    <div class="modal fade" id="modal-lg1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ongeza Bidhaa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    <div class="row">
                        <div class="col col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Weka Jina la bidhaa...">
                        </div>
                        <div class="col col-md-6">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" placeholder="Weka aina ya bidhaa...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-6">
                            <label>Buying Price</label>
                            <input type="number" name="bprice" class="form-control"
                                placeholder="Weka Bei ya Kununua...">
                        </div>

                        <div class="col col-md-6">
                            <label>Selling Price</label>
                            <input type="number" name="amount" class="form-control" placeholder="Weka Bei ya Kuuza...">
                        </div>

                        <div class="col col-md-6">
                            <label>Quantity</label>
                            <input type="number" min="0" name="quantity" class="form-control"
                                placeholder="Weka idadi ya bidhaa...">
                        </div>
                        <div class="col col-md-6">
                            <label>Branch</label>
                            <select class="form-control" name="branch">
                                <option disabled selected value>---</option>
                                @foreach ($branch as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}-{{ $role->location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-md-6">
                            <label>Kipengele</label>
                            <select class="form-control" name="category"  onchange="enanbleCategory(this)">
                                <option disabled selected value>---</option>
                                @foreach ($categories as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-md-6 d-nones" id="kupimwa">
                            <label>idadi(kupimwa Jumla)</label>
                            <input type="number" name="sub_quantity" min="0" step="0.25" value="0" class="form-control"
                                placeholder="weka punguzo la bidhaa..." required>

                        </div>
                        <div class="col col-md-6 d-nones" id="kupimwaa">
                            <label>Bei kwa kipimo</label>
                            <input type="number" step="0.25" name="sub_amount" min="0" value="0" class="form-control"
                                placeholder="weka punguzo la bidhaa..." required>
                        </div>

                        <!-- <div class="col col-md-6 d-nones" id="kupi">

                            <label>Bei kwa kipimo</label>
                            <select>
                                <option value="m">Metre</option>
                                <option value="cm">Centimetre</option>
                                <option value="mm">MilliMetre</option>
                            </select>
                        </div>  -->

                        @can('ongeza-punguzo')
                        <div class="col col-md-6">
                            <label>punguzo %</label>
                            <input type="number" name="discount" min="0" max="100" value="0" class="form-control"
                                placeholder="weka punguzo la bidhaa..." required>
                        </div>
                        @endcan

                    </div>
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button name="addproduct" class="btn btn-primary ">Ongeza</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>

<form method="POST" action="/upload" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modal-lg-file">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ongeza Bidhaa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    <div class="row">
                        <div class="col col-md-12">
                            <label>Weka File hapa (*SCV)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" id="exampleInputFile">
                                    {{-- <label class="custom-file-label" for="exampleInputFile">Chagua
                                        file</label> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" name="fileadd" class="btn btn-primary toastrDefaultSuccess">Ongeza</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>


<!-- file bidhaa mpya model -->
<div class="modal fade" id="modal-file">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bidhaa Mpya</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputFile">Weka file hapa</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="upload_file" class="custom-file-input"
                                        id="exampleInputFile">
                                    <label for="exampleInputFile">Chagua
                                        file</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary " data-target="#success">Submit</button>
                    </div>
                </form>

            </div>
            <!-- /.card-body -->


        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.content-wrapper -->

<script>
function enanbleCategory(cat) {
    console.log(cat.value);
    if (cat.value == 1) {
        document.getElementById('kupimwa').classList.add('d-nones')
        document.getElementById('kupimwaa').classList.add('d-nones')
    } else {
        document.getElementById('kupimwa').classList.remove('d-nones')
        document.getElementById('kupimwaa').classList.remove('d-nones')
    }
}

function enanbleCategor(cat) {
    console.log(cat.value);
    if (cat.value == 1) {
        document.getElementById('kupimw').classList.add('d-nones')
        document.getElementById('kupim').classList.add('d-nones')
    } else {
        document.getElementById('kupimw').classList.remove('d-nones')
        document.getElementById('kupim').classList.remove('d-nones')
    }

}
</script>
@include('includes/footer')