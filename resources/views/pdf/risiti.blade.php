<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body>

    <!-- Start your project here-->
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                
                <?php $shop = App\Models\ShopInfo::all() ?>
                @foreach($shop as $shop)
                <?php
                $path = $shop->logo;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>

                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                            <h4>{{ $shop->name }}</h4>
                            <p class="pt-0"><img src="{{$base64}}"
                                    style="width:150px;height:100px; border-radius:20px;"></p>

                            <p style="font-size:12px"> Address: {{ $shop->address }},location:
                                {{ $shop->location }},Tel: {{ $shop->phoneNumber}},
                                Mob: {{ $shop->mobile1 }},Email:{{ $shop->email}},Web: {{ $shop->website}}</p>
                        </div>
                        <hr>
                    </div>
                    @endforeach
                    @foreach ($o as $o)
                    <div class="row">
                        <table>
                            <tr>
                                <td width="150">
                                    <ul class="list-unstyled">
                                        <li class="text-muted">To: <span
                                                style="color:#5d9fc5 ;">{{ ucwords($o->customer_name) }}</span></li>
                                        <li class="text-muted"><b>Namba:</b> <span
                                                style="color:#5d9fc5 ;">{{ $o->phonenumber }}</span></li>
                                        <li class="text-muted"><b>Email:</b></li>
                                        <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
                                    </ul>
                                </td>
                                <td width="120"></td>
                                <td width="150">
                                   
                                    <ul class="list-unstyled">
                                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                            <span
                                                class="fw-bold"><b>INV-ID:</b></span>{{ str_pad( $o->id,5,'0',STR_PAD_LEFT) }}
                                        </li>
                                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                            <span class="fw-bold"><b>Tarehe:</b> </span>{{ $date->format('d/m/Y') }}
                                        </li>
                                        
                                    </ul>
                                </td>
                            </tr>
                        </table>
                        <div class="col-xl-8">

                        </div>
                        <div class="col-xl-4 float">

                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless border-sm">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">BIDHAA</th>
                                    <th scope="col">IDADI</th>
                                    <th scope="col">BEI</th>
                                    <th scope="col">JUMLA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($s as $q)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td> {{ $q['product'] ['name']}}</td>
                                    <td> {{ $q['quantity']}} </td>
                                    <td>{{ $q['amount']}} </td>
                                    <td> {{ $q['amount']*$q['quantity']}} </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <table>
                        <tr>
                            <td width="300" colspan="2"></td>
                            <td><span class="text-black me-3">SubTotal</span></td>
                            <td>{{ $o->org_amount + $o->discount }}</td>
                        </tr>
                        <tr>
                            <td width="300" colspan="2"></td>
                            <td><span class="text-black me-3">Punguzo</span></td>
                            <td>{{ $o->discount }}</td>
                        </tr>
                        <tr>
                            <td width="300" colspan="2"></td>
                            <td width="100"><b class="text-black me-3"> Jumla</b></td>
                            <td><b style="font-size: 20px;"> {{ $o->org_amount  }}</b></td>
                        </tr>
                    </table>
                    @endforeach

                    <div class="row">
                        <div class="col-xl-10">
                            <footer class="main-footer no-print">
                                <div class="float-right d-none d-sm-block">
                                    <b>Printed by</b> {{ ucwords(Auth::user()->first_name)}}
                                </div>
                                <strong>Copyright &copy; 2023 <a href="#">Kimaro Company ltd</a></strong>
                            </footer>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>