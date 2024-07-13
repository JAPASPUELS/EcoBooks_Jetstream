<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class SecurityQuestionController extends Controller
{
    public function showSecurityQuestionForm(Request $request)
    {
        $email = $request->input('email');
        $securityQuestion = null;

        if ($email) {
            $user = User::where('email', $email)->first();
            $securityQuestion = $user ? $user->security_question : null;
        }

        return view('auth.passwords.security-question', compact('email', 'securityQuestion'));
    }

    public function verifySecurityQuestion(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'security_answer' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->security_answer, $user->security_answer)) {
            // Generar un token de restablecimiento de contraseña
            $token = Password::broker()->createToken($user);

            // Redirigir al formulario de restablecimiento de contraseña con el token
            return redirect()->route('password.reset', ['token' => $token, 'email' => $request->email]);
        }

        return back()->withErrors(['security_answer' => 'La respuesta a la pregunta de seguridad es incorrecta.']);
    }
}
