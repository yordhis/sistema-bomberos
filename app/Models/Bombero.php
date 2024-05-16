<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bombero extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cedula', 
        'telefono',
        'correo',
        'direccion',
        'cargo',
        'rol',
    ];
}
