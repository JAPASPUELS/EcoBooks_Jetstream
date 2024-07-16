<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table = 'inventario';

    protected $fillable = [
        'art_id',
        'inv_fecha',
        'inv_cantidad',
        'created_by',
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
