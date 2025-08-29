<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fineconia - Ahorro</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  @vite('resources/css/Ahorro.css')
</head>
<body>

  <!-- Navbar 
   aaaa-->
  <nav class="navbar">
    <div class="logo-container">
     <img src="img/LogoCompleto.jpg"  alt="Logo"  style="height: 100px;">
    </div>
    <div class="right-side">
      <div class="nav-links">
        <a class="btn nav-link" id ="finanzas_personales">Finanzas Personales</a>
        <a class="btn nav-link" id="gastos_ingresos">Gastos e Ingresos</a>
        <a class="btn nav-link" id="presupuestos">Presupuestos</a>
        <a class="btn nav-link" id="ahorros">Ahorro</a>
      </div>
       @include('partials.header-user')  {{-- ← nuevo partial --}}
    </div>
  </nav>

  <!-- Header -->
  <div class="header">
    <h1>AHORRO</h1>
    <p>Optimiza tu capacidad de ahorro con esta sección dedicada. Aquí recibirás recomendaciones personalizadas para ahorrar y podrás configurar tus propios objetivos de ahorro. Además, tendrás acceso a gráficos de ahorro que te permitirán seguir tu progreso y mantenerte motivado hacia tus metas financieras.</p>
  </div>

  <!-- Secciones -->
  <div class="container">

    <!-- Recomendaciones -->
    <div class="custom-card">
      <div class="custom-card-header">
        <i class="bi bi-sliders"></i> Recomendaciones
      </div>
      <div class="custom-card-body">
        <p>Accede a consejos prácticos y estrategias adaptadas para mejorar tus hábitos de ahorro. Aprenderás a identificar gastos innecesarios, aprovechar mejor tus ingresos y aplicar métodos sencillos como el 50/30/20.</p>
        <button class="custom-btn">Ver Consejo</button>
      </div>
    </div>

   <!-- Objetivos -->
<div class="custom-card">
  <div class="custom-card-header">
    <i class="bi bi-bullseye"></i> Objetivos de Ahorro
  </div>
  <div class="custom-card-body">
    <p>
      Establece metas de ahorro personalizadas según tus necesidades. Define objetivos específicos, asigna montos y fechas límite, y calcula cuánto deberías ahorrar periódicamente para alcanzarlos.
    </p>
    <a href="{{ route('objetivos.nuevo') }}" class="custom-btn">Crear Objetivo</a>
  </div>
</div>


    <!-- Gráficos -->
    <div class="custom-card">
      <div class="custom-card-header">
        <i class="bi bi-graph-up"></i> Gráficos de Ahorro
      </div>
      <div class="custom-card-body">
        <p>Visualiza tu progreso con gráficos dinámicos. Consulta estadísticas por periodos de tiempo, observa cuánto has ahorrado en relación con lo planificado y detecta patrones en tu comportamiento.</p>
        <button class="custom-btn">Ver Gráfica</button>
      </div>
    </div>

  <!-- Objetivos actuales -->
<div class="goal-wrapper">
  <h3 class="goal-title">Tus Objetivos de Ahorro</h3>
  <div id="goals-container" class="goals-scroll-container">
    <!-- Las tarjetas se cargarán dinámicamente -->
  </div>
</div>

<script>
  const objetivosEndpoint = "{{ route('objetivos.index') }}"; // Se define desde Blade
</script>

<script>
  async function cargarObjetivos() {
    try {
      const res = await fetch(objetivosEndpoint);
      const objetivos = await res.json();
      console.log("Objetivos cargados:", objetivos);

      const container = document.getElementById("goals-container");
      if (!container) {
        console.error("No se encontró el contenedor de objetivos.");
        return;
      }

      container.innerHTML = ""; // Limpia el contenedor

      if (objetivos.length === 0) {
        container.innerHTML = `
          <div class="alert alert-info text-center w-100">No tienes objetivos de ahorro registrados.</div>
        `;
        return;
      }

      objetivos.forEach(goal => {
        const montoActual = parseFloat(goal.actual ?? 0);
        const montoMeta = parseFloat(goal.monto ?? 0);
        if (isNaN(montoMeta) || montoMeta === 0) return;

        const progreso = (montoActual / montoMeta) * 100;

        const card = document.createElement("div");
        card.classList.add("goal-card");

        card.innerHTML = `
          <h5>${goal.nombre}</h5>
          <p>$${montoActual.toLocaleString()} / $${montoMeta.toLocaleString()}</p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: ${progreso}%"></div>
          </div>
          <p class="mt-2">FECHA LÍMITE: ${new Date(goal.fecha_hasta).toLocaleDateString()}</p>
          <button class="btn-goal">Abonar</button>
        `;

        container.appendChild(card);
      });
    } catch (error) {
      console.error("Error cargando objetivos:", error);
    }
  }

}

document.addEventListener("DOMContentLoaded", cargarObjetivos);
 </script>



  document.addEventListener("DOMContentLoaded", cargarObjetivos);
</script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Aquí puedes añadir funcionalidad JavaScript para los presupuestos
      console.log('Página de ahorro cargada');
      
      // Ejemplo: Podrías añadir eventos para los botones
      const buttons = document.querySelectorAll('.custom-btn, .btn-goal');
      buttons.forEach(button => {
        button.addEventListener('click', function() {
          const action = this.textContent.trim();
          console.log(`Acción: ${action}`);
          // Aquí podrías redirigir a diferentes secciones o mostrar modales
        });
      });
    });
  </script>
 
  <script>
document.getElementById('formObjetivo').addEventListener('submit', async function (e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  try {
    const res = await fetch("{{ route('objetivos.store') }}", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      },
      body: formData
    });

    const data = await res.json();

    if (data.status === 'ok') {
      alertify.success('¡Objetivo guardado con éxito!');
      form.reset();
      const modalElement = document.getElementById('modalCrearObjetivo');
      const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
      modal.hide();
    } else {
      alertify.error('Algo salió mal al guardar.');
    }
  } catch (error) {
    alertify.error('Error en la conexión con el servidor.');
    console.error(error);
  }
});

</script>

  <!-- Enlaces a las vistas de Finanzas Personales, Gastos e Ingresos, Presupuesto y Ahorro
   probando github -->
<script>
  document.getElementById('finanzas_personales').addEventListener('click', function() {
    window.location.href = "{{ route('finanzas.personales') }}";
  });
  document.getElementById('gastos_ingresos').addEventListener('click', function() {
    window.location.href = "{{ route('gastos-ingresos') }}";
  })
  document.getElementById('presupuestos').addEventListener('click', function() {
    window.location.href = "{{ route('presupuesto') }}";
  });
  document.getElementById('ahorros').addEventListener('click', function() {
    window.location.href = "{{ route('ahorro') }}";
  });
</script>
</body>
</html> 