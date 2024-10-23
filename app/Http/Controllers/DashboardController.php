<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el usuario autenticado
            $user = Auth::user();
            // Obtener las tareas del usuario autenticado
            $tasks = $user->tasks; 
            // Pasar las tareas y el nombre del usuario a la vista
            return view('dashboard', compact('tasks', 'user'));
        }

        // Si no está autenticado, redirigir a la vista de bienvenida
        return redirect('/'); 
    }
}
