<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Plantilla principal</title>
  @vite('resources/css/ConsejosDeAhorro.css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <!-- Fuente Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <!-- Fuente Open Sans -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

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
    </div>

    <div class="menu-toggle" id="menu-toggle">
    <i class="fas fa-bars"></i>
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
          <li data-consejo="Registra tus ingresos y gastos">Consejo 1: Registra tus ingresos y gastos</li>
          <li data-consejo="Crea un presupuesto mensual">Consejo 2: Crea un presupuesto mensual</li>
          <li data-consejo="Controla los gastos hormiga">Consejo 3: Controla los gastos hormiga</li>
          <li data-consejo="Establece límites de gasto">Consejo 4: Establece límites de gasto</li>
          <li data-consejo="Haz un seguimiento semanal">Consejo 5: Haz un seguimiento semanal</li>
          <li data-consejo="Categoriza tus gastos">Consejo 6: Categoriza tus gastos</li>
          <li data-consejo="Revisa tus suscripciones">Consejo 7: Revisa tus suscripciones</li>
          <li data-consejo="Utiliza apps de finanzas">Consejo 8: Utiliza apps de finanzas</li>
          <li data-consejo="Compara meses anteriores">Consejo 9: Compara meses anteriores</li>
          <li data-consejo="Ajusta el presupuesto cada mes">Consejo 10: Ajusta el presupuesto cada mes</li>
        </ul>

        <!-- Compras Inteligentes -->
        <div class="categoria" data-categoria="compras">
          <i class="bi bi-cart3"></i>
          <span>Compras Inteligentes</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <ul class="consejos-lista" data-categoria="compras">
  <li data-consejo="Haz una lista de compras">Consejo 1: Haz una lista de compras</li>
  <li data-consejo="Compra productos genéricos">Consejo 2: Compra productos genéricos</li>
  <li data-consejo="Aprovecha ofertas y cupones">Consejo 3: Aprovecha ofertas y cupones</li>
  <li data-consejo="Compara precios antes de comprar">Consejo 4: Compara precios antes de comprar</li>
  <li data-consejo="Evita compras impulsivas">Consejo 5: Evita compras impulsivas</li>
  <li data-consejo="Compra al por mayor">Consejo 6: Compra al por mayor</li>
  <li data-consejo="Revisa reseñas de productos">Consejo 7: Revisa reseñas de productos</li>
  <li data-consejo="Establece un tope de gasto">Consejo 8: Establece un tope de gasto</li>
  <li data-consejo="Prioriza necesidades sobre deseos">Consejo 9: Prioriza necesidades sobre deseos</li>
  <li data-consejo="Ahorra en compras en línea">Consejo 10: Ahorra en compras en línea</li>
</ul>


        <!-- Energía y Servicio -->
        <div class="categoria" data-categoria="energia">
          <i class="bi bi-lightbulb"></i>
          <span>Energía y Servicio</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <ul class="consejos-lista" data-categoria="energia">
  <li data-consejo="Apaga luces que no uses">Consejo 1: Apaga luces que no uses</li>
  <li data-consejo="Desconecta aparatos eléctricos">Consejo 2: Desconecta aparatos eléctricos</li>
  <li data-consejo="Usa focos LED">Consejo 3: Usa focos LED</li>
  <li data-consejo="Aprovecha luz natural">Consejo 4: Aprovecha luz natural</li>
  <li data-consejo="Lava con carga completa">Consejo 5: Lava con carga completa</li>
  <li data-consejo="Reduce uso del aire acondicionado">Consejo 6: Reduce uso del aire acondicionado</li>
  <li data-consejo="Revisa fugas de agua">Consejo 7: Revisa fugas de agua</li>
  <li data-consejo="Instala economizadores">Consejo 8: Instala economizadores</li>
  <li data-consejo="Utiliza temporizadores">Consejo 9: Utiliza temporizadores</li>
  <li data-consejo="Revisa tarifas de servicios">Consejo 10: Revisa tarifas de servicios</li>
</ul>


        <!-- Metas de ahorro -->
        <div class="categoria" data-categoria="metas">
          <i class="bi bi-flag"></i>
          <span>Metas de ahorro</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <ul class="consejos-lista" data-categoria="metas">
  <li data-consejo="Define metas específicas">Consejo 1: Define metas específicas</li>
  <li data-consejo="Establece un plazo">Consejo 2: Establece un plazo</li>
  <li data-consejo="Automatiza el ahorro">Consejo 3: Automatiza el ahorro</li>
  <li data-consejo="Crea un fondo de emergencia">Consejo 4: Crea un fondo de emergencia</li>
  <li data-consejo="Usa la regla 50/30/20">Consejo 5: Usa la regla 50/30/20</li>
  <li data-consejo="Revisa tus metas mensualmente">Consejo 6: Revisa tus metas mensualmente</li>
  <li data-consejo="Celebra logros pequeños">Consejo 7: Celebra logros pequeños</li>
  <li data-consejo="Invierte en instrumentos seguros">Consejo 8: Invierte en instrumentos seguros</li>
  <li data-consejo="Visualiza tus metas">Consejo 9: Visualiza tus metas</li>
  <li data-consejo="Involucra a tu familia">Consejo 10: Involucra a tu familia</li>
</ul>

        <!-- Familiar -->
        <div class="categoria" data-categoria="familiar">
          <i class="bi bi-people"></i>
          <span>Familiar</span>
          <i class="bi bi-chevron-down flecha"></i>
        </div>
        <ul class="consejos-lista" data-categoria="familiar">
  <li data-consejo="Educa a tus hijos sobre finanzas">Consejo 1: Educa a tus hijos sobre finanzas</li>
  <li data-consejo="Planifica salidas económicas">Consejo 2: Planifica salidas económicas</li>
  <li data-consejo="Haz reuniones familiares sobre ahorro">Consejo 3: Haz reuniones familiares sobre ahorro</li>
  <li data-consejo="Cocinen en casa juntos">Consejo 4: Cocinen en casa juntos</li>
  <li data-consejo="Compra ropa de segunda mano">Consejo 5: Compra ropa de segunda mano</li>
  <li data-consejo="Usa transporte público">Consejo 6: Usa transporte público</li>
  <li data-consejo="Aprovecha becas y apoyos">Consejo 7: Aprovecha becas y apoyos</li>
  <li data-consejo="Crea retos de ahorro en familia">Consejo 8: Crea retos de ahorro en familia</li>
  <li data-consejo="Recicla y reutiliza en casa">Consejo 9: Recicla y reutiliza en casa</li>
  <li data-consejo="Haz presupuestos familiares">Consejo 10: Haz presupuestos familiares</li>
</ul>
      </div>

      <!-- Cuadro derecho -->
      <div id="tarjeta-contenido" class="tarjeta">
       <h3 id="consejo-titulo">Selecciona una categoria para visualizar sus consejos aqui.</h3>
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