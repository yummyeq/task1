<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

=======
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
>>>>>>> fbbc4ac (init)

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD
Route::resource('tasks', TaskController::class);

=======

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/file', [FileManagerController::class, 'index'])->name('file-manager.index');
    Route::post('/file/upload', [FileManagerController::class, 'upload'])->name('file-manager.upload');
    Route::delete('/file/delete/{id}', [FileManagerController::class, 'delete'])->name('file-manager.delete');
    Route::post('/file/create-folder', [FileManagerController::class, 'createFolder'])->name('file-manager.create-folder');
    Route::delete('/file/delete-folder/{id}', [FileManagerController::class, 'deleteFolder'])->name('file-manager.delete-folder');
    Route::get('/file/download/{id}', [FileManagerController::class, 'download'])->name('file-manager.download');
    Route::post('/file/move/{id}', [FileManagerController::class, 'moveFile'])->name('file-manager.move');
>>>>>>> fbbc4ac (init)
