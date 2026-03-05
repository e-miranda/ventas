<?php

use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard / Perfil
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Catálogo público
|--------------------------------------------------------------------------
*/

Route::get('/', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('/producto/{producto}', [CatalogoController::class, 'show'])->name('catalogo.show');

/*
|--------------------------------------------------------------------------
| Ventas - Público
|--------------------------------------------------------------------------
*/

Route::get('/ventas/crear/{producto}', [VentaController::class, 'crear'])
    ->name('ventas.crear');

Route::post('/ventas', [VentaController::class, 'store'])
    ->name('ventas.store');

Route::get('/venta/estado/{venta}', [VentaController::class, 'estado'])
    ->name('ventas.estado');

/*
|--------------------------------------------------------------------------
| Ventas - Administración
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/ventas', [VentaController::class, 'index'])
        ->name('ventas.index');

    Route::get('/ventas/{venta}', [VentaController::class, 'show'])
        ->name('ventas.show');

    Route::put('/ventas/{venta}/aprobar', [VentaController::class, 'aprobar'])
        ->name('ventas.aprobar');

    Route::put('/ventas/{venta}/rechazar', [VentaController::class, 'rechazar'])
        ->name('ventas.rechazar');

    Route::put('/ventas/{venta}/entregar', [VentaController::class, 'entregar'])
        ->name('ventas.entregar');
});

/*
|--------------------------------------------------------------------------
| Productos - Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('productos', ProductoController::class);
});
