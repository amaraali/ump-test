<?php

namespace App\Livewire;

use App\Models\Todo;
use App\Models\JenisKegiatan;
use Livewire\Component;

class TodoList extends Component
{
    public $title = '';
    public $jenis_kegiatan_id = '';
    public $editingTodoId = null;
    public $editingTitle = '';

    protected $rules = [
        'title' => 'required|min:3',
        'jenis_kegiatan_id' => 'required|exists:jenis_kegiatan,id',
        'editingTitle' => 'required|min:3'
    ];

    protected $messages = [
        'title.required' => 'The todo title is required',
        'title.min' => 'The todo title must be at least 3 characters',
        'jenis_kegiatan_id.required' => 'Please select a type',
    ];

    public function mount()
    {
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::with('jenisKegiatan')->latest()->get(),
            'jenisKegiatans' => JenisKegiatan::all()
        ]);
    }

    public function createTodo()
    {
        $validated = $this->validate([
            'title' => 'required|min:3',
            'jenis_kegiatan_id' => 'required|exists:jenis_kegiatan,id'
        ]);

        Todo::create($validated);

        $this->reset(['title', 'jenis_kegiatan_id']);
        $this->resetValidation();

        $this->dispatch('show-toast', [
            'type' => 'success',
            'title' => 'Success!',
            'message' => 'Todo created successfully!'
        ]);
    }

    public function toggleComplete($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->update([
            'completed' => !$todo->completed
        ]);
        $this->dispatch('show-toast', [
            'type' => 'success',
            'title' => 'Success!',
            'message' => 'Todo status updated successfully!'
        ]);
    }

    public function deleteTodo($todoId)
    {
        Todo::find($todoId)->delete();
        $this->dispatch('show-toast', [
            'type' => 'success',
            'title' => 'Deleted!',
            'message' => 'Todo deleted successfully!'
        ]);
    }

    public function editTodo($todoId)
    {
        $todo = Todo::find($todoId);
        if ($todo) {
            $this->editingTodoId = $todoId;
            $this->editingTitle = $todo->title;
        }
    }

    public function updateTitle()
    {
        $this->validate([
            'editingTitle' => 'required|min:3'
        ]);

        $todo = Todo::find($this->editingTodoId);
        if ($todo) {
            $todo->update([
                'title' => $this->editingTitle
            ]);

            $this->dispatch('show-toast', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Todo title updated successfully!'
            ]);
        }

        $this->editingTodoId = null;
        $this->editingTitle = '';
    }

    public function cancelEdit()
    {
        $this->editingTodoId = null;
        $this->editingTitle = '';
    }
}
