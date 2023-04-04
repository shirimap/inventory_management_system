@include('includes/header')
@include('includes/nav')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="fa fa-male"></span> Wauzaji</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
                        <li class="breadcrumb-item active">Wauzaji</li>
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

            <div class="card card-secondary card-outline">
                @can('ongeza-muuzaji')
                <div class="card-header">
                    <h3 class="card-title"> Wauzaji waliopo</h3>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                        data-target="#modal-lgg"> <span class="fa fa-plus"></span> Ongeza muuzaji</button>
                </div>
                @endcan
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/no</th>
                                <th>Jina Kamili</th>
                                <th>Anwani</th>
                                <th>Namba ya simu</th>
                                <th>Barua pepe</th>
                                <th>Jinsia</th>
                                <th>Tawi</th>
                                <th>jukumu</th>
                                <th>Kitendo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $user)
                            @if (!empty($user->branch->name))

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->phone}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender}}</td>

                                <td>{{ $user->branch->name }}</td>


                                @foreach($user->getRoleNames() as $v)
                                <td>{{ $v }}</td>
                                @endforeach
                                <td>
                                    @can('hariri-muuzaji')
                                    <a type="button" class="btn btn-sm btn-secondary" style="color:white"
                                        data-toggle="modal" data-target="#modal-secondary{{ $user->id }}"><span
                                            class="fa fa-edit"></span></a>
                                    @endcan
                                    @can('futa-muuzaji')
                                    <a type="button" class="btn btn-sm btn-danger" style="color:white"
                                        data-toggle="modal" data-target="#modal-danger{{ $user->id }}"><span
                                            class="fa fa-trash"></span></a>
                                    @endcan
                                </td>
                                <div class="modal fade" id="modal-danger{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Futa Mfanyakzi</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="wauzaji/delete/{{ $user->id }}">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                    <input type="hidden" name="proid" value="{{ $user->id }}">
                                                    <p>Mfanyakazi Huyu atafutwa <b>{{ $user->first_name }}
                                                            {{ $user->last_name }} </b></p>
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


                                <div class="modal fade" id="modal-secondary{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-secondary">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hariri Muuzaji</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="wauzaji/edit/{{ $user->id }}">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="proid" value="{{ $user->id }}">
                                                    <p>Hariri Muuzaji </p>

                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-6">
                                                            <label>Jina la kwanza</label>
                                                            <input type="text" name="first_name" class="form-control"
                                                                value="{{ $user->first_name }}" required>
                                                        </div>
                                                        <div class="col col-md-6">
                                                            <label>Jina la Pili</label>
                                                            <input type="text" name="last_name" class="form-control"
                                                                value="{{ $user->last_name }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col col-md-6">
                                                            <label>Anwani</label>
                                                            <input type="text" name="address" class="form-control"
                                                                value="{{ $user->address }}" required>
                                                        </div>
                                                        <div class="col col-md-6">
                                                            <label>Namba ya simu</label>
                                                            <input type="text" name="phone" class="form-control"
                                                                value="{{ $user->phone }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col col-md-6">
                                                            <label>Barua pepe</label>
                                                            <input type="email" name="email" class="form-control"
                                                                value="{{ $user->email }}" required>
                                                        </div>
                                                        <div class="col col-md-6">
                                                            <label>Jinsia</label>
                                                            <select class="form-control" name="gender">
                                                                @if ( $user->gender == 'MME')
                                                                <option disabled selected>--</option>

                                                                <option value="MME" selected>{{ $user->gender}}</option>
                                                                <option value="MKE">MKE</option>
                                                                @else
                                                                {{-- <option disabled selected>--</option> --}}

                                                                <option value="MME">MME</option>
                                                                <option value="MKE" selected>{{ $user->gender}}</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col col-md-6">
                                                            <label>Jukumu</label>
                                                            <select class="form-control" name="roles">
                                                                <option disabled selected value>--</option>

                                                                @foreach ($roles as $role)

                                                                @if (!empty($user->roles->first()->name) && ($role->name
                                                                == $user->roles->first()->name))



                                                                <option value="{{ $user->roles->first()->name }}"
                                                                    selected>{{ $user->roles->first()->name }}</option>
                                                                @else

                                                                <option value="{{ $role->id }}">{{ $role->name }}
                                                                </option>
                                                                @endif

                                                                @endforeach


                                                            </select>
                                                        </div>
                                                        <div class="col col-md-6">
                                                            <label>Tawi</label>
                                                            <select class="form-control" name="branch">
                                                                <option disabled selected value>--</option>
                                                                @foreach ($branch as $role)
                                                                @if ($role->name == $user->branch->name)
                                                                <option value="{{ $user->branch->id }}" selected>
                                                                    {{ $user->branch->name }}</option>
                                                                @else
                                                                <option value="{{ $role->id }}">{{ $role->name }}
                                                                </option>
                                                                @endif

                                                                @endforeach


                                                            </select>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="row">
                                      <div class="col col-md-6">
                                        <label>Chagua tawi</label>
                                        <select class="form-control" name="selectbranch">
                                          <option>--</option>

                                            <option>branchname</option>

                                        </select>
                                      </div>
                                      <div class="col col-md-6">
                                        <label>Chagua jukumu</label>
                                        <select class="form-control" name="rolename">
                                          <option>Muuzaji</option>
                                          <option>Msimamizi</option>
                                        </select>
                                      </div>
                                    </div> --}}
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
                            @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>


            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <form method="post" action="{{ route('wauzaji.create') }}">
        @csrf
        <div class="modal fade" id="modal-lgg">
            <div class="modal-dialog modal-lgg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ongeza Muuzaji</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                        <div class="row">
                            <div class="col col-md-6">
                                <label>Jina la kwanza</label>
                                <input type="text" name="first_name" class="form-control"
                                    placeholder="Weka jina la kwanza..." required>
                            </div>
                            <div class="col col-md-6">
                                <label>Jina la Pili</label>
                                <input type="text" name="last_name" class="form-control"
                                    placeholder="Weka jina la pili..." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <label>Anwani</label>
                                <input type="text" name="address" class="form-control" placeholder="Weka Anwani..."
                                    required>
                            </div>
                            <div class="col col-md-6">
                                <label>Namba ya simu</label>
                                <input type="text" name="phone" class="form-control" placeholder="Weka namba ya simu..."
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <label>Barua pepe</label>
                                <input type="email" name="email" class="form-control" placeholder="Weka barua pepe..."
                                    required>
                            </div>
                            <div class="col col-md-6">
                                <label>Jinsia</label>
                                <select class="form-control" name="gender">
                                    <option>--</option>
                                    <option value="MME">MME</option>
                                    <option value="MKE">MKE</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <label>Jukumu</label>
                                <select class="form-control" name="roles">
                                    <option disabled selected value>--</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach


                                </select>
                            </div>
                            <div class="col col-md-6">
                                <label>Tawi</label>
                                <select class="form-control" name="branch">
                                    <option disabled selected value>--</option>
                                    @foreach ($branch as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>
                        {{-- <div class="row">
                  <div class="col col-md-6">
                    <label>Chagua tawi</label>
                    <select class="form-control" name="selectbranch">
                      <option>--</option>

                    	<option>branchname</option>

                    </select>
                  </div>
                  <div class="col col-md-6">
                    <label>Chagua jukumu</label>
                    <select class="form-control" name="rolename">
                      <option>Muuzaji</option>
                      <option>Msimamizi</option>
                    </select>
                  </div>
                </div> --}}
                        </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
                        <button name="add" class="btn btn-primary">Ongeza</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
    <!-- /.modal -->
</div>
<!-- /.content-wrapper -->
@include('includes/footer')