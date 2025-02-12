@extends('layouts.app')

@section('content')
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Todo List (jQuery Version)</h1>
        </div>
        <div class="card-body">
            <form id="todoForm" class="mb-4">
                <div class="input-group mb-3">
                    <input type="text" id="todoTitle" class="form-control" placeholder="Enter your todo" required>
                    <select class="form-select" id="jenisKegiatanId" required>
                        <option value="">Select Type</option>
                        @foreach ($jenisKegiatans as $jenisKegiatan)
                            <option value="{{ $jenisKegiatan->id }}">{{ $jenisKegiatan->nama_jenis_kegiatan }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">Add Todo</button>
                </div>
            </form>

            <ul class="list-group" id="todoList">
                @foreach ($todos as $todo)
                    <li class="list-group-item todo-item d-flex justify-content-between align-items-center {{ $todo->completed ? 'completed' : '' }}"
                        data-id="{{ $todo->id }}">
                        <div class="d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input toggle-todo" type="checkbox"
                                    {{ $todo->completed ? 'checked' : '' }}>
                                <label class="form-check-label todo-title">{{ $todo->title }}</label>
                                <input type="text" class="form-control edit-input d-none" value="{{ $todo->title }}">
                            </div>
                            <span class="badge bg-info ms-2">{{ $todo->jenisKegiatan->nama_jenis_kegiatan }}</span>
                        </div>
                        <div>
                            <button class="btn btn-warning btn-sm edit-todo">Edit</button>
                            <button class="btn btn-success btn-sm save-todo d-none">Save</button>
                            <button class="btn btn-danger btn-sm delete-todo">Delete</button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#todoForm').on('submit', function(e) {
            e.preventDefault();
            let title = $('#todoTitle').val();
            let jenisKegiatanId = $('#jenisKegiatanId').val();
            let form = $(this);
            form.find('button').prop('disabled', true);

            $.post('/todos', {
                    title: title,
                    jenis_kegiatan_id: jenisKegiatanId
                })
                .done(function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        willClose: () => {
                            location.reload();
                        }
                    });
                    $('#todoTitle').val('');
                })
                .fail(function(response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong!',
                        icon: 'error',
                        timer: 2000
                    });
                })
                .always(function() {
                    form.find('button').prop('disabled', false);
                });
        });

        $('.toggle-todo').on('change', function() {
            let todoId = $(this).closest('.todo-item').data('id');
            let checkbox = $(this);
            checkbox.prop('disabled', true);

            $.ajax({
                url: `/todos/${todoId}`,
                type: 'PATCH',
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        willClose: () => {
                            location.reload();
                        }
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update todo status',
                        icon: 'error',
                        timer: 2000
                    });
                }
            }).always(function() {
                checkbox.prop('disabled', false);
            });
        });

        $('.delete-todo').on('click', function() {
            let todoItem = $(this).closest('.todo-item');
            let todoId = todoItem.data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/todos/${todoId}`,
                        type: 'DELETE',
                        success: function(response) {
                            todoItem.remove();
                            Swal.fire('Deleted!', response.message, 'success');
                        }
                    });
                }
            });
        });

        $('.edit-todo').on('click', function() {
            let todoItem = $(this).closest('.todo-item');
            todoItem.find('.todo-title').addClass('d-none');
            todoItem.find('.edit-input').removeClass('d-none');
            $(this).addClass('d-none');
            todoItem.find('.save-todo').removeClass('d-none');
        });

        $('.save-todo').on('click', function() {
            let todoItem = $(this).closest('.todo-item');
            let todoId = todoItem.data('id');
            let newTitle = todoItem.find('.edit-input').val();
            let saveButton = $(this);

            if (!newTitle.trim()) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Title cannot be empty',
                    icon: 'error',
                    timer: 2000
                });
                return;
            }

            $.ajax({
                url: `/todos/${todoId}/update-title`,
                type: 'PATCH',
                data: {
                    title: newTitle
                },
                success: function(response) {
                    todoItem.find('.todo-title').text(newTitle).removeClass('d-none');
                    todoItem.find('.edit-input').addClass('d-none');
                    saveButton.addClass('d-none');
                    todoItem.find('.edit-todo').removeClass('d-none');

                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    let message = xhr.responseJSON?.message || 'Failed to update todo title';
                    Swal.fire({
                        title: 'Error!',
                        text: message,
                        icon: 'error',
                        timer: 2000
                    });
                }
            });
        });
    </script>
@endpush
