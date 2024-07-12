<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';
    protected $primaryKey = 'det_id';

    protected $fillable = [
        'vent_numero',
        'art_id',
        'det_precio',
        'det_unidades',
        'det_precio_total',
        'created_by',
    ];

    public $timestamps = false;

    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'vent_numero', 'vent_numero');
    }
}
