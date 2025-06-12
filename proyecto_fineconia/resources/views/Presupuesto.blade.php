<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Presupuestos - Fineconia</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  @vite('resources/css/Presupuesto.css')
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo-container">
    <img src="img/LogoCompleto.jpg"  alt="Logo"  style="height: 100px;">
    </div>
    <div class="right-side">
      <div class="nav-links">
        <a button class="btn nav-link" id ="finanzas_personales">Finanzas Personales</a>
        <a butoon class="btn nav-link" id="gastos_ingresos">Gastos e Ingresos</a>
        <a button class="btn nav-link" id="presupuestos">Presupuestos</a>
        <a button class="btn nav-link" id="ahorros">Ahorro</a>
      </div>
       @include('partials.header-user')  {{-- ← nuevo partial --}}
    </div>
  </nav>

  <!-- Header -->
  <header class="header">
    <h2>PRESUPUESTOS</h2>
    <p>
      En esta sección puedes crear y administrar tus presupuestos mensuales para cada categoría de gastos. 
      Establece límites, realiza ajustes cuando sea necesario y compara lo planificado con lo gastado 
      realmente para mantener el control de tus finanzas.
    </p>
  </header>

  <!-- Main content -->
  <div class="section-container">
    <!-- Establecer presupuestos -->
    <section class="section">
      <div class="section-header create-header">
        <i class="bi bi-wallet2"></i>
        Establecer presupuestos
      </div>
      <div class="section-body">
        <p>
          En esta pantalla podrás crear presupuestos personalizados para cada categoría de gasto, como alimentación, 
          transporte, entretenimiento, entre otros. Esto te ayudará a tener un panorama claro de cuánto planeas gastar 
          en cada área y distribuir mejor tus recursos.
        </p>
        <div class="divider"></div>
        <div class="buttons-container">
          <a href="{{ route('presupuestos.create') }}" class="btn btn-primary"><i  class="bi bi-plus-circle"></i> Crear Presupuesto</a>
        </div>
      </div>
    </section>

    <!-- Ajustar límites -->
    <section class="section">
      <div class="section-header adjust-header">
        <i class="bi bi-sliders"></i>
        Ajustar límites
      </div>
      <div class="section-body">
        <p>
          ¿Tus necesidades cambiaron? Aquí puedes modificar fácilmente los límites de gasto asignados a cada categoría, 
          adaptándolos a nuevas situaciones o prioridades. Esta herramienta te permite mantener tus finanzas actualizadas 
          y en sintonía con tu realidad.
        </p>
        <div class="divider"></div>
        <div class="buttons-container">
          <a href="{{ route('presupuestos.index') }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Ajustar Presupuesto</a>
        </div>
      </div>
    </section>

    <!-- Comparar presupuestos -->
    <section class="section">
      <div class="section-header compare-header">
        <i class="bi bi-graph-up"></i>
        Comparar presupuestos
      </div>
      <div class="section-body">
        <p>
          En esta sección podrás ver de forma clara cuánto has gastado realmente frente a lo que habías planificado. 
          A través de comparaciones visuales, identificarás si estás dentro del presupuesto o si necesitas hacer ajustes. 
          Ideal para evaluar tu desempeño financiero mes a mes.
        </p>
        <div class="divider"></div>
        <div class="buttons-container">
          <a href="{{ route('graficas.presupuesto') }}" class="btn btn-info">
    <i class="bi bi-bar-chart-line"></i> Ver Comparación
</a>
        </div>
      </div>
    </section>
  </div>

  <!-- Tabla de presupuestos -->
  <section class="budgets-section">
    <h3 class="budgets-title">Tus Presupuestos</h3>
    <table>
      <thead>
        <tr>
          <th>Categoría</th>
          <th>Presupuesto</th>
          <th>Gastado</th>
          <th>Restante</th>
          <th>Progreso</th>
        </tr>
      </thead>
<tbody>
@forelse ($presupuestos as $pre)
  <tr>
    <td>{{ $pre->categoria }}</td>

    <td>${{ number_format($pre->monto, 2) }}</td>

    <td>${{ number_format($pre->gastado, 2) }}</td>

    <td class="{{ $pre->restante < 0 ? 'text-danger' : '' }}">
        ${{ number_format($pre->restante, 2) }}
    </td>

    <td>
      <div class="progress-container">
        <div class="progress-bar {{ $pre->barClass }}"
             style="width: {{ $pre->pct }}%"></div>
      </div>
    </td>
  </tr>
@empty
  <tr>
    <td colspan="5" class="text-center py-4">Aún no tienes presupuestos registrados.</td>
  </tr>
@endforelse
</tbody>

    </table>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Aquí puedes añadir funcionalidad JavaScript para los presupuestos
      console.log('Página de presupuestos cargada');
      
      // Ejemplo: Podrías añadir eventos para los botones de crear/ajustar/ver presupuestos
      const buttons = document.querySelectorAll('.btn');
      buttons.forEach(button => {
        button.addEventListener('click', function() {
          const action = this.textContent.trim();
          console.log(`Acción: ${action}`);
          // Aquí podrías redirigir a diferentes secciones o mostrar modales
        });
      });
    });
  </script>
  <!-- Enlaces a las vistas de Finanzas Personales, Gastos e Ingresos, Presupuesto y Ahorro -->
<script>
  document.getElementById('finanzas_personales').addEventListener('click', function() {
    window.location.href = "{{ route('finanzas.personales') }}";
  });
  document.getElementById('gastos_ingresos').addEventListener('click', function() {
    window.location.href = "{{ route('gastos-ingresos') }}";
  })
  document.getElementById('presupuestos').addEventListener('click', function() {
    window.location.href = "{{ route('presupuesto') }}";
  });
  document.getElementById('ahorros').addEventListener('click', function() {
    window.location.href = "{{ route('ahorro') }}";
  
  });
  
  

</script>
</body>
</html>