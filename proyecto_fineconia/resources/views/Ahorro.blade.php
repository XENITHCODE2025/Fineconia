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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  @vite('resources/css/Ahorro.css')

  <!-- 🔹 IMPORTACIÓN DE PONPINS -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<header class="header">
  <!-- Logo -->
  <div class="logo-container">
    <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" class="responsive-logo">
  </div>

  <!-- Menú escritorio -->
  <div class="menu">
    <a href="{{ route('finanzas.personales') }}" class="nav-link" id="finanzas_personales">Finanzas Personales</a>
    <a href="{{ route('gastos-ingresos') }}" class="nav-link" id="gastos_ingresos">Gastos e Ingresos</a>
    <a href="{{ route('presupuesto') }}" class="nav-link" id="presupuestos">Presupuestos</a>
    <a href="{{ route('ahorro') }}" class="nav-link" id="ahorros">Ahorro</a>
  </div>

  <!-- Botón hamburguesa -->
  <div class="menu-toggle" id="menu-toggle">
    <i class="bi bi-list"></i>
  </div>
</header>

<!-- Menú móvil -->
<nav class="mobile-menu" id="mobile-menu">
  <a href="{{ route('finanzas.personales') }}" class="mobile-nav-link" id="finanzas_personales_mobile">Finanzas Personales</a>
  <a href="{{ route('gastos-ingresos') }}" class="mobile-nav-link" id="gastos_ingresos_mobile">Gastos e Ingresos</a>
  <a href="{{ route('presupuesto') }}" class="mobile-nav-link" id="presupuestos_mobile">Presupuestos</a>
  <a href="{{ route('ahorro') }}" class="mobile-nav-link" id="ahorros_mobile">Ahorro</a>
</nav>

<!-- Header contenido -->
<section class="header-ahorro">
  <h1>AHORRO</h1>
  <p>
    Optimiza tu capacidad de ahorro con esta sección dedicada. Aquí recibirás recomendaciones personalizadas para ahorrar y podrás configurar tus propios objetivos de ahorro. Además, tendrás acceso a gráficos de ahorro que te permitirán seguir tu progreso y mantenerte motivado hacia tus metas financieras.
  </p>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const currentPage = "ahorros"; // Ajusta según la página actual

  // 🔹 Enlaces escritorio
  document.querySelectorAll(".nav-link").forEach(link => {
    if(link.id === currentPage) link.classList.add("active");
    else link.classList.remove("active");
  });

  // 🔹 Enlaces móvil
  const mobileMenu = document.getElementById("mobile-menu");
  document.querySelectorAll(".mobile-nav-link").forEach(link => {
    if(link.id.includes(currentPage)) link.classList.add("active");
    else link.classList.remove("active");

    // Cierra menú al hacer clic
    link.addEventListener("click", () => {
      mobileMenu.classList.remove("active");
    });
  });

  // 🔹 Botón hamburguesa
  const menuToggle = document.getElementById("menu-toggle");
  menuToggle.addEventListener("click", () => {
    mobileMenu.classList.toggle("active");
  });

  // 🔹 Cierra menú si pasa a escritorio
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) {
      mobileMenu.classList.remove("active");
    }
  });
});
</script>

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
        <a href="#" id="btnCrearObjetivo" class="custom-btn">Crear Objetivo</a>

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

    <!-- Historial de Abono -->
<div class="custom-card">
  <div class="custom-card-header">
    <i class="bi bi-clock-history"></i> Historial de Abono
  </div>
  <div class="custom-card-body">
  <p class="justificado">
    Es un registro donde se detallan los abonos realizados para cumplir con metas previamente establecidas. En este historial se pueden visualizar las fechas, montos abonados, saldo pendiente y el progreso alcanzado en cada objetivo, permitiendo un control claro y ordenado del avance financiero.
  </p>
  <a href="{{ route('historial') }}" class="custom-btn">Ver Historial</a>
</div>

</div>


    <!-- Objetivos actuales -->
    <div class="goal-wrapper">
  <div class="titulo-objetivos d-flex justify-content-between align-items-center px-4 py-3">
  <h2 class="titulo mb-0">Tus Objetivos de Ahorro</h2>
  <span id="contador-objetivos" class="contador">10/100</span>
