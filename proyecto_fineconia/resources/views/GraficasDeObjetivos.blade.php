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

  <!-- Alertify CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Alertify Theme (opcional) -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<!-- Alertify JS -->

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- Archivo de estilos externo -->
  @vite('resources/css/GraficasDeObjetivos.css')

  <!-- Librería Chart.js -->
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
    </div>
    <div class="menu-toggle" id="menu-toggle">
      <i class="fas fa-bars"></i>
    </div>
  </header>

  <!-- Menú móvil -->
  <nav class="mobile-menu" id="mobile-menu">
    <a href="{{ route('ahorro') }}" class="mobile-nav-link">Ahorro</a>
    <a href="{{ route('consejos.ahorro') }}" class="mobile-nav-link">Consejos</a>
    <a href="{{ route('objetivos.nuevo') }}" class="mobile-nav-link">Objetivos</a>
    <a href="{{ route('graficas.ahorro') }}" class="mobile-nav-link active">Gráficas</a>
  </nav>

  <!-- CONTENIDO -->
  <main class="contenido">
    <h2 class="titulo">Gráficas de Objetivos de Ahorro</h2>
    <p class="subtitulo">Visualiza el progreso de cada meta financiera</p>

    <!-- Filtro por fechas -->
    <div class="filtro-fechas" style="margin: 20px 0; text-align: center;">
      <label for="fecha_desde">Desde:</label>
      <input type="date" id="fecha_desde">
      <label for="fecha_hasta">Hasta:</label>
      <input type="date" id="fecha_hasta">

      <button onclick="cargarMetas()" style="margin-left: 10px; padding: 5px 15px;">
        Filtrar
      </button>
      <button onclick="limpiarFiltro()" style="margin-left: 5px; padding: 5px 15px; background-color:#ccc;">
        Limpiar
      </button>
    </div>

    <!-- Mensaje si no hay metas en el rango -->
    <div id="mensaje-sin-metas" style="display: none; font-family: 'Open Sans', sans-serif; color: gray; text-align: center;">
        No hay metas de ahorro en este rango de tiempo.
    </div>

    <div id="graficas-container" class="graficas-grid"></div>

    <!-- Mensajes dinámicos -->
    <p id="sin-metas" class="subtitulo" style="display:none; text-align:center; color:#888; font-style:italic;">
      Aún no tienes metas de ahorro registradas
    </p>
    <p id="sin-rango" class="subtitulo" style="display:none; text-align:center; color:#888; font-style:italic;">
      No hay metas de ahorro en este rango de tiempo
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
    const menuToggle = document.getElementById("menu-toggle");
    if (menuToggle) {
      menuToggle.addEventListener("click", function() {
        const mobileMenu = document.getElementById("mobile-menu");
        if (mobileMenu) mobileMenu.classList.toggle("active");
      });
    }

    function checkScreenSize() {
      const mobileMenu = document.getElementById("mobile-menu");
      if (window.innerWidth > 768 && mobileMenu.classList.contains("active")) {
        mobileMenu.classList.remove("active");
      }
    }
    window.addEventListener("load", checkScreenSize);
    window.addEventListener("resize", checkScreenSize);

    // Crear gráfica
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
            legend: {
              display: false
            },
            tooltip: {
              enabled: false
            }
          }
        }
      });
    }

    // Crear tarjeta
    function crearTarjeta(meta) {
      const porcentaje = meta.meta > 0 ? (meta.ahorrado / meta.meta) * 100 : 0;
      const tarjeta = document.createElement('div');
      tarjeta.className = 'grafica-card';
      const idCanvas = `chart-${meta.id}-${Math.random().toString(36).substr(2, 5)}`;
      tarjeta.innerHTML = `
        <h3>${meta.nombre}</h3>
        <p>Meta: $${meta.meta} (Ahorrado: $${meta.ahorrado})</p>
        <div class="grafica-container">
          <canvas id="${idCanvas}"></canvas>
          <div class="porcentaje-texto">${porcentaje.toFixed(1)}%</div>
        </div>
      `;
      document.getElementById('graficas-container').appendChild(tarjeta);
      crearGrafica(idCanvas, porcentaje);
    }

    // Cargar metas
    async function cargarMetas() {
      const contenedor = document.getElementById('graficas-container');
      const sinMetas = document.getElementById('sin-metas');
      const sinRango = document.getElementById('sin-rango');
      contenedor.innerHTML = '';
      sinMetas.style.display = 'none';
      sinRango.style.display = 'none';

      try {
        const desde = document.getElementById('fecha_desde').value;
        const hasta = document.getElementById('fecha_hasta').value;
        const params = new URLSearchParams();
        if (desde) params.append('desde', desde);
        if (hasta) params.append('hasta', hasta);

        const res = await fetch('/api/objetivos?' + params.toString());
        const datos = await res.json();

        if (!datos || datos.length === 0) {
          if (desde || hasta) {
            sinRango.style.display = 'block';
          } else {
            sinMetas.style.display = 'block';
          }
          return;
        }

        datos.forEach(meta => crearTarjeta(meta));
      } catch (error) {
        console.error('Error al cargar las metas:', error);
        sinMetas.style.display = 'block';
      }
    }

    // Ejecutar al cargar
    window.addEventListener('DOMContentLoaded', cargarMetas);

    // Función para limpiar filtro y mostrar todas las metas
    function limpiarFiltro() {
      document.getElementById('fecha_desde').value = '';
      document.getElementById('fecha_hasta').value = '';
      cargarMetas();
    }
  </script>

 <script>
  // Validación de fechas con condiciones específicas
  function validarFechas({ mostrarError = false } = {}) {
    const desdeInput = document.getElementById('fecha_desde');
    const hastaInput = document.getElementById('fecha_hasta');
    const desde = new Date(desdeInput.value);
    const hasta = new Date(hastaInput.value);
    let valido = true;

    // Reset estilos
    [desdeInput, hastaInput].forEach(input => {
      input.classList.remove('input-error', 'input-success');
    });

    // Solo validar si ambas fechas están completas
    if (desdeInput.value && hastaInput.value) {
      if (hasta < desde) {
        if (mostrarError) {
          alertify.error("La fecha Hasta debe ser mayor o igual a la fecha Desde");
        }
        desdeInput.classList.add('input-error');
        hastaInput.classList.add('input-error');
        valido = false;
      } else {
        desdeInput.classList.add('input-success');
        hastaInput.classList.add('input-success');
      }
    }

    return valido;
  }

  // Cargar metas después de validar fechas correctamente
  async function cargarMetas() {
    if (!validarFechas({ mostrarError: true })) return;

    const contenedor = document.getElementById('graficas-container');
    const sinMetas = document.getElementById('sin-metas');
    const sinRango = document.getElementById('sin-rango');
    contenedor.innerHTML = '';
    sinMetas.style.display = 'none';
    sinRango.style.display = 'none';

    try {
      const desde = document.getElementById('fecha_desde').value;
      const hasta = document.getElementById('fecha_hasta').value;
      const params = new URLSearchParams();
      if (desde) params.append('desde', desde);
      if (hasta) params.append('hasta', hasta);

      const res = await fetch('/api/objetivos?' + params.toString());
      const datos = await res.json();

      if (!datos || datos.length === 0) {
        sinRango.style.display = 'block';
        return;
      }

      datos.forEach(meta => crearTarjeta(meta));
    } catch (error) {
      console.error('Error al cargar las metas:', error);
      sinMetas.style.display = 'block';
    }
  }

  // Limpiar fechas y estilos
  function limpiarFiltro() {
    const desdeInput = document.getElementById('fecha_desde');
    const hastaInput = document.getElementById('fecha_hasta');

    desdeInput.value = '';
    hastaInput.value = '';

    // Limpiar estilos visuales
    desdeInput.classList.remove('input-error', 'input-success');
    hastaInput.classList.remove('input-error', 'input-success');

    cargarMetas();
  }

  // Agregar listeners para validar automáticamente al cambiar fechas
  document.addEventListener('DOMContentLoaded', () => {
    const desdeInput = document.getElementById('fecha_desde');
    const hastaInput = document.getElementById('fecha_hasta');

    desdeInput.addEventListener('change', () => validarFechas({ mostrarError: true }));
    hastaInput.addEventListener('change', () => validarFechas({ mostrarError: true }));
  });
  
