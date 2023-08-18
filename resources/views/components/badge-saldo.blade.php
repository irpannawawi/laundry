@if ($saldo > 0)
    <small>
        <span class="badge rounded-pill bg-success "><i class="fa fa-money"></i> Saldo digunakan Rp. {{ number_format($saldo, 0, ',','.') }},-</span>
    </small>
@endif
