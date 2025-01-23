<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken; // Generar token
            return response()->json([
                'token' => $token,
                'user' => $user,
                'roles' => $user->getRoleNames(), // Roles del usuario (si usas Spatie)
            ]);
        }

        return response()->json(['error' => 'Credenciales inválidas'], 401);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // Revocar todos los tokens del usuario
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
