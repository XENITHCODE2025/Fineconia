<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Fineconia</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  @vite('resources/css/login-registro.css')
</head>
<body>

  <!-- Logo -->
  <div class="logo">FINEC®NIA</div>

  <div class="login-wrapper">
    <div class="background-box">
      
      <!-- Caja de Registro -->
      <div class="register-box">
        <h4>¿Aun no tienes cuenta?</h4>
        <p>Regístrate para que puedas iniciar sesión</p>
        <button class="btn-register">REGISTRATE</button>
      </div>

      <!-- Caja de Login que sobresale -->
      <div class="login-box">
        <h3>Iniciar Sesión</h3>
        <form>
          <label for="email" class="form-label">Correo electrónico</label>
          <input type="email" class="form-control" id="email" required>
          
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" required>
          
          <div class="forgot-password">
            <a href="#">¿Olvidaste tu contraseña?</a>
          </div>
          
          <button type="submit" class="btn-login">INICIAR</button>
        </form>
      </div>
    </div>
  </div>1

  <!-- Bootstrap JS (opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>