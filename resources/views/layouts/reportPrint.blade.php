<html>

<head>
    <title></title>
    <style>
    body {
        margin: 10px;
    }

    .total {
        background-color: rgb(201, 201, 201);
        color: rgb(0, 0, 0);
        font-weight: bold;
    }

    .zrb {
        /* background-color: rgb(182, 193, 208); */
        color: rgb(19, 19, 19);
        font-weight: bold;
        font-size: 30px;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #ddd;
    }

    .table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04aaaa;
        color: white;
    }

    .subTitle {
        font-size: 18px;
    }
    small{
        float: right;
        font-size: 10px;
        padding-top: 10px;
    }
    .main-footer{
        padding: 10px;
    }
    </style>
</head>

<body style="font-size: 7pt">
    <table style="border-collapse:collapse; width:100%">
        <thead>
            <tr>
                <th style="text-align:center;" colspan="17" height="70">
                    <strong class="zrb">GIRAFFE SHAPPERS COMPANY LTD</strong><br>
                    <strong class="subTitle">RIPORI YA MAUZO TAWI LA KARIAKOO</strong><br>

                    Ripoti ya mwezi
                    <strong>August 2022</strong>
                    <strong>From 20 Aug 2022 To 20 Sept 2022 </strong>

                </th>
            </tr>
        </thead>
    </table>
    <br>
    <table class="table">
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
            <!-- here your content -->
            @foreach($query as $value)

            <tr>
                <td class="id">{{$loop->iteration}}</td>
{{--  <?php $total+=($value->quantity * $value->amount) ?>
<?php $quantity+=$value->quantity ?>  --}}
                <td class="email">{{$value->created_at}}</td>
                <td class="name">{{$value->product->name}}-{{$value->product->type}}</td>
                <td class="sex">{{$value->quantity}}</td>
                <td class="discount">{{$value->product->discount}}%</td>
                <td class="dateOfBirth">{{$value->amount}}</td>
                <td class="salary">Tsh {{$value->quantity * $value->amount}}</td>
                <td class="phone">{{$value->order->user->first_name}} {{$value->order->user->last_name}}</td>
                <td class="jobPosition">{{$value->product->branch->name}}-{{$value->product->branch->location}}</td>





            </tr>

            @endforeach
        </tbody>
    </table>
    <footer class="main-footer">
    <strong>1 of 5</strong>
    <small>
    21 August 2022
    </small>
  </footer>
    <script type="text/javascript">
    window.addEventListener("load", window.print());
    </script>
</body>

</html>
