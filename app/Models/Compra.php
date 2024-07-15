<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'comp_id';

    protected $fillable = [
        'art_id',
        'pro_id',
        'comp_numfac',
        'com_detalles',
        'comp_cantidad',
        'created_by',
    ];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'art_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'pro_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
