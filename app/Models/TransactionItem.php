<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransactionItem extends Model
{
    use HasFactory;
    protected $table = 'transaction_item';
    protected $primaryKey = 'id_product';
    public $fillable = [
        'product_name',
        'descriptions',
        'price',
        'picture',
        'is_deleted',
        'created_at',
        'updated_at',
        'id_transaction',
        'setrika',
    ];

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'id_transaction', 'id_transaction');
    }
    

}
