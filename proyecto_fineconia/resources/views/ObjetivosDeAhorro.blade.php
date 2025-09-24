<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Plantilla principal</title>
    @vite('resources/css/ObjetivosDeAhorro.css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

  <!-- ✅ AlertifyJS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</head>
@if(session('success'))
<script>
    alertify.success("{{ session('success') }}");
</script>
@endif
@if(session('error'))
<script>
    alertify.error("{{ session('error') }}");
</script>
@endif
<body>
  <header class="header">
    <div class="logo-container">
      <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" class="responsive-logo">
    </div>
    <div class="menu">
      <!-- Solo los 4 enlaces solicitados -->
      <a href="{{ route('ahorro') }}" class="nav-link">Ahorro</a>
      <a href="{{ route('consejos.ahorro') }}" class="nav-link">Consejos</a>
      <a href="{{ route('objetivos.nuevo') }}" class="nav-link {{ request()->routeIs('objetivos.*') ? 'active' : '' }}">Objetivos</a>
      <a href="{{ route('graficas.ahorro') }}" class="nav-link">Gráficas</a>
    </div>

    <div class="menu-toggle" id="menu-toggle">
    <i class="fas fa-bars"></i>
  </header>

 <nav class="mobile-menu" id="mobile-menu">
  <a href="{{ route('ahorro') }}" class="mobile-nav-link {{ request()->routeIs('ahorro') ? 'active' : '' }}">Ahorro</a>
  <a href="{{ route('consejos.ahorro') }}" class="mobile-nav-link {{ request()->is('consejos') ? 'active' : '' }}">Consejos</a>
  <a href="{{ route('objetivos.nuevo') }}" class="mobile-nav-link {{ request()->routeIs('objetivos.*') ? 'active' : '' }}">Objetivos</a>
  <a href="{{ route('graficas.ahorro') }}" class="mobile-nav-link {{ request()->routeIs('graficas.ahorro') ? 'active' : '' }}">Gráficas</a>
</nav>

  <main class="contenido">
    <div class="form-container">
      <h2>Nuevo objetivo de ahorro</h2>
      <form id="objetivo-form" action="{{ route('objetivos.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre del objetivo:</label>
        <div class="input-container">
          <input type="text" id="nombre" name="nombre" required>
          <span class="input-icon" id="icon-nombre"></span>
        </div>

        <label for="monto">Monto:</label>
        <div class="input-container">
          <input type="number" id="monto" name="monto" min="1" required>
          <span class="input-icon" id="icon-monto"></span>
        </div>

        <label>Fecha del objetivo</label>
        <div class="fechas">
          <div class="fecha-item">
            <label for="desde">Desde:</label>
            <div class="fecha-input-wrapper">
              <input type="date" id="desde" name="fecha_desde" required>
              <span class="fecha-icon" id="icon-desde"></span>
            </div>
          </div>
          <div class="fecha-item">
            <label for="hasta">Hasta:</label>
            <div class="fecha-input-wrapper">
              <input type="date" id="hasta" name="fecha_hasta" required>
              <span class="fecha-icon" id="icon-hasta"></span>
            </div>
          </div>
        </div>

        <div class="botones-container">
          <button type="button" class="btn-cancelar" id="btn-cancelar" disabled>Cancelar</button>
          <button type="submit" class="btn-guardar" disabled>Guardar</button>
        </div>
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

    const form = document.getElementById('objetivo-form');
    const guardarBtn = document.querySelector('.btn-guardar');
    const btnCancelar = document.getElementById('btn-cancelar');

    const nombre = document.getElementById('nombre');
    const monto = document.getElementById('monto');
    const desde = document.getElementById('desde');
    const hasta = document.getElementById('hasta');

    const campoInteractuado = {
      nombre: false,
      monto: false,
      desde: false,
      hasta: false
    };

    // Objeto para rastrear errores ya mostrados
    const erroresMostrados = {
      fechaDesdePasado: false,
      fechaHastaAnterior: false
    };

    function actualizarIcono(input, valido, iconId) {
      const iconElement = document.getElementById(iconId);

      if (input.value.trim() === '') {
        iconElement.classList.remove('show');
        iconElement.innerHTML = '';
        input.classList.remove('error');
        input.classList.remove('success');
        return;
      }

      if (campoInteractuado[input.id]) {
        if (valido) {
          iconElement.innerHTML = '<i class="fas fa-check-circle"></i>';
          iconElement.classList.add('show');
          input.classList.remove("error");
          input.classList.add("success");
          
          // Cuando se corrige un error, resetear su estado de mostrado
          if (input.id === 'desde') {
            erroresMostrados.fechaDesdePasado = false;
          } else if (input.id === 'hasta') {
            erroresMostrados.fechaHastaAnterior = false;
          }
        } else {
          iconElement.innerHTML = '<i class="fas fa-times-circle"></i>';
          iconElement.classList.add('show');
          input.classList.remove("success");
          input.classList.add("error");
        }
      } else {
        iconElement.classList.remove('show');
        input.classList.remove("success");
        input.classList.remove("error");
      }
    }

    function validarFormulario() {
      let valido = true;
      const erroresInmediatos = [];

      const fechaDesde = desde.value;
      const fechaHasta = hasta.value;
      const hoyStr = new Date().toISOString().split('T')[0]; // Formato "YYYY-MM-DD"

      // Nombre
      if (nombre.value.trim() === "") {
        actualizarIcono(nombre, false, 'icon-nombre');
        valido = false;
      } else {
        actualizarIcono(nombre, true, 'icon-nombre');
      }

      // Monto
      if (monto.value.trim() === "" || parseFloat(monto.value) <= 0) {
        actualizarIcono(monto, false, 'icon-monto');
        valido = false;
      } else {
        actualizarIcono(monto, true, 'icon-monto');
      }

      // Fecha Desde
      if (fechaDesde === "") {
        actualizarIcono(desde, false, 'icon-desde');
        valido = false;
        erroresMostrados.fechaDesdePasado = false; // Resetear si está vacío
      } else if (fechaDesde < hoyStr) {
        actualizarIcono(desde, false, 'icon-desde');
        valido = false;
        
        // Solo mostrar el error si no se ha mostrado antes
        if (!erroresMostrados.fechaDesdePasado) {
          erroresInmediatos.push("La fecha Desde tiene que ser igual o mayor a la actual");
          erroresMostrados.fechaDesdePasado = true;
        }
      } else {
        actualizarIcono(desde, true, 'icon-desde');
        erroresMostrados.fechaDesdePasado = false; // Resetear cuando es válido
      }

      // Fecha Hasta
      if (fechaHasta === "") {
        actualizarIcono(hasta, false, 'icon-hasta');
        valido = false;
        erroresMostrados.fechaHastaAnterior = false; // Resetear si está vacío
      } else if (fechaHasta <= fechaDesde) {
        actualizarIcono(hasta, false, 'icon-hasta');
        valido = false;
        
        // Solo mostrar el error si no se ha mostrado antes
        if (!erroresMostrados.fechaHastaAnterior) {
          erroresInmediatos.push("La fecha Hasta debe ser mayor a la fecha Desde");
          erroresMostrados.fechaHastaAnterior = true;
        }
      } else {
        actualizarIcono(hasta, true, 'icon-hasta');
        erroresMostrados.fechaHastaAnterior = false; // Resetear cuando es válido
      }

      // Mostrar errores solo si hay nuevos
      if (erroresInmediatos.length > 0) {
        alertify.error(erroresInmediatos.join("<br>"));
      }

      guardarBtn.disabled = !valido;
    }

    function hayCamposConDatos() {
      return nombre.value.trim() !== '' ||
            monto.value.trim() !== '' ||
            desde.value !== '' ||
            hasta.value !== '';
    }

    function actualizarBotonCancelar() {
      btnCancelar.disabled = !hayCamposConDatos();
    }

    [nombre, monto, desde, hasta].forEach(input => {
      input.addEventListener("input", function () {
        campoInteractuado[this.id] = true;
        validarFormulario();
        actualizarBotonCancelar();
      });

      input.addEventListener("change", function () {
        campoInteractuado[this.id] = true;
        validarFormulario();
        actualizarBotonCancelar();
      });

      input.addEventListener("blur", function () {
        campoInteractuado[this.id] = true;
        validarFormulario();
        actualizarBotonCancelar();
      });
    });

    // ✅ Botón Cancelar con confirmación
btnCancelar.addEventListener('click', function () {
  if (hayCamposConDatos()) {

    alertify.confirm(
      "¿Está seguro que desea cancelar?",
      function () {
        // ✅ Botón Sí: limpiar formulario
        nombre.value = '';
        monto.value = '';
        desde.value = '';
        hasta.value = '';

        Object.keys(campoInteractuado).forEach(key => {
          campoInteractuado[key] = false;
        });

        Object.keys(erroresMostrados).forEach(key => {
          erroresMostrados[key] = false;
        });

        document.querySelectorAll('.input-icon, .fecha-icon').forEach(icon => {
          icon.classList.remove('show');
          icon.innerHTML = '';
        });

        document.querySelectorAll('input').forEach(input => {
          input.classList.remove('error');
          input.classList.remove('success');
        });

        guardarBtn.disabled = true;
        btnCancelar.disabled = true;

        alertify.success('Acción cancelada');
      },
    )
    .set('labels', {ok:'Sí', cancel:'No'})
    .set('closable', true) // permite cerrar con X
    .set('title', '')      // header vacío
    .set('onclose', function () {
      // ✅ Solo mensaje si se cierra con X
      const dialog = document.querySelector('.ajs-dialog');
      if (dialog && !dialog.dataset.cerradoPorBoton) {
        alertify.error('Acción cancelada');
      }
    });

    // ✅ Marcar que se cerró por botón para que onclose no lo vuelva a disparar
    const okBtn = document.querySelector('.ajs-ok');
    const cancelBtn = document.querySelector('.ajs-cancel');

    okBtn.onclick = () => document.querySelector('.ajs-dialog').dataset.cerradoPorBoton = true;
    cancelBtn.onclick = () => document.querySelector('.ajs-dialog').dataset.cerradoPorBoton = true;
  }
});

    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      
      let errores = [];

      Object.keys(campoInteractuado).forEach(key => campoInteractuado[key] = true);
      validarFormulario();

      const hoyStr = new Date().toISOString().split('T')[0];

      if (nombre.value.trim() === "") errores.push("El campo 'Nombre del objetivo' es obligatorio.");
      if (monto.value.trim() === "" || parseFloat(monto.value) <= 0) errores.push("El campo 'Monto' debe ser mayor a 0.");
      if (desde.value === "") {
        errores.push("Debes seleccionar la fecha Desde.");
      } else if (desde.value < hoyStr) {
        errores.push("La fecha Desde tiene que ser igual o mayor a la actual.");
      }

      if (hasta.value === "") {
        errores.push("Debes seleccionar la fecha Hasta.");
      } else if (hasta.value <= desde.value) {
        errores.push("La fecha Hasta debe ser mayor a la fecha Desde.");
      }

      if (errores.length > 0) {
        alertify.error(errores.join("<br>"));
        return;
      }

      // ✅ Verificar límite de objetivos antes de enviar
      try {
        const response = await fetch('{{ route("objetivos.count") }}', {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        });

        const data = await response.json();
        
        if (data.count >= 100) {
          alertify.error('Has alcanzado el límite máximo de objetivos.');
          return;
        }

        // Si todo está bien, enviar el formulario
        form.submit();
      } catch (error) {
        console.error('Error:', error);
        alertify.error('Error al verificar el límite de objetivos.');
      }
    });

    window.addEventListener("load", function () {
      validarFormulario();
      actualizarBotonCancelar();
    });

    document.querySelectorAll('.mobile-nav-link').forEach(link => {
      link.addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.remove('active');
      });
    });
  </script>
</body>
</html>