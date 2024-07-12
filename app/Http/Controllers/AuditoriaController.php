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
            $query = Auditoria::query();    
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where('aud_accion', 'LIKE', "%{$search}%")
                      ->orWhere('aud_table', 'LIKE', "%{$search}%");
            }
            $auditoria = $query->paginate(10); 
            $users = User::all();
            return view('vistas.auditoria.index', compact('auditoria', 'users'));
        } catch (\Throwable $th) {
            //throw $th;
            error_log("Error Load Audit Data -> $th");
        }
    }
}
