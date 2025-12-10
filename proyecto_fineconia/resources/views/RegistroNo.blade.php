<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro - Fineconia</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      background-color: #ffffff;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    /* ====== LOGO ====== */
  .logo-container {
      display: flex;
      align-items: center;
      margin-top: 20px;
      margin-bottom: 20px;
      max-width: 200px;
      width: 100%;
      margin-left: 50px; /* Mueve el logo hacia la izquierda */
    }

    .logo-container img {
      height: 100px;
      width: 100%;
      object-fit: contain;
    }

    /* ====== CONTENEDOR PRINCIPAL ====== */
    .register-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 75vh;
    }

    .background-box {
      background-color: #2C4E53;
      width: 65%;
      height: 380px;
      border-radius: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      padding: 0 30px;
    }

    /* ====== FORMULARIO DE REGISTRO ====== */
    .register-box {
      background-color: #92BDC5;
      width: 340px;
      padding: 1.8rem;
      border-radius: 20px;
      position: absolute;
      left: 60%;
      top: 50%;
      transform: translateY(-50%);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    .register-box h3 {
      color: white;
      text-align: center;
      margin-bottom: 1rem;
      font-weight: 600;
    }

    .register-box .form-control,
    .register-box .form-select {
      border-radius: 10px;
      margin-bottom: 0.6rem;
      padding: 8px;
      font-size: 0.9rem;
      border: none;
    }

    .register-box small {
      color: #f8f9fa;
      margin-top: -6px;
      margin-bottom: 0.6rem;
      display: block;
      font-size: 0.75rem;
    }

    .btn-crear {
      background-color: #2C4E53;
      color: white;
      border-radius: 10px;
      font-weight: bold;
      padding: 10px;
      font-size: 0.9rem;
      width: 100%;
      border: none;
      transition: 0.3s;
    }

    .btn-crear:hover {
      background-color: #1f363a;
    }

    /* ====== SECCIÓN LOGIN ====== */
    .login-box {
      color: white;
      text-align: center;
      width: 250px;
      position: absolute;
      right: 55%;
      top: 50%;
      transform: translateY(-50%);
    }

    .login-box h5 {
      font-size: 1rem;
      margin-bottom: 0.6rem;
    }

    .login-box p {
      font-size: 0.85rem;
      margin-bottom: 1rem;
    }

    .btn-login {
      background-color: white;
      color: #2C4E53;
      border-radius: 10px;
      font-weight: bold;
      padding: 10px 25px;
      font-size: 0.9rem;
      border: none;
      transition: 0.3s;
    }

    .btn-login:hover {
      background-color: #d9d9d9;
    }

    /* ====== RESPONSIVE ====== */
    @media (max-width: 900px) {
      .background-box {
        flex-direction: column;
        height: auto;
        padding: 2rem 1rem;
      }

      .register-box, .login-box {
        position: static;
        transform: none;
        width: 90%;
        margin: 1rem auto;
      }
    }
  </style>
</head>
<body>

  <!-- Logo centrado arriba -->
  <div class="logo-container">
    <img src="img/LogoConDerecho.jpg" alt="Fineconia Logo">
  </div>

  <div class="register-wrapper">
    <div class="background-box">

      <!-- Sección "¿Ya tienes cuenta?" -->
      <div class="login-box">
        <h5>¿Ya tienes una cuenta?</h5>
        <p>Si ya tienes una cuenta solo logéate aquí</p>
        <button class="btn btn-login" id="btn-login">Iniciar Sesión</button>
      </div>

      <!-- Formulario de Registro -->
      <div class="register-box">
        <h3>Regístrate</h3>
        <form method="POST" action="#">
          <div class="row g-2">
            <div class="col">
              <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="col">
              <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
            </div>
          </div>

          <select name="miembro" class="form-select" required>
            <option value="" disabled selected>Miembro Familiar:</option>
            <option value="padre">Padre</option>
            <option value="madre">Madre</option>
            <option value="hijo">Hijo</option>
          </select>

          <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required>
          <small>Recibirás un código para verificar tu cuenta</small>

          <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
          <small>Mínimo 8 caracteres, incluye números y símbolos</small>

          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>

          <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" required>
            <label class="form-check-label">Términos y Condiciones</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" required>
            <label class="form-check-label">Política y Privacidad</label>
          </div>

          <button type="submit" class="btn btn-crear mt-3">CREAR</button>
        </form>
      </div>

    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById("btn-login").addEventListener("click", function() {
      // Redirige a la página de inicio de sesión
      window.location.href = "login.html";
    });
  </script>

</body>
</html>