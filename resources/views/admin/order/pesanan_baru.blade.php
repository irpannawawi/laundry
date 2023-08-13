<table class="table table-sm table-borderd table-striped">
    <tr class="text-center">
        <th>No</th>
        <th>Order Id</th>
        <th>Tanggal Pesan</th>
        <th>Pemesan</th>
        <th>Layanan</th>
        <th>Pembayaran</th>
        @if(Auth::user()->role == 'admin')
        <th>Aksi</th>
        @endif
    </tr>
    @php
        $n = 1;
    @endphp
    @foreach ($orderList as $order)
            @if ($order->jadwal_jemput==null)
                <tr>
                    <td>{{ $n++ }}</td>
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
                    <td>Rp. {{ number_format($order->payment->price-$order->payment->with_saldo-$order->payment->with_discount, 0, ',', '.') }},- ({{ $order->payment->payment_type }}) 
                        @if($order->payment->payment_type=='Transfer')
                        <a href="#" onclick="get_payment_info('{{$order->payment->payment_info}}')" data-bs-toggle="modal" data-bs-target="#infoPayment"><i class="fa fa-eye"></i></a>
                        @endif
                    </td>
                    @if(Auth::user()->role == 'admin')
                    <td>
                        @if ($order->transaction_status != 'caceled')
                        
                        <div class="btn-group">
                            <a href="{{route('accTransaction', ['id'=>$order->id_transaction])}}" onclick="return confirm('Terima pesanan?')" class="btn btn-primary">Terima</a>
                            <a href="{{route('cancelTransaction', ['id'=>$order->id_transaction])}}" onclick="return confirm('Batalkan pesanan?')" class="btn btn-danger">Batal</a>
                        </div>
                        @else
                        Pesanan dibatalkan
                        @endif
                    </td>
                    @endif
                </tr>
            @endif
    @endforeach
</table>

