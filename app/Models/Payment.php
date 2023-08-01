<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    protected $primaryKey = 'id_payment';
    public $fillable = [
        'payment_type',
        'status',
        'price'	
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'id_payment', 'id_payment');
    }


}
