<table class="table table-sm table-borderd table-striped">
    <tr>
        <th>No</th>
        <th>Order Id</th>
        <th>Tanggal pesan</th>
        <th>Pemesan</th>
        <th>Layanan</th>
        <th>Pembayaran</th>
        <th>Pengiriman</th>
        <th>Aksi</th>
    </tr>
    @php
        $n = 1;
    @endphp
    @foreach ($orderList as $order)
    @if ($order->jadwal_antar == null)
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
            <td>Rp. {{ number_format($order->payment->price, 0, ',', '.') }},- ({{ $order->payment->payment_type }})
            </td>
            <td>
                @if($order->jadwal_jemput!=null)
                <i class="fa fa-truck"></i>
                Perlu dikirim 
                @else 
                Diambil customer
                @endif
            </td>
            <td>
                @if ($order->transaction_status == 'accepted')
                    <a href="{{ route('toProccess', ['id' => $order->id_transaction]) }}"
                        onclick="return confirm('Proses pesanan?')" class="btn btn-primary">Proses pesanan</a>
                
                @elseif($order->transaction_status=='proccess')
                    @if ($order->jadwal_jemput != null)                        
                        <button type="button" data-bs-toggle="modal" data-bs-target="#pengirimanModal"  onclick="add_shipment('{{$order->id_transaction}}')" class="btn btn-success">Jadwalkan pengiriman</a>
                    @else
                        <a href="{{ route('completeProccess', ['id' => $order->id_transaction]) }}" onclick="return confirm('Selesaikan pesanan?')" class="btn btn-success">Selesai</a>
                    @endif
                @elseif ($order->transaction_status=='shipment' && $order->jadwal_antar==null)
                    Menunggu customer
                @endif
            </td>
        </tr>
    @endif
    @endforeach
</table>
