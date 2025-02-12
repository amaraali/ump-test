<?php

use App\Http\Controllers\AlgoritmaController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::get('/', function () {
    return redirect()->route('identitas');
});

Route::get('/identitas', function () {
    return view('identitas');
})->name('identitas');

Route::get('/algoritma', [AlgoritmaController::class, 'algoritma'])->name('algoritma');
Route::get('/enkripsi', [AlgoritmaController::class, 'enkripsi'])->name('enkripsi');
Route::post('/enkripsi-dekripsi', [AlgoritmaController::class, 'enkripsiDekripsi'])->name('enkripsi-dekripsi');

Route::get('/todos/jquery', [TodoController::class, 'index'])->name('todos.jquery');
Route::get('/todos/livewire', function () {
    return view('todos.livewire');
})->name('todos.livewire');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::patch('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
Route::patch('/todos/{todo}/update-title', [TodoController::class, 'updateTitle'])->name('todos.update-title');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
