<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogConnexion;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $userCredentials = [
        'email' => $credentials['email'],
        'password' => $credentials['password'],
    ];

    // Vérifie d'abord si l'utilisateur existe
    if (Auth::attempt($userCredentials, $request->remember)) {
        $request->session()->regenerate();

        LogConnexion::create([
            'utilisateur_id' => auth()->user()->id_utilisateur,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);


        // Puis vérifie si c'est bien un admin
        if (Auth::user()->type_utilisateur !== 'admin') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Accès réservé aux administrateurs uniquement.',
            ]);
        }

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Identifiants incorrects.',
    ])->onlyInput('email');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
