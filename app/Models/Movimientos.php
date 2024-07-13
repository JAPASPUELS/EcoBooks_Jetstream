<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    use HasFactory;

    protected $table = 'movimientos';
    protected $primaryKey = 'mov_id';
    public $timestamps = false;

    protected $fillable = [
        'mov_tipo',
        'mov_cantidad',
        'mov_fecha',
        'art_id',
        'stock_previo',
        'stock_actual',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function product()
    {
        return $this->belongsTo(Articulo::class, 'art_id');
    }
}