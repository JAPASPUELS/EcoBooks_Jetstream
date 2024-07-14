<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;


class GastoController extends Controller
{
    public function index(Request $request)
    {
        $query = Gasto::query();

        if ($request->has('usuario') && $request->usuario != 0) {
            $query->where('created_by', $request->usuario);
        }
        if ($request->has('fechaInicio') && $request->fechaInicio != '') {
            $query->whereDate('mov_fecha', '>=', $request->fechaInicio);
        }
        if ($request->has('fechaFin') && $request->fechaFin != '') {
            $query->whereDate('mov_fecha', '<=', $request->fechaFin);
        }

        if ($request->has('searchTerm') && $request->searchTerm != '') {
            $query->where(function ($q) use ($request) {
                $q->where('gast_descripcion', 'like', '%' . $request->searchTerm . '%')
                    ->where('gast_valor', 'like', '%' . $request->searchTerm . '%')
                    ->where('gast_fecha', 'like', '%' . $request->searchTerm . '%')
                    ->orWhereHas('user', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->searchTerm . '%');
                    });
            });
        }
        $calculateValue = $query->sum('gast_valor');
        $data = $query->paginate(10);



        $users = User::all();

        return view('vistas.gastos.index', [
            'data' => $data,
            'users' => $users,
            'calculateValue' => $calculateValue,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'fecha' => 'required|date',
            // 'usuario' => 'required|exists:users,id',
        ]);

        // Crear el nuevo registro
        Gasto::create([
            'gast_descripcion' => $request->descripcion,
            'gast_valor' => $request->valor,
            'gast_fecha' => $request->fecha,
            'user_id' => $request->usuario,
            'created_by' => Auth::id()

        ]);

        return redirect()->route('gastos.index')->with('success', 'Registro creado exitosamente.');
    }


    public function edit($id)
    {
        $gasto = Gasto::findOrFail($id);
        $users = User::all();

        return response()->json(['gasto' => $gasto, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $gasto = Gasto::findOrFail($id);
        $gasto->update($request->all());

        return redirect()->route('gastos.index')->with('success', 'Gasto actualizado con éxito');
    }

    public function destroy($id)
    {
        $gasto = Gasto::findOrFail($id);
        $gasto->delete();

        return redirect()->route('gastos.index')->with('success', 'Gasto eliminado con éxito');
    }
}
