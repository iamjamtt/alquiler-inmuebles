<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $dates = ['fecha_inicio', 'fecha_fin'];

    protected $table = 'contrato';
    protected $fillable = [
        'user_id',
        'monto',
        'tiempo',
        'fecha_inicio',
        'fecha_fin',
        'contrato',
        'estado',
        'penalidad',
        'fecha_registro',
    ];

    public $timestamps = false;

    public function User(){
        return $this->belongsTo(User::class,
        'user_id','id');
    }
}
