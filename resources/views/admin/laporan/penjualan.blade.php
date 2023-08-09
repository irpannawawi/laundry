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
                <input type="hidden" class="form-control" name="page" value="2">
            </td>
            <td>
                <input type="date" class="form-control" name="tgl_end" value="{{ $tgl_end }}">
            </td>
            <td>
                <input type="submit" class="form-control btn btn-primary" value="Pilih" name="search">
            </td>
            <td>
                <a target="__blank" class="btn btn-info form-control" href="{{route('printPenjualan', ['start'=>$tgl_start, 'end'=>$tgl_end])}}"><div class="i fa fa-print"></div> Print</a>
            </td>
        </tr>
    </table>
</form>
<table class="table table-sm table-borderd">
    <tr>
        <th colspan="6">
            <h2 align="center">Laporan Penjualan</h2>
        </th>
    </tr>
    <tr class="bg-dark text-white text-center">
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
                <td class="text-center">{{ $n++ }}</td>
                <td>{{ $item['product_name'] }}</td>
                <td class="text-center">{{ $item['total_terjual'] }}</td>
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
