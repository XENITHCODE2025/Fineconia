<!DOCTYPE html>
<html lang="es">    
<head>    
  <meta charset="UTF-8" />    
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>    
  <title>Registro - Fineconia</title>

  <!-- Bootstrap 5 -->      
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />    
  @vite('resources/css/login-registro.css')

  <style>
    /* Estilos para los contenedores de los checkboxes */
    .policy-check-container {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-top: 10px;
    }

    .policy-link {
      color: #FFFFFF;
      text-decoration: underline;
      cursor: pointer;
    }

    .policy-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 8px;
    }
  </style>

</head>    

<body>

  <!-- Logo -->
  <div class="logo-container" style="max-width: 200px; width: 100%;">
      <img src="{{ asset('img/LogoConDerecho.jpg') }}" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
  </div>

  <div class="register-wrapper">

    <div class="background-box">

      <!-- Formulario de Registro -->
      <div class="register-box">
        <h3>Regístrate</h3>

        <form method="POST" action="{{ route('register') }}">    
          @csrf    

          <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>    
          <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>    
              
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
      
          <!-- CHECKBOX Términos y condiciones -->
          <div class="policy-row">
              <input type="checkbox" id="termsCheck" class="policy-check">
              <span class="policy-link" onclick="goToTerms()">Términos y condiciones</span>
          </div>

          <!-- CHECKBOX Política y seguridad -->
          <div class="policy-row">
              <input type="checkbox" id="policyCheck" class="policy-check">
              <span class="policy-link" onclick="goToPolicy()">Política y seguridad</span>
          </div>

          <!-- Botón Crear deshabilitado por defecto -->
          <button type="submit" class="btn btn-crear mt-3" id="btnCrear" disabled>CREAR</button>

        </form>
      </div>

      <!-- Caja derecha -->
      <div class="login-box">
        <h5>¿Ya tienes una cuenta?</h5>    
        <p>Si ya tienes una cuenta solo lógrate aquí</p>    
        <button class="btn btn-login" id="btn-login">Iniciar Sección</button>    
      </div>

    </div>

  </div>

  <!-- Bootstrap JS -->      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>      

  <script>
    // Redirección al login
    document.getElementById("btn-login").addEventListener("click", function() {    
      window.location.href = "{{ route('login') }}";    
    });

    // Redirección a Términos y Condiciones
    function goToTerms() {
      window.location.href = "{{ route('politica.privacidad') }}";
    }

    // Redirección a Política y Seguridad
    function goToPolicy() {
      window.location.href = "{{ route('politica.seguridad') }}";
    }

    // Habilitar / deshabilitar botón CREAR solo si ambos checkboxes están seleccionados
    const termsCheck = document.getElementById("termsCheck");
    const policyCheck = document.getElementById("policyCheck");
    const btnCrear = document.getElementById("btnCrear");

    function toggleBtnCrear() {
      btnCrear.disabled = !(termsCheck.checked && policyCheck.checked);
    }

    termsCheck.addEventListener("change", toggleBtnCrear);
    policyCheck.addEventListener("change", toggleBtnCrear);
  </script>

</body>    
</html>