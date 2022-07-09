<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function index()
    {
        $todos = Todo::get();
        return response()->json([
            'status' => 'success',
            'todos' => $todos,
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Todo created successfully',
            'todo' => $todo,
        ], Response::HTTP_CREATED);
    }

    public function show(Todo $todo)
    {
        // $todo = Todo::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'todo' => $todo,
        ],  Response::HTTP_OK);
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // $todo = Todo::findOrFail($id);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Todo updated successfully',
            'todo' => $todo,
        ]);
    }

    public function destroy(Todo $todo)
    {
        // $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Todo deleted successfully',
            'todo' => $todo,
        ]);
    }
}
