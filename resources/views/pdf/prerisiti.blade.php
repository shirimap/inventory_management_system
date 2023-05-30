<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <title>
        Risiti
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >

    {{--  <link rel="stylesheet" href="{{URL::asset('css/pdf.css')}}">  --}}
<style>
table {
        border-collapse: collapse;
        width: 90%;
        margin-top: 2%;
        margin-bottom: 2%;
        margin-left: 5%;
        margin-right: 5%;
        border: 1px solid;
            }
td, th{
        padding: 3px;
        text-align: left;
    }
    th{
        border: 1px solid;
    }

#customer_table td, #invoice_table td, #sign_table td{
    border-left: 1px solid;
}

#info_table{
    border: 0px;
}

img{
    width:200px;
    height:150px
}
tr.border_bottom td{
    border-bottom: 1px solid black
}
</style>
</head>
<body>

    <table id="info_table">

        <?php $shop = App\Models\ShopInfo::all() ?>

        @foreach($shop as $shop)
        <tr>
            <td style="margin-left: 5%">
                <?php
                $path = $shop->logo;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
        <img src="{{$base64}}">

            </td>
            <td>
             <b>{{ $shop->name }}<br>
                {{ $shop->address }}<br>
                {{ $shop->location }},<br>
                {{ $shop->address }}<br>

            </td>
            <td>
             <b>Tel:  {{ $shop->phoneNumber}}<br>
                Mob:  {{ $shop->mobile1 }}<br>
                      {{ $shop->mobile2 }}<br>
                      {{ $shop->mobile3 }}<br>
                Email: {{ $shop->email}}<br>
                Web: {{ $shop->website}}</b>
            </td>
        </tr>
    @endforeach

    </table>
    @foreach ($o as $o)


    <table id="customer_table">

        <tr>
            <th colspan="3" style="text-align:center;">
                .::PROFORMA INVOICE::.
            </th>
        </tr>
        <tr>
            <th colspan="3">

            </th>
        </tr>
        <tr>
            <th>
                Customer Details
            </th>
            <th>
                Company Details
            </th>
            <th>

            </th>
        </tr>

        <tr>
            <td>
                <b>NAME:  {{ ucwords($o->customer_name) }}</b>
            </td>
            <td>
                <b>REF NUMBER</b>
            </td>
            <td>
                PINV-{{ str_pad( $o->id,5,'0',STR_PAD_LEFT) }}
            </td>
        </tr>
        <tr>
            <td>
                <b>ADDRESS: {{ ucwords($o->address) }}</b>
            </td>
            <td>
                <b>TIN NUMBER</b>
            </td>
            <td>
                {{ $shop->TIN }}
            </td>
        </tr>
        <tr>
            <td>
                <b>PHONE:{{ $o->phonenumber }}</b>
            </td>
            {{--  <td>
                <b>TIN NUMBER</b>
            </td>
            <td>
                2022-07=21
            </td>  --}}
            <td>
                <b>VRN</b>
                </td>
                <td>
                    {{ $shop->VRN }}
                </td>
        </tr>
        <tr>
            <td>
            <b>TIN:{{ ucwords($o->TIN) }}</b>
            </td>
            {{--  <td>
            <b>VRN</b>
            </td>
            <td>
                20220721
            </td>  --}}
            <td>
                <b>CURRECY</b>
                </td>
                <td>
                    TZS
                </td>
        </tr>
        <tr>
            <td>
            <b>VRN</b>
            </td>
            <td>
                <b> BRANCH</b>
            </td>
            @if(empty(Auth::user()->branch->name))
            <td>{{ ucwords($shop->MainBranch)}}</td>
             @else
            <td>{{ ucwords(Auth::user()->branch->name)}}</td>
            @endif



        </tr>
        {{--  <tr>
            <td> </td>
            <td>
            <b> BRANCH</b>
            </td>
            <td>
            <b>Kariakoo</b>
            </td>
        </tr>  --}}
    </table>

    <br><br>
    <table id="invoice_table">
        <thead>
        <tr>
            <th>
                DESCRIPTION
            </th>
            <th>
                QTY
            </th>
            <th>
                UNIT PRICE
            </th>
            <th>
                AMOUNT
            </th>
        </tr>
        </thead>

        <tbody>

        <tr>


            <td>

                @foreach ($s as $q)

                              {{ $loop->iteration }}. {{ $q['product'] ['name']}} {{ $q['product'] ['type']}}<br><br>

                              @endforeach

            </td>




            <td>
                @foreach ($s as $q)

                            {{ $q['quantity']}}<br><br>

                              @endforeach
            </td>
            <td>
                @foreach ($s as $q)

                            {{ $q['amount']}}<br><br>

                              @endforeach
            </td>
            <td>
                @foreach ($s as $q)

                            {{ $q['amount']*$q['quantity']}}<br><br>

                              @endforeach
            </td>

        </tr>


        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><b>Subtotal</b></td>
            <td>

            {{ $o->org_amount + $o->discount }}

            </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td><b>Discount</b></td>
            <td>

            {{ $o->discount }}

            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><b>Net SubTotal</b></td>
            <td>

            {{ $o->org_amount  }}

            </td>
        </tr>
        <tr class="border_bottom">
            <td></td>
            <td></td>
            <td><b>VAT {{ $o->vat  }}%</b></td>
            <td>

            {{ ($o->vat/100) * $o->org_amount }}

            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><b>TOTAL</b></td>
            <td>

            {{ $o->total_amount  }}

            </td>
        </tr>
        @endforeach
    </tbody>

    </table>

    <br><br>
    <table id="sign_table">
        <tr>
            <th>
                Terms & Conditions:
            </th>
            <th>
                Autrorised Signature:
            </th>
        </tr>
        <tr>
            <td width="50%" style="text-align: center;">
               Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem magnam esse temporibus expedita unde, error adipisci nostrum excepturi facere dicta .
            </td>
            <td width="50%">
                Name: {{ ucwords(Auth::user()->first_name)}} {{ ucwords(Auth::user()->last_name)}}<br>
                Date: {{ $date->format('d/m/Y') }}
<br><br><br>
            </td>

        </tr>

    </table>

<footer>
    <p style="text-align: center"><strong>Copyright &copy; 2022 <a href="#">Giraffe Shappers Co.Ltd</Co></a>.</strong>
    All rights reserved.</p>

  </footer>
</body>
