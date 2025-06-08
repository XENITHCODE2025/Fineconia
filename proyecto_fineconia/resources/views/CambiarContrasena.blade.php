<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restablecer Contraseña - Fineconia</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Iconos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    @vite('resources/css/CambiarContrasena.css')

</head>

<body>

    <!-- Logo -->
    <div class="logo text-center mt-4">
        <img src="https://i.imgur.com/bFQ2H1g.png" alt="Logo" style="height:60px" />
        <span class="logo-text ms-2 fw-bold">FINEC<i>ONIA</i></span>
    </div>

    <div class="password-wrapper">
        <div class="password-container">

        <!-- Blade: mostrar mensajes de Laravel con Alertify -->
                @if ($errors->any())
                    <script>
                        alertify.set('notifier','position','top-right');
                        @foreach ($errors->all() as $error)
                            alertify.error(@json($error));
                        @endforeach
                    </script>
                @endif
                @if (session('status'))
                    <script>
                        alertify.set('notifier','position','top-right');
                        alertify.success(@json(session('status')));
                    </script>
                @endif
            <!-- Formulario de restablecimiento de contraseña -->
            <div class="password-box">
                <h2>Restablecer contraseña</h2>
                <form id="passwordForm" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">

                    <label for="new-password" class="form-label">Nueva contraseña</label>
                    <input type="password" name="password" id="new-password" class="form-control mb-3" required minlength="8">

                    <label for="confirm-password" class="form-label">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" id="confirm-password" class="form-control mb-4" required minlength="8">

                    <button type="submit" class="btn btn-primary w-100">Guardar Contraseña</button>
                </form>
            </div>
            <!-- Panel informativo derecho -->
            <div class="info-panel"> 
                <h3>¡Listo! Iniciá sesión con tu nueva contraseña.</h3>
                <a href="#" class="btn-login">Iniciar Sesión</a>
            </div>


            </div>

              

        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Validación de contraseñas en cliente -->
    <script>
        document.getElementById('passwordForm').addEventListener('submit', function (e) {
            const newPassword     = document.getElementById('new-password').value.trim();
            const confirmPassword = document.getElementById('confirm-password').value.trim();

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alertify.set('notifier','position','top-right');
                alertify.error('Las contraseñas no coinciden');
            }
        });
    </script>
</body>
</html>
