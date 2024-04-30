<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', 
        'cedula_estudiante', 
        'codigo_inscripcion', 
        'concepto', 
        'fecha', 
        'estatus'
    ];
}
