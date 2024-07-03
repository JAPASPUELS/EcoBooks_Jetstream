<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'clientes';

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'cli_codigo',
        'cli_nombre',
        'cli_apellido',
        'cli_correo',
        'cli_direccion',
        'cli_identificacion',
    ];

    // Si la clave primaria no se llama 'id', especificarla
    protected $primaryKey = 'cli_codigo';

    // Si la clave primaria no es autoincrementable, especificarlo
    public $incrementing = false;
    protected $keyType = 'string';
}
