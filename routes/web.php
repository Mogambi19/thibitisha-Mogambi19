use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('users/{user}/reset-password',[UserController::class,'resetPassword'])
        ->name('users.reset-password');
});

use App\Http\Livewire\Statuses;
use App\Livewire\Practitioners;

Route::get('/statuses', Statuses::class)->name('statuses.index');
Route::get('/practitioners', Practitioners::class)->name('practitioners.index');
