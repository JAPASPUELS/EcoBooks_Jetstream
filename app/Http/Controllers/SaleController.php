<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Sale;

class SaleController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        return view('sales.create', compact('clients'));
    }

    public function store(Request $request)
    {
        // Lógica para almacenar la venta
        $sale = new Sale();
        $sale->client_id = $request->client_id;
        $sale->date = $request->date;
        $sale->total = $request->total;
        $sale->save();

        return redirect()->route('sales.create')->with('success', 'Venta registrada correctamente.');
    }
}
