<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'rol_id';

    protected $fillable = [
        
        'rol_nombre',
        'rol_descripcion',

    ];

    // Eloquent automáticamente manejará las columnas created_at y updated_at
    public $timestamps = false;
}
