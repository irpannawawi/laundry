<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discounts';
    protected $primaryKey = 'id_discount';
    public $fillable = [
        'discount_code',
        'discount_name',
        'discount_type',
        'product_selected',
        'total_discount',
    ];
    public $timestamps = true;
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'product_selected', 'id_product');
    }
}
