<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $table = 'edificio';
    protected $fillable = [
        'nombre',
        'descripcion',
        'direccion',
        'foto',
        'pisos',
        'estado',
        'tipo_edificio_id',
    ];

    public $timestamps = false;

    public function TipoEdificio(){
        return $this->belongsTo(TipoEdificio::class,
        'tipo_edificio_id','id');
    }
}
