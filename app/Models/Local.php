<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    
    protected $primaryKey = "id";

    protected $table = 'local';
    protected $fillable = [
        'numero',
        'descripcion',
        'precio',
        'estado',
        'edificio',
        'piso_id',
    ];

    public $timestamps = false;

    public function Pisos(){
        return $this->belongsTo(Pisos::class,
        'piso_id','id');
    }
}
