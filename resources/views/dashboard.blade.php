<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: blue;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn.delete {
            background-color: red;
        }
        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .task:last-child {
            border-bottom: none;
        }
        .success {
            padding: 10px;
            background-color: green;
            color: white;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h2, h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif
        <h2>Hola, {{ $user->name }}</h2>
        <!-- Formulario para agregar nueva tarea -->
        <h2>Agregar nueva tarea</h2>
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-6">
            @csrf
            <div class="form-group">
                <label for="title">Título de la tarea</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="form-group">
                <label for="description">Descripción de la tarea</label>
                <textarea name="description" id="description"></textarea>
            </div>

            <button type="submit" class="btn">Agregar tarea</button>
        </form>

        <!-- Lista de tareas -->
        <br><h3>Tus Tareas</h3>

        @if ($tasks->isEmpty())
            <p>No tienes tareas disponibles. ¡Agrega una tarea arriba!</p>
        @else
            <ul>
                @foreach ($tasks as $task)
                    <li class="task">
                        <div>
                            <strong>{{ $task->title }}</strong>
                            <p>{{ $task->description }}</p>
                        </div>
                        <!-- Botón para eliminar tarea -->
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</body>
</html>
