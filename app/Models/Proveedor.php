<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $primaryKey = 'pro_id';

    protected $fillable = [
        'pro_nombre',
        'direccion_pro',
        'pro_email',
        'pro_telefono1',
        'pro_telefono2',
    ];

    // Eloquent automáticamente manejará las columnas created_at y updated_at
    public $timestamps = true;
}
