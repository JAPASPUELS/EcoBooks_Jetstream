<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;
use App\Models\User;

class AuditoriaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $users = User::all();
            return view('vistas.auditoria.index', compact( 'users'));
        } catch (\Throwable $th) {
            //throw $th;
            error_log("Error Load Audit Data -> $th");
        }
    }
}
