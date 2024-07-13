<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'pag_id';

    protected $fillable = [
        'vent_numero',
        'fpa_id',
        'pag_valor',
    ];

    public $timestamps = false;

    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'vent_numero', 'vent_numero');
    }
}
