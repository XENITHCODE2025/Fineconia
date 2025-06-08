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
use App\Models\Gasto;
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

    // Mostrar todos los ingresos y gastos 
    Route::get('/gastos-ingresos', function () {
        $gastos = Gasto::select('id_Gasto','fecha', 'descripcion', 'categoria', 'monto')
            ->get()->map(function ($item) {
                $item->tipo = 'Gasto';
                return $item;
            });

        $ingresos = Ingreso::select('id_Ingreso','fecha', 'descripcion', 'categoria', 'monto')
            ->get()->map(function ($item) {
                $item->tipo = 'Ingreso';
                return $item;
            });

        $transacciones = $gastos->concat($ingresos)->sortByDesc('fecha')->values();

        return view('welcome', compact('transacciones'));
    })->name('gastos-ingresos');

     // CRUD Gastos
    Route::get('/gastos/crear', fn() => view('gastos'))->name('gastos.create');
    Route::post('/gastos', [GastoController::class, 'store'])->name('gastos.store');
    Route::delete('/gastos/{id_Gasto}', [GastoController::class, 'destroy'])->name('gastos.destroy');
    Route::put('/gastos/{id}', [GastoController::class, 'update']);
    
    // CRUD Ingresos
    Route::get('/ingresos/crear', fn() => view('ingresos'))->name('ingresos.create');
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
