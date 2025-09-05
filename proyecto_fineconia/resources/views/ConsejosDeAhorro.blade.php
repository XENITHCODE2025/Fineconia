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

        <!-- Presupuesto -->
        <div class="categoria" data-categoria="presupuesto">
          <i class="bi bi-clipboard2-check"></i>
          <span>Presupuesto</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <ul class="consejos-lista" data-categoria="presupuesto">
          <li data-consejo="Registra tus ingresos y gastos">Registra tus ingresos y gastos</li>
          <li data-consejo="Crea un presupuesto mensual">Crea un presupuesto mensual</li>
          <li data-consejo="Controla los gastos hormiga">Controla los gastos hormiga</li>
          <li data-consejo="Establece límites de gasto">Establece límites de gasto</li>
          <li data-consejo="Haz un seguimiento semanal">Haz un seguimiento semanal</li>
          <li data-consejo="Categoriza tus gastos">Categoriza tus gastos</li>
          <li data-consejo="Revisa tus suscripciones">Revisa tus suscripciones</li>
          <li data-consejo="Utiliza apps de finanzas">Utiliza apps de finanzas</li>
          <li data-consejo="Compara meses anteriores">Compara meses anteriores</li>
          <li data-consejo="Ajusta el presupuesto cada mes">Ajusta el presupuesto cada mes</li>
        </ul>

        <!-- Compras Inteligentes -->
        <div class="categoria" data-categoria="compras">
          <i class="bi bi-cart3"></i>
          <span>Compras Inteligentes</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <ul class="consejos-lista" data-categoria="compras">
          <li data-consejo="Haz una lista de compras">Haz una lista de compras</li>
          <li data-consejo="Compra productos genéricos">Compra productos genéricos</li>
          <li data-consejo="Aprovecha ofertas y cupones">Aprovecha ofertas y cupones</li>
          <li data-consejo="Compara precios antes de comprar">Compara precios antes de comprar</li>
          <li data-consejo="Evita compras impulsivas">Evita compras impulsivas</li>
          <li data-consejo="Compra al por mayor">Compra al por mayor</li>
          <li data-consejo="Revisa reseñas de productos">Revisa reseñas de productos</li>
          <li data-consejo="Establece un tope de gasto">Establece un tope de gasto</li>
          <li data-consejo="Prioriza necesidades sobre deseos">Prioriza necesidades sobre deseos</li>
          <li data-consejo="Ahorra en compras en línea">Ahorra en compras en línea</li>
        </ul>

        <!-- Energía y Servicio -->
        <div class="categoria" data-categoria="energia">
          <i class="bi bi-lightbulb"></i>
          <span>Energía y Servicio</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <ul class="consejos-lista" data-categoria="energia">
          <li data-consejo="Apaga luces que no uses">Apaga luces que no uses</li>
          <li data-consejo="Desconecta aparatos eléctricos">Desconecta aparatos eléctricos</li>
          <li data-consejo="Usa focos LED">Usa focos LED</li>
          <li data-consejo="Aprovecha luz natural">Aprovecha luz natural</li>
          <li data-consejo="Lava con carga completa">Lava con carga completa</li>
          <li data-consejo="Reduce uso del aire acondicionado">Reduce uso del aire acondicionado</li>
          <li data-consejo="Revisa fugas de agua">Revisa fugas de agua</li>
          <li data-consejo="Instala economizadores">Instala economizadores</li>
          <li data-consejo="Utiliza temporizadores">Utiliza temporizadores</li>
          <li data-consejo="Revisa tarifas de servicios">Revisa tarifas de servicios</li>
        </ul>

        <!-- Metas de ahorro -->
        <div class="categoria" data-categoria="metas">
          <i class="bi bi-flag"></i>
          <span>Metas de ahorro</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <ul class="consejos-lista" data-categoria="metas">
          <li data-consejo="Define metas específicas">Define metas específicas</li>
          <li data-consejo="Establece un plazo">Establece un plazo</li>
          <li data-consejo="Automatiza el ahorro">Automatiza el ahorro</li>
          <li data-consejo="Crea un fondo de emergencia">Crea un fondo de emergencia</li>
          <li data-consejo="Usa la regla 50/30/20">Usa la regla 50/30/20</li>
          <li data-consejo="Revisa tus metas mensualmente">Revisa tus metas mensualmente</li>
          <li data-consejo="Celebra logros pequeños">Celebra logros pequeños</li>
          <li data-consejo="Invierte en instrumentos seguros">Invierte en instrumentos seguros</li>
          <li data-consejo="Visualiza tus metas">Visualiza tus metas</li>
          <li data-consejo="Involucra a tu familia">Involucra a tu familia</li>
        </ul>

        <!-- Familiar -->
        <div class="categoria" data-categoria="familiar">
          <i class="bi bi-people"></i>
          <span>Familiar</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <ul class="consejos-lista" data-categoria="familiar">
          <li data-consejo="Educa a tus hijos sobre finanzas">Educa a tus hijos sobre finanzas</li>
          <li data-consejo="Planifica salidas económicas">Planifica salidas económicas</li>
          <li data-consejo="Haz reuniones familiares sobre ahorro">Haz reuniones familiares sobre ahorro</li>
          <li data-consejo="Cocinen en casa juntos">Cocinen en casa juntos</li>
          <li data-consejo="Compra ropa de segunda mano">Compra ropa de segunda mano</li>
          <li data-consejo="Usa transporte público">Usa transporte público</li>
          <li data-consejo="Aprovecha becas y apoyos">Aprovecha becas y apoyos</li>
          <li data-consejo="Crea retos de ahorro en familia">Crea retos de ahorro en familia</li>
          <li data-consejo="Recicla y reutiliza en casa">Recicla y reutiliza en casa</li>
          <li data-consejo="Haz presupuestos familiares">Haz presupuestos familiares</li>
        </ul>
      </div>

      <!-- Cuadro derecho -->
      <div id="tarjeta-contenido" class="tarjeta">
       <h3 id="consejo-titulo">Selecciona un consejo para visualizarlo aquí.</h3>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
  document.getElementById("menu-toggle").addEventListener("click", function () {
  document.getElementById("mobile-menu").classList.toggle("active");
});

