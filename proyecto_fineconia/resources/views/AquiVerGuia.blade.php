<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Educación Financiera - Fineconia</title>

  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Alertify CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

  <!-- Alertify JS --> 
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


  <!-- Tipografías -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

  <!-- CSS externo -->
  @vite('resources/css/AquiVerGuia.css')
</head>

<body> 
  <!-- HEADER -->
  <header class="header">
    <div class="logo-container" style="max-width: 200px; width: 100%;">
      <img src="img/LogoCompleto.jpg" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
    </div>
    <!-- BOTÓN DE USUARIO -->
<div class="user-section" id="btn-user">
  @include('partials.header-user') {{-- ← partial del usuario --}}
</div>

<!-- DESPLEGABLE DEL MENÚ USUARIO -->
<div class="user-menu" id="userMenu">
  <div class="menu-container">
    <div class="menu-header">
      <i class="bi bi-person-circle"></i>
      <span>{{ Auth::user()->name }}</span>
    </div>

    <div class="menu-item" id="btn-datos">
      <span>Datos Generales</span>
      <i class="bi bi-chevron-right"></i>
    </div>

    <div class="menu-item" id="btn-objetivos">    
  <span>Mis Objetivos</span>    
  <i class="bi bi-chevron-right"></i>    
</div>

    <div class="menu-item">
      <span>Ayuda</span>
      <i class="bi bi-chevron-right"></i>
    </div>

    <button class="logout-btn" id="btnLogout">Cerrar sesión</button>
  </div>
</div>

<script>
  const userBtn = document.getElementById('btn-user');
  const userMenu = document.getElementById('userMenu');
  const btnDatos = document.getElementById('btn-datos');
  const btnLogout = document.getElementById('btnLogout');

  // Mostrar / ocultar menú al hacer clic en el botón del usuario
  userBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const isVisible = userMenu.style.display === 'block';
    userMenu.style.display = isVisible ? 'none' : 'block';
  });

  // Redirigir al hacer clic en "Datos Generales"
  btnDatos.addEventListener('click', () => {
    window.location.href = "{{ route('centro.usuario') }}";
  });

  // Cerrar menú si se hace clic fuera
  document.addEventListener('click', (e) => {
    if (!userMenu.contains(e.target) && !userBtn.contains(e.target)) {
      userMenu.style.display = 'none';
    }
  });

  // Simulación de cierre de sesión
  btnLogout.addEventListener('click', () => {
    alert('Sesión cerrada');
    userMenu.style.display = 'none';
  });

  // Redirigir al hacer clic en "Mis Objetivos"
const btnObjetivos = document.getElementById('btn-objetivos');
btnObjetivos.addEventListener('click', () => {
  window.location.href = "{{ route('centro.objetivos') }}";
});

</script>

  </header> 

  <!-- CONTENIDO -->
  <main class="contenido">
    <section class="guia-container">
      <!-- TÍTULO PRINCIPAL -->
      <div class="titulo-seccion" id="tituloSeccion">
        <i class="fa-solid fa-book-open"></i>
        <div>
          <h2 class="titulo-guia">Educación Financiera</h2>
          <p class="subtitulo-guia">Cómo crear tu primer presupuesto familiar</p>
        </div>
      </div>

      <!-- BLOQUE FLEX -->
      <div class="contenido-flex" id="contenidoFlex">

        <!-- SIDEBAR tipo PowerPoint -->
<aside class="sidebar" id="sidebar">
  <div class="miniaturas">
    <div class="mini-slide active" data-index="0">
      <img src="img/slide0.jpg" alt="Objetivo" />
      <span>Objetivo: elaborar un presupuesto sencillo...</span>
      <span>1</span>
    </div>
    <div class="mini-slide" data-index="1">
      <img src="img/slide1.jpg" alt="Introducción" />
      <span>Introducción: importancia de organizar ingresos y gastos...</span>
      <span>2</span>
    </div>
    <div class="mini-slide" data-index="2">
      <img src="img/slide2.jpg" alt="Conceptos clave" />
      <span>Conceptos clave: ingresos, gastos, ahorro...</span>
      <span>3</span>
    </div>
    <!-- Agrega más miniaturas aquí siguiendo el mismo patrón -->
  </div>
</aside>


        <!-- CONTENIDO CENTRAL tipo PowerPoint -->
        <div class="contenido-central" id="contenidoCentral">
          <div class="slide" id="slide0">
            <p>Al finalizar esta guía, podrás elaborar un presupuesto sencillo que te ayude a organizar tus ingresos y gastos de manera eficiente.</p>
          </div>
          <div class="slide" id="slide1" style="display:none;">
            <p>La introducción explica la importancia de organizar tus ingresos y gastos para una mejor salud financiera familiar.</p>
          </div>
          <div class="slide" id="slide2" style="display:none;">
            <p>Conceptos clave: ingresos, gastos, ahorro, balance financiero y cómo aplicarlos en tu presupuesto.</p>
          </div>
          <!-- Más slides aquí -->
        </div>

        <!-- BOTONES DE NAVEGACIÓN -->
        <div class="navegacion navegacion-izquierda">
          <i class="fas fa-chevron-left"></i>
        </div>
        <div class="navegacion navegacion-derecha">
          <i class="fas fa-chevron-right"></i>
        </div>

      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-links">
        <a href="#">Ayuda</a>
        <a href="#">Sugerencias y opiniones</a>
      </div>
      <div class="footer-contact">
        <a href="mailto:fineconia@gmail.com"><i class="fa-regular fa-envelope"></i> fineconia@gmail.com</a>
        <a href="#"><i class="fa-brands fa-facebook"></i> Fineconia</a>
      </div>
    </div>
  </footer>

  <!-- JS para navegación y miniaturas -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Inicializar alertify
  if (typeof alertify === 'undefined') {
    console.warn("Alertify no está cargado.");
  }

  const slides = document.querySelectorAll('.slide');
  const miniSlides = document.querySelectorAll('.mini-slide');
  let currentSlide = 0;

  const mostrarSlide = (index) => {
    if(slides.length === 0) return;

    if (index < 0) index = 0;
    if (index >= slides.length) index = slides.length - 1;

    slides.forEach((slide, i) => slide.style.display = i === index ? 'block' : 'none');
    miniSlides.forEach((mini, i) => mini.classList.toggle('active', i === index));
    currentSlide = index;
  }

  try {
    if(slides.length === 0) throw new Error("No se puede visualizar la guía");

    // Botones de navegación
    document.querySelector('.navegacion-derecha').addEventListener('click', () => {
      if (currentSlide < slides.length - 1) mostrarSlide(currentSlide + 1);
    });
    document.querySelector('.navegacion-izquierda').addEventListener('click', () => {
      if (currentSlide > 0) mostrarSlide(currentSlide - 1);
    });

    // Click en miniaturas
    miniSlides.forEach(mini => {
      mini.addEventListener('click', () => mostrarSlide(parseInt(mini.dataset.index)));
    });

    // Mostrar primer slide
    mostrarSlide(currentSlide);

    console.log("Carga exitosa: contenido de la guía mostrado correctamente.");
  } catch (error) {
    if (typeof alertify !== 'undefined') {
      alertify.error("No se puede visualizar la guía");
    } else {
      alert("No se puede visualizar la guía"); // fallback
    }
  }
});
</script>
</body>
</html