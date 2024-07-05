<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';

    protected $fillable = [
        'art_id',
        'art_nombre',
        'art_precio',
        'art_cantidad',
    ];

    public $timestamps = false;
}
