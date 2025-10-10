<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Presupuestos - Fineconia</title>

  <!-- Iconos y Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- 🔹 IMPORTACIÓN DE PONPINS -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

  <!-- Tu CSS personalizado -->
  @vite('resources/css/Presupuesto.css')
</head>
<body>


<!-- Navbar -->
<header class="header">
  <!-- Logo -->
  <div class="logo-container">
    <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" class="responsive-logo">
  </div>

  <!-- Menú escritorio -->
  <div class="menu">
    <a href="{{ route('finanzas.personales') }}" class="nav-link" id="finanzas_personales">Finanzas Personales</a>
    <a href="{{ route('gastos-ingresos') }}" class="nav-link" id="gastos_ingresos">Gastos e Ingresos</a>
    <a href="{{ route('presupuesto') }}" class="nav-link" id="presupuestos">Presupuestos</a>
    <a href="{{ route('ahorro') }}" class="nav-link" id="ahorros">Ahorro</a>
  </div>

  <!-- Botón hamburguesa -->
  <div class="menu-toggle" id="menu-toggle">
    <i class="bi bi-list"></i>
  </div>

</header>

<!-- Menú móvil -->
<nav class="mobile-menu" id="mobile-menu">

  <!-- Opciones de navegación -->
  <a href="{{ route('finanzas.personales') }}" class="mobile-nav-link" id="finanzas_personales_mobile">Finanzas Personales</a>
  <a href="{{ route('gastos-ingresos') }}" class="mobile-nav-link" id="gastos_ingresos_mobile">Gastos e Ingresos</a>
  <a href="{{ route('presupuesto') }}" class="mobile-nav-link" id="presupuestos_mobile">Presupuestos</a>
  <a href="{{ route('ahorro') }}" class="mobile-nav-link" id="ahorros_mobile">Ahorro</a>
</nav>

<!-- Header contenido -->
<section class="header-presupuesto">
  <h1>PRESUPUESTOS</h1>
  <p>
    En esta sección puedes crear y administrar tus presupuestos mensuales para cada categoría de gastos. 
    Establece límites, realiza ajustes cuando sea necesario y compara lo planificado con lo gastado 
    realmente para mantener el control de tus finanzas.
  </p>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const currentPage = "presupuestos"; // Ajusta según la página actual

  // 🔹 Enlaces escritorio
  document.querySelectorAll(".nav-link").forEach(link => {
    if(link.id === currentPage) link.classList.add("active");
    else link.classList.remove("active");
  });

  // 🔹 Enlaces móvil
  const mobileMenu = document.getElementById("mobile-menu");
  document.querySelectorAll(".mobile-nav-link").forEach(link => {
    if(link.id.includes(currentPage)) link.classList.add("active");
    else link.classList.remove("active");

    // Cierra menú al hacer clic
    link.addEventListener("click", () => {
      mobileMenu.classList.remove("active");
    });
  });

  // 🔹 Botón hamburguesa
  const menuToggle = document.getElementById("menu-toggle");
  menuToggle.addEventListener("click", () => {
    mobileMenu.classList.toggle("active");
  });

  // 🔹 Cierra menú si pasa a escritorio
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) {
      mobileMenu.classList.remove("active");
    }
  });
});
</script>

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
          <a href="{{ route('presupuestos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Crear Presupuesto
          </a>
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
          <a href="{{ route('presupuestos.index') }}" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Ajustar Presupuesto
          </a>
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
            <i class="bi bi-bar-chart-line"></i> Distribución de presupuesto
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
                <div class="progress-bar {{ $pre->bar_class }}"
                     style="width: {{ $pre->pct }}%"></div>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-4">
              Aún no tienes presupuestos registrados.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Tu JS -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Toggle menú hamburguesa
      const btn = document.querySelector('.hamburger');
      const links = document.querySelector('.nav-links');
      btn.addEventListener('click', () => {
        links.classList.toggle('active');
      });

      // Navegación
      document.getElementById('finanzas_personales').onclick = () =>
        window.location.href = "{{ route('finanzas.personales') }}";
      document.getElementById('gastos_ingresos').onclick = () =>
        window.location.href = "{{ route('gastos-ingresos') }}";
      document.getElementById('presupuestos').onclick = () =>
        window.location.href = "{{ route('presupuesto') }}";
      document.getElementById('ahorros').onclick = () =>
        window.location.href = "{{ route('ahorro') }}";
    });
  </script>
  <script>
document.addEventListener('DOMContentLoaded', () => {
  // Selecciona el contenedor del partial
  const headerUser = document.querySelector('.header-user');

  if (!headerUser) return;

  // Función que muestra/oculta según ancho
  function toggleHeaderUser() {
    if (window.innerWidth <= 768) {
      headerUser.style.display = 'none';
    } else {
      headerUser.style.display = '';
    }
  }

  // Ejecuta al cargar…
  toggleHeaderUser();

  // …y cada vez que se redimensiona la ventana
  window.addEventListener('resize', toggleHeaderUser);
});
</script>

</body>
</html>