</div>
  <div id="goals-container" class="goals-scroll-container">
    <!-- Las tarjetas se cargarán dinámicamente -->
  </div>
</div>

<!-- Modal ABONAR -->
<div class="modal fade" id="modalAbonar" tabindex="-1" aria-labelledby="modalAbonarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title w-100 text-center" id="modalAbonarLabel">Gestión de Ahorro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      
      <div class="modal-body">
        <label for="cantidad" class="roboto-slab">Cantidad a ingresar:</label>
        
        <!-- Campo con ícono personalizado -->
        <div class="position-relative">
          <input type="number" id="cantidad" class="form-control" placeholder="0.00" inputmode="decimal" autocomplete="off" style="padding-right: 2.5rem;">
          <div id="icono-validacion" class="position-absolute top-50 translate-middle-y" style="right: 0.75rem; font-size: 1.2rem; display: none;"></div>
        </div>

        <!-- Mensaje de error -->
        <div id="cantidad-error" style="display:none; color:red; font-size: 0.9em;">Cantidad inválida</div>

        <!-- Mostrar saldo actual del usuario -->
        <label id="saldoActualUsuario" class="fw-bold mt-3 d-block">
         <p class="roboto-slab">Saldo actual: ${{ number_format($saldoDisponible, 2) }}</p>
        </label>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" id="btnCancelarAbono" disabled>Cancelar</button>
        <button class="btn btn-dark" id="btnGuardarAbono" disabled>Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Eliminación de Objetivo -->
<div id="modalEliminarObjetivo" style="
  display:none;
  position:fixed;
  top:0; left:0;
  width:100%; height:100%;
  background-color:rgba(0,0,0,0.5);
  z-index:9999;
  justify-content:center;
  align-items:center;">
  
  <div style="
    background-color:#fff;
    border:1px solid #000;
    border-radius:12px;
    max-width:600px;
    width:90%;
    font-family:'Open Sans',sans-serif;
    color:#000;
    display:flex;
    flex-direction:column;
    overflow:hidden;">
    
    <!-- HEADER -->
    <div style="
      background-color:#2A4145;
      color:white;
      padding:15px 20px;
      text-align:center;
      font-size:1.2em;
      font-weight:bold;
      font-family:'Poppins',sans-serif;">
      Confirmar eliminación
    </div>
    
    <!-- BODY -->
    <div style="padding:25px 20px; text-align:center;">
      <div id="mensajeEliminar" style="font-size:1em; margin-bottom:15px;">
        ¿Está seguro que desea eliminar el objetivo?
      </div>
      <div id="subtituloEliminar" style="font-size:0.9em; color:#333;">
        <!-- Aquí se mostrará: Este objetivo tiene $X abonados. Recibirás: $Y -->
      </div>
    </div>
    
    <!-- FOOTER -->
    <div style="
      display:flex;
      justify-content:flex-end;
      gap:15px;
      padding:15px;">
      <button id="btnEliminarSi" style="
        background-color:#CB3737;
        color:white;
        border:none;
        border-radius:8px;
        padding:10px 30px;
        cursor:pointer;
        min-width:100px;">Si</button>
      <button id="btnEliminarNo" style="
        background-color:#31565E;
        color:white;
        border:none;
        border-radius:8px;
        padding:10px 30px;
        cursor:pointer;
        min-width:100px;">No</button>
    </div>
    
  </div>
</div>


