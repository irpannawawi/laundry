<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JadwalJemput extends Model
{
    use HasFactory;
    protected $table = 'jadwal_jemput';
    protected $primaryKey = 'id_jadwal_jemput';
    public $fillable = [
        'tanggal',
        'jam',	
        'status',	
        'id_transaction',	
    ];

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'id_transaction', 'id_transaction');
    }
}
