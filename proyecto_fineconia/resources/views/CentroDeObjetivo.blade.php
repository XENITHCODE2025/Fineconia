<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información Básica - Fineconia</title>

  <!-- Íconos de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
  <!-- Estilos externos -->
  @vite('resources/css/CentroDeObjetivo.css')
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
      <div class="info-header">
        <h3>Información Básica</h3>

        <!-- Saldo -->
        <div class="saldo-container">
          <label>Saldo</label>
          <input type="text" value="$200" disabled>
        </div>
      </div>

      <!-- Subtítulo -->
      <p class="subtitulo">
        <strong>Objetivos Completados</strong> | Total: 3
      </p>

      <!-- Tabla -->
      <table class="objetivos-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Nombre de Objetivo</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>05/06/2025</td>
            <td>Alimentación</td>
            <td>Terminado</td>
          </tr>
          <tr>
            <td>05/06/2025</td>
            <td>Alimentación</td>
            <td>Terminado</td>
          </tr>
          <tr>
            <td>05/06/2025</td>
            <td>Alimentación</td>
            <td>Terminado</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>