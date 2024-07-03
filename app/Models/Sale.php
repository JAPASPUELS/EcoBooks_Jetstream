<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Definir las propiedades del modelo según tu esquema de base de datos
    protected $fillable = [
        'client_id',
        'date',
        'total',
        // Otros campos...
    ];
}
