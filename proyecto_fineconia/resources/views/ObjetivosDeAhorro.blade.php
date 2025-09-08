</html><!DOCTYPE html>
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

// Objeto para rastrear si los campos han sido interactuados
const campoInteractuado = {
  nombre: false,
  monto: false,
  desde: false,
  hasta: false
};

function actualizarIcono(input, valido, iconId, esFecha = false) {
  const iconElement = document.getElementById(iconId);
  
  // Solo mostrar icono si el campo ha sido interactuado
  if (campoInteractuado[input.id]) {
    if (valido) {
      iconElement.innerHTML = '<i class="fas fa-check-circle"></i>';
      iconElement.classList.add('show');
      input.classList.remove("error");
      input.classList.add("success");
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

  // Fechas
  if (desde.value === "" || hasta.value === "") {
    actualizarIcono(desde, false, 'icon-desde', true);
    actualizarIcono(hasta, false, 'icon-hasta', true);
    valido = false;
  } else {
    const fechaDesde = new Date(desde.value);
    const fechaHasta = new Date(hasta.value);
    if (fechaHasta < fechaDesde) {
      actualizarIcono(desde, false, 'icon-desde', true);
      actualizarIcono(hasta, false, 'icon-hasta', true);
      valido = false;
    } else {
      actualizarIcono(desde, true, 'icon-desde', true);
      actualizarIcono(hasta, true, 'icon-hasta', true);
    }
  }

  guardarBtn.disabled = !valido;
}

// Event listeners para marcar campos como interactuados
[nombre, monto, desde, hasta].forEach(input => {
  input.addEventListener("input", function() {
    campoInteractuado[this.id] = true;
    validarFormulario();
  });
  input.addEventListener("change", function() {
    campoInteractuado[this.id] = true;
    validarFormulario();
  });
  input.addEventListener("blur", function() {
    campoInteractuado[this.id] = true;
    validarFormulario();
  });
});

form.addEventListener("submit", (e) => {
  let errores = [];

  Object.keys(campoInteractuado).forEach(key => campoInteractuado[key] = true);
  validarFormulario();

  if (nombre.value.trim() === "") errores.push("El campo 'Nombre del objetivo' es obligatorio.");
  if (monto.value.trim() === "" || parseFloat(monto.value) <= 0) errores.push("El campo 'Monto' debe ser mayor a 0.");
  if (desde.value === "" || hasta.value === "") {
    errores.push("Debes seleccionar las fechas.");
  } else {
    const fechaDesde = new Date(desde.value);
    const fechaHasta = new Date(hasta.value);
    if (fechaHasta < fechaDesde) errores.push("La fecha 'Hasta' no puede ser menor que la fecha 'Desde'.");
  }

  if (errores.length > 0) {
    e.preventDefault(); // 🚨 detiene envío si hay errores
    alertify.error(errores.join("<br>"));
  }
});

// Agregar esto después de definir las variables de los campos
const btnCancelar = document.getElementById('btn-cancelar');

// Función para verificar si hay campos con datos
function hayCamposConDatos() {
  return nombre.value.trim() !== '' || 
         monto.value.trim() !== '' || 
         desde.value !== '' || 
         hasta.value !== '';
}

// Función para actualizar el estado del botón Cancelar
function actualizarBotonCancelar() {
  btnCancelar.disabled = !hayCamposConDatos();
}

// Detectar error inmediato al cambiar las fechas
desde.addEventListener("change", validarFechasInmediato);
hasta.addEventListener("change", validarFechasInmediato);

// ✅ Función para limpiar campos (cancelar)
btnCancelar.addEventListener('click', function() {
  if (hayCamposConDatos()) {
    // Limpiar campos
    nombre.value = '';
    monto.value = '';
    desde.value = '';
    hasta.value = '';
    
    // Restablecer estado de interacción
    Object.keys(campoInteractuado).forEach(key => {
      campoInteractuado[key] = false;
    });
    
    // Restablecer estilos
    document.querySelectorAll('.input-icon').forEach(icon => {
      icon.classList.remove('show');
    });
    
    document.querySelectorAll('input').forEach(input => {
      input.classList.remove('error');
      input.classList.remove('success');
    });
    
    // Deshabilitar botones
    guardarBtn.disabled = true;
    btnCancelar.disabled = true;
    
  }
});

// Event listeners para actualizar el estado del botón Cancelar
[nombre, monto, desde, hasta].forEach(input => {
  input.addEventListener("input", function() {
    campoInteractuado[this.id] = true;
    validarFormulario();
    actualizarBotonCancelar();
  });
  input.addEventListener("change", function() {
    campoInteractuado[this.id] = true;
    validarFormulario();
    actualizarBotonCancelar();
  });
  input.addEventListener("blur", function() {
    campoInteractuado[this.id] = true;
    validarFormulario();
    actualizarBotonCancelar();
  });
});

// Inicializar estado del botón Cancelar
window.addEventListener("load", function() {
  validarFormulario();
  actualizarBotonCancelar();
});

// Cerrar menú móvil al hacer clic en un enlace
document.querySelectorAll('.mobile-nav-link').forEach(link => {
  link.addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.remove('active');
  });
});

window.addEventListener("load", validarFormulario);

// ✅ Detectar cambio en las fechas y mostrar mensaje inmediato si son inválidas
function validarFechasInmediato() {
  const fechaDesde = new Date(desde.value);
  const fechaHasta = new Date(hasta.value);

  if (desde.value && hasta.value && fechaHasta < fechaDesde) {
    alertify.error("La fecha final no puede ser menor que la inicial.");
  }
}

  </script>
</body>
</html>