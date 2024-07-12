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
        'vent_fecha',
        'created_by',
    ];

    public $timestamps = false;

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
        return $this->hasOne(Pagos::class, 'vent_numero', 'vent_numero');
    }
}
