<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function create()
    {
        return view('vistas.proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pro_nombre' => 'required|string|max:50',
            'direccion_pro' => 'required|string|max:150',
            'pro_email' => 'required|string|email|max:100',
            'pro_telefono1' => 'required|string|max:20',
            'pro_telefono2' => 'nullable|string|max:20',
        ]);

        Proveedor::create([
            'pro_nombre' => $request->pro_nombre,
            'direccion_pro' => $request->direccion_pro,
            'pro_email' => $request->pro_email,
            'pro_telefono1' => $request->pro_telefono1,
            'pro_telefono2' => $request->pro_telefono2,
        ]);

        return redirect()->route('proveedores.create')->with('success', 'Proveedor registrado exitosamente');
    }

    public function index()
    {
        $proveedores = Proveedor::orderBy('pro_nombre', 'asc')->get();
        return view('vistas.proveedores.index', compact('proveedores'));
    }


    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return response()->json($proveedor);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pro_nombre' => 'required|string|max:50',
            'direccion_pro' => 'required|string|max:150',
            'pro_email' => 'required|string|email|max:100',
            'pro_telefono1' => 'required|string|max:20',
            'pro_telefono2' => 'nullable|string|max:20',
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update([
            'pro_nombre' => $request->pro_nombre,
            'direccion_pro' => $request->direccion_pro,
            'pro_email' => $request->pro_email,
            'pro_telefono1' => $request->pro_telefono1,
            'pro_telefono2' => $request->pro_telefono2,
        ]);

        return response()->json(['success' => true, 'message' => 'Proveedor actualizado exitosamente']);
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return response()->json(['success' => true, 'message' => 'Proveedor eliminado exitosamente']);
    }
}
