<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información Básica - Fineconia</title>

  <!-- Íconos de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
  <!-- Estilos externos -->
  @vite('resources/css/CentroDeUsuario.css')
</head>
<body>

  <!-- Barra de navegación -->
<nav class="navbar">
  <div class="logo-container" style="max-width: 200px; width: 100%;">
    <img src="img/LogoCompleto.jpg" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
  </div>
  <div class="user-section header-user">
    <a href="{{ route('fineconia.home') }}" class="nav-link">Home</a>
  </div>
</nav>

<!-- Contenedor principal -->
<div class="container">
  <!-- Encabezado de usuario -->
  <div class="user-header">
    <i class="bi bi-person-circle"></i>
    <div>
      <h2>Bienvenido</h2>
      <h1>{{ Auth::user()->name }}</h1>
    </div>
  </div>

  <!-- Tarjeta de información -->
  <div class="info-card">
    <h3>Información Básica</h3>

    <div class="form-grid">
      <div class="form-group">
        <label>Nombre</label>
        <input type="text" value="{{ Auth::user()->nombre ?? 'No disponible' }}" disabled>
      </div>

      <div class="form-group">
        <label>Apellido</label> 
        <input type="text" value="{{ Auth::user()->apellido ?? 'No disponible' }}" disabled>
      </div>

      <div class="form-group">
        <label>Miembro Familiar</label>
        <input type="text" value="{{ Auth::user()->miembro_familiar ?? 'No asignado' }}" disabled>
      </div>

      <div class="form-group">
        <label>Correo Electrónico</label>
        <input type="text" value="{{ Auth::user()->email }}" disabled>
      </div>
    </div>
  </div>
</div>
</body>
</html>
