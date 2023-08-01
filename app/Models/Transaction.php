<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $primaryKey = 'id_transaction';
    public $fillable = [
        'transaction_status',	'id_payment',	'id_transaction_item',	'created_at',	'updated_at',
    ];

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'id_payment', 'id_payment');
    }
    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class, 'id_transaction', 'id_transaction');
    }
}
