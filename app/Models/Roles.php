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
        'active',
        'created_by',

    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function permissions()
    {
        return $this->hasMany(Permiso::class, 'id_rol');
    }    // Eloquent automáticamente manejará las columnas created_at y updated_at
    public $timestamps = false;
}