<!-- Modal de Actualización de Objetivo -->
<div id="modalActualizar" style="
  display:none;
  position:fixed;
  top:0; left:0;
  width:100%; height:100%;
  background-color:rgba(0,0,0,0.5);
  z-index:9999;
  justify-content:center;
  align-items:center;">

  <div style="
    background-color:#fff;
    border:1px solid #000;
    border-radius:8px;
    width:360px;
    box-shadow:0 4px 10px rgba(0,0,0,0.4);
    overflow:hidden;
    font-family:'Open Sans',sans-serif;"> 

    <!-- HEADER -->
    <div class="modal-header" style="
      display:flex;
      align-items:center;
      justify-content:center;
      height:50px;
      font-size:18px;
      font-weight:bold;
      background-color:#2A4145;
      color:white;
      font-family:'Poppins',sans-serif;">
      Actualización de datos
    </div>

    <!-- BODY -->
    <div class="modal-body" style="padding:20px; font-family:'Open Sans',sans-serif;">
      <!-- Nombre del objetivo -->
      <div class="form-group" style="margin-bottom:20px;">
        <label for="nombre" style="display:block; font-size:14px; margin-bottom:6px; font-family:'Open Sans',sans-serif;">Nombre del objetivo:</label>
        <input type="text" id="nombre" name="nombre" style="
          font-family:'Open Sans',sans-serif;
          width:100%;
          padding:8px;
          font-size:14px;
          border:1px solid #000;
          border-radius:6px;
          color:#000;">
      </div>

      <!-- Monto -->
      <div class="form-group" style="margin-bottom:20px;">
        <label for="monto" style="display:block; font-size:14px; margin-bottom:6px; font-family:'Open Sans',sans-serif;">Monto:</label>
        <input type="number" id="monto" name="monto" style="
          font-family:'Open Sans',sans-serif;
          width:100%;
          padding:8px;
          font-size:14px;
          border:1px solid #000;
          border-radius:6px;
          color:#000;">
      </div>

      <!-- Fechas -->
      <div class="form-group" style="margin-bottom:20px;">
        <label style="display:block; font-size:14px; margin-bottom:6px; font-family:'Open Sans',sans-serif;">Fechas del objetivo:</label>
        <div style="display:flex; align-items:center; margin-bottom:10px; gap:10px;">
          <label for="desde" style="width:60px; font-size:14px; font-family:'Open Sans',sans-serif;">Desde:</label>
          <input type="date" id="desde" name="desde" style="
            font-family:'Open Sans',sans-serif;
            width:120px;
            padding:6px;
            font-size:14px;
            border:1px solid #000;
            border-radius:6px;">
        </div>
        <div style="display:flex; align-items:center; gap:10px;">
          <label for="hasta" style="width:60px; font-size:14px; font-family:'Open Sans',sans-serif;">Hasta:</label>
          <input type="date" id="hasta" name="hasta" style="
            font-family:'Open Sans',sans-serif;
            width:120px;
            padding:6px;
            font-size:14px;
            border:1px solid #000;
            border-radius:6px;">
        </div>
      </div>
    </div>

    <!-- FOOTER -->
    <div class="modal-footer" style="
      display:flex;
      justify-content:space-around;
      padding:15px;
      font-family:'Open Sans',sans-serif;">
      <button class="btn btn-success" id="btnGuardar" style="
        font-family:'Open Sans',sans-serif;
        border:none;
        padding:8px 16px;
        font-size:14px;
        border-radius:6px;
        cursor:pointer;
        font-weight:bold;
        background:#427F2B;
        color:#FFFFFF;">
        Actualizar
      </button>
      <button class="btn btn-danger" id="btnCancelar" style="
        font-family:'Open Sans',sans-serif;
        border:none;
        padding:8px 16px;
        font-size:14px;
        border-radius:6px;
        cursor:pointer;
        font-weight:bold;
        background:#CB3737;
        color:#FFFFFF;">
        Cancelar 
      </button>
    </div>
  </div>
</div>

<!-- Modal de Eliminación de Objetivo -->
<div id="modalEliminarObjetivo" style="
  display:none;
  position:fixed;
  top:0; left:0;
  width:100%; height:100%;
  background-color:rgba(0,0,0,0.5);
  z-index:10000;
  justify-content:center;
  align-items:center;">
  <div style="
    background-color:#fff;
    border-radius:8px;
    width:360px;
    padding:20px;
    box-shadow:0 4px 10px rgba(0,0,0,0.4);
    font-family:'Open Sans',sans-serif;
    text-align:center;">
    <h3 id="mensajeEliminar" style="margin-bottom:10px;">¿Desea eliminar el objetivo?</h3>
    <p id="subtituloEliminar" style="margin-bottom:20px; font-size:14px; color:#333;">
      Este objetivo tiene $0 abonados. Al eliminarlo, el dinero se devolverá a tu saldo general. Recibirás: $0
    </p>
    <div style="display:flex; justify-content:space-around;">
      <button id="btnEliminarSi" style="
        padding:8px 16px;
        border:none;
        border-radius:6px;
        background:#CB3737;
        color:white;
        font-weight:bold;
        cursor:pointer;">
        Sí
      </button>
      <button id="btnEliminarNo" style="
        padding:8px 16px;
        border:none;
        border-radius:6px;
        background:#31565E;
        color:white;
        font-weight:bold;
        cursor:pointer;">
        No
      </button>
    </div>
  </div>
