<table class="table table-sm table-borderd table-striped">
    <tr>
        <th>No</th>
        <th>Order Id</th>
        <th>Tanggal pesan</th>
        <th>Pemesan</th>
        <th>Layanan</th>
        <th>Pembayaran</th>
        <th>Jadwal Pengiriman</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    @php
        $n = 1;
    @endphp
    @foreach ($orderList as $order)
        @if ($order->transaction_status == 'shipment' && $order->jadwal_antar != null)

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
                        {{$order->user->address}}
                        {{$order->user->phone}}
                    </td>
                    <td>
                        <a href="{{ route('toFinish', ['id' => $order->id_transaction]) }}" onclick="return confirm('Selesaikan pesanan?')" class="btn btn-success">Selesai</a>
                    </td>
                </tr>

        @endif
    @endforeach
</table>
