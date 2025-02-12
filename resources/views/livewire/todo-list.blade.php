<div>
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Todo List (Livewire Version)</h1>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createTodo" class="mb-4">
                <div class="input-group mb-3">
                    <input type="text" wire:model.live="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Enter your todo">
                    <select class="form-select @error('jenis_kegiatan_id') is-invalid @enderror"
                        wire:model.live="jenis_kegiatan_id">
                        <option value="">Select Type</option>
                        @foreach ($jenisKegiatans as $jenisKegiatan)
                            <option value="{{ $jenisKegiatan->id }}">{{ $jenisKegiatan->nama_jenis_kegiatan }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">Add Todo</button>
                </div>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('jenis_kegiatan_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </form>

            <ul class="list-group" wire:loading.class="opacity-50">
                @foreach ($todos as $todo)
                    <li
                        class="list-group-item todo-item d-flex justify-content-between align-items-center {{ $todo->completed ? 'completed' : '' }}">
                        <div class="d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    wire:click="toggleComplete({{ $todo->id }})"
                                    {{ $todo->completed ? 'checked' : '' }}>
                                @if ($editingTodoId === $todo->id)
                                    <input type="text" class="form-control" wire:model="editingTitle"
                                        wire:keydown.enter="updateTitle" wire:keydown.escape="cancelEdit" autofocus>
                                    @error('editingTitle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                @else
                                    <label class="form-check-label">{{ $todo->title }}</label>
                                @endif
                            </div>
                            <span class="badge bg-info ms-2">{{ $todo->jenisKegiatan->nama_jenis_kegiatan }}</span>
                        </div>
                        <div>
                            @if ($editingTodoId === $todo->id)
                                <button class="btn btn-success btn-sm" wire:click="updateTitle">Save</button>
                                <button class="btn btn-secondary btn-sm" wire:click="cancelEdit">Cancel</button>
                            @else
                                <button class="btn btn-warning btn-sm"
                                    wire:click="editTodo({{ $todo->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="deleteTodo({{ $todo->id }})"
                                    wire:confirm="Are you sure you want to delete this todo?">Delete</button>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-toast', (event) => {
                const data = event[0];
                Swal.fire({
                    title: data.title,
                    text: data.message,
                    icon: data.type,
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            });
        });
    </script>
</div>
