Route::post('users/{user}/reset-password',[UserController::class,'resetPassword'])
    ->name('users.reset-password');
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\RoleController;
Route::resource('roles', RoleController::class);

use App\Http\Livewire\Statuses;
use App\Livewire\Practitioners;

Route::get('/statuses', Statuses::class)->name('statuses.index');
Route::get('/practitioners', Practitioners::class)->name('practitioners.index');