function checkScreenSize() {
  const mobileMenu = document.getElementById("mobile-menu");
  if (window.innerWidth > 768 && mobileMenu.classList.contains("active")) {
    mobileMenu.classList.remove("active");
  }
}

window.addEventListener("load", () => {
  checkScreenSize();
  // Al cargar la página, aplicamos la clase default-style para el h3
  document.getElementById('consejo-titulo').classList.add('default-style');
});

window.addEventListener("resize", checkScreenSize);

document.querySelectorAll('.mobile-nav-link').forEach(link => {
  link.addEventListener('click', function () {
    document.getElementById('mobile-menu').classList.remove('active');
  });
});

// Expandir categoría (solo una abierta a la vez)
document.querySelectorAll('.categoria').forEach(categoria => {
  categoria.addEventListener('click', () => {
    const cat = categoria.dataset.categoria;

    // Cerrar otras listas
    document.querySelectorAll('.consejos-lista.visible').forEach(lista => {
      if (lista.dataset.categoria !== cat) {
        lista.classList.remove('visible');
      }
    });

    // Abrir/cerrar la seleccionada
    const lista = document.querySelector(`.consejos-lista[data-categoria="${cat}"]`);
    if (lista) {
      lista.classList.toggle('visible');
    }
  });
});

// Cambiar contenido y resaltar
document.querySelectorAll('.consejos-lista li').forEach(item => {
  item.addEventListener('click', () => {
    document.querySelectorAll('.consejos-lista li').forEach(li => li.classList.remove('activo'));
    item.classList.add('activo');

    const contenido = item.dataset.consejo;
    const consejoTitulo = document.getElementById('consejo-titulo');

    // Cambia el texto
    consejoTitulo.textContent = contenido;

    // Quitamos la clase default-style para aplicar el estilo verde
    consejoTitulo.classList.remove('default-style');
  });
});
  </script>
</body>
</html>