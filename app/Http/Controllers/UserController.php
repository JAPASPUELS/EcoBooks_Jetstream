<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $criteria = $request->input('criteria', 'name');
        $search = $request->input('search', '');

        $users = User::where($criteria, 'LIKE', "%$search%")->paginate(10);
        // Obtener todos los roles
        $users = User::with('role')->paginate(10);
        $roles = Roles::all();
        return view('vistas.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('vistas.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol_id' => 'required|integer|exists:roles,rol_id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
    }
    public function updateRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,rol_id',
        ]);

        $user = User::find($request->user_id);
        $user->rol_id = $request->role_id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Rol del usuario actualizado exitosamente');
    }
}
