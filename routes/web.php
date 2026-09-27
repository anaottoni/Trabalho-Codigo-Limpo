<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

// Front-end em Blade: uma única página com formulário de criação/edição
// e a listagem de games (com editar e deletar).
Route::prefix('/games')->group(function () {
    Route::get('/', [GameController::class, 'index'])->name('games.index');
    Route::get('/{id}/edit', [GameController::class, 'edit'])->name('games.edit')->whereNumber('id');
    Route::post('/', [GameController::class, 'store'])->name('games.store');
    Route::put('/{id}', [GameController::class, 'update'])->name('games.update')->whereNumber('id');
    Route::delete('/{id}', [GameController::class, 'destroy'])->name('games.destroy')->whereNumber('id');
});

Route::redirect('/', '/games');