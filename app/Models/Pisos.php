<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pisos extends Model
{
    use HasFactory;
    
    protected $primaryKey = "id";

    protected $table = 'pisos';
    protected $fillable = [
        'nombre',
        'estado',
        'numero_locales',
        'edificio_id',
    ];

    public $timestamps = false;

    public function Edificio(){
        return $this->belongsTo(Edificio::class,
        'edificio_id','id');
    }
}
