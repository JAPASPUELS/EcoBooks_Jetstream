<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';

    protected $primaryKey = 'art_id';

    protected $fillable = [
        'art_nombre',
        'art_precio',
        'art_cantidad',
        'cat_id',
        'created_by',
        'art_unidades',
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cat_id');
    }
}
