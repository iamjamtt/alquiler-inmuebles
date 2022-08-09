<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenciaUsuario extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $table = 'user_evidencia';
    protected $fillable = [
        'user_id',
        'evidencia_id',
        'documento_evidencia',
        'estado',
    ];

    public $timestamps = false;

    public function Evidencia(){
        return $this->belongsTo(Evidencia::class,
        'evidencia_id','id');
    }

    public function User(){
        return $this->belongsTo(User::class,
        'user_id','id');
    }
}
