<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Saldo extends Model
{
    use HasFactory;
    protected $table = 'log_saldo';
    protected $primaryKey = 'id_log_saldo';
    public $fillable = [
        'saldo',
        'type',	
        'ket',	
        'user_id',	
    ];
    public $timestamps = true;
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'id');
    }

}
