<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    public $fillable = [
        'id_user',
        'id_product',	
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'id');
    }

    
    public function product(): HasOne
    {
        return $this->hasOne(Produk::class, 'id_product', 'id_product');
    }
}
