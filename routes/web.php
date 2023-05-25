<?php

use App\Http\Controllers\AccessMenuController;
use App\Http\Controllers\AccessProgramController;
use App\Http\Controllers\AccessSubMenuController;
use App\Http\Controllers\AllRouteUrlController;
use App\Http\Controllers\DataWargaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HubunganWargaController;
use App\Http\Controllers\LayoutAppUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuFooterController;
use App\Http\Controllers\ProfileAppController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubMenuController;
use App\Models\AccessProgram;
use App\Models\DataWarga;
use App\Models\LayoutAppUser;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->middleware(['auth'])->name('home');
Route::get('/setting/app', [HomeController::class, 'setting'])->middleware(['auth'])->name('set');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit/data', [ProfileController::class, 'edit_data'])->name('profile.edit.data');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('menu', MenuController::class);
Route::get('/menus/trash/', [MenuController::class, 'trash'])->middleware(['auth', 'verified'])->name('menu.trash');
Route::post('/menus/kill/{id}', [MenuController::class, 'kill'])->middleware(['auth', 'verified'])->name('menu.kill');
Route::get('/menus/restore/{id}', [MenuController::class, 'restore'])->middleware(['auth', 'verified'])->name('menu.restore');

Route::resource('sub-menu', SubMenuController::class);
Route::get('/sub-menus/trash/', [SubMenuController::class, 'trash'])->middleware(['auth', 'verified'])->name('sub-menu.trash');
Route::post('/sub-menus/kill/{id}', [SubMenuController::class, 'kill'])->middleware(['auth', 'verified'])->name('sub-menu.kill');
Route::get('/sub-menus/restore/{id}', [SubMenuController::class, 'restore'])->middleware(['auth', 'verified'])->name('sub-menu.restore');

Route::resource('program', ProgramController::class);
Route::get('/programs/trash/', [ProgramController::class, 'trash'])->middleware(['auth', 'verified'])->name('program.trash');
Route::post('/programs/kill/{id}', [ProgramController::class, 'kill'])->middleware(['auth', 'verified'])->name('program.kill');
Route::get('/programs/restore/{id}', [ProgramController::class, 'restore'])->middleware(['auth', 'verified'])->name('program.restore');

Route::resource('role', RoleController::class);
Route::get('/roles/trash/', [RoleController::class, 'trash'])->middleware(['auth', 'verified'])->name('role.trash');
Route::post('/roles/kill/{id}', [RoleController::class, 'kill'])->middleware(['auth', 'verified'])->name('role.kill');
Route::get('/roles/restore/{id}', [RoleController::class, 'restore'])->middleware(['auth', 'verified'])->name('role.restore');

Route::resource('route-url', AllRouteUrlController::class);
Route::get('/route-urls/trash/', [AllRouteUrlController::class, 'trash'])->middleware(['auth', 'verified'])->name('route-url.trash');
Route::post('/route-urls/kill/{id}', [AllRouteUrlController::class, 'kill'])->middleware(['auth', 'verified'])->name('route-url.kill');
Route::get('/route-urls/restore/{id}', [AllRouteUrlController::class, 'restore'])->middleware(['auth', 'verified'])->name('route-url.restore');

Route::resource('access-menu', AccessMenuController::class);
Route::resource('access-program', AccessProgramController::class);
Route::resource('access-sub-menu', AccessSubMenuController::class);
Route::resource('menu-footer', MenuFooterController::class);

Route::resource('profile-app', ProfileAppController::class);
Route::get('profile-app/layout/login', [ProfileAppController::class, 'login'])->middleware(['auth', 'verified'])->name('profile-app-login');

Route::resource('/layout-app-user', LayoutAppUserController::class);

Route::resource('data-warga', DataWargaController::class);
Route::get('/data/warga/trash/', [DataWargaController::class, 'trash'])->middleware(['auth', 'verified'])->name('data-warga.trash');
Route::post('/data/warga/kill/{id}', [DataWargaController::class, 'kill'])->middleware(['auth', 'verified'])->name('data-warga.kill');
Route::get('/data/warga/restore/{id}', [DataWargaController::class, 'restore'])->middleware(['auth', 'verified'])->name('data-warga.restore');
Route::resource('data-hubungan-warga', HubunganWargaController::class);

require __DIR__ . '/auth.php';
