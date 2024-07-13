<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;

    protected $table = 'forma_pagos';
    protected $primaryKey = 'fpa_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'fpa_nombre',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
