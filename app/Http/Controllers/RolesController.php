<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RolesController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'rol_nombre' => 'required|string|max:50',
            'rol_descripcion' => 'required|string|max:150',
        ]);

        Roles::create([
            'rol_nombre' => $request->rol_nombre,
            'rol_descripcion' => $request->rol_descripcion,
            'active' => false,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol registrado exitosamente');
    }

    public function index(Request $request)
    {
        $query = Roles::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('rol_nombre', 'LIKE', "%{$search}%")
                ->orWhere('rol_descripcion', 'LIKE', "%{$search}%");
        }

        $roles = $query->paginate(10);

        return view('vistas.roles.index', compact('roles'));
    }


    public function edit($id)
    {
        $rol = Roles::findOrFail($id);
        return response()->json($rol);
    }

    public function update(Request $request, $id)
    {

        try {

            $request->validate([
                'rol_nombre' => 'required|string|max:50',
                'rol_descripcion' => 'required|string|max:150',
            ]);

            $rol = Roles::findOrFail($id);

            $rol->update([
                'rol_nombre' => $request->rol_nombre,
                'rol_descripcion' => $request->rol_descripcion,
            ]);


            return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente');
        } catch (\Throwable $th) {
            return response()->json($request);
        }
    }




    public function destroy($id)
    {
        try {
            $rol = Roles::findOrFail($id);

            // Verifica si hay usuarios que tienen este rol
            $enUso = User::where('rol_id', $rol->rol_id)->exists();

            if ($enUso) {
                return response()->json(['success' => false, 'message' => 'El rol está en uso']);
            } else {
                $rol->update([
                    'active' => !$rol->active,
                ]);
                return response()->json(['success' => true, 'message' => 'Cambio el estado del Rol exitosamente']);
            }
        } catch (\Throwable $th) {
            error_log($th);
            return response()->json(['success' => false, 'message' => 'Ocurrió un error al intentar actualizar el rol']);
        }
    }
}
