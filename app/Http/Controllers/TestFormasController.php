<?php
namespace App\Http\Controllers;

use App\Models\FormaPago;
use Illuminate\Http\Request;

class TestFormasController extends Controller
{
    public function index()
    {
        return FormaPago::all();
    }

    public function store(Request $request)
    {
        $formaDePago = FormaPago::create($request->all());
        return response()->json($formaDePago, 201);
    }
    
    public function show($id)
    {
        return FormaPago::find($id);
    }

    public function update(Request $request, $id)
    {
        $formaDePago = FormaPago::findOrFail($id);
        $formaDePago->update($request->all());
        return response()->json($formaDePago, 200);
    }


    public function destroy($id)
    {
        FormaPago::destroy($id);
        return response()->json(null, 204);
    }
}