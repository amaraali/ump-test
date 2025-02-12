<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Models\JenisKegiatan;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::with('jenisKegiatan')->latest()->get();
        $jenisKegiatans = JenisKegiatan::all();
        return view('todos.index', compact('todos', 'jenisKegiatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'jenis_kegiatan_id' => 'required|exists:jenis_kegiatan,id'
        ]);

        Todo::create([
            'title' => $request->title,
            'jenis_kegiatan_id' => $request->jenis_kegiatan_id
        ]);

        return response()->json([
            'message' => 'Todo created successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Todo $todo)
    {
        $todo->update([
            'completed' => !$todo->completed
        ]);

        return response()->json([
            'message' => 'Todo status updated!'
        ]);
    }

    /**
     * Update the title of the specified resource in storage.
     */
    public function updateTitle(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);

        $todo->update([
            'title' => $request->title
        ]);

        return response()->json([
            'message' => 'Todo title updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json([
            'message' => 'Todo deleted successfully!'
        ]);
    }
}
