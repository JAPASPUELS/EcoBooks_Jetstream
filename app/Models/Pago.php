<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'pag_id';
    public $timestamps = false;

    protected $fillable = [
        'fpa_id',
        'vent_numero',
        'pag_valor',
        'pag_fecha',
        'created_by'
    ];

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'fpa_id', 'fpa_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'vent_numero', 'vent_numero');
    }
}
