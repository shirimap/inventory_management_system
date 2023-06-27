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

                <!-- /alert -->
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-shopping-cart"></i> Point Of Sale</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">pos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- Content Header (Page header) -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><span class="fas fa-shopping-cart "></span>Product List
                                Cart
                            </h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example3" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Sell Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $p )
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td style="width: 150px;"><b>{{ $p->sbidhaa->name }}</b></td>
                                        <td style="width: 150px;"> {{ $p->sbidhaa->type }}</td>
                                        <td> @if($p->category_id == 1)
                                            @if($p->quantity <= $p->sbidhaa->threshold)
                                                <span class="badge badge-danger">{{ $p->quantity }}</span>
                                                @else
                                                <span class="badge badge-info">{{ $p->quantity }}</span>
                                                @endif

                                                @else
                                                @if($p->quantity <= $p->sbidhaa->threshold)
                                                    <span class="badge badge-danger">{{ $p->quantity }}</span>
                                                    @else
                                                    <span class="badge badge-info">{{ $p->quantity }}</span>
                                                    @endif
                                                    @endif
                                        </td>
                                        <td style="width:100px;">@if($p->category_id == 1)
                                            <b>{{ number_format($p->net_amount) }}</b>
                                            @else
                                            <b>{{ number_format($p->net_amount) }}</b>
                                            @endif
                                        </td>

                                        <form method="post" action="addToCart/{{ $p->id }}">
                                            @csrf
                                            @if($p->category_id == 2)

                                            <td>kupima
                                                <input class="form-control" type="number" name="quantity" min="0" max=""
                                                    step="0.5" value="1" style="width: 100%">
                                            </td>

                                            @else
                                            <td style="width: 20%"> <input class="form-control" type="number" min="0"
                                                    name="quantity" max="" value="1" style="width: 100%">
                                            </td>
                                            @endif
                                            </td>
                                            <td>
                                                @can('ongeza-mkokoteni')
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <span class="fas fa-plus"></span></button>
                                                @endcan
                                        </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> <br>
                            <!-- @can('ona-mkokoteni')
                            <a href="/cart"><button class="btn btn-primary btn-block"><span class="fa fa-plus"></span>
                                    Onesha
                                    Mkokoteni</button></a>
                            @endcan -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title"><span class="fas fa-shopping-cart "></span> Choosen To
                                Cart</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-sm table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Sell Price</th>
                                        <!-- <th>Punguzo</th> -->
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0 ?>
                                    <?php $quantity = 0 ?>
                                    <?php $pprofit = 0 ?>
                                    <?php $fullName = ucwords(Auth::user()->first_name)." ". ucwords(Auth::user()->last_name) ?>

                                    @if(session('cart'))
                                    @foreach(session('cart') as $id => $details )
                                    <?php

                                 $total+=($details['net_amount'] * $details['quantity']) ?>

                                    <?php $quantity+=$details['quantity'] ?>
                                    <tr>
                                        <td>{{ $loop->iteration }} </td>
                                        <td><b>{{ $details['sbidhaa_id'] }}</b> </td>

                                        <td>
                                            @if($details['category_id'] == 2)
                                            <span class="badge badge-danger">{{$details['quantity'] }}</span>

                                            @else
                                            <span class="badge badge-danger">{{$details['quantity'] }}</span>

                                            @endif
                                        </td>
                                        <td>
                                            @if($details['category_id'] == 2)
                                            {{ number_format($details['net_amount']) }}
                                            @else
                                            {{ number_format($details['net_amount']) }}
                                            @endif

                                        </td>


                                        <td>
                                            @if($details['category_id'] == 2)
                                            <b>{{ number_format($details['net_amount']* $details['quantity']) }}</b>
                                            @else
                                            <b>{{ number_format($details['net_amount']* $details['quantity']) }}</b>
                                            @endif

                                        </td>

                                        <td>

                                            @can('hariri-mkokoteni')

                                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#modal-md3{{ $details['id'] }}">
                                                <span class="fa fa-edit"></span></button>

                                            @endcan
                                            @can('futa-mkokoteni')
                                            <button action="submit" class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#modal-danger{{ $details['id'] }}"><span
                                                    class="fa fa-trash"></span></button>
                                            @endcan
                                        </td>

                                        <!-- modal -->
                                        <div class="modal fade" id="modal-danger{{ $details['id'] }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete From Cart</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="deleteCart">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $details['id'] }}">
                                                            <p>This Product Will Be removed From Cart</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-outline-light"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button name="remove"
                                                            class="btn btn-outline-light">Save</button>
                                                        </form>
                                                    </div>


                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        <div class="modal fade" id="modal-md3{{ $details['id'] }}">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Cart</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="updateCart">
                                                            @csrf
                                                            <p>

                                                            <div class="row">
                                                                <div class="col col-md-4">
                                                                    <label>Total</label>
                                                                </div>
                                                                <div class="col col-md-8">
                                                                    <input type="hidden" name="id"
                                                                        value="{{$details['id']}}">
                                                                    <input type="text" name="amount"
                                                                        class="form-control" value="{{$total}}"
                                                                        disabled>

                                                                </div>
                                                            </div><br>

                                                            <div class="row">
                                                                <div class="col col-md-4">
                                                                    <label>idadi</label>
                                                                </div>
                                                                <div class="col col-md-8">
                                                                    <input type="number" min="0" name="quantity"
                                                                        class="form-control"
                                                                        value="{{ $details['quantity'] }}" required>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            @if($details['category_id'] == 2)
                                                            <div class="row">
                                                                <div class="col col-md-4">
                                                                    <label>kipimo</label>
                                                                </div>
                                                                <div class="col col-md-8">
                                                                    <input type="number" min="0" step="0.25"
                                                                        name="sub_quantity" class="form-control"
                                                                        value="{{ $details['quantity'] }}" required>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            </p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        <!-- /.modal -->
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tr>
                                    <td colspan="5" align="right"><b>Total Amount</b></td>
                                    <td colspan="2">
                                        <b>{{ number_format($total,2) }}</b>
                                    </td>
                                </tr>
                            </table> <br>
                            @can('fanya-mauzo')

                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-md"><span
                                    class="fa fa-plus"></span> Add Sell</button>
                            @endcan
                            @can('ongeza-order')

                            <button class="btn btn-secondary btn-block" data-toggle="modal"
                                data-target="#modal-mdd"><span class="fa fa-plus"></span>Add Order</button>
                            @endcan


                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>


            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <form action="checkout" method="POST">
        @csrf
        <div class="modal fade" id="modal-md">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Payment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Total Amount</label>
                            <div class="col-sm-8">
                                @foreach(session('cart') as $id => $details )
                                <input type="hidden" name="product[]" value="{{ $details['id'] }}">
                                <input type="hidden" name="quantity[]" value="{{ $details['quantity'] }}">
                                <input type="hidden" name="pprofit[]" value="{{ $details['pprofit'] }}">
                                <input type="hidden" name="amount[]" value="{{ $details['net_amount'] }}">
                                @endforeach
                                <input type="number" class="form-control" name="total_amount" value="{{ $total }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Quantity</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="total_quantity" value="{{ $quantity }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Payment</label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control" required>
                                    <option value="">...</option>
                                    <option value="IMEUZWA">cash</option>
                                    <option value="MKOPO">mkopo</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Customer Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="customer_name" class="form-control"
                                    placeholder="Enter customer Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phonenumber"
                                    placeholder="Enter Phone number">
                            </div>
                        </div>

                        @can('ongeza-punguzo')
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Discount</label>
                            <div class="col-sm-8">
                                <input type="number" min="0" value="0" name="discount" class="form-control">
                            </div>
                        </div>
                        @endcan
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">VAT %</label>
                            <div class="col-sm-8">
                                <input type="number" min="0" value="0" name="vat" class="form-control">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="sell" class="btn btn-primary">Submit</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

    <form action="makeorder" method="POST">
        @csrf
        <div class="modal fade" id="modal-mdd">
            <div class="modal-dialog modal-mdd">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Order</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Total Amount</label>
                            <div class="col-sm-8">
                                @foreach(session('cart') as $id => $details )
                                <input type="hidden" name="product[]" value="{{ $details['id'] }}">
                                <input type="hidden" name="quantity[]" value="{{ $details['quantity'] }}">
                                <input type="hidden" name="pprofit[]" value="{{ $details['pprofit'] }}">
                                <input type="hidden" name="amount[]" value="{{ $details['net_amount'] }}">
                                @endforeach
                                <input type="number" class="form-control" name="total_amount" value="{{ $total }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Quantity</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="total_quantity" value="{{ $quantity }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row" style="display:none;">
                            <label class="col-sm-4 col-form-label">Payment</label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control" >
                                    <option value="">...</option>
                                    <option value="IMEUZWA">cash</option>
                                    <option value="MKOPO">mkopo</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Customer Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="customer_name" class="form-control"
                                    placeholder="Enter customer Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phonenumber"
                                    placeholder="Enter Phone number">
                            </div>
                        </div>

                        @can('ongeza-punguzo')
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Discount</label>
                            <div class="col-sm-8">
                                <input type="number" min="0" value="0" name="discount" class="form-control">
                            </div>
                        </div>
                        @endcan
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">VAT %</label>
                            <div class="col-sm-8">
                                <input type="number" min="0" value="0" name="vat" class="form-control">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="sell" class="btn btn-primary">Submit</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

    @endif


</div>
<!-- /.content-wrapper -->
@include('includes/footer')