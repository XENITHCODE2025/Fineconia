<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationCodeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GastoController;  // Importar el controlador
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\TransaccionesController;
use App\Models\Gasto;
use App\Models\Ingreso;




// Página principal muestra el registro
Route::get('/', function () {
    return view('Home'); // Asumiendo que tienes esta vista en resources/views
});

// Registro de usuario
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



Route::get('/login', function () {
    return view('LOGIN'); // Asegurate de que el archivo se llame LOGIN.blade.php y esté en la carpeta resources/views
})->name('login');
Route::post('login', [LoginController::class, 'login']);

// Enlace a la vista de verificación de código
Route::get('/verificacion-de-codigo', [VerificationCodeController::class, 'show'])->name('verificacion.codigo');
Route::post('/verificar-codigo', [VerificationCodeController::class, 'verificar'])->name('verificar.codigo');

// Ruta para la vista de Bienvenida
Route::get('/bienvenida', function () {
    return view('Bienvenida');
})->name('bienvenida');

/* Ruta para la vista de Recuperar Contrasena
Route::get('/recuperar-contrasena', function () {
    return view('RecuperarContrasena');
})->name('recuperar.contrasena');*/




// Ruta para la vista de Finanzas Personales
Route::get('/finanzas-personales', function () {
    return view('Finanzas_personales');
})->name('finanzas.personales');

// Enlace a la vista de Finanzas Personales
/*Route::get('/gastos-ingresos', function () {
    return view('welcome'); 
})->name('gastos-ingresos');*/

Route::get('/ahorro', function () {
    return view('Ahorro'); 
})->name('ahorro');

Route::get('/presupuesto', function () {
    return view('Presupuesto'); 
})->name('presupuesto');

// Ruta para recuperar la contraseña
// Recuperación de contraseña
Route::get('/recuperar-contrasena', [VerificationCodeController::class, 'showRecoveryForm'])->name('password.request');
Route::post('/recuperar-contrasena', [VerificationCodeController::class, 'sendRecoveryCode'])->name('password.email');
// Ruta para mostrar el formulario de "Olvidé mi contraseña"


// Ruta para procesar el envío del código (POST)
Route::post('/recuperar-contrasena', [VerificationCodeController::class, 'sendRecoveryCode'])
    ->name('password.email');

// Verificación de código
Route::get('/verificar-codigo', [VerificationCodeController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/verificar-codigo', [VerificationCodeController::class, 'verifyCode'])->name('password.verify.submit');

// Cambio de contraseña
Route::get('/cambiar-contrasena', [VerificationCodeController::class, 'showResetForm'])->name('password.reset');
Route::post('/cambiar-contrasena', [VerificationCodeController::class, 'updatePassword'])->name('password.update');


//gastos e ingresos

Route::get('/gastos-ingresos', function () {
    $gastos = Gasto::select('id_Gasto','fecha', 'descripcion', 'categoria', 'monto')
        ->get()
        ->map(function ($item) {
            $item->tipo = 'Gasto';
            return $item;
        });

    $ingresos = Ingreso::select('id_Ingreso','fecha', 'descripcion', 'categoria', 'monto')
        ->get()
        ->map(function ($item) {
            $item->tipo = 'Ingreso';
            return $item;
        });

    $transacciones = $gastos->concat($ingresos)->sortByDesc('fecha')->values();

    return view('welcome', compact('transacciones'));
})->name('gastos-ingresos'); // ← agrega esto

// Rutas para el CRUD de Gastos

Route::get('/gastos/crear', function () {
    return view('gastos');
})->name('gastos.create');

Route::post('/gastos', [GastoController::class, 'store'])->name('gastos.store');

// Rutas para el CRUD de Ingresos

Route::get('/ingresos/crear', function () {
    return view('ingresos');
})->name('ingresos.create');

Route::post('/ingresos', [IngresoController::class, 'store'])->name('ingresos.store');

// Rutas para eliminar gastos e ingresos

Route::delete('/gastos/{id_Gasto}', [GastoController::class, 'destroy'])->name('gastos.destroy');
Route::delete('/ingresos/{id_Ingreso}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');

