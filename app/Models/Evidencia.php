<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $table = 'evidencia';
    protected $fillable = [
        'evidencia',
        'estado',
    ];

    public $timestamps = false;
}
