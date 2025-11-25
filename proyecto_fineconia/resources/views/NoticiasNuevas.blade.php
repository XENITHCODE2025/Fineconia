<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noticias - Fineconia</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto+Slab:wght@400;600&display=swap" rel="stylesheet">

<!-- Alertify -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    /* NAVBAR NUEVA */
    .navbar {
        background-color: #31565e;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 20px;
    }

    .logo-container img {
        height: 100px !important;
        width: 100%;
        object-fit: contain;
    }

    .navbar a {
      font-family: 'Open Sans', sans-serif !important;
      font-weight: 400 !important;
      color: #FFFFFF !important;
      text-decoration: none;
      font-size: 14px;
      padding: 10px 15px;
      transition: all 0.2s ease;
    }

    .navbar a:hover {
        text-decoration: underline !important;
    }

    /* ÁREA DE TÍTULO + BOTONES */
    .header-area {
        width: 90%;
        max-width: 1100px;
        margin: 40px auto 15px auto;
    }

    .header-area h1 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        color: #000000;
        font-size: 40px;
        margin-bottom: 15px;
    }

    .top-buttons {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
    }

    .btn {
        padding: 10px 30px;
        border-radius: 8px;
        border: 2px solid transparent;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none !important;
    }

    .btn-green {
        background: #2ecc71;
        color: white;
        border-color: #27ae60;
    }

    .btn-blue {
        background: white;
        border-color: #2980b9;
        color: #2980b9;
    }

    .btn-red {
        background: white;
        border-color: #c0392b;
        color: #c0392b;
    }

    /* CONTENEDOR PRINCIPAL */
    .container {
        width: 90%;
        max-width: 1100px;
        margin: 10px auto 40px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
    }

    /* Subtítulos */
    h3, label {
        font-family: 'Roboto Slab', serif;
        color: #000000;
    }

    label {
        display: block;
        margin-top: 15px;
        font-weight: 600;
        font-size: 15px;
    }

    input[type="text"], textarea {
        width: 100%;
        padding: 12px;
        border-radius: 5px;
        border: 2px solid #4BCA21; /* Trazo verde */
        outline: none;
        font-size: 15px;
    }

    textarea {
        height: 120px;
        resize: none;
    }

    .error-text {
        font-size: 13px;
        color: #BC1616;
        margin-top: 3px;
    }

    /* SECCIÓN IMAGEN + CATEGORÍAS */
    .flex-row {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    /* Caja de imagen */
   .image-box {
    width: 40%;
    border: 2px solid #4BCA21;
    border-radius: 8px;
    padding: 15px;

    /* Tamaño fijo del contenedor */
    height: 400px;
    box-sizing: border-box;

    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: left;
}

.preview {
    /* Área fija donde aparecerá la imagen */
    width: 100%;
    height: 100%;

    /* Fondo por si no hay imagen */
    background: #dcdcdc;

    border-radius: 5px;
    margin-bottom: 15px;

    /* La imagen se adapta SIN deformar y SIN cambiar el tamaño del contenedor */
    object-fit: contain;
    object-position: center;

    /* Evita que la imagen fuerce el contenedor hacia afuera */
    max-width: 100%;
    max-height: 100%;

    /* Esto bloquea completamente la deformación del contenedor */
    display: block;
}


    .upload-btn {
        background: #31565E;
        color: white;
        padding: 10px;
        border-radius: 5px;
        font-size: 15px;
        border: none;
        cursor: pointer;
        width: 120px;
    }

    /* Categorías */
    .categories {
        width: 50%;
        font-size: 15px;
    }

    .categories label {
        margin-top: 6px;
        font-family: 'Roboto Slab', serif;
        font-weight: normal;
    }

    /* BOTONES FINALES */
    .bottom-buttons {
        margin-top: 35px;
        display: flex;
        gap: 15px;
    }

    .btn-create {
        background: #31565E;
        padding: 12px 35px;
        color: white;
        border-radius: 6px;
        border: none;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-create:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .btn-cancel {
        background: white;
        padding: 12px 35px;
        color: #31565E;
        border-radius: 6px;
        border: 2px solid #31565E;
        font-size: 16px;
        cursor: pointer;
    }

    /* MODAL */
    .modal-bg {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        border: 2px solid black;
        border-radius: 10px;
        width: 400px;
        overflow: hidden;
    }

    .modal-header {
        background: #2A4145;
        padding: 15px;
        color: white;
        text-align: center;
        font-family: 'Open Sans', sans-serif;
    }

    .modal-body {
        padding: 20px;
        text-align: center;
        font-family: 'Open Sans', sans-serif;
        color: black;
    }

    .modal-buttons {
        display: flex;
        justify-content: space-evenly;
        padding: 20px;
    }

    .btn-yes {
        background: #CB3737;
        padding: 8px 25px;
        border: none;
        border-radius: 6px;
        color: white;
        cursor: pointer;
    }

    .btn-no {
        background: #31565E;
        padding: 8px 25px;
        border: none;
        border-radius: 6px;
        color: white;
        cursor: pointer;
    }

</style>
</head>

<body>

<!-- NAVBAR NUEVA -->
<div class="navbar">
    <div class="logo-container" style="max-width: 200px; width: 100%;">
        <img src="img/LogoCompleto.jpg" alt="Logo">
    </div>

    <a href="{{ route('fineconia.home') }}" class="nav-link">Home</a>
</div>

<!-- TÍTULO + BOTONES -->
<div class="header-area">
    <h1>NOTICIAS</h1>

    <div class="top-buttons">
        <a href="{{ route('noticias.nueva') }}" class="btn btn-green">Nueva</a>
        <a href="{{ route('noticias.actualizar') }}" class="btn btn-blue">Editar</a>
        <a href="{{ route('noticias.eliminar') }}" class="btn btn-red">Eliminar</a>
    </div>
</div>

<!-- CONTENEDOR PRINCIPAL -->
<div class="container">

    <h3>Llene los siguientes campos para crear una noticia</h3>

    <!-- TITULO -->
    <label>Título:</label>
    <input type="text" id="titulo">
    <p id="err-titulo" class="error-text"></p>

    <!-- DESCRIPCIÓN -->
    <label>Descripción:</label>
    <textarea id="descripcion"></textarea>
    <p id="err-descripcion" class="error-text"></p>

    <div class="flex-row">

        <!-- IMAGEN -->
        <div class="image-box">
            <label>Imagen:</label>

            <img class="preview" id="preview-img">

            <input type="file" id="image-input" accept="image/png, image/jpeg, image/jpg" style="display:none;">

            <button class="upload-btn" onclick="document.getElementById('image-input').click();">
                Subir imagen
            </button>

            <p id="err-imagen" class="error-text"></p>
        </div>

        <!-- CATEGORÍAS -->
        <div class="categories">
            <label>Categoría:</label>

            <label><input type="checkbox" class="cat"> Economía</label>
            <label><input type="checkbox" class="cat"> Finanzas Personales</label>
            <label><input type="checkbox" class="cat"> Mercados</label>
            <label><input type="checkbox" class="cat"> Emprendimiento</label>
            <label><input type="checkbox" class="cat"> Tecnología Financiera</label>
            <label><input type="checkbox" class="cat"> Inversiones</label>
            <label><input type="checkbox" class="cat"> Economía Familiar</label>
            <label><input type="checkbox" class="cat"> Educación Financiera</label>
            <label><input type="checkbox" class="cat"> Impuestos</label>

            <p id="err-cat" class="error-text"></p>
        </div>

    </div>

    <div class="bottom-buttons">
        <button class="btn-create" id="btn-crear" disabled>Crear</button>
        <button class="btn-cancel" id="btn-cancelar">Cancelar</button>
    </div>

</div>

<!-- MODAL -->
<div class="modal-bg" id="modal">
    <div class="modal-content">
        <div class="modal-header">¿Está seguro que desea cancelar?</div>

        <div class="modal-body">
            Se perderán los datos ingresados.
        </div>

        <div class="modal-buttons">
            <button class="btn-yes" id="modal-si">Si</button>
            <button class="btn-no" id="modal-no">No</button>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>

// ------------------------------
//   VALIDACIONES
// ------------------------------

function validateForm() {
    let valid = true;

    const titulo = document.getElementById("titulo");
    const descripcion = document.getElementById("descripcion");
    const imagen = document.getElementById("image-input");
    const categorias = document.querySelectorAll(".cat");
    const btnCrear = document.getElementById("btn-crear");

    // limpiar mensajes
    document.getElementById("err-titulo").innerText = "";
    document.getElementById("err-descripcion").innerText = "";
    document.getElementById("err-imagen").innerText = "";
    document.getElementById("err-cat").innerText = "";

    titulo.style.borderColor = "#4BCA21";
    descripcion.style.borderColor = "#4BCA21";

    // validar título
    if (titulo.value.trim() === "") {
        document.getElementById("err-titulo").innerText = "Complete todos los campos";
        titulo.style.borderColor = "#BC1616";
        valid = false;
    }

    // validar descripción
    if (descripcion.value.trim() === "") {
        document.getElementById("err-descripcion").innerText = "Complete todos los campos";
        descripcion.style.borderColor = "#BC1616";
        valid = false;
    }

    // validar imagen obligatoria
    if (!imagen.files[0]) {
        document.getElementById("err-imagen").innerText = "Complete todos los campos";
        valid = false;
    }

    // validar categorías
    let selected = 0;
    categorias.forEach(c => { if (c.checked) selected++; });

    if (selected === 0) {
        document.getElementById("err-cat").innerText = "Seleccione al menos una categoría";
        valid = false;
    }

    // habilitar o deshabilitar botón
    btnCrear.disabled = !valid;
}

// detectar cambios
document.getElementById("titulo").addEventListener("input", validateForm);
document.getElementById("descripcion").addEventListener("input", validateForm);

document.querySelectorAll(".cat").forEach(chk => {
    chk.addEventListener("change", validateForm);
});

// validar imagen al cargar
document.getElementById("image-input").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (!file) return;

    const ext = file.name.split(".").pop().toLowerCase();
    if (!["jpg", "jpeg", "png"].includes(ext)) {
        alertify.error("El formato de la imagen no es permitido");
        this.value = "";
        validateForm();
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById("preview-img").src = e.target.result;
    };
    reader.readAsDataURL(file);

    validateForm();
});

