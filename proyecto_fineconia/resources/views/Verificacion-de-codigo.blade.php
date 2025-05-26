<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verificación - Fineconia</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Iconos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    @vite('resources/css/veriCodigo.css')

</head>

<body>

    <!-- Logo -->
    <img src="img/LogoConDerecho.jpg" alt="Logo" style="height: 100px;">

    <div class="register-wrapper">
        <div class="background-box">

            <!-- Formulario de Verificación (izquierda) -->
            <div class="register-box">
                <div class="icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3>Verificación de código</h3>
                <p>Por favor ingrese el código de verificación que te enviamos a tu correo</p>
                <form id="verificationForm" action="{{ route('registro.verificar.codigo') }}" method="POST">
                    @csrf
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" required>
                    <button type="submit" class="btn-verificar">Verificar</button>
                </form>
            </div>

           

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

     
</body>

</html