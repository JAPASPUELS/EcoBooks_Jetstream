<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';
    protected $primaryKey = 'art_id';
    // public $incrementing = false; // Asumiendo que cli_codigo no es autoincremental
    public $timestamps = false;

    protected $fillable = [
        'art_nombre',
        'art_precio',
        'art_cantidad',
        'cat_id',
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cat_id', 'cat_id');
    }


}