</div>

<!-- SCRIPT FINAL -->
<script>
let selectedGoalEliminar = null;

document.addEventListener("click", function(e) {
  const modalActualizar = document.getElementById("modalActualizar");
  const modalEliminar = document.getElementById("modalEliminarObjetivo");

  // Abrir modal eliminar
  if (e.target && e.target.classList.contains("btn-eliminar")) {
    selectedGoalEliminar = e.target.closest(".goal-card");

    if (selectedGoalEliminar.dataset.estado === "completado") {
      alertify.alert("Solo se pueden eliminar objetivos que están en progreso");
      return;
    }

    const nombre = selectedGoalEliminar.dataset.nombre || "";
    const abonado = parseFloat(selectedGoalEliminar.dataset.abonado || 0);
    const recibir = abonado;

    document.getElementById("mensajeEliminar").innerText = `¿Está seguro que desea eliminar el objetivo "${nombre}"?`;
    document.getElementById("subtituloEliminar").innerText =
      `Este objetivo tiene $${abonado.toLocaleString()} abonados. Al eliminarlo, el dinero se devolverá a tu saldo general. Recibirás: $${recibir.toLocaleString()}`;

    modalEliminar.style.display = "flex";
  }

  // Abrir modal actualizar
  if (e.target && e.target.classList.contains("btn-actualizar")) {
    const selectedGoal = e.target.closest(".goal-card");
    const goalId = selectedGoal?.dataset?.id || "";
    const nombre = selectedGoal?.dataset?.nombre || "";
    const monto = selectedGoal?.dataset?.meta || "";
    const fechaDesde = selectedGoal?.dataset?.desde || "";
    const fechaHasta = selectedGoal?.dataset?.hasta || "";
    const abonado = parseFloat(selectedGoal?.dataset?.abonado || "0");

    const inputNombre = document.getElementById("nombre");
    const inputMonto = document.getElementById("monto");
    const inputDesde = document.getElementById("desde");
    const inputHasta = document.getElementById("hasta");

    inputNombre.value = nombre;
    inputMonto.value = monto;
    inputDesde.value = fechaDesde;
    inputHasta.value = fechaHasta;

    if (!isNaN(abonado) && abonado > 0) {
      // Solo permitir editar nombre y fecha hasta
      inputNombre.disabled = false;
      inputHasta.disabled = false;
      inputMonto.disabled = true;
      inputDesde.disabled = true;
    } else {
      // Permitir editar todo
      inputNombre.disabled = false;
      inputMonto.disabled = false;
      inputDesde.disabled = false;
      inputHasta.disabled = false;
    }

    modalActualizar.style.display = "flex";
    modalActualizar.dataset.id = goalId;
  }
});

// Cancelar actualización
document.getElementById("btnCancelar").addEventListener("click", () => {
  document.getElementById("modalActualizar").style.display = "none";
});

// Guardar actualización
document.getElementById("btnGuardar").addEventListener("click", () => {
  try {
    const nombre = document.getElementById("nombre").value;
    // Aquí podrías enviar los datos por AJAX
    alertify.success(`Objetivo de ahorro "${nombre}" actualizado correctamente`);
    document.getElementById("modalActualizar").style.display = "none";
  } catch (error) {
    alertify.error("Error al actualizar el objetivo");
  }
});

// Confirmar eliminación
document.getElementById("btnEliminarSi").addEventListener("click", () => {
  try {
    if (selectedGoalEliminar) {
      selectedGoalEliminar.remove();
      alertify.success("Objetivo de ahorro eliminado correctamente");
    }
    closeEliminarModal();
  } catch (error) {
    alertify.error("Error al eliminar el objetivo");
  }
});

