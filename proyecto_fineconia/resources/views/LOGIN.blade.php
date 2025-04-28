<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Fineconia</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- AlertifyJS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" rel="stylesheet"/>

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
        <a href="{{ route('register') }}" class="btn-register">REGÍSTRATE</a>
      </div>

      <!-- Caja de Login que sobresale -->
      <div class="login-box">
        <h3>Iniciar Sesión</h3>

       

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <label for="email" class="form-label">Correo electrónico</label>
          <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
          >
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          
          <label for="password" class="form-label mt-3">Contraseña</label>
          <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            id="password"
            name="password"
            required
          >
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          
          <div class="forgot-password mt-2">
            <a href="{{ route('recuperar.contrasena') }}">¿Olvidaste tu contraseña?</a>
          </div>

          
          <button type="submit" class="btn-login mt-3">INICIAR</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
  // Mostrar alertas personalizadas con AlertifyJS
  @if(session('success'))
    alertify.success("{{ session('success') }}");
  @endif

  @if($errors->any())
    let errors = @json($errors->all());
    errors.forEach(error => {
      alertify.error(error);
    });
  @endif
</script>


</body>
</html>
