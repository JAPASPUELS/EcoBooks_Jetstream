<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'vent_numero';

    protected $fillable = [
        'cli_codigo',
        'vent_total',
        'vent_subtotal',
        'vent_fecha',
        'created_by',
    ];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cli_codigo', 'cli_codigo'); // Cambio aquí
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVentas::class, 'vent_numero', 'vent_numero');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'vent_numero', 'vent_numero'); // Cambio aquí
    }
}