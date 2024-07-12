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
