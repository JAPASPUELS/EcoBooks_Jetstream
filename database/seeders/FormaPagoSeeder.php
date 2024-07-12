<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormaPago;

class FormaPagoSeeder extends Seeder
{
    public function run()
    {
        FormaPago::create(['fpa_id' => '001', 'fpa_nombre' => 'Efectivo']);
        FormaPago::create(['fpa_id' => '002', 'fpa_nombre' => 'Transferencia']);
    }
}

