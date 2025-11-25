<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nuevo usuario</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    @vite('resources/css/CrearUnDios.css')
</head>

<body>

<nav class="navbar">
  <div class="logo-container" style="max-width: 200px; width: 100%;">
    <img src="img/LogoCompleto.jpg" alt="Logo">
  </div>
  <div class="user-section header-user">
    <a href="{{ route('fineconia.home') }}" class="nav-link">Home</a>
  </div>
</nav>

<div class="page-container">

    <div class="title-container">
        <h1 class="page-title" style="color: black; margin-left: 30px;">Crear nuevo usuario administrativo</h1>
        <p class="page-description">Complete la información necesaria para registrar y dar permisos al usuario.</p>
    </div>

    <div class="flex-wrapper">

        <div class="form-container">
            <h3 class="section-title">Datos Personales</h3>

            <div class="field-group">
                <div class="field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre">
                </div>

                <div class="field">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido">
                </div>
            </div>

            <div class="field">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email">
            </div>

            <h3 class="section-title">Credenciales de acceso</h3>

            <div class="field">
                <label for="password">Contraseña</label>
                <input type="password" id="password">
            </div>

            <div class="field">
                <label for="confirm-password">Confirmar contraseña</label>
                <input type="password" id="confirm-password">
            </div>

            <div style="margin-top: 15px;">
                <span>Rol:</span>
                <div class="role-display"><strong>Administrador</strong></div>
            </div>

            <h3 class="section-title">Permisos administrativos</h3>

            <div class="checkbox-group">
                <input type="checkbox" class="permiso" value="guias" id="permiso1">
                <label for="permiso1">Administrar Guías de Educación financiera</label>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" class="permiso" value="consejos" id="permiso2">
                <label for="permiso2">Administrar Consejos de ahorro</label>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" class="permiso" value="noticias" id="permiso3">
                <label for="permiso3">Administrar Noticias</label>
            </div>

            <div class="btn-container">
                <button class="btn-cancelar">Cancelar</button>
                <button class="btn-guardar" disabled style="opacity: 0.5; cursor: not-allowed;">Guardar</button>
            </div>
        </div>

        <div class="photo-box">
            <div>
                <div class="photo-icon" id="preview-photo">
                    <i class="bi bi-person-circle"></i>
                </div>
                <button class="btn-upload" id="uploadBtn">Subir Imagen</button>
                <input type="file" id="fileInput" accept="image/*" style="display:none;">
            </div>
        </div>

    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    const guardarBtn = document.querySelector('.btn-guardar');
    const cancelarBtn = document.querySelector('.btn-cancelar');
    const permisos = document.querySelectorAll('.permiso');
    const fileInput = document.getElementById('fileInput');
    const uploadBtn = document.getElementById('uploadBtn');
    const previewPhoto = document.getElementById('preview-photo');

    let imagenCargada = false;

    uploadBtn.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewPhoto.innerHTML = `<img src="${e.target.result}" style="width:120px; height:120px; border-radius:50%; object-fit:cover;">`;
            }
            reader.readAsDataURL(this.files[0]);
            imagenCargada = true;
            validarFormulario();
        }
    });

    permisos.forEach(p => p.addEventListener('change', validarFormulario));
    document.querySelectorAll('#password, #confirm-password, #nombre, #apellido, #email').forEach(inp => {
        inp.addEventListener('input', validarFormulario);
    });

    function validarFormulario() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        const permisosMarcados = [...permisos].some(p => p.checked);

        const todoCompleto =
            imagenCargada &&
            permisosMarcados &&
            password !== "" &&
            confirmPassword !== "" &&
            password === confirmPassword;

        if (todoCompleto) {
            guardarBtn.disabled = false;
            guardarBtn.style.opacity = "1";
            guardarBtn.style.cursor = "pointer";
        } else {
            guardarBtn.disabled = true;
            guardarBtn.style.opacity = "0.5";
            guardarBtn.style.cursor = "not-allowed";
        }
    }

    // ⭐⭐⭐ ENVÍO REAL CON FETCH ⭐⭐⭐
    guardarBtn.addEventListener('click', async function() {

    const permisosSeleccionados = [...permisos]
        .filter(p => p.checked)
        .map(p => p.value);

    const formData = new FormData();
    formData.append('nombre', document.getElementById('nombre').value);
    formData.append('apellido', document.getElementById('apellido').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('password', document.getElementById('password').value);
    formData.append('rol', 'Administrador');
    formData.append('imagen', fileInput.files[0]);

    permisosSeleccionados.forEach(p => formData.append('permisos[]', p));

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch("{{ route('admin.usuarios.store') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": token
            },
            body: formData
        });

        const result = await response.json();

        if (result.status === "ok") {
            alertify.success("Usuario administrador registrado exitosamente");

            // OPCIONAL: limpiar formulario
            // cancelarBtn.click();
        } else {
            alertify.error("Error: " + result.message);
        }

    } catch (err) {
        alertify.error("Error inesperado al registrar el usuario");
    }
});


    cancelarBtn.addEventListener('click', function() {
        if (confirm('¿Cancelar y borrar todo?')) {
            document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]').forEach(i => i.value = '');
            permisos.forEach(c => c.checked = false);
            fileInput.value = "";
            previewPhoto.innerHTML = '<i class="bi bi-person-circle"></i>';
            imagenCargada = false;
            validarFormulario();
        }
    });

});
</script>

</body>
</html>
