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
    
    protected $casts = [
        'cli_codigo' => 'string',
    ];
    protected $fillable = [
        'cli_codigo',
        'cli_nombre',
        'cli_apellido',
        'cli_correo',
        'cli_direccion',
        'cli_identificacion',
        'created_by',
    ];

    public function ventas()
    {
        return $this->belongsTo(Ventas::class, 'cli_codigo', 'cli_codigo'); // Cambio aquí
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
