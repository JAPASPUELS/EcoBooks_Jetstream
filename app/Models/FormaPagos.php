<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagos extends Model
{
    use HasFactory;

    protected $table = 'forma_pagos';
    protected $primaryKey = 'fpa_id';

    protected $fillable = [
        'fpa_nombre',
        'created_by',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
