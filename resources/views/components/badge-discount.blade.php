@if ($discount > 0)
    <small>
        <span class="badge rounded-pill bg-info text-dark"><i class="fa fa-ticket"></i> Voucher diskon digunakan Rp. {{ number_format($discount, 0, ',','.') }},-</span>
    </small>
@endif
