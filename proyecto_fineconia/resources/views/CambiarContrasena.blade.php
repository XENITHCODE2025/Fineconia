Cambio de contraseña - Elena

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
    <div class="logo">
        <img src="https://i.imgur.com/bFQ2H1g.png" alt="Logo" />
        <span class="logo-text">FINEC<i>ONIA</i></span>
    </div>

    <div class="password-wrapper">
        <div class="password-container">

            <!-- Formulario de restablecimiento de contraseña -->
            <div class="password-box">
                <h2>Restablecer contraseña</h2>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    <label>Nueva contraseña</label>
                    <input type="password" name="password" required>
                    <label>Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" required>
                    <button type="submit">Actualizar</button>
                </form>

            </div>

            <!-- Panel informativo derecho -->
            <div class="info-panel">
                <h3>¡Listo! Iniciá sesión con tu nueva contraseña.</h3>
                <a href="#" class="btn-login">Iniciar Sesión</a>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para validación de contraseñas -->
    <script>
    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const newPassword = document.getElementById('new-password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (newPassword !== confirmPassword) {
            alert('Las contraseñas no coinciden');
            return;
        }

        // Aquí iría la lógica para enviar la nueva contraseña al servidor
        alert('Contraseña actualizada correctamente');
    });
    </script>
</body>

</html>