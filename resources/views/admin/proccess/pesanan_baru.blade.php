<table class="table table-sm table-borderd table-striped">
    <tr>
        <th>No</th>
        <th>Order Id</th>
        <th>Tanggal pesan</th>
        <th>Pemesan</th>
        <th>Layanan</th>
        <th>Pembayaran</th>
        <th>Aksi</th>
    </tr>
    @php
        $n = 1;
    @endphp
    @foreach ($orderList as $order)
        @if ($order->jadwal_jemput != null)
            @if (
                $order->payment->payment_type == 'COD' ||
                    ($order->payment->payment_type == 'Transfer' && $order->payment->status == 'Paid'))
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
                        <a href="{{route('accTransaction')}}" onclick="return confirm('Terima pesanan?')" class="btn btn-primary">Terima</a>
                        <a href="{{route('accTransaction')}}" onclick="return confirm('Terima pesanan?')" class="btn btn-danger">Batal</a>
                    </td>
                </tr>
            @endif
        @endif
    @endforeach
</table>