</script>

<script>
  async function reiniciarGraficas() {
    const contenedor = document.getElementById('graficas-container');
    const sinMetas = document.getElementById('sin-metas');
    const sinRango = document.getElementById('sin-rango');

    contenedor.innerHTML = '';
    sinMetas.style.display = 'none';
    sinRango.style.display = 'none';

    try {
      const res = await fetch('/api/objetivos');
      const datos = await res.json();

      if (!datos || datos.length === 0) {
        sinMetas.style.display = 'block';
        return;
      }

      datos.forEach(meta => crearTarjeta(meta));
    } catch (error) {
      console.error('Error al reiniciar gráficas:', error);
      sinMetas.style.display = 'block';
    }
  }

  async function validarYReiniciarSiEsNecesario() {
    const desdeInput = document.getElementById('fecha_desde');
    const hastaInput = document.getElementById('fecha_hasta');

    const desdeStr = desdeInput.value.trim();
    const hastaStr = hastaInput.value.trim();

    if (!desdeStr || !hastaStr) {
      // No hacer nada si las fechas están incompletas
      return;
    }

    const desde = new Date(desdeStr);
    const hasta = new Date(hastaStr);

    if (hasta < desde) {
      // Solo reiniciar sin mostrar mensaje porque ya tienes otro script que lo hace
      await reiniciarGraficas();
    }
  }

  async function cargarMetasConFiltro() {
    const desdeInput = document.getElementById('fecha_desde');
    const hastaInput = document.getElementById('fecha_hasta');

    const desdeStr = desdeInput.value.trim();
    const hastaStr = hastaInput.value.trim();

    const contenedor = document.getElementById('graficas-container');
    const sinMetas = document.getElementById('sin-metas');
    const sinRango = document.getElementById('sin-rango');

    contenedor.innerHTML = '';
    sinMetas.style.display = 'none';
    sinRango.style.display = 'none';

    if (!desdeStr || !hastaStr) {
      alertify.error("Por favor, ingresa ambas fechas para filtrar.");
      return;
    }

    const desde = new Date(desdeStr);
    const hasta = new Date(hastaStr);

    if (hasta < desde) {
      // Aquí sí podrías mostrar el mensaje, pero si ya lo tienes afuera, solo reinicia
      await reiniciarGraficas();
      return;
    }

    try {
      const res = await fetch(`/api/objetivos?desde=${desdeStr}&hasta=${hastaStr}`);
      const datos = await res.json();

      if (!datos || datos.length === 0) {
        sinRango.style.display = 'block';
        return;
      }

      datos.forEach(meta => crearTarjeta(meta));
    } catch (error) {
      console.error('Error al cargar las metas:', error);
      sinMetas.style.display = 'block';
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    reiniciarGraficas();

    const desdeInput = document.getElementById('fecha_desde');
    const hastaInput = document.getElementById('fecha_hasta');

    desdeInput.addEventListener('change', validarYReiniciarSiEsNecesario);
    hastaInput.addEventListener('change', validarYReiniciarSiEsNecesario);

    const btnFiltrar = document.querySelector('button[onclick="cargarMetas()"], button[onclick]');
    if (btnFiltrar) {
      btnFiltrar.removeAttribute('onclick');
      btnFiltrar.id = 'btn-filtrar';
      btnFiltrar.addEventListener('click', cargarMetasConFiltro);
    }
  });
</script>

</body>

</html>