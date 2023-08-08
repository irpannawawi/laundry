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
      <h2 align="center">Laporan Penjualan</h2>
      <h3 align="center">Tanggal : {{$tgl_start}} - {{$tgl_end}}</h3>
      <table class="table table-sm table-borderd">
        <tr>
            <th colspan="6">
                <h2 align="center">Laporan Penjualan</h2>
            </th>
        </tr>
        <tr class="bg-dark text-white">
            <th>No</th>
            <th>Layanan</th>
            <th>Terjual</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        @php
            $n = 1;
            $grand_total=0;
        @endphp
        @foreach ($itemList as $item)
            @php
                $grand_total += $item['total_price'];
            @endphp
                <tr>
                    <td>{{ $n++ }}</td>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['total_terjual'] }}</td>
                    <td>Rp. {{ number_format($item['price'], 0, ',', '.') }},-</td>
                    <td>Rp. {{ number_format($item['total_price'], 0, ',', '.') }},-</td>
                </tr>
        @endforeach
        <tr class="bg-dark text-white">
            <th colspan="4" class="text-center">TOTAL</th>
            <th>
                Rp. {{ number_format($grand_total, 0, ',', '.') }},-
            </th>
        </tr>
    </table>
    </div>

    <script>
        window.print();
    </script>
  </body>
</html>