<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noticias - Fineconia</title>

<!-- ICONOS BOOTSTRAP -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- TIPOGRAFÍAS -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@700&family=Roboto+Slab:wght@400;600&display=swap" rel="stylesheet">

@vite('resources/css/Noticias.css')
</head>

<body>

<nav class="navbar">
  <div class="logo-container">

    <!-- Si usas Laravel, cambia esta línea por:
    <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo">
    -->
     <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo">

  </div>

  <div class="user-section header-user">
    <a href="{{ route('fineconia.home') }}" class="nav-link">Home</a>
  </div>
</nav>

<div class="news-header">
    <div class="header-left">
        <h1>NOTICIAS</h1>
        <div class="news-category">Finanzas | Economía</div>
    </div>
</div>

<!-- TARJETA -->
<div class="news-card">

    <!-- FILTRO -->
    <div class="inner-filter-container">
        <div class="inner-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Buscar noticia...">
        </div>

        <button class="inner-filter-btn">
            <i class="bi bi-funnel"></i>
        </button>
    </div>

    <div class="news-date">14 de noviembre de 2025.</div>

    <img class="news-img" src="https://www.minsalud.gob.sv/wp-content/uploads/2021/11/economia-1024x576.jpg">

    <div class="news-title">
        El Salvador proyecta un crecimiento del 3.8% impulsado por consumo familiar y digitalización
    </div>

    <div class="news-content">
        El Ministerio de Economía presentó este jueves su proyección más reciente, indicando que el país cerrará el año con un crecimiento estimado del 3.8% del PIB...
    </div>

    <div class="bottom-row">
        <button class="btn-more">Ver más</button>
        <div class="bottom-icons">
            <i class="bi bi-chat-dots comment-btn"></i>
            <i class="bi bi-star star-btn"></i>
        </div>
    </div>

    <div class="comment-section" id="commentSection">
        <div class="comment-box">
            <input type="text" class="comment-input" placeholder="Escribe un comentario">
            <button class="comment-share">Compartir</button>
        </div>
    </div>

</div>

<script>
document.querySelector(".star-btn").addEventListener("click", function () {
    if (this.classList.contains("bi-star")) {
        this.classList.replace("bi-star", "bi-star-fill");
        this.style.color = "#f1c40f";
    } else {
        this.classList.replace("bi-star-fill", "bi-star");
        this.style.color = "#777";
    }
});

document.querySelector(".comment-btn").addEventListener("click", () => {
    const section = document.getElementById("commentSection");
    section.style.display = section.style.display === "block" ? "none" : "block";
});

document.querySelector(".comment-share").addEventListener("click", () => {
    const commentInput = document.querySelector(".comment-input");
    if (commentInput.value.trim() !== "") {
        alert("Comentario enviado");
        commentInput.value = "";
    } else {
        alert("Por favor, escribe un comentario antes de enviar");
    }
});
</script>

</body>
</html>
