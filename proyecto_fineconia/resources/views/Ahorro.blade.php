<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fineconia - Ahorro</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  @vite('resources/css/Ahorro.css')
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo-container">
      <img src="img/LogoCompleto.jpg" alt="Logo" class="responsive-logo">
    </div>
    <div class="right-side">
      <div class="nav-links">
        <a class="btn nav-link" id="finanzas_personales">Finanzas Personales</a>
        <a class="btn nav-link" id="gastos_ingresos">Gastos e Ingresos</a>
        <a class="btn nav-link" id="presupuestos">Presupuestos</a>
        <a class="btn nav-link" id="ahorros">Ahorro</a>
      </div>
      @include('partials.header-user')
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
        <button id="btn-ver-consejo" class="custom-btn">Ver Consejo</button>
      </div>
    </div>

    <!-- Objetivos -->
    <div class="custom-card">
      <div class="custom-card-header">
        <i class="bi bi-bullseye"></i> Objetivos de Ahorro
      </div>
      <div class="custom-card-body">
        <p>Establece metas de ahorro personalizadas según tus necesidades. Define objetivos específicos, asigna montos y fechas límite, y calcula cuánto deberías ahorrar periódicamente para alcanzarlos.</p>
        <a href="{{ route('objetivos.nuevo') }}" class="custom-btn">Crear Objetivo</a>
      </div>
    </div>

    <div class="custom-card">
      <div class="custom-card-header">
        <i class="bi bi-graph-up"></i> Gráficos de Ahorro
      </div>
      <div class="custom-card-body">
        <p>Visualiza tu progreso con gráficos dinámicos. Consulta estadísticas por periodos de tiempo, observa cuánto has ahorrado en relación con lo planificado y detecta patrones en tu comportamiento.</p>
        <a href="{{ route('graficas.ahorro') }}" class="custom-btn">Ver Gráfica</a>
      </div>
    </div>


    <!-- Objetivos actuales -->
    <div class="goal-wrapper">
      <h3 class="goal-title">Tus Objetivos de Ahorro</h3>
      <div id="goals-container" class="goals-scroll-container">
        <!-- Las tarjetas se cargarán dinámicamente -->
      </div>
    </div>
  </div>

  <!-- Modal ABONAR -->
  <div class="modal fade" id="modalAbonar" tabindex="-1" aria-labelledby="modalAbonarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAbonarLabel">Gestión de Ahorro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <label for="cantidad">Cantidad a ingresar:</label>
          <input type="number" id="cantidad" class="form-control" placeholder="0.00">
          <div id="cantidad-error" style="display:none; color:red; font-size: 0.9em;">Cantidad inválida</div>

          <!-- Mostrar saldo actual del usuario -->
          <label id="saldoActualUsuario" class="fw-bold mt-3 d-block">
            Saldo actual: ${{ number_format($saldoDisponible, 2) }}
          </label>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button class="btn btn-dark" id="btnGuardarAbono" disabled>Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const objetivosEndpoint = "{{ route('objetivos.index') }}";
    let selectedGoal = null;
    // Variable para almacenar el saldo actual del usuario
    let saldoUsuario = parseFloat({{$saldoDisponible}});

    async function cargarObjetivos() {
      try {
        const res = await fetch(objetivosEndpoint);
        const objetivos = await res.json();
        const container = document.getElementById("goals-container");
        container.innerHTML = "";

        if (objetivos.length === 0) {
          container.innerHTML = `<div class="alert alert-info text-center w-100">No tienes objetivos de ahorro registrados.</div>`;
          return;
        } 

        // Crear tarjetas para cada objetivo
objetivos.forEach(goal => {
  const montoActual = parseFloat(goal.monto_ahorrado ?? 0);
  const montoMeta = parseFloat(goal.monto ?? 0);
  if (isNaN(montoMeta) || montoMeta === 0) return;

  const progreso = (montoActual / montoMeta) * 100;
  const card = document.createElement("div");
  card.classList.add("goal-card");
  card.dataset.meta = montoMeta;
  card.dataset.actual = montoActual;
  card.dataset.id = goal.id;

  let boton = "";
  if (montoActual >= montoMeta) {
    boton = `<button class="btn btn-success mt-2" disabled>Completado 🎉</button>`;
  } else {
    boton = `<button class="btn-goal btn btn-primary mt-2">Abonar</button>`;
  }

  card.innerHTML = `
    <h5>${goal.nombre}</h5>
    <p>$${montoActual.toLocaleString()} / $${montoMeta.toLocaleString()}</p>
    <div class="progress">
      <div class="progress-bar" style="width: ${Math.min(progreso, 100)}%"></div>
    </div>
    <p class="mt-2">FECHA LÍMITE: ${new Date(goal.fecha_hasta + 'T12:00:00').toLocaleDateString()}</p>
    ${boton}
  `;

  container.appendChild(card);
});
        

      } catch (error) {
        console.error("Error cargando objetivos:", error);
      }
    }

    document.addEventListener("DOMContentLoaded", () => {
      cargarObjetivos();

      // Navegación
      document.getElementById('finanzas_personales').addEventListener('click', () => window.location.href = "{{ route('finanzas.personales') }}");
      document.getElementById('gastos_ingresos').addEventListener('click', () => window.location.href = "{{ route('gastos-ingresos') }}");
      document.getElementById('presupuestos').addEventListener('click', () => window.location.href = "{{ route('presupuesto') }}");
      document.getElementById('ahorros').addEventListener('click', () => window.location.href = "{{ route('ahorro') }}");

      // Abrir modal al dar clic en Abonar
      document.addEventListener("click", function(e) {
        if (e.target && e.target.classList.contains("btn-goal")) {
          selectedGoal = e.target.closest(".goal-card");
          const modal = new bootstrap.Modal(document.getElementById("modalAbonar"));

          document.getElementById("cantidad").value = "";
          document.getElementById("btnGuardarAbono").disabled = true;
          document.getElementById("cantidad-error").style.display = "none";
          document.getElementById("cantidad").classList.remove("error");
          modal.show();
        }
      });

      const cantidadInput = document.getElementById("cantidad");
      const btnGuardar = document.getElementById("btnGuardarAbono");
      const errorDiv = document.getElementById("cantidad-error");
      const saldoUsuarioLabel = document.getElementById("saldoActualUsuario");

      function formatCurrency(value) {
        return `$${value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      }

      function actualizarSaldoUsuario() {
        saldoUsuarioLabel.innerText = `Saldo actual: ${formatCurrency(saldoUsuario)}`;
      }

cantidadInput.addEventListener("input", () => {
  let valor = parseFloat(cantidadInput.value);
  btnGuardar.disabled = true;
  errorDiv.style.display = "none";
  cantidadInput.classList.remove("error");

  let actual = parseFloat(selectedGoal.dataset.actual);
  let meta = parseFloat(selectedGoal.dataset.meta);
  let restante = meta - actual;

  if (isNaN(valor) || valor <= 0) {
    cantidadInput.classList.add("error");
    errorDiv.innerText = "Ingresa un monto válido mayor a 0";
    errorDiv.style.display = "block";
    return;
  }

  cantidadInput.value = Math.floor(valor * 100) / 100;

  // Validar saldo suficiente
  if (valor > saldoUsuario) {
    errorDiv.innerText = `No tienes suficiente saldo. Tu saldo actual es: ${formatCurrency(saldoUsuario)}`;
    errorDiv.style.display = "block";
    cantidadInput.classList.add("error");
    return;
  }

  // ✅ Validar que no supere lo restante
  if (valor > restante) {
    errorDiv.innerText = `El valor excede el restante necesario (${formatCurrency(restante)})`;
    errorDiv.style.display = "block";
    cantidadInput.classList.add("error");
    return; // ⛔ No habilitamos el botón
  }

  // ✅ Solo si todo es válido habilitamos Guardar
  btnGuardar.disabled = false;
});

      btnGuardar.addEventListener("click", async () => {
        let valor = parseFloat(cantidadInput.value);
        if (isNaN(valor) || valor <= 0) return;

        try {
          const res = await fetch(`/objetivos/${selectedGoal.dataset.id}/abonar`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
              cantidad: valor
            })
          });

          const data = await res.json();

          if (!res.ok) {
            alertify.error(data.error || "Error al abonar");
            return;
          }

          // ✅ Actualizar saldo local y tarjeta
          saldoUsuario -= valor;
          actualizarSaldoUsuario();

          // ✅ Actualizar dataset
selectedGoal.dataset.actual = data.nuevo_monto;

// ✅ Actualizar texto de montos
const montoParrafo = selectedGoal.querySelector("p:first-of-type");
montoParrafo.innerText =
  `$${parseFloat(data.nuevo_monto).toLocaleString()} / $${parseFloat(data.meta).toLocaleString()}`;

// ✅ Actualizar barra de progreso
const progressBarCard = selectedGoal.querySelector(".progress-bar");
const porcentaje = (data.nuevo_monto / data.meta) * 100;
progressBarCard.style.width = `${Math.min(porcentaje, 100)}%`;

// ✅ Si ya completó la meta, cambiar botón en vivo
if (data.nuevo_monto >= data.meta) {
  const btn = selectedGoal.querySelector(".btn-goal");
  if (btn) {
    btn.outerHTML = `<button class="btn btn-success mt-2" disabled>Completado 🎉</button>`;
  }
}

          alertify.success("Abono registrado correctamente ✅");

          // Cerrar modal
          setTimeout(() => {
            const modal = bootstrap.Modal.getInstance(document.getElementById("modalAbonar"));
            modal.hide();
          }, 1000);

        } catch (err) {
          console.error(err);
          alertify.error("Error de conexión");
        }
      });
    });
  </script>

  <script>
    document.getElementById("btn-ver-grafica").addEventListener("click", function() {
      window.location.href = "{{ route('graficas.ahorro') }}";
    });
  </script>

  <script>
    document.getElementById("btn-ver-consejo").addEventListener("click", function() {
      // Cambia los valores según el consejo que quieras mostrar
      const categoria = "metas";
      const consejo = 5;

      window.location.href = "{{ route('consejos.ahorro') }}" + `?categoria=${categoria}&consejo=${consejo}`;
    });
  </script>

</body>

</html>