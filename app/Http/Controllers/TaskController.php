<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{   

    public function home()
    {
        return view('welcome');
    }
    /**
     * Mostrar el listado de tareas.
     */
    public function index()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $tasks = $user->tasks; // Obtener las tareas del usuario autenticado
        $name = $user->name; // Obtener el nombre del usuario

        return view('dashboard', compact('tasks', 'name')); // Pasar 'tasks' y 'name' a la vista
    }

    /**
     * Almacenar una nueva tarea en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar el formulario
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        // Crear una nueva tarea asociada al usuario autenticado
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id, // Asocia la tarea al usuario autenticado
        ]);

        // Redirigir al dashboard después de guardar la tarea
        return redirect()->route('dashboard')->with('success', 'tarea agregada exitosamente!');
    }

    /**
     * Eliminar una tarea existente.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        // Verificar que la tarea pertenece al usuario autenticado
        if(Auth::user()->id != $task->user_id)
        {
            return abort(401); // Retorna un error 401 si el usuario no es el dueño de la tarea
        }

        // Eliminar la tarea
        $task->delete();

        // Redirigir al dashboard después de eliminar la tarea
        return redirect()->route('dashboard')->with('success', 'Tarea borrada exitosamente!');
    }
}
