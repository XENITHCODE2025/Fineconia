<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Historial</title>
  <!-- AlertifyJS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css">
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- Iconos y fuentes -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

  @vite('resources/css/historial.css')
</head>
<body>
  <header class="header">
    <div class="logo-container">
      <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" class="responsive-logo">
    </div>
    <div class="menu">
      <a href="{{ route('ahorro') }}" class="nav-link">Ahorro</a>
      <a href="{{ route('consejos.ahorro') }}" class="nav-link">Consejos</a>
      <a href="{{ route('objetivos.nuevo') }}" class="nav-link">Objetivos</a>
      <a href="{{ route('graficas.ahorro') }}" class="nav-link">Gráficas</a>
      <a href="{{ route('historial') }}" class="nav-link active">Historial</a>
    </div>
    <div class="menu-toggle" id="menu-toggle">
      <i class="fas fa-bars"></i>
    </div>
  </header>

  <nav class="mobile-menu" id="mobile-menu">
    <a href="{{ route('ahorro') }}" class="mobile-nav-link">Ahorro</a>
    <a href="{{ route('consejos.ahorro') }}" class="mobile-nav-link">Consejos</a>
    <a href="{{ route('objetivos.nuevo') }}" class="mobile-nav-link">Objetivos</a>
    <a href="{{ route('graficas.ahorro') }}" class="mobile-nav-link">Gráficas</a>
    <a href="{{ route('historial') }}" class="mobile-nav-link active">Historial</a>
  </nav>

  <main class="contenido">
    <div class="historial-wrapper">
      <h2 class="titulo">Historial de Abono</h2>

      <div class="panel-historial">
        <div class="buscador">
          <span class="buscador-titulo">Buscar objetivo</span>
          <div class="filtros">
            <div>
              <label for="fecha-desde">Desde:</label>
              <input type="date" id="fecha-desde" name="fecha-desde">
            </div>
            <div>
              <label for="fecha-hasta">Hasta:</label>
              <input type="date" id="fecha-hasta" name="fecha-hasta">
            </div>
            <div>
              <label for="objetivo">Objetivo:</label>
              <select id="objetivo" name="objetivo">
                <option value="">Seleccionar</option>
                <option value="alimentacion">Alimentación</option>
                <option value="transporte">Transporte</option>
                <option value="educacion">Educación</option>
              </select>
            </div>
            <div class="boton-buscar-container">
              <button class="btn-buscar" id="btn-buscar">Buscar</button>
            </div>
          </div>
        </div>

        <div class="tabla-container" id="tabla-container">
          <table class="tabla-historial" id="tabla-historial">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Nombre de Objetivo</th>
                <th>Monto Objetivo</th>
                <th>Monto Abonado</th>
                <th>Restante</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody id="tabla-body"></tbody>
          </table>
          <div class="no-results" id="no-results" style="display:none;">No se encontraron resultados para su búsqueda</div>
        </div>
      </div>
    </div>
  </main>

  <footer class="footer">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

  <script>
    // Menú móvil
    document.getElementById("menu-toggle").addEventListener("click", () => {
      document.getElementById("mobile-menu").classList.toggle("active");
    });
    window.addEventListener("resize", () => {
      if(window.innerWidth > 768) document.getElementById("mobile-menu").classList.remove("active");
    });
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
      link.addEventListener('click', () => document.getElementById('mobile-menu').classList.remove('active'));
    });

    // Datos de ejemplo
    const registros = [
      { fecha: '2025-06-05', objetivo: 'Alimentación', monto: 800, abonado: 0, estado: 'Pendiente' },
      { fecha: '2025-06-05', objetivo: 'Alimentación', monto: 900, abonado: 800, estado: 'En proceso' },
      { fecha: '2025-06-05', objetivo: 'Alimentación', monto: 800, abonado: 800, estado: 'Finalizado' },
    ];

    const tablaBody = document.getElementById('tabla-body');
    const noResults = document.getElementById('no-results');

    function renderTabla(filtrados) {
      tablaBody.innerHTML = '';
      if(filtrados.length === 0) {
        noResults.style.display = 'block';
        return;
      }
      noResults.style.display = 'none';
      filtrados.forEach(r => {
        const restante = r.monto - r.abonado;
        tablaBody.innerHTML += `
          <tr class="${r.estado.toLowerCase().replace(' ', '-')}">
            <td>${r.fecha}</td>
            <td>${r.objetivo}</td>
            <td>$${r.monto.toFixed(2)}</td>
            <td>$${r.abonado.toFixed(2)}</td>
            <td>$${restante.toFixed(2)}</td>
            <td>${r.estado}</td>
          </tr>
        `;
      });
    }

    document.getElementById('btn-buscar').addEventListener('click', () => {
      try {
        const desde = document.getElementById('fecha-desde').value;
        const hasta = document.getElementById('fecha-hasta').value;
        const objetivo = document.getElementById('objetivo').value;

        if((desde && !hasta) || (!desde && hasta)) { alertify.error('Debe seleccionar ambas fechas para filtrar por rango'); return; }
        if(desde && hasta && desde > hasta) { alertify.error('La fecha "Desde" no puede ser mayor a la fecha "Hasta"'); return; }

        let filtrados = registros;
        if(objetivo) filtrados = filtrados.filter(r => r.objetivo === objetivo);
        if(desde && hasta) filtrados = filtrados.filter(r => r.fecha >= desde && r.fecha <= hasta);

        renderTabla(filtrados);
      } catch (error) {
        alertify.error("Ocurrió un error al cargar los datos. Intente nuevamente.");
      }
    });

    // Inicialmente mostrar todos los registros
    renderTabla(registros);
  </script>
</body>
</html>