// Cancelar eliminación
document.getElementById("btnEliminarNo").addEventListener("click", () => {
  closeEliminarModal();
});

function closeEliminarModal() {
  document.getElementById("modalEliminarObjetivo").style.display = "none";
  selectedGoalEliminar = null;
}

</script>


<!-- Agrega Bootstrap Icons en tu <head> si no está -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script>
document.addEventListener('DOMContentLoaded', function () {
  const inputCantidad = document.getElementById('cantidad');
  const errorDiv = document.getElementById('cantidad-error');
  const iconoValidacion = document.getElementById('icono-validacion');
  const btnGuardar = document.getElementById('btnGuardarAbono');
  const btnCancelar = document.getElementById('btnCancelarAbono');

  inputCantidad.addEventListener('input', function () {
    const valor = parseFloat(inputCantidad.value);

    if (isNaN(valor) || valor <= 0) {
      inputCantidad.classList.add('is-invalid');
      inputCantidad.classList.remove('is-valid');

      iconoValidacion.className = 'bi bi-x-circle-fill position-absolute top-50 translate-middle-y';
      iconoValidacion.style.color = 'red';
      iconoValidacion.style.right = '0.75rem';
      iconoValidacion.style.fontSize = '1.2rem';
      iconoValidacion.style.display = 'inline';

      errorDiv.style.display = 'block';
      errorDiv.textContent = "La cantidad a abonar debe ser mayor a 0";

      btnGuardar.disabled = true;
      btnCancelar.disabled = true;
    } else {
      inputCantidad.classList.remove('is-invalid');
      inputCantidad.classList.add('is-valid');

      iconoValidacion.className = 'bi bi-check-circle-fill position-absolute top-50 translate-middle-y';
      iconoValidacion.style.color = 'green';
      iconoValidacion.style.right = '0.75rem';
      iconoValidacion.style.fontSize = '1.2rem';
      iconoValidacion.style.display = 'inline';

      errorDiv.style.display = 'none';

      btnGuardar.disabled = false;
      btnCancelar.disabled = false;
    }
  });

    btnCancelar.addEventListener('click', function () {
    // Limpiar campo de cantidad
    inputCantidad.value = '';

    // Quitar clases de validación
    inputCantidad.classList.remove('is-valid', 'is-invalid');

    // Ocultar icono de validación
    iconoValidacion.style.display = 'none';

    // Ocultar mensaje de error
    errorDiv.style.display = 'none';

    // Deshabilitar botones de nuevo si quieres
    btnGuardar.disabled = true;
    btnCancelar.disabled = true;
  });

});
</script>

  <!-- Modal de Límite de Objetivos -->
<div class="modal fade" id="modalLimiteObjetivos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-limite-modal">
      <div class="modal-body text-center">
        <p class="modal-text">Has alcanzado el límite máximo de objetivos.</p>
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal personalizado -->
<div id="limiteModal" style="
  display:none;
  position:fixed;
  top:0;left:0;
  width:100%;height:100%;
  background-color:rgba(0,0,0,0.4);
  font-family:'Open Sans',regular;
  z-index:9999;
  justify-content:center;
  align-items:center;">
  <div style="
    background-color:#fff;
    padding:20px 30px;
    border-radius:12px;
    max-width:400px;
    text-align:center;
    font-family:'Open Sans',regular;
    color:#000;
    position:relative;">
    <h3 style="margin-bottom:10px; font-family:'Open Sans',regular;">Límite alcanzado</h3>
    <p style="margin-bottom:40px; font-family:'Open Sans',regular;">Has alcanzado el límite máximo de objetivos.</p>

    <!-- Botón alineado abajo a la derecha -->
    <div style="
      width:100%;
      display:flex;
      justify-content:flex-end;">
      <button id="cerrarModalBtn" style="
        padding:8px 20px;
        border:1px solid #000;
        background-color:#e0e0e0;
        font-family:'Open Sans',regular;
        color:#000;
        border-radius:6px;
        cursor:pointer;">Aceptar</button>
    </div>
  </div>
