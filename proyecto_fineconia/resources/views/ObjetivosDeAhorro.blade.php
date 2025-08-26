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

  <!-- ✅ AlertifyJS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <style>
    /* ✅ Botón dinámico */
    .btn-guardar {
      background-color: #2ecc71; /* Verde brillante */
      border: none;
      padding: 10px 20px;
      color: white;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-guardar:disabled {
      background-color: rgba(46, 204, 113, 0.5); /* Verde opaco */
      cursor: not-allowed;
    }

    /* ✅ Colores de validación */
    input.error {
      border: 2px solid #e74c3c; /* rojo */
      background-color: #fdecea;
    }
    input.success {
      border: 2px solid #2ecc71; /* verde */
      background-color: #ecfdf3;
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="logo-container">
      <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" class="responsive-logo">
    </div>
    <div class="menu">
      <a href="{{ route('gastos-ingresos') }}" class="nav-link {{ request()->routeIs('gastos.*') ? 'active' : '' }}">Gastos e ingresos</a>
      <a href="{{ route('objetivos.nuevo') }}" class="nav-link {{ request()->routeIs('objetivos.*') ? 'active' : '' }}">Objetivos de ahorro</a>
      <a href="{{ route('presupuesto') }}" class="nav-link {{ request()->routeIs('presupuestos.*') ? 'active' : '' }}">Presupuestos</a>
      @include('partials.header-user')
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </header>

  <nav class="mobile-menu" id="mobile-menu">
    <a href="{{ route('gastos-ingresos') }}">Gastos e ingresos</a>
    <a href="{{ route('objetivos.nuevo') }}">Objetivos de ahorro</a>
    <a href="{{ route('presupuesto') }}">Presupuestos</a>
  </nav>

  <main class="contenido">
    <div class="form-container">
      <h2>Nuevo objetivo de ahorro</h2>
      <form id="objetivo-form">
        <label for="nombre">Nombre del objetivo:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" min="1" required>

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

        <button type="submit" class="btn-guardar" disabled>Guardar</button>
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

    // ✅ Validación con feedback
    const form = document.getElementById('objetivo-form');
    const guardarBtn = document.querySelector('.btn-guardar');
    const nombre = document.getElementById('nombre');
    const monto = document.getElementById('monto');
    const desde = document.getElementById('desde');
    const hasta = document.getElementById('hasta');

    function marcarInput(input, valido) {
      if (valido) {
        input.classList.remove("error");
        input.classList.add("success");
      } else {
        input.classList.remove("success");
        input.classList.add("error");
      }
    }

    function validarFormulario() {
      let valido = true;

      // Nombre
      if (nombre.value.trim() === "") {
        marcarInput(nombre, false);
        valido = false;
      } else {
        marcarInput(nombre, true);
      }

      // Monto
      if (monto.value.trim() === "" || parseFloat(monto.value) <= 0) {
        marcarInput(monto, false);
        valido = false;
      } else {
        marcarInput(monto, true);
      }

      // Fechas
      if (desde.value === "" || hasta.value === "") {
        marcarInput(desde, false);
        marcarInput(hasta, false);
        valido = false;
      } else {
        const fechaDesde = new Date(desde.value);
        const fechaHasta = new Date(hasta.value);
        if (fechaHasta < fechaDesde) {
          marcarInput(desde, false);
          marcarInput(hasta, false);
          valido = false;
        } else {
          marcarInput(desde, true);
          marcarInput(hasta, true);
        }
      }

      guardarBtn.disabled = !valido;
    }

    [nombre, monto, desde, hasta].forEach(input => {
      input.addEventListener("input", validarFormulario);
      input.addEventListener("change", validarFormulario);
    });

    form.addEventListener("submit", (e) => {
      e.preventDefault();
      let errores = [];

      if (nombre.value.trim() === "") {
        errores.push("El campo 'Nombre del objetivo' es obligatorio.");
      }

      if (monto.value.trim() === "" || parseFloat(monto.value) <= 0) {
        errores.push("El campo 'Monto' debe ser mayor a 0.");
      }

      if (desde.value === "" || hasta.value === "") {
        errores.push("Debes seleccionar las fechas.");
      } else {
        const fechaDesde = new Date(desde.value);
        const fechaHasta = new Date(hasta.value);
        if (fechaHasta < fechaDesde) {
          errores.push("La fecha 'Hasta' no puede ser menor que la fecha 'Desde'.");
        }
      }

      if (errores.length > 0) {
        alertify.error(errores.join("<br>"));
      } else {
        alertify.success("¡Objetivo guardado correctamente!");
        form.submit();
      }
    });

    window.addEventListener("load", validarFormulario);
  </script>
</body>
</html>