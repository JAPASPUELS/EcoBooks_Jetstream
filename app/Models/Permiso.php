<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'permisos';

    protected $primaryKey = 'id';


    protected $fillable = [
        'id_rol',
        'permission_name',
    ];

    public function role()
    {
        return $this->belongsTo(Roles::class, 'id_rol');
    }
}
