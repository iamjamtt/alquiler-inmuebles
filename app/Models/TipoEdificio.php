<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEdificio extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $table = 'tipo_edificio';
    protected $fillable = [
        'tipo_edificio',
        'estado',
        'limite_pisos',
        'limite_locales',
    ];

    public $timestamps = false;
}
