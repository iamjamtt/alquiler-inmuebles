<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleContrato extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $table = 'detalle_contrato';
    protected $fillable = [
        'contrato_id',
        'local_id',
        'edificio',
        'tipo_edificio',
        'subtotal',
        'estado',
    ];

    public $timestamps = false;

    public function Contrato(){
        return $this->belongsTo(Contrato::class,
        'contrato_id','id');
    }

    public function Local(){
        return $this->belongsTo(Local::class,
        'local_id','id');
    }
}
