<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // Mostrar la vista de Login y Registro
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard'); // Redirigir al panel de usuario
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function registerCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);

        $user = User::create([
            'name'        => $request->name,
            'last_name'   => $request->last_name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'zip'         => $request->zip,
            'is_technician' => false,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // Método para técnico
    public function registerTechnician(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'verification_video' => 'required|file|mimes:mp4,mov,avi|max:10240',
        ]);

        $user = User::create([
            'name'        => $request->name,
            'last_name'   => $request->last_name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'zip'         => $request->zip,
            'is_technician' => true,
        ]);

        $videoPath = $request->file('verification_video')->store('videos', 'public');

        Technician::create([
            'user_id' => $user->id,
            'verification_video' => $videoPath,
            'verified' => false,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }


    // Mostrar página después del pago exitoso
    public function paymentSuccess()
    {
        return view('payment-success');
    }
}
