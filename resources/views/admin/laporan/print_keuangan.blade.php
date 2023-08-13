<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laporan Keuangan</title>
    <style>
body
    {
        font-family: Arial;
        font-size: 10pt;
    }
    table
    {
        border: 1px solid #ccc;
        border-collapse: collapse;
    }
    table th
    {
        background-color: #F7F7F7;
        color: #333;
        font-weight: bold;
    }
    table th, table td
    {
        padding: 5px;
        border: 1px solid #ccc;
    }
    </style>
  </head>
  <body>
   
      <div class="container">
      <h2 align="center">Laporan Keuangan</h2>
      <h3 align="center">Tanggal : {{$tgl_start}} - {{$tgl_end}}</h3>
        <table class="table">
           <thead>
               <tr class="text-center">
                   <th>No</th>
                   <th>Order Id</th>
                   <th>Tanggal pesan</th>
                   <th>Pemesan</th>
                   <th>Layanan</th>
                   <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $n = 1;
                    $grand_total=0;
                @endphp
                @foreach ($orderList as $order)
                    @php
                        $grand_total += ($order->payment->price-($order->payment->with_saldo+$order->payment->with_discount));
                    @endphp
                        <tr>
                            <td class="text-center">{{ $n++ }}</td>
                            <td>ORD{{ $order->id_transaction }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->user->full_name }}</td>
                            <td>
                                <ol class="list">
                                    @foreach ($order->items as $tri)
                                        <li>{{ $tri->product_name }}
                                            @if ($tri->product_name == 'Pakaian Harian')
                                                <small>({{ number_format($tri->price, 0, ',', '.') }}x{{ $tri->berat }}Kg)</small>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>Rp. {{ number_format($order->payment->price-$order->payment->with_saldo-$order->payment->with_discount, 0, ',', '.') }},-
                            </td>
                        </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-center">TOTAL</th>
                    <th>
                        Rp. {{ number_format($grand_total, 0, ',', '.') }},-
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        window.print();
    </script>
  </body>
</html>