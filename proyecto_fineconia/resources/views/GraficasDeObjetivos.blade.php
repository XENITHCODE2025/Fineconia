<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gráficas de Objetivos de Ahorro</title>

  <!-- Iconos de Bootstrap y FontAwesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <!-- Fuente Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <!-- Archivo de estilos externo -->
  @vite('resources/css/GraficasDeObjetivos.css')

  <!-- Librería Chart.js para las gráficas -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <!-- HEADER -->
  <header class="header">
    <!-- Logo -->
    <div class="logo-container">
      <img src="img/LogoCompleto.jpg" alt="Logo" class="responsive-logo">
    </div>

    <!-- Menú de navegación -->
    <div class="menu">
      <!-- Solo los 4 enlaces solicitados -->
      <a href="{{ route('ahorro') }}" class="nav-link {{ request()->routeIs('ahorro') ? 'active' : '' }}">Ahorro</a>
      <a href="{{ route('consejos.ahorro') }}" class="nav-link {{ request()->is('consejos') ? 'active' : '' }}">Consejos</a>
      <a href="{{ route('objetivos.nuevo') }}" class="nav-link {{ request()->routeIs('objetivos.*') ? 'active' : '' }}">Objetivos</a>
      <a href="{{ route('graficas.ahorro') }}" class="nav-link active">Gráficas</a>

      @include('partials.header-user')

      <!-- Botón hamburguesa (visible solo en móvil) -->
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </header>

  <!-- Menú desplegable para móvil -->
  <nav class="mobile-menu" id="mobile-menu">
    <!-- Solo los 4 enlaces solicitados en menú móvil -->
    <a href="{{ route('ahorro') }}" class="mobile-nav-link">Ahorro</a>
    <a href="{{ route('consejos.ahorro') }}" class="mobile-nav-link">Consejos</a>
    <a href="{{ route('objetivos.nuevo') }}" class="mobile-nav-link">Objetivos</a>
    <a href="{{ route('graficas.ahorro') }}" class="mobile-nav-link active">Gráficas</a>
  </nav>

  <!-- CONTENIDO PRINCIPAL -->
  <main class="contenido">
    <h2 class="titulo">Gráficas de Objetivos de Ahorro</h2>
    <p class="subtitulo">Visualiza el progreso de cada meta financiera</p>

    <!-- Contenedor de todas las gráficas -->
    <div class="graficas-grid">
      <!-- Tarjeta de gráfica -->
      <div class="grafica-card">
        <h3>Viaje</h3>
        <p>Meta: $1000 (Ahorrado: $600)</p>
        <div class="grafica-container">
          <canvas id="viajeChart"></canvas>
          <div class="porcentaje-texto">60.0%</div>
        </div>
      </div>

      <div class="grafica-card">
        <h3>Laptop</h3>
        <p>Meta: $500 (Ahorrado: $400)</p>
        <div class="grafica-container">
          <canvas id="laptopChart"></canvas>
          <div class="porcentaje-texto">80.0%</div>
        </div>
      </div>

      <div class="grafica-card">
        <h3>Emergencia</h3>
        <p>Meta: $500 (Ahorrado: $100)</p>
        <div class="grafica-container">
          <canvas id="emergenciaChart"></canvas>
          <div class="porcentaje-texto">20.0%</div>
        </div>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

  <!-- SCRIPT -->
  <script>
    // ✅ Menú móvil
    document.getElementById("menu-toggle").addEventListener("click", function () {
      document.getElementById("mobile-menu").classList.toggle("active");
    });

    function checkScreenSize() {
      const mobileMenu = document.getElementById("mobile-menu");
      if (window.innerWidth > 768 && mobileMenu.classList.contains("active")) {
        mobileMenu.classList.remove("active");
      }
    }
    window.addEventListener("load", checkScreenSize);
    window.addEventListener("resize", checkScreenSize);

    // Cerrar menú móvil al hacer clic en un enlace
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
      link.addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.remove('active');
      });
    });

    // Función para crear gráficas con Chart.js
    function crearGrafica(id, porcentaje, color) {
      new Chart(document.getElementById(id), {
        type: 'doughnut',
        data: {
          datasets: [{
            data: [porcentaje, 100 - porcentaje],
            backgroundColor: [color, '#e0e0e0'],
            borderWidth: 0
          }]
        },
        options: {
          cutout: '70%',
          plugins: {
            legend: { display: false },
            tooltip: { enabled: false }
          }
        }
      });
    }

    // Crear cada gráfica
    crearGrafica("viajeChart", 60, "#4CAF50");
    crearGrafica("laptopChart", 80, "#2196F3");
    crearGrafica("emergenciaChart", 20, "#FF9800");
  </script>
</body>
</html>