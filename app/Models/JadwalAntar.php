<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JadwalAntar extends Model
{
    use HasFactory;
    protected $table = 'jadwal_antar';
    protected $primaryKey = 'id_jadwal_antar';
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
