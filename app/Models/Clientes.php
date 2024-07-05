<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'cli_codigo';
    public $incrementing = false; // Asumiendo que cli_codigo no es autoincremental
    public $timestamps = true;

    protected $fillable = [
        'cli_codigo',
        'cli_nombre',
        'cli_apellido',
        'cli_correo',
        'cli_direccion',
        'cli_identificacion'
    ];
}
