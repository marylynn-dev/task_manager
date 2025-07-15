<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\TaskController as UserTaskController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dynamic Redirect After Login/Register
|--------------------------------------------------------------------------
| This handles redirect after login/registration based on user role.
*/

Route::get('/redirect-after-login', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.users.index');
    }

    return redirect()->route('tasks.index');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authenticated User Profile Routes
|--------------------------------------------------------------------------
| These allow users to edit/update/delete their profile.
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Only accessible by users with `admin` role.
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);            // Admin manages users
    Route::resource('tasks', AdminTaskController::class);       // Admin assigns tasks
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});



/*
|--------------------------------------------------------------------------
| Regular User Task Routes
|--------------------------------------------------------------------------
| These routes are for normal users to manage their tasks.
*/

Route::middleware(['auth'])->prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', [UserTaskController::class, 'index'])->name('index');    // View tasks
    Route::put('/{task}', [UserTaskController::class, 'update'])->name('update'); // Update task status
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Provided by Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
