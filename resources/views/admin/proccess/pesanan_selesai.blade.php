<table class="table table-sm table-borderd table-striped">
    <tr class="text-center">
        <th>No</th>
        <th>Order Id</th>
        <th>Tanggal Pesan</th>
        <th>Pemesan</th>
        <th>Layanan</th>
        <th>Pembayaran</th>
        <th>Struk/Invoice</th>
    </tr>
    @php
        $n = 1;
    @endphp
    @foreach ($orderList as $order)
        <tr>
            <td>{{ $n++ }}</td>
            <td>ORD{{ $order->id_transaction }}</td>
            <td>{{ $order->created_at }}</td>
            <td>@if($order->user->is_membership==1)
                <i class="fa fa-crown text-warning"></i>
                @endif{{ $order->user->full_name }}</td>
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
            </td>
            <td>
                <a href="{{route('invoice', ['id'=>$order->id_transaction])}}" target="__blank"><i class="fa fa-print"></i> Cetak</a>
            </td>
        </tr>
    @endforeach
</table>
