<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'cat_id';
    // public $incrementing = false; // Asumiendo que cli_codigo no es autoincremental
    public $timestamps = true;

    protected $fillable = [
        'cat_name',
        'cat_description',
        'created_by',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
