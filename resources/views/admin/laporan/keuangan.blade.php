<form action="{{ route('laporan') }}" method="GET">
    @csrf
<div class="row col-md-6 float-end mb-4 border border-primary border-1 rounded p-2">
        <div class="col">
            <label for="tgl_start">Tanggal dari</label>
            <input type="date" class="form-control" name="tgl_start" value="{{ $tgl_start }}">
        </div>
        <div class="col">
            <label for="tgl_end">Sampai dengan</label>
            <input type="date" class="form-control" name="tgl_end" value="{{ $tgl_end }}">
        </div>
        <div class="col">
            <label for="find">- </label>
            <input type="submit" class="form-control btn btn-primary" value="Pilih" name="search">
        </div>
    </div>
</form>
<table class="table table-sm table-borderd">
    <tr class="bg-dark text-white">
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
        @if ($order->jadwal_jemput == null)
        @php
            $grand_total += $order->payment->price;
        @endphp
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
                <td>Rp. {{ number_format($order->payment->price, 0, ',', '.') }},-
                </td>
            </tr>
        @endif
    @endforeach
    <tr class="bg-dark text-white">
        <th colspan="5" class="text-center">TOTAL</th>
        <th>
            Rp. {{ number_format($grand_total, 0, ',', '.') }},-
        </th>
    </tr>
</table>
