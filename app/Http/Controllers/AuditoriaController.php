<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;

class AuditoriaController extends Controller
{
    public function index()
    {
        try {
            $auditoria = Auditoria::orderBy('id_aud', 'asc')->get();
            // return view('vistas.auditoria.index', compact('auditoria'));
            // Aquí puedes preparar datos para tus gráficos
            $acciones = $auditoria->pluck('aud_accion')->unique()->values();
            $cantidadPorAccion = $auditoria->groupBy('aud_accion')->map->count();

            return view('index', [
                'auditoria' => $auditoria,
                'acciones' => $acciones,
                'cantidadPorAccion' => $cantidadPorAccion,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            error_log("Error Load Audit Data -> $th");
        }
    }
}
