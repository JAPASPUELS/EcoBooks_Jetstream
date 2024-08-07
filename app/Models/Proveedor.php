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
        'created_at',
        'updated_at',
        'created_by',  
    ];
    
    // Eloquent automáticamente manejará las columnas created_at y updated_at
    public $timestamps = true;
    
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
