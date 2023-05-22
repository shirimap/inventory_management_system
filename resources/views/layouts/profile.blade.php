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
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
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
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{asset('dist/img/user2-160x160.jpg')}}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                            <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#timeline"
                                        data-toggle="tab">Badili Neno La Siri</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Badili
                                        Taarifa</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="activity">
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane active" id="timeline">
                                    <form action="changepassword" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <label>Password ya zamani</label>
                                                <input type="text" name="old" class="form-control"
                                                    placeholder="Password ya zamani">
                                            </div>
                                            <div class="col col-md-12">
                                                <label>
                                                    <p>Password mpya</p>
                                                </label>
                                                <input type="text" name="new" class="form-control"
                                                    placeholder="Password mpya">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form action="changeinfo" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col col-md-6">
                                                <label>Jina la kwanza</label>
                                                <input type="text" name="first_name" class="form-control"
                                                    value="{{ Auth::user()->first_name }}" required>
                                            </div>
                                            <div class="col col-md-6">
                                                <label>Jina la Pili</label>
                                                <input type="text" name="last_name" class="form-control"
                                                    value="{{ Auth::user()->last_name }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-md-6">
                                                <label>Anwani</label>
                                                <input type="text" name="address" class="form-control"
                                                    value="{{ Auth::user()->address }}" required>
                                            </div>
                                            <div class="col col-md-6">
                                                <label>Namba ya simu</label>
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ Auth::user()->phone }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-md-6">
                                                <label>Barua pepe</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ Auth::user()->email }}" required>
                                            </div>
                                            <div class="col col-md-6">
                                                <label>Jinsia</label>
                                                <select class="form-control" name="gender">
                                                    <option>--</option>
                                                    @if(Auth::user()->gender == "MME")
                                                    <option value="MME" selected>MME</option>
                                                    <option value="MKE">MKE</option>
                                                    @else
                                                    <option value="MME">MME</option>
                                                    <option value="MKE" selected>MKE</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger pull-right">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('includes/footer')