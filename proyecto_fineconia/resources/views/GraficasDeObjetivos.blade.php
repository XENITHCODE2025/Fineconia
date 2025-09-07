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

  <!-- Fuente Open Sans -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

  <!-- Archivo de estilos externo -->
  @vite('resources/css/GraficasDeObjetivos.css')

  <!-- Librería Chart.js para las gráficas -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <!-- HEADER -->
  <header class="header">
    <div class="logo-container">
      <img src="img/LogoCompleto.jpg" alt="Logo" class="responsive-logo">
    </div>
    <div class="menu">
      <a href="{{ route('ahorro') }}" class="nav-link {{ request()->routeIs('ahorro') ? 'active' : '' }}">Ahorro</a>
      <a href="{{ route('consejos.ahorro') }}" class="nav-link {{ request()->is('consejos') ? 'active' : '' }}">Consejos</a>
      <a href="{{ route('objetivos.nuevo') }}" class="nav-link {{ request()->routeIs('objetivos.*') ? 'active' : '' }}">Objetivos</a>
      <a href="{{ route('graficas.ahorro') }}" class="nav-link active">Gráficas</a>
      
      @include('partials.header-user')
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </header>

  <!-- Menú móvil -->
  <nav class="mobile-menu" id="mobile-menu">
    <a href="{{ route('ahorro') }}" class="mobile-nav-link">Ahorro</a>
    <a href="{{ route('consejos.ahorro') }}" class="mobile-nav-link">Consejos</a>
    <a href="{{ route('objetivos.nuevo') }}" class="mobile-nav-link">Objetivos</a>
    <a href="{{ route('graficas.ahorro') }}" class="mobile-nav-link active">Gráficas</a>
  </nav>

  <!-- CONTENIDO PRINCIPAL -->
  <main class="contenido">
    <h2 class="titulo">Gráficas de Objetivos de Ahorro</h2>
    <p class="subtitulo">Visualiza el progreso de cada meta financiera</p>

    <!-- Contenedor dinámico -->
    <div id="graficas-container" class="graficas-grid"></div>

    <!-- Mensaje si no hay metas -->
    <p id="sin-metas" class="subtitulo" style="display: none; text-align: center; color: #888; font-style: italic;">
      Aún no tienes metas de ahorro registradas
    </p>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

  <script>
  // Menú móvil
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

  document.querySelectorAll('.mobile-nav-link').forEach(link => {
    link.addEventListener('click', function () {
      document.getElementById('mobile-menu').classList.remove('active');
    });
  });

  // Crear gráfica con colores del CSS
  function crearGrafica(id, porcentaje) {
    const colorAvance = getComputedStyle(document.documentElement).getPropertyValue('--color-verde-avance').trim();
    const colorFaltante = getComputedStyle(document.documentElement).getPropertyValue('--color-gris-faltante').trim();

    new Chart(document.getElementById(id), {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [porcentaje, 100 - porcentaje],
          backgroundColor: [colorAvance, colorFaltante],
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

  // Crear tarjeta HTML con gráfica
  function crearTarjeta(meta) {
    const porcentaje = meta.meta > 0 ? (meta.ahorrado / meta.meta) * 100 : 0;
    const porcentajeRedondeado = porcentaje.toFixed(1);

    const tarjeta = document.createElement('div');
    tarjeta.className = 'grafica-card';

    const idCanvas = `chart-${meta.nombre.replace(/\s+/g, '-')}-${Math.random().toString(36).substr(2, 5)}`;

    tarjeta.innerHTML = `
      <h3>${meta.nombre}</h3>
      <p>Meta: $${meta.meta} (Ahorrado: $${meta.ahorrado})</p>
      <div class="grafica-container">
        <canvas id="${idCanvas}"></canvas>
        <div class="porcentaje-texto">${porcentajeRedondeado}%</div>
      </div>
    `;

    document.getElementById('graficas-container').appendChild(tarjeta);
    crearGrafica(idCanvas, porcentaje);
  }

  // Mostrar ejemplos si no hay datos reales
  function mostrarMetasDeEjemplo() {
    const ejemplos = [
      { nombre: 'Vacaciones en la playa', meta: 1000, ahorrado: 450 },
      { nombre: 'Compra de laptop', meta: 1500, ahorrado: 900 },
      { nombre: 'Fondo de emergencia', meta: 2000, ahorrado: 1200 }
    ];

    ejemplos.forEach(meta => crearTarjeta(meta));

    const mensajeEjemplo = document.createElement('p');
    mensajeEjemplo.textContent = '';
    mensajeEjemplo.style.textAlign = 'center';
    mensajeEjemplo.style.fontStyle = 'italic';
    mensajeEjemplo.style.color = '#888';

    document.querySelector('main.contenido').appendChild(mensajeEjemplo);
  }

  // Cargar las metas desde la API
  async function cargarMetas() {
    const contenedor = document.getElementById('graficas-container');
    const sinMetas = document.getElementById('sin-metas');
    contenedor.innerHTML = '';
    sinMetas.style.display = 'none';

    try {
      const res = await fetch('/api/objetivos');
      const datos = await res.json();

      if (!datos || datos.length === 0) {
        mostrarMetasDeEjemplo();
        return;
      }

      datos.forEach(meta => crearTarjeta(meta));
    } catch (error) {
      console.error('Error al cargar las metas:', error);
      mostrarMetasDeEjemplo();
    }
  }

  // Ejecutar al cargar el DOM
  window.addEventListener('DOMContentLoaded', cargarMetas);
</script>

</body>
</html>
