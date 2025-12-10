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

<!-- NAVBAR -->
<nav class="navbar">
  <div class="logo-container" style="max-width: 200px;">
    <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" style="height: 100px;">
  </div>
  <div class="user-section">
    <a href="{{ route('fineconia.home') }}" class="nav-link">Home</a>
  </div>
</nav>

<div class="main-card">

  <h2 class="titulo">Datos Generales</h2>

  <div class="contenido">

    <!-- FOTO -->
<div class="foto-box">
  <div class="circle-avatar" id="previewFoto">
    @if(Auth::user()->imagen_url)
      <img src="{{ asset(Auth::user()->imagen_url) }}">
    @else
      <i class="bi bi-person"></i>
    @endif
  </div>

  <button type="button" class="btn-upload" onclick="document.getElementById('inputFoto').click()">
    Subir Imagen
  </button>
</div>

<form class="formulario" id="formGeneral" enctype="multipart/form-data">

  @csrf

  <!-- INPUT IMAGEN REAL (AHORA SÍ SE ENVÍA) -->
  <input type="file" id="inputFoto" name="imagen" accept="image/*" hidden>

  <div class="fila">
    <div class="grupo">
      <label>Nombre completo</label>
      <input type="text" name="name" id="nombre_completo" value="{{ Auth::user()->name }}">
    </div>
  </div>

  <div class="fila">
    <div class="grupo">
      <label>Correo Electrónico</label>
      <input type="email" name="email" id="correo" value="{{ Auth::user()->email }}">
    </div>
  </div>

  <div class="fila">
    <div class="grupo">
      <label>Miembro Familiar</label>
      <input type="text" name="miembro" id="miembro" value="{{ Auth::user()->miembro }}">
    </div>
  </div>

  <div class="botones">
    <button type="button" class="btn-cancelar" id="btnCancelar">Cancelar</button>
    <button type="submit" class="btn-guardar" id="btnGuardar" disabled>Guardar</button>
  </div>

</form>

  </div>
</div>

<!-- MODAL -->
<div class="modal-bg" id="modalCancelar">
  <div class="modal-box">
    <div class="modal-header">Confirmación</div>
    <div class="modal-body">¿Está seguro que desea cancelar?</div>
    <div class="modal-buttons">
      <button class="btn-si" id="btnSi">Si</button>
      <button class="btn-no" id="btnNo">No</button>
    </div>
  </div>
</div>

<!-- SCRIPT -->
<script>

const form = document.getElementById("formGeneral");
const inputFoto = document.getElementById("inputFoto");
const preview = document.getElementById("previewFoto");
const btnGuardar = document.getElementById("btnGuardar");

const originalValues = {
  nombre_completo: document.getElementById("nombre_completo").value,
  correo: document.getElementById("correo").value,
  miembro: document.getElementById("miembro").value
};

// Preview Imagen
inputFoto.addEventListener("change", e => {
  const file = e.target.files[0];
  if(!file) return;

  if(!["image/jpeg","image/png","image/jpg"].includes(file.type)){
    alertify.error("Formato inválido");
    return;
  }

  const reader = new FileReader();
  reader.onload = ev => {
    preview.innerHTML = `<img src="${ev.target.result}">`;
    btnGuardar.disabled = false;
  }
  reader.readAsDataURL(file);
});

// HABILITAR BOTÓN AL MODIFICAR
document.querySelectorAll("#formGeneral input").forEach(input => {
  input.addEventListener("input", () => {
    btnGuardar.disabled = false;
  });
});

// CANCELAR
document.getElementById("btnCancelar").onclick = () => {
  document.getElementById("modalCancelar").style.display = "flex";
}

document.getElementById("btnNo").onclick = () => {
  document.getElementById("modalCancelar").style.display = "none";
}

document.getElementById("btnSi").onclick = () => {
  document.getElementById("modalCancelar").style.display = "none";
  location.reload();
}

// SUBMIT REAL
form.addEventListener("submit", function(e){
  e.preventDefault();

  let formData = new FormData(form);

  fetch("{{ route('perfil.actualizar') }}", {
    method: "POST",
    headers: {
      'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    },
    body: formData
  })
  .then(res => res.json())
  .then(data => {

    if(data.success){
      alertify.success(data.message);
    }else{
      alertify.error("No se pudieron guardar los datos");
    }

  })
  .catch(() => alertify.error("Error del servidor"));

});

</script>

</body>
</html>
