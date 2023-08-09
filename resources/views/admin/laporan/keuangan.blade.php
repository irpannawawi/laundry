<form action="{{ route('laporan') }}" method="GET">
    @csrf
    <table class="table table-borderless table-sm">
        <tr>
            <td>
                <label for="tgl_start">Tanggal dari</label>
            </td>
            <td>
                <label for="tgl_end">Sampai dengan</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="date" class="form-control" name="tgl_start" value="{{ $tgl_start }}">
                <input type="hidden" class="form-control" name="page" value="1">
            </td>
            <td>
                <input type="date" class="form-control" name="tgl_end" value="{{ $tgl_end }}">
            </td>
            <td>
                <input type="submit" class="form-control btn btn-primary" value="Pilih" name="search">
            </td>
            <td>
                <a target="__blank" class="btn btn-info form-control" href="{{route('printKeuangan', ['start'=>$tgl_start, 'end'=>$tgl_end])}}"><div class="i fa fa-print"></div> Print</a>
            </td>
        </tr>
    </table>
</form>
<table class="table table-sm table-borderd">
    <tr>
        <th colspan="6">
            <h2 align="center">Laporan Keuangan</h2>
        </th>
    </tr>
    <tr class="bg-dark text-white text-center">
        <th>No</th>
        <th>Order Id</th>
        <th>Tanggal pesan</th>
        <th>Pemesan</th>
        <th>Layanan</th>
        <th>Harga</th>
    </tr>
    @php
        $n = 1;
        $grand_total=0;
    @endphp
    @foreach ($orderList as $order)
        @php
            $grand_total += $order->payment->price;
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
                <td>Rp. {{ number_format($order->payment->price, 0, ',', '.') }},-
                </td>
            </tr>
    @endforeach
    <tr class="bg-dark text-white">
        <th colspan="5" class="text-center">TOTAL</th>
        <th>
            Rp. {{ number_format($grand_total, 0, ',', '.') }},-
        </th>
    </tr>
</table>