// ------------------------------
//   MODAL DE CANCELAR
// ------------------------------

const modal = document.getElementById("modal");

document.getElementById("btn-cancelar").addEventListener("click", () => {
    modal.style.display = "flex";
});

document.getElementById("modal-no").addEventListener("click", () => {
    modal.style.display = "none";
});

document.getElementById("modal-si").addEventListener("click", () => {
    modal.style.display = "none";

    // limpiar todo
    document.getElementById("titulo").value = "";
    document.getElementById("descripcion").value = "";
    document.getElementById("preview-img").src = "";
    document.getElementById("image-input").value = "";

    document.querySelectorAll(".cat").forEach(c => c.checked = false);

    validateForm();

    alertify.success("Acción cancelada");
});

// ------------------------------
//   BOTÓN CREAR
// ------------------------------

document.getElementById("btn-crear").addEventListener("click", () => {
    // Aquí NO se enviará a servidor (como pediste)
    alertify.success("Noticia creada exitosamente.");

    // limpiar
    document.getElementById("titulo").value = "";
    document.getElementById("descripcion").value = "";
    document.getElementById("preview-img").src = "";
    document.getElementById("image-input").value = "";
    document.querySelectorAll(".cat").forEach(c => c.checked = false);

    validateForm();
});

</script>

</body>
</html>