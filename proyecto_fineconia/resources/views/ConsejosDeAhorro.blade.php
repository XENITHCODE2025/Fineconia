<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Plantilla principal</title>
  @vite('resources/css/ConsejosDeAhorro.css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
  <header class="header">
    <!-- Logo -->
    <div class="logo-container">
      <img src="img/LogoCompleto.jpg" alt="Logo" class="responsive-logo">
    </div>

    <!-- Menú de navegación -->
    <div class="menu">
      <a href="{{ route('ahorro') }}" class="nav-link {{ request()->routeIs('ahorro') ? 'active' : '' }}">Ahorro</a>
      <a href="{{ route('consejos.ahorro') }}" class="nav-link active">Consejos</a>
      <a href="{{ route('objetivos.nuevo') }}" class="nav-link {{ request()->routeIs('objetivos.*') ? 'active' : '' }}">Objetivos</a>
      <a href="{{ route('graficas.ahorro') }}" class="nav-link {{ request()->is('graficas') ? 'active' : '' }}">Gráficas</a>

      @include('partials.header-user')
      <!-- Botón hamburguesa -->
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </header>

  <!-- Menú desplegable (móvil) -->
  <nav class="mobile-menu" id="mobile-menu">
    <a href="{{ route('ahorro') }}" class="mobile-nav-link">Ahorro</a>
    <a href="{{ route('consejos.ahorro') }}" class="mobile-nav-link active">Consejos</a>
    <a href="{{ route('objetivos.nuevo') }}" class="mobile-nav-link">Objetivos</a>
    <a href="{{ route('graficas.ahorro') }}" class="mobile-nav-link">Gráficas</a>
  </nav>

  <main class="contenido">
    <section class="titulo-consejos">
      <h2>CONSEJOS DE AHORRO</h2>
    </section>

    <p class="subtexto-consejos">
      Ahorrar te da seguridad, estabilidad y te ayuda a cumplir tus metas sin deudas.
    </p>

    <section class="consejos-grid">
      <!-- Lado izquierdo: categorías -->
      <div class="categorias">
        <div class="categoria">
          <i class="bi bi-clipboard2-check"></i>
          <span>Presupuesto</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <div class="categoria">
          <i class="bi bi-cart3"></i>
          <span>Compras Inteligentes</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <div class="categoria">
          <i class="bi bi-lightbulb"></i>
          <span>Energía y Servicio</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <div class="categoria">
          <i class="bi bi-flag"></i>
          <span>Metas de ahorro</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <div class="categoria">
          <i class="bi bi-people"></i>
          <span>Familiar</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
      </div>

      <!-- Lado derecho: cuadro de texto -->
      <div id="tarjets" class="tarjeta">
        <h3>Registra todos tus ingresos y gastos mensuales.</h3>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

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
  </script>
</body>
</html>