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

    @php
      // Filtrar solo los objetivos terminados
      $objetivosTerminados = $objetivos->filter(function($o){
          return $o->monto_ahorrado >= $o->monto;
      });
    @endphp

    <!-- Tarjeta de información -->
    <div class="info-card">
      <div class="info-header">
        <h3>Información Básica</h3>

        <!-- Saldo dinámico -->
        <div class="saldo-container">
          <label>Saldo</label>
          <input type="text" value="${{ number_format($saldoDisponible) }}" disabled>
        </div>
      </div>

      <!-- Subtítulo con conteo de objetivos -->
      <p class="subtitulo">
        <strong>Objetivos Completados</strong> | Total: {{ $objetivosTerminados->count() }}
      </p>

      <!-- Tabla de objetivos terminados -->
      <table class="objetivos-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Nombre de Objetivo</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          @forelse($objetivosTerminados as $objetivo)
            <tr>
              <td>{{ \Carbon\Carbon::parse($objetivo->fecha_desde)->format('d/m/Y') }}</td>
              <td>{{ $objetivo->nombre }}</td>
              <td>Terminado</td>
            </tr>
          @empty
            <tr>
              <td colspan="3">No tienes objetivos de ahorro completados.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
