<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{


    // public function create()
    // {
    //     return view('vistas.clientes.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'cli_codigo' => 'required|string|max:20|unique:clientes,cli_codigo',
    //         'cli_nombre' => 'required|string|max:50',
    //         'cli_apellido' => 'required|string|max:50',
    //         'cli_correo' => 'required|string|email|max:100',
    //         'cli_direccion' => 'required|string|max:150',
    //         'cli_identificacion' => 'required|string|in:CI,PP,RUC',
    //     ]);

    //     Clientes::create([
    //         'cli_codigo' => $request->cli_codigo,
    //         'cli_nombre' => $request->cli_nombre,
    //         'cli_apellido' => $request->cli_apellido,
    //         'cli_correo' => $request->cli_correo,
    //         'cli_direccion' => $request->cli_direccion,
    //         'cli_identificacion' => $request->cli_identificacion,
    //         'created_by' => Auth::id()
    //     ]);

    //     return redirect()->route('clientes.create')->with('success', 'Clientes registrado exitosamente');
    // }

    public function index(Request $request)
    {
        $users = User::all();
        return view('vistas.users.index', compact('users'));
    }


    // public function edit($id)
    // {
    //     $cliente = Clientes::findOrFail($id);
    //     return response()->json($cliente);
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'cli_codigo' => 'required|string|max:20|unique:clientes,cli_codigo,' . $id . ',cli_codigo',
    //         'cli_nombre' => 'required|string|max:50',
    //         'cli_apellido' => 'required|string|max:50',
    //         'cli_correo' => 'required|string|email|max:100',
    //         'cli_direccion' => 'required|string|max:150',
    //         'cli_identificacion' => 'required|string|in:CI,PP,RUC',
    //     ]);

    //     try {
    //         $cliente = Clientes::findOrFail($id);
    //         $cliente->update([
    //             'cli_codigo' => $request->cli_codigo,
    //             'cli_nombre' => $request->cli_nombre,
    //             'cli_apellido' => $request->cli_apellido,
    //             'cli_correo' => $request->cli_correo,
    //             'cli_direccion' => $request->cli_direccion,
    //             'cli_identificacion' => $request->cli_identificacion,
    //         ]);

    //         return response()->json(['success' => true, 'message' => 'Cliente actualizado exitosamente']);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'Error actualizando cliente', 'error' => $e->getMessage()], 500);
    //     }
    // }


    //     public function destroy($id)
    //     {
    //         $cliente = Clientes::findOrFail($id);
    //         $cliente->delete();

    //         return response()->json(['success' => true, 'message' => 'Clientes eliminado exitosamente']);
    //     }

}
