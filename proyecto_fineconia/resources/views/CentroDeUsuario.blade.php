<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información del Usuario - Fineconia</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  @vite('resources/css/CentroDeUsuario.css')
</head>
<body> 

<nav class="navbar">
  <div class="logo-container" style="max-width: 200px; width: 100%;">
    <img src="img/LogoCompleto.jpg" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
  </div>
  <div class="user-section header-user">
    <a href="{{ route('fineconia.home') }}" class="nav-link">Home</a>
  </div>
</nav>

<div class="container">
  <div class="user-header">
    <i class="bi bi-person-circle"></i>
    <div>
      <h2>Bienvenido</h2>
      <h1>{{ Auth::user()->name }}</h1>
    </div>
  </div>

  <!-- BOTÓN EDITAR DATOS -->
  <div class="edit-btn-container">
    <a href="{{ route('usuario.editar') }}" class="edit-btn">Editar Datos</a>
  </div>

  <div class="info-card">
    <h3>Información Básica</h3>

    <div class="form-grid">
      <div class="form-group">
        <label>Nombre completo</label>
        <input type="text" value="{{ Auth::user()->name }}" disabled>
      </div>

      <div class="form-group">
        <label>Correo Electrónico</label>
        <input type="text" value="{{ Auth::user()->email }}" disabled>
      </div>

      <div class="form-group">
        <label>Edad</label>
        <input type="text" value="{{ Auth::user()->edad ?? 'No registrada' }}" disabled>
      </div>

      <div class="form-group">
        <label>Miembro familiar</label>
        <input type="text" value="{{ Auth::user()->miembro ?? 'No asignado' }}" disabled>
      </div>

      <div class="form-group">
        <label>Fecha de registro</label>
        <input type="text" value="{{ Auth::user()->created_at->format('d/m/Y') }}" disabled>
      </div>
    </div>
  </div>
</div>

</body>
</html>