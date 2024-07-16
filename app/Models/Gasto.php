<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $table = 'gastos';
    protected $primaryKey = 'gast_id';
    public $timestamps = false;

    protected $fillable = [
        'gast_descripcion',
        'gast_valor',
        'gast_fecha',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
