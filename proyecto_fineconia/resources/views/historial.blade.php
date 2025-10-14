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

  <style>
    /* --- Estilo adicional para el límite de la tabla --- */
    .tabla-container {
      max-height: 285px;
      overflow-y: auto;
      border: 1px solid #ddd;
      border-radius: 6px;
    }

    .tabla-historial {
      width: 100%;
      border-collapse: collapse;
    }

    .tabla-historial th,
    .tabla-historial td {
      padding: 10px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    .tabla-historial thead {
      background-color: #62AF46;
      color: #fff;
      position: sticky;
      top: 0;
      z-index: 1;
    }

    .tabla-container::-webkit-scrollbar {
      width: 6px;
    }

    .tabla-container::-webkit-scrollbar-thumb {
      background: #62AF46;
      border-radius: 10px;
    }

    .tabla-container::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
  </style>
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
              </select>
            </div>
            <div class="boton-buscar-container">
              <button class="btn-buscar" id="btn-buscar">Buscar</button>
              <button class="btn-limpiar" id="btn-limpiar">Limpiar</button>
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
    // --- Menú móvil ---
    document.getElementById("menu-toggle").addEventListener("click", () => {
      document.getElementById("mobile-menu").classList.toggle("active");
    });
    window.addEventListener("resize", () => {
      if(window.innerWidth > 768) document.getElementById("mobile-menu").classList.remove("active");
    });
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
      link.addEventListener('click', () => document.getElementById('mobile-menu').classList.remove('active'));
    });

    const tablaBody = document.getElementById('tabla-body');
    const noResults = document.getElementById('no-results');
    const selectObjetivo = document.getElementById('objetivo');

    // --- Cargar objetivos ---
    async function cargarObjetivos() {
      try {
        const res = await fetch('/historial/objetivos');
        const data = await res.json();
        if (data.status === 'success') {
          data.data.forEach(obj => {
            const option = document.createElement('option');
            option.value = obj.nombre;
            option.textContent = obj.nombre;
            selectObjetivo.appendChild(option);
          });
        }
      } catch (err) {
        alertify.error("Error al cargar los objetivos.");
      }
    }

    // --- Renderizar tabla ---
    function renderTabla(filtrados) {
      tablaBody.innerHTML = '';
      if (filtrados.length === 0) {
        noResults.style.display = 'block';
        return;
      }
      noResults.style.display = 'none';
      filtrados.forEach(r => {
        tablaBody.innerHTML += `
          <tr class="${r.estado.toLowerCase().replace(' ', '-')}">
            <td>${r.fecha}</td>
            <td>${r.nombre}</td>
            <td>$${parseFloat(r.monto).toFixed(2)}</td>
            <td>$${parseFloat(r.monto_ahorrado).toFixed(2)}</td>
            <td>$${parseFloat(r.restante).toFixed(2)}</td>
            <td>${r.estado}</td>
          </tr>
        `;
      });
    }

    // --- Buscar historial ---
    document.getElementById('btn-buscar').addEventListener('click', async () => {
      try {
        const desde = document.getElementById('fecha-desde').value;
        const hasta = document.getElementById('fecha-hasta').value;
        const objetivo = document.getElementById('objetivo').value;

        if ((desde && !hasta) || (!desde && hasta)) {
          alertify.error('Debe seleccionar ambas fechas para filtrar por rango');
          return;
        }
        if (desde && hasta && desde > hasta) {
          alertify.error('La fecha "Desde" no puede ser mayor a la fecha "Hasta"');
          return;
        }

        const params = new URLSearchParams({
          fecha_desde: desde,
          fecha_hasta: hasta,
          objetivo: objetivo
        });

        const response = await fetch(`/historial/abonos?${params.toString()}`);
        const data = await response.json();

        if (data.status === 'error') {
          tablaBody.innerHTML = '';
          noResults.style.display = 'block';
          alertify.warning(data.message);
        } else {
          renderTabla(data.data);
        }
      } catch (error) {
        alertify.error("Ocurrió un error al cargar los datos. Intente nuevamente.");
      }
    });

    // --- Botón limpiar ---
    document.getElementById('btn-limpiar').addEventListener('click', async () => {
      document.getElementById('fecha-desde').value = '';
      document.getElementById('fecha-hasta').value = '';
      document.getElementById('objetivo').value = '';
      const res = await fetch('/historial/abonos');
      const data = await res.json();
      if (data.status === 'success') renderTabla(data.data);
      alertify.success("Filtros limpiados y datos restaurados.");
    });

    // --- Inicialización ---
    window.onload = async () => {
      await cargarObjetivos();
      const res = await fetch('/historial/abonos');
      const data = await res.json();
      if (data.status === 'success') renderTabla(data.data);
    };
  </script>
</body>
</html>