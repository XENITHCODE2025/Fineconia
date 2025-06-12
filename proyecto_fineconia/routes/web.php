<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationCodeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\IngresoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ObjetivoAhorroController;
use App\Http\Controllers\TransaccionesController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\PresupuestoController;
use App\Models\Gasto;
use App\Models\Presupuesto;
use App\Models\Ingreso;

// Página principal
Route::get('/', function () {
    return view('Home');
});

// Registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', function () {
    return view('LOGIN');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/bienvenida', fn() => view('Bienvenida'))->name('bienvenida');
    Route::get('/finanzas-personales', fn() => view('Finanzas_personales'))->name('finanzas.personales');
    Route::get('/ahorro', fn() => view('Ahorro'))->name('ahorro');
    Route::get('/presupuesto', fn() => view('Presupuesto'))->name('presupuesto');
    Route::get('/reportes', [ReporteController::class, 'index'])
        ->name('reportes');
    Route::get('/graficas',                 [GraficasController::class, 'index'])->name('graficas');
    Route::get('/graficas/gastos-data',     [GraficasController::class, 'gastosAgrupados'])->name('graficas.gastos.data');
    Route::get('/graficas/ingresos-data',   [GraficasController::class, 'ingresosAgrupados'])->name('graficas.ingresos.data');
    Route::get(
        '/graficas/ingresos-gastos',
        [GraficasController::class, 'ingresosYGastosPorMes']
    )->name('graficas.ingresos-gastos');

    Route::get('Crear_Presupuesto', [PresupuestoController::class, 'create'])
        ->name('presupuestos.create');

    Route::post('/presupuestos', [PresupuestoController::class, 'store'])
        ->name('presupuestos.store');


    // Mostrar todos los ingresos y gastos 
    // Mostrar solo los ingresos


Route::get('/gastos-ingresos', function () {

    $userId = auth()->id();

    /* ───── INGRESOS ───── */
    $ingresos = Ingreso::with('categoriaIngreso')
        ->where('user_id', $userId)
        ->get()
        ->map(function ($ing) {
            return (object) [
                'id'         => $ing->id_Ingreso,                     // ID único normalizado
                'fecha'      => $ing->fecha,
                'descripcion'=> $ing->descripcion,
                'categoria'  => optional($ing->categoriaIngreso)->nombre ?: 'Sin categoría',
                'monto'      => $ing->monto,
                'tipo'       => 'Ingreso',
            ];
        });

    /* ───── GASTOS ───── */
    $gastos = Gasto::with('categoriaGasto')
        ->where('user_id', $userId)
        ->get()
        ->map(function ($g) {
            return (object) [
                'id'         => $g->id_Gasto,                         // ID único normalizado
                'fecha'      => $g->fecha,
                'descripcion'=> $g->descripcion,
                'categoria'  => optional($g->categoriaGasto)->nombre ?: 'Sin categoría',
                'monto'      => $g->monto,
                'tipo'       => 'Gasto',
            ];
        });

    /* ───── SALDO ───── */
    $totalIngresos     = Ingreso::where('user_id', $userId)->sum('monto');
    $totalPresupuestos = Presupuesto::where('user_id', $userId)->sum('monto');
    $saldoDisponible   = $totalIngresos - $totalPresupuestos;

    /* ───── LISTA FINAL ───── */
    $transacciones = $gastos->merge($ingresos)
                            ->sortByDesc('fecha')
                            ->values();

    return view('welcome', compact('transacciones', 'saldoDisponible'));
})->name('gastos-ingresos');




    

    // CRUD Gastos
    Route::prefix('gastos')->middleware(['auth'])->group(function () {
    Route::get   ('/crear',  [GastoController::class, 'create'])->name('gastos.create');
    Route::post  ('/gastos',      [GastoController::class, 'store'])->name('gastos.store');
    Route::put   ('/{gasto}',[GastoController::class, 'update'])->name('gastos.update');
    Route::delete('/{gasto}',[GastoController::class, 'destroy'])->name('gastos.destroy');
});

    // CRUD Ingresos
    Route::get('/ingresos/crear', [IngresoController::class, 'create'])->name('ingresos.create');
    Route::post('/ingresos', [IngresoController::class, 'store'])->name('ingresos.store');
    Route::delete('/ingresos/{id_Ingreso}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');
    Route::put('/ingresos/{id}', [IngresoController::class, 'update']);



    Route::get('/transacciones', [TransaccionesController::class, 'lista'])
        ->name('transacciones.lista');
});


Route::get('/verificacion-de-codigo', [VerificationCodeController::class, 'show'])->name('verificacion.codigo');
Route::post('/verificar-codigo-registro', [VerificationCodeController::class, 'verificar'])->name('registro.verificar.codigo');

Route::middleware(['auth'])->group(function () {
    Route::post('/objetivos', [ObjetivoAhorroController::class, 'store'])->name('objetivos.store');
});




Route::get('/prueba-auth', function () {
    return Auth::check() ? 'Usuario autenticado' : 'No autenticado';
});



// Recuperación de contraseña
Route::get('/recuperar-contrasena', [VerificationCodeController::class, 'showRecoveryForm'])->name('password.request');
Route::post('/recuperar-contrasena', [VerificationCodeController::class, 'sendRecoveryCode'])->name('password.email');

Route::get('/verificar-codigo', [VerificationCodeController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/verificar-codigo', [VerificationCodeController::class, 'verifyCode'])->name('password.verify.submit');

Route::get('/cambiar-contrasena', [VerificationCodeController::class, 'showResetForm'])->name('password.reset');
Route::post('/cambiar-contrasena', [VerificationCodeController::class, 'updatePassword'])->name('password.update');
