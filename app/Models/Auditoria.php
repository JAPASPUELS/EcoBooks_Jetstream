<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;

    protected $table = 'auditoria';

    protected $primaryKey = 'id_aud';

    protected $fillable = [
        
        'usu_id',
        'aud_fecha',
        'aud_accion',
        'aud_descripcion',
        'aud_table',
        'user_id'

    ];

    // Eloquent automáticamente manejará las columnas created_at y updated_at
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
