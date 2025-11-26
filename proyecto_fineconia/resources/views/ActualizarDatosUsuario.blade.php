<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Datos Generales - Fineconia</title>

  <!-- ICONOS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- FUENTES -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Poppins:wght@700&family=Roboto+Slab:wght@600&display=swap" rel="stylesheet">

  <!-- ALERTIFY -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  @vite('resources/css/ActualizarDatosUsuario.css')

</head>

<body>

<!-- NAVBAR NUEVA -->
<nav class="navbar">
  <div class="logo-container" style="max-width: 200px; width: 100%;">
    <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" 
         style="height: 100px; width: 100%; object-fit: contain;">
  </div>

  <div class="user-section header-user">
    <a href="{{ route('fineconia.home') }}" class="nav-link">Home</a>
  </div>
</nav>

<!-- TARJETA -->
<div class="main-card">

  <h2 class="titulo">Datos Generales</h2>

  <div class="contenido">

    <!-- FOTO -->
    <div class="foto-box">
      <div class="circle-avatar" id="previewFoto">
        <i class="bi bi-person"></i>
      </div>

      <button class="btn-upload" onclick="document.getElementById('inputFoto').click()">Subir Imagen</button>
      <input type="file" id="inputFoto" accept="image/*">
    </div>

    <!-- FORMULARIO -->
    <form class="formulario" id="formGeneral">

      <div class="fila">
        <div class="grupo" style="width: 100%;">
          <label>Nombre completo</label>
          <input type="text" id="nombre_completo" value="{{ Auth::user()->name }}">
          <span class="error-msg" id="err-nombre-completo"></span>
        </div>
      </div>

      <div class="fila">
        <div class="grupo">
          <label>Correo Electrónico</label>
          <input type="text" id="correo" value="{{ Auth::user()->email }}">
          <span class="error-msg" id="err-correo"></span>
        </div>
      </div>

      <div class="fila">
        <div class="grupo">
          <label>Miembro Familiar</label>
          <input type="text" id="miembro" value="{{ Auth::user()->miembro }}">
          <span class="error-msg" id="err-miembro"></span>
        </div>
      </div>

      <div class="botones">
        <button type="button" class="btn-cancelar" id="btnCancelar">Cancelar</button>
        <button type="submit" class="btn-guardar" id="btnGuardar" disabled>Guardar</button>
      </div>

    </form>
  </div>
</div>

<!-- MODAL CANCELAR -->
<div class="modal-bg" id="modalCancelar">
  <div class="modal-box">
    <div class="modal-header">Confirmación</div>

    <div class="modal-body">
      ¿Está seguro que desea cancelar?
    </div>

    <div class="modal-buttons">
      <button class="btn-si" id="btnSi">Si</button>
      <button class="btn-no" id="btnNo">No</button>
    </div>
  </div>
</div>

<!-- SCRIPTS -->
<script>

  const inputFoto = document.getElementById("inputFoto");
  const preview = document.getElementById("previewFoto");
  const btnGuardar = document.getElementById("btnGuardar");

  const originalValues = {
    nombre_completo: document.getElementById("nombre_completo").value,
    correo: document.getElementById("correo").value,
    miembro: document.getElementById("miembro").value
  };

  /* ---------------- IMAGEN ---------------- */
  inputFoto.addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (!file) return;

    const validTypes = ["image/jpeg", "image/jpg", "image/png"];

    if (!validTypes.includes(file.type)) {
      alertify.error("El formato de la imagen no es válido");
      return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
      preview.innerHTML = `<img src="${e.target.result}" alt="Foto">`;
      btnGuardar.disabled = false;
    };
    reader.readAsDataURL(file);
  });

  /* ---------------- ACTIVAR GUARDAR SI SE MODIFICA ALGO ---------------- */
  document.querySelectorAll("#formGeneral input").forEach(input => {
    input.addEventListener("input", () => {
      const modificado = input.value !== originalValues[input.id];
      if (modificado) btnGuardar.disabled = false;
    });
  });

  /* ---------------- BOTÓN CANCELAR ---------------- */
  document.getElementById("btnCancelar").addEventListener("click", () => {
    document.getElementById("modalCancelar").style.display = "flex";
  });

  /* ---------------- CERRAR MODAL ---------------- */
  document.getElementById("btnNo").addEventListener("click", () => {
    document.getElementById("modalCancelar").style.display = "none";
  });

  /* ---------------- SI CANCELA (MODIFICADO) ---------------- */
  document.getElementById("btnSi").addEventListener("click", () => {
    document.getElementById("modalCancelar").style.display = "none";

    // Limpiar todos los campos
    document.getElementById("nombre_completo").value = "";
    document.getElementById("correo").value = "";
    document.getElementById("miembro").value = "";

    // Limpiar imagen
    preview.innerHTML = `<i class="bi bi-person"></i>`;
    inputFoto.value = "";

    // Desactivar botón guardar
    btnGuardar.disabled = true;

    alertify.success("Acción cancelada");
  });

  /* ---------------- GUARDAR FORMULARIO ---------------- */
  document.getElementById("formGeneral").addEventListener("submit", function(event) {
    event.preventDefault();

    if (!nombre_completo.value || !correo.value || !miembro.value) {
      alertify.error("Todos los campos son obligatorios");
      return;
    }

    alertify.success("Datos de perfil actualizados correctamente");

    setTimeout(() => {
      window.location.href = "{{ route('centro.usuario') }}";
    }, 1500);

  });
</script>

</body>
</html>
