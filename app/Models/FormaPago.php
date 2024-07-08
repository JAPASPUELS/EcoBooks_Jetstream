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
        'fpa_id',
        'fpa_nombre',
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'fpa_id', 'fpa_id');
    }
}
