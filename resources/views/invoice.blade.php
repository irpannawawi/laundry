<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Invoice</title>
    <style>
        .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
    </style>
  </head>
  <body>
   
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Invoice</h2><h3 class="float-end"> #ORD{{$transaction->id_transaction}}</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <address>
                        <strong>Pembayaran untuk:</strong><br>
                            {{Str::upper($transaction->user->full_name)}}<br>
                            {{$transaction->user->address}}<br>
                            {{$transaction->user->phone}}<br>
                        </address>
                    </div>
        
                    <div class="col-6">
                        <address>
                            <strong>Metode Pembayaran:</strong><br>
                            {{$transaction->payment->payment_type}} (LUNAS)<br>
                        </address>
                    </div>
                    <div class="col-6 text-right">
                        <address>
                            <strong>Tanggal pesanan:</strong><br>
                            {{$transaction->created_at}}<br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Daftar pesanan</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Layanan</strong></td>
                                        <td class="text-center"><strong>Harga</strong></td>
                                        <td class="text-center"><strong>Jumlah</strong></td>
                                        <td class="text-right"><strong>Totals</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->items as $item)
                                        
                                    <tr>
                                        <td>{{$item->product_name}}</td>
                                        <td class="text-center">Rp. {{number_format($item->price, 0, ',','.')}},-</td>
                                        <td class="text-center">{{$item->product_name=='Pakaian Harian'?$item->berat.' Kg':$item->berat}}</td>
                                        <td class="text-right">Rp. {{number_format($item->price*$item->berat, 0, ',','.')}},-</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right">Rp. {{number_format($transaction->payment->price, 0, ',','.')}},-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        window.print();
    </script>
  </body>
</html>