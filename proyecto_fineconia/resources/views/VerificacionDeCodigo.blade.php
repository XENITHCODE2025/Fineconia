

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Verificación - Fineconia</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Iconos Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  @vite('resources/css/veriCodigo.css')
  
</head>
<body>

  <!-- Logo -->
  <div class="logo">
    <img src="https://i.imgur.com/bFQ2H1g.png" alt="Logo" />
    <span class="logo-text">FINEC<i>ONIA</i></span>
  </div>

  <div class="register-wrapper">
    <div class="background-box">

      <!-- Formulario de Verificación (izquierda) -->
      <div class="register-box">
        <div class="icon">
          <i class="bi bi-shield-check"></i>
        </div>
        <h3>Verificación de código</h3>
        <p>Por favor ingrese el código de verificación que te enviamos a tu correo</p>
        <form method="POST" action="{{ route('codigo.verificado.post') }}">
        @csrf
       <label for="codigo">Código</label>
       <input type="text" name="codigo" id="codigo" class="form-control" required>
       <button type="submit" class="btn-verificar">Verificar</button>
       </form>
      </div>

      <!-- Panel derecho con dos estados -->
      <div class="right-panel">
        <!-- Estado inicial: Recuperación de contraseña -->
        <div class="password-recovery" id="passwordRecovery">
          <div class="icon-lock">
            <i class="bi bi-shield-lock"></i>
          </div>
          <h4>Soporte de fineconia</h4> 
          <a href="#"></a>
        </div>

        <!-- Estado después de verificación -->
        <div class="verified-message" id="verifiedMessage">
          <div class="icon-check">
            <i class="bi bi-check-circle-fill"></i>
          </div>
          <p>Se esta recuperando la contraseña</p>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Script para manejar la verificación -->
</body>
</html>