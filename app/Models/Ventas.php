<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'vent_numero';

    public $timestamps = true;

    protected $fillable = [
        'vent_numero',
        'cli_codigo',
        'vent_fecha',
        'vent_total'
    ];

    protected $guarded = [

    ];
}
