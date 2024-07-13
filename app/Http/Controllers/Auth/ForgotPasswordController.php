<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordOptionForm()
    {
        return view('auth.forgot-password-option');
    }

    public function handleForgotPasswordOption(Request $request)
    {
        $request->validate([
            'recovery_option' => 'required|in:email,security_question',
        ]);

        if ($request->recovery_option == 'email') {
            return redirect()->route('password.request');
        } else {
            return redirect()->route('password.security-question');
        }
    }
}
