@include('includes/header')
@include('includes/nav')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="fa fa-map-marker"></span> Jukumu</h1>


                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
                        <li class="breadcrumb-item active">Jukumu</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content pb-3">
        <div class="container-fluid h-100">
            <div class="card card-row card-secondary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><span class="fa fa-map-marker"></span>
                        Jukumu
                    </h3>
                    @can('ongeza-jukumu')
                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                        data-target="#modal-defaultt"> <span class="fa fa-plus"></span> Ongeza Jukumu</button>
                    @endcan
                </div>
                <div class="card-body">
                    @foreach($role as $r)
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h5 class="card-title"><b>{{ $r->name }}</b></h5>
                            <h5 class="card-title pull-right"><button
                                    class="btn btn-sm btn-warning">{{ $r->getPermissionNames()->count() }}</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">                              
                                    @foreach( $r->getPermissionNames() as $p)
                                    <div class="col-2">
                                        <input type="checkbox" disabled="" checked>{{ $p }}</input>
                                    </div>
                                    @endforeach   
                            </div>
                            <div class="modal-footer">
                                @can('hariri-jukumu')
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modal-defaultt{{ $r->id }}"> <span class="fa fa-edit"></span></button>
                                @endcan
                                @can('futa-jukumu')
                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#modal-danger{{ $r->id }}"><span class="fa fa-trash"></span></button>
                                @endcan

                            </div>
                        </div>

                    </div>
                    <div class="modal fade" id="modal-defaultt{{ $r->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ongeza Jukumu</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="editRole/{{ $r->id }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <label>Jina la Jukumu</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $r->name }}">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Aina za ruhusa</label>
                                                    <select select class="select2 form-control" multiple="multiple"
                                                        name="permission[]" data-placeholder="Chagua Ruhusa"
                                                        style="width: 100%;">
                                                        @foreach ($permission as $j)
                                                        <option value="{{ $j->id }}">{{ $j->name }}</option>

                                                        @endforeach
                                                        {{--  @else
                                                         <option value="{{ $j->name }}">{{ $j->name }}</option>


                                                        @endif


                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Funga</button>
                                            <button type="submit" class="btn btn-primary">Ongeza</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-danger{{ $r->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ondoa Jukumu</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="deleterole/{{$r->id}}">
                                        @csrf
                                        <input type="hidden" name="proid" value="">
                                        <p>Jukumu hili Litafutwa </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light"
                                        data-dismiss="modal">Funga</button>
                                    <button type="submit" name="remove" class="btn btn-outline-light">Ondoa</button>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>

            <div class="modal fade" id="modal-defaultt">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ongeza Jukumu</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="addrole">
                                @csrf
                                <div class="row">
                                    <div class="col col-md-12">
                                        <label>Jina la Jukumu</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Jina la Jukumu">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Aina za ruhusa</label>
                                            <select select class="select2 form-control" multiple="multiple"
                                                name="permission[]" data-placeholder="Chagua Ruhusa"
                                                style="width: 100%;">
                                                @foreach ($permission as $p)


                                                <option value="{{ $p->id }}">{{ $p->name }}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
                                    <button type="submit" class="btn btn-primary">Ongeza</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <!-- /.row -->
</div>
<!-- /.content-wrapper -->
@include('includes/footer')
{{-- @include('includes/script') --}}