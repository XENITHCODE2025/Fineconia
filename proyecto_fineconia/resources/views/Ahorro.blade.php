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
        <p>Establece metas de ahorro personalizadas según tus necesidades. Define objetivos específicos, asigna montos y fechas límite, y calcula cuánto deberías ahorrar periódicamente para alcanzarlos.</p>
        <button class="custom-btn">Crear Objetivo</button>
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
    <div class="goal-section">
      <h3 class="fw-bold mb-3">Tus Objetivos de Ahorro</h3>
      <div class="goal-card">
        <h5>Vacaciones</h5>
        <p>$1,200 / $2,000</p>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: 60%"></div>
        </div>
        <p class="mt-2">FECHA LÍMITE: 15/07/2025</p>
        <button class="btn-goal">Añadir Ahorro</button>
      </div>
    </div>

  </div>

  <!-- Botón para mostrar el modal -->
<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearObjetivo">
    Crear Objetivo
</button>

<!-- Modal -->
<div class="modal fade" id="modalCrearObjetivo" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 15px;">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Objetivo</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearObjetivo">
  Crear Objetivo
</button>

      </div>
      <div class="modal-body">
        <form id="formObjetivo">
          @csrf
          <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" maxlength="100" required>
          </div>
          <div class="mb-3">
            <label>Monto meta</label>
            <input type="number" name="monto" class="form-control" step="0.01" min="1" required>
          </div>
          <div class="mb-3">
            <label>Fecha límite</label>
            <input type="date" name="fecha" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>


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