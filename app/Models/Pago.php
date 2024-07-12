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
        'pag_id',
        'fpa_id',
        'vent_numero',
        'pag_valor',
        'pag_fecha'
    ];

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'fpa_id', 'fpa_id');
    }
}
