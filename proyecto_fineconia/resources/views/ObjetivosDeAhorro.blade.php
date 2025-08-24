<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Plantilla principal</title>
  @vite('resources/css/ObjetivosDeAhorro.css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
  <header class="header">
    <!-- Logo -->
   <div class="logo-container">
  <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" class="responsive-logo">
</div>

    <!-- Menú de navegación -->
    <div class="menu">
      <a href="#" class="nav-link">Gastos e ingresos</a>
      <a href="#" class="nav-link">Objetivos de ahorro</a>
      <a href="#" class="nav-link">Presupuestos</a>

      <span class="nombre">Rolando</span>
      <div class="user-icon"><i class="bi bi-person-circle"></i></div>

      <!-- Botón hamburguesa -->
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </header>

  <!-- Menú desplegable (móvil) -->
  <nav class="mobile-menu" id="mobile-menu">
    <a href="#">Gastos e ingresos</a>
>
  </nav>

  <main class="contenido">
  <div class="form-container">
    <h2>Nuevo objetivo de ahorro</h2>
    <form>
      <label for="nombre">Nombre de objetivo:</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="monto">Monto:</label>
      <input type="number" id="monto" name="monto" required>

      <label>Fecha del objetivo</label>

      <div class="fechas">
        <div>
          <label for="desde">Desde:</label>
          <input type="date" id="desde" name="desde" required>
        </div>
        <div>
          <label for="hasta">Hasta:</label>
          <input type="date" id="hasta" name="hasta" required>
        </div>
      </div>

      <button type="submit" class="btn-guardar">Guardar</button>
    </form>
  </div>
</main>

  <footer class="footer">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

  <script>
  // Mostrar/Ocultar menú móvil
  document.getElementById("menu-toggle").addEventListener("click", function () {
    document.getElementById("mobile-menu").classList.toggle("active");
  });

  // Función para verificar el tamaño de pantalla y cerrar menú si es necesario
  function checkScreenSize() {
    const mobileMenu = document.getElementById("mobile-menu");
    if (window.innerWidth > 768 && mobileMenu.classList.contains("active")) {
      mobileMenu.classList.remove("active");
    }
  }

  // Ejecutar al cargar y al redimensionar
  window.addEventListener("load", checkScreenSize);
  window.addEventListener("resize", checkScreenSize);
</script>
</body>
</html>