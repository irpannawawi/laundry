<table class="table table-sm table-borderd table-striped">
    <tr class="text-center">
        <th>No</th>
        <th>Order Id</th>
        <th>Tanggal Pesan</th>
        <th>Pemesan</th>
        <th>Layanan</th>
        <th>Pembayaran</th>
        <th>Jadwal Pengiriman</th>
        <th>Alamat</th>
        @if(Auth::user()->role == 'admin')
        <th>Aksi</th>
        @endif
    </tr>
    @php
        $n = 1;
    @endphp
    @foreach ($orderList as $order)
        @if ($order->transaction_status == 'shipment' && $order->jadwal_antar != null)

                <tr class="text-center">
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
                    <td>{{$order->jadwal_antar->tanggal.' Jam '. $order->jadwal_antar->jam. 'WIB'}}</td>
                    <td>
                        {{$order->user->address}}
                        {{$order->user->phone}}
                    </td>
                    @if(Auth::user()->role == 'admin')
                    <td>
                        <a href="{{ route('toFinish', ['id' => $order->id_transaction]) }}" onclick="return confirm('Selesaikan pesanan?')" class="btn btn-success">Selesai</a>
                    </td>
                    @endif
                </tr>

        @endif
    @endforeach
</table>
