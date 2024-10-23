<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{   
    // Mostrar la vista de bienvenida
    public function home()
    {
        return view('welcome');
    }

    // Mostrar el listado de tareas en el dashboard
    public function index()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $tasks = $user->tasks; // Obtener las tareas del usuario autenticado

        return view('dashboard', [
            'tasks' => $tasks,
            'name' => $user->name
        ]); 
    }

    // Almacenar una nueva tarea
    public function store(Request $request)
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        // Validar el formulario
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        // Crear la nueva tarea
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $user->id, // Asocia la tarea al usuario autenticado
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('dashboard')->with('success', '¡Tarea agregada exitosamente!');
    }

    // Eliminar una tarea existente
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id); // Encuentra la tarea o falla si no existe
        $user = Auth::user(); // Obtener el usuario autenticado

        // Verificar que la tarea pertenece al usuario autenticado
        if($user->id != $task->user_id) {
            return abort(401, 'No autorizado para eliminar esta tarea');
        }

        // Eliminar la tarea
        $task->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('dashboard')->with('success', '¡Tarea borrada exitosamente!');
    }
}
