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
            return view('vistas.auditoria.index', compact('auditoria'));
        } catch (\Throwable $th) {
            //throw $th;
            error_log("Error Load Audit Data -> $th");
        }
    }
}