</div>


 <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const objetivosEndpoint = "{{ route('objetivos.index') }}";
  let selectedGoal = null;
  let saldoUsuario = parseFloat({{$saldoDisponible}});

async function cargarObjetivos() {
  try {
    const res = await fetch(objetivosEndpoint);
    const objetivos = await res.json();
    const container = document.getElementById("goals-container");
    const contador = document.getElementById("contador-objetivos");

    // Actualizar contador de objetivos
    if (contador) contador.innerText = `${objetivos.length}/100`;

    container.innerHTML = "";

    if (objetivos.length === 0) {
      container.innerHTML = `<div class="alert alert-info text-center w-100">No tienes objetivos de ahorro registrados.</div>`;
      return;
    }

    objetivos.forEach((goal, index) => {
      const montoActual = parseFloat(goal.monto_ahorrado ?? 0);
      const montoMeta = parseFloat(goal.monto ?? 0);
      if (isNaN(montoMeta) || montoMeta === 0) return;

      const progreso = (montoActual / montoMeta) * 100;
      const card = document.createElement("div");
      card.classList.add("goal-card", "position-relative", "p-3", "mb-3");
      card.dataset.meta = montoMeta;
      card.dataset.actual = montoActual;
      card.dataset.id = goal.id;
      card.dataset.nombre = goal.nombre;

      let abonarBtn = "";
      let iconos = "";

      if (montoActual >= montoMeta) {
        abonarBtn = `<button class="btn btn-success mt-2" disabled>Completado 🎉</button>`;
        // No se muestran los íconos si está completado
      } else {
        abonarBtn = `<button class="btn-goal btn btn-primary mt-2">Abonar</button>`;
        iconos = `
          <div style="position:absolute; top:10px; left:10px; display:flex; gap:10px;">
            <i class="bi bi-trash btn-eliminar" style="color:#2D555D; cursor:pointer; font-size:1.2rem;" title="Eliminar"></i>
            <i class="bi bi-pencil-square btn-actualizar" style="color:#2D555D; cursor:pointer; font-size:1.2rem;" title="Actualizar"></i>
          </div>
        `;
      }

      card.innerHTML = `
        ${iconos}
        <div class="goal-badge">${index + 1}</div>
        <h5>${goal.nombre}</h5>
        <p>Cantidad abonada: $${montoActual.toLocaleString()} / Meta: $${montoMeta.toLocaleString()}</p>
        <div class="progress">
          <div class="progress-bar" style="width: ${Math.min(progreso, 100)}%"></div>
        </div>
        <p class="mt-2">FECHA LÍMITE: ${new Date(goal.fecha_hasta + 'T12:00:00').toLocaleDateString()}</p>
        ${abonarBtn}
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

    // Validar límite de objetivos al dar clic en "Nuevo Objetivo"

document.getElementById('btnCrearObjetivo').addEventListener('click', (e)=>{
    e.preventDefault();
    const totalObjetivos = parseInt(document.getElementById("contador-objetivos").innerText.split('/')[0]);
    if (totalObjetivos >= 100) {
      // Mostrar el modal personalizado
      document.getElementById('limiteModal').style.display = 'flex';
    } else {
      window.location.href = "{{ route('objetivos.nuevo') }}";
    }
  });

  // Cerrar el modal al hacer clic en “Aceptar”
  document.getElementById('cerrarModalBtn').addEventListener('click', ()=>{
    document.getElementById('limiteModal').style.display = 'none';
  });



// Abrir modal al dar clic en Abonar
document.addEventListener("click", function (e) {
  if (e.target && e.target.classList.contains("btn-goal")) {
    selectedGoal = e.target.closest(".goal-card");
    const modal = new bootstrap.Modal(document.getElementById("modalAbonar"));

    // 🔹 Obtener nombre del objetivo y actualizar título
    const objetivoNombre = selectedGoal.querySelector("h5").innerText;
    document.getElementById("modalAbonarLabel").innerText = objetivoNombre;

    // Reiniciar estado del formulario
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
    saldoUsuarioLabel.style.fontFamily = "'Open Sans', sans-serif";
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

      if (valor > saldoUsuario) {
        errorDiv.innerText = `No tienes suficiente saldo. Tu saldo actual es: ${formatCurrency(saldoUsuario)}`;
        errorDiv.style.display = "block";
        cantidadInput.classList.add("error");
        return;
      }

      if (valor > restante) {
        errorDiv.innerText = `El valor excede el restante necesario (${formatCurrency(restante)})`;
        errorDiv.style.display = "block";
        cantidadInput.classList.add("error");
        return;
      }

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
          body: JSON.stringify({ cantidad: valor })
        });

        const data = await res.json();

        if (!res.ok) {
          alertify.error(data.error || "Error al abonar");
          return;
        }

        saldoUsuario -= valor;
        actualizarSaldoUsuario();

        selectedGoal.dataset.actual = data.nuevo_monto;

        const montoParrafo = selectedGoal.querySelector("p:first-of-type");
        montoParrafo.innerText = `$${parseFloat(data.nuevo_monto).toLocaleString()} / $${parseFloat(data.meta).toLocaleString()}`;

        const progressBarCard = selectedGoal.querySelector(".progress-bar");
        const porcentaje = (data.nuevo_monto / data.meta) * 100;
        progressBarCard.style.width = `${Math.min(porcentaje, 100)}%`;
if (data.nuevo_monto >= data.meta) {
  const btn = selectedGoal.querySelector(".btn-goal");
  if (btn) {
    btn.outerHTML = `<button class="btn btn-success mt-2" disabled>Completado 🎉</button>`;
  }
}

alertify.success("Abono registrado correctamente ");

// 🔽 Limpieza del formulario
cantidadInput.value = "";
btnGuardar.disabled = true;
errorDiv.style.display = "none";
cantidadInput.classList.remove("error");

// 🔽 Ocultar el modal
setTimeout(() => {
  const modal = bootstrap.Modal.getInstance(document.getElementById("modalAbonar"));
  modal.hide();
}, 100);


      } catch (err) {
        console.error(err);
        alertify.error("Error de conexión");
      }
    });
  });
</script>

<!-- Botón Ver Gráfica -->
<script>
  document.getElementById("btn-ver-grafica").addEventListener("click", function () {
    window.location.href = "{{ route('graficas.ahorro') }}";
  });
</script>

<!-- Botón Ver Consejo -->
<script>
  document.getElementById("btn-ver-consejo").addEventListener("click", function () {
    const categoria = "metas";
    const consejo = 5;
    window.location.href = "{{ route('consejos.ahorro') }}" + `?categoria=${categoria}&consejo=${consejo}`;
  });
</script>

<script>
const cantidadInput = document.getElementById("cantidad");
const btnGuardar = document.getElementById("btnGuardarAbono");
const errorDiv = document.getElementById("cantidad-error");

// 🔹 Bloquear letras (solo permitir números, punto y teclas de control)
cantidadInput.addEventListener("keypress", (e) => {
  const char = String.fromCharCode(e.which);

  // Permitir números y el punto decimal
  if (!/[0-9.]/.test(char)) {
    e.preventDefault();
  }

  // Solo un punto decimal permitido
  if (char === "." && cantidadInput.value.includes(".")) {
    e.preventDefault();
  }
});

// 🔹 Validación en cada cambio
cantidadInput.addEventListener("input", () => {
  const valor = cantidadInput.value.trim();
  const regex = /^\d*(\.\d{0,2})?$/; // hasta 2 decimales

  if (regex.test(valor) && valor !== ".") {
    errorDiv.style.display = "none";
    const numValor = parseFloat(valor);
    btnGuardar.disabled = !(numValor > 0);
  } else {
    errorDiv.innerText = "Cantidad inválida (solo números con máximo 2 decimales)";
    errorDiv.style.display = "block";
    btnGuardar.disabled = true;
  }
});

// 🔹 Formatear al perder foco
cantidadInput.addEventListener("blur", () => {
  let valor = cantidadInput.value.trim();
  if (valor === "") return;

  let numValor = parseFloat(valor);
  if (!isNaN(numValor)) {
    cantidadInput.value = numValor.toFixed(2);
  }
});

@if(session('success'))
  
    alertify.success("{{ session('success') }}");
  
@endif

</script>

<script>
  const btnCancelar = document.getElementById("btnCancelarAbono");

  // 🟡 Activar/Desactivar Cancelar cuando se escribe una cantidad
  cantidadInput.addEventListener("input", () => {
    const valor = parseFloat(cantidadInput.value);
    if (!isNaN(valor) && valor > 0) {
      btnCancelar.disabled = false;
    } else {
      btnCancelar.disabled = true;
    }
  });

  // 🔄 Función para limpiar los campos del modal
  function limpiarModal() {
    cantidadInput.value = "";
    cantidadInput.classList.remove("error");
    errorDiv.style.display = "none";
    btnGuardar.disabled = true;
    btnCancelar.disabled = true;
  }

  // 🚫 Cancelar solo limpia (no cierra el modal)
  btnCancelar.addEventListener("click", () => {
    limpiarModal();
  });

  // 🟢 También se limpia al abrir el modal
  document.getElementById("modalAbonar").addEventListener("show.bs.modal", () => {
    limpiarModal();
  });
</script>

<script>
  // Función para limpiar completamente el modal de abonar
  function limpiarModalAbonar() {
    const inputCantidad = document.getElementById('cantidad');
    const errorDiv = document.getElementById('cantidad-error');
    const iconoValidacion = document.getElementById('icono-validacion');
    const btnGuardar = document.getElementById('btnGuardarAbono');
    const btnCancelar = document.getElementById('btnCancelarAbono');

    // Resetear campos y estilos
    inputCantidad.value = '';
    inputCantidad.classList.remove('is-valid', 'is-invalid');
    iconoValidacion.style.display = 'none';
    errorDiv.style.display = 'none';

    btnGuardar.disabled = true;
    btnCancelar.disabled = true;
  }

  // Evento: Al mostrar el modal (abrir)
  document.getElementById("modalAbonar").addEventListener("show.bs.modal", () => {
    limpiarModalAbonar();
  });

  // Evento: Al ocultar el modal (cerrar)
  document.getElementById("modalAbonar").addEventListener("hidden.bs.modal", () => {
    limpiarModalAbonar();
  });

  // Evento: Validación en tiempo real
  document.getElementById('cantidad').addEventListener('input', function () {
    const inputCantidad = this;
    const valor = parseFloat(inputCantidad.value);
    const errorDiv = document.getElementById('cantidad-error');
    const iconoValidacion = document.getElementById('icono-validacion');
    const btnGuardar = document.getElementById('btnGuardarAbono');
    const btnCancelar = document.getElementById('btnCancelarAbono');

    // Si está vacío, limpiar validaciones
    if (!inputCantidad.value.trim()) {
      iconoValidacion.style.display = 'none';
      inputCantidad.classList.remove('is-valid', 'is-invalid');
      errorDiv.style.display = 'none';
      btnGuardar.disabled = true;
      btnCancelar.disabled = true;
      return;
    }

    // Valor inválido
    if (isNaN(valor) || valor <= 0) {
      inputCantidad.classList.add('is-invalid');
      inputCantidad.classList.remove('is-valid');

      iconoValidacion.className = 'bi bi-x-circle-fill position-absolute top-50 translate-middle-y';
      iconoValidacion.style.color = 'red';
      iconoValidacion.style.right = '0.75rem';
      iconoValidacion.style.fontSize = '1.2rem';
      iconoValidacion.style.display = 'inline';

      errorDiv.textContent = "La cantidad a abonar debe ser mayor a 0";
      errorDiv.style.display = 'block';

      btnGuardar.disabled = true;
      btnCancelar.disabled = true;
    } else {
      // Valor válido
      inputCantidad.classList.remove('is-invalid');
      inputCantidad.classList.add('is-valid');

      iconoValidacion.className = 'bi bi-check-circle-fill position-absolute top-50 translate-middle-y';
      iconoValidacion.style.color = 'green';
      iconoValidacion.style.right = '0.75rem';
      iconoValidacion.style.fontSize = '1.2rem';
      iconoValidacion.style.display = 'inline';

      errorDiv.style.display = 'none';
      btnGuardar.disabled = false;
      btnCancelar.disabled = false;
    }
  });
</script>

</body>
</html>