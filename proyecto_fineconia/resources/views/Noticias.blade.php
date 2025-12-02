<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noticias - Fineconia</title>

<!-- FUENTES: Poppins & Roboto Slab -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;900&family=Roboto+Slab:wght@400;600&display=swap" rel="stylesheet">

<!-- ICONOS BOOTSTRAP -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- ALERTIFYJS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

 @vite('resources/css/Noticias.css')
</head>

<body>

<!-- NOMBRE DEL USUARIO (OCULTO) -->
<input type="hidden" id="nombre_completo" value="{{ Auth::user()->name }}">

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

<div class="news-header">
  <div class="header-left">
    <h1>NOTICIAS</h1>
    <div class="news-category">Finanzas | Economía</div>
  </div>
</div>

<!-- BUSCADOR -->
<div class="filter-container">
  <div class="inner-search">
    <i class="bi bi-search"></i>
    <input type="text" placeholder="Buscar noticia...">
  </div>
  <div class="filter-wrapper" style="position: relative;">
    <button class="inner-filter-btn" id="filter-btn">
      <i class="bi bi-funnel"></i>
    </button>
    <div class="filter-dropdown" id="filter-dropdown">
      <div class="filter-item">Economía</div>
      <div class="filter-item">Finanzas personales</div>
      <div class="filter-item">Mercados</div>
      <div class="filter-item">Emprendimiento</div>
      <div class="filter-item">Tecnología financiera</div>
      <div class="filter-item">Inversiones</div>
      <div class="filter-item">Educación financiera</div>
      <div class="filter-item">Impuestos</div>
    </div>
  </div>
</div>

<!-- CONTENEDOR DE NOTICIAS -->
<div class="news-container">

<!-- NOTICIA 1 -->
<div class="news-card">
  <div class="news-date">14 de noviembre de 2025.</div>
  <img class="news-img" src="https://www.minsalud.gob.sv/wp-content/uploads/2021/11/economia-1024x576.jpg" alt="Economía El Salvador">
  <div class="news-title">El Salvador proyecta un crecimiento del 3.8% impulsado por consumo familiar y digitalización</div>

  <div class="news-content">
    El Ministerio de Economía presentó este jueves su proyección más reciente, indicando que el país cerrará el año con un crecimiento estimado del 3.8% del PIB. Este aumento se atribuye a un mayor consumo de los hogares, la recuperación del sector comercio y el impulso de programas de digitalización empresarial que han fortalecido a las pequeñas y medianas empresas.
  </div>

  <div class="bottom-row">
    <button class="btn-more">Ver más</button>
    <button class="comment-btn"><i class="bi bi-chat-dots"></i> Comentarios</button>
    <button class="star-btn"><i class="bi bi-star"></i> Favoritos</button>
  </div>

  <div class="comment-section">
    <div class="comment-list"></div>
    <div class="comment-box">
      <input type="text" class="comment-input" placeholder="Escribe un comentario">
      <button class="comment-share">Compartir</button>
    </div>
  </div>
</div>


<!-- NOTICIA 2 -->
<div class="news-card">
  <div class="news-date">15 de noviembre de 2025.</div>
  <img class="news-img" src="https://www.elsalvador.com/wp-content/uploads/2025/10/bitcoin.jpg" alt="Bitcoin El Salvador">
  <div class="news-title">Bitcoin sigue ganando terreno en El Salvador...</div>

  <div class="news-content">
    La adopción del Bitcoin como moneda de curso legal continúa creciendo en el país, impulsada por nuevas plataformas digitales y programas educativos que fomentan su uso responsable.
  </div>

  <div class="bottom-row">
    <button class="btn-more">Ver más</button>
    <button class="comment-btn"><i class="bi bi-chat-dots"></i> Comentarios</button>
    <button class="star-btn"><i class="bi bi-star"></i> Favoritos</button>
  </div>

  <div class="comment-section">
    <div class="comment-list"></div>
    <div class="comment-box">
      <input type="text" class="comment-input" placeholder="Escribe un comentario">
      <button class="comment-share">Compartir</button>
    </div>
  </div>
</div>

<!-- NOTICIA 3 -->
<div class="news-card">
  <div class="news-date">16 de noviembre de 2025.</div>
  <img class="news-img" src="https://www.elmundo.es/internacional/el-salvador.jpg" alt="Digitalización PYMES El Salvador">
  <div class="news-title">El Salvador implementa programa de digitalización...</div>

  <div class="news-content">
    El Gobierno lanzó un nuevo programa para facilitar la digitalización de pymes, ofreciendo capacitación, herramientas de software y apoyo para la transformación tecnológica.
  </div>

  <div class="bottom-row">
    <button class="btn-more">Ver más</button>
    <button class="comment-btn"><i class="bi bi-chat-dots"></i> Comentarios</button>
    <button class="star-btn"><i class="bi bi-star"></i> Favoritos</button>
  </div>

  <div class="comment-section">
    <div class="comment-list"></div>
    <div class="comment-box">
      <input type="text" class="comment-input" placeholder="Escribe un comentario">
      <button class="comment-share">Compartir</button>
    </div>
  </div>
</div>

</div>

<script>

/* FAVORITOS */
document.querySelectorAll(".star-btn").forEach(btn => {
  btn.addEventListener("click", function () {
    const icon = this.querySelector("i");
    if (icon.classList.contains("bi-star")) {
      icon.classList.replace("bi-star", "bi-star-fill");
      alertify.success("Noticia añadida a tus favoritos");
    } else {
      icon.classList.replace("bi-star-fill", "bi-star");
      alertify.error("Noticia eliminada de tus favoritos");
    }
  });
});

/* MOSTRAR / OCULTAR COMENTARIOS */
document.querySelectorAll(".comment-btn").forEach(btn => {
  btn.addEventListener("click", () => {
    const section = btn.closest(".news-card").querySelector(".comment-section");
    section.style.display = (section.style.display === "flex") ? "none" : "flex";
  });
});

/* AGREGAR COMENTARIOS */
document.querySelectorAll(".comment-share").forEach(btn => {
  btn.addEventListener("click", () => {

    const username = document.getElementById("nombre_completo").value;
    const card = btn.closest(".news-card");
    const input = card.querySelector(".comment-input");
    const list = card.querySelector(".comment-list");

    if (input.value.trim() === "") {
      alertify.warning("Escribe un comentario");
      return;
    }

    const newComment = document.createElement("div");
    newComment.classList.add("comment-item");

    newComment.innerHTML = `
      <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png">
      <div class="comment-content">
          <span class="comment-username">${username}</span>
          <p class="comment-text">${input.value}</p>
      </div>
    `;

    list.appendChild(newComment);
    input.value = "";
    alertify.success("Comentario publicado");
  });
});

/* FILTRO DESPLEGABLE */
const filterBtn = document.getElementById('filter-btn');
const filterDropdown = document.getElementById('filter-dropdown');
filterBtn.addEventListener('click', () => {
  filterDropdown.style.display = filterDropdown.style.display === 'flex' ? 'none' : 'flex';
});
document.addEventListener('click', (e) => {
  if (!filterBtn.contains(e.target) && !filterDropdown.contains(e.target)) {
    filterDropdown.style.display = 'none';
  }
});

/* FUNCIONALIDAD DE VER MÁS (ahora busca la .news-content dentro de la misma .news-card) */
document.querySelectorAll(".btn-more").forEach(btn => {
    btn.addEventListener("click", function () {
        const card = this.closest(".news-card");
        const content = card.querySelector(".news-content");

        if (content.classList.contains("expanded")) {
            content.classList.remove("expanded");
            this.textContent = "Ver más";
        } else {
            content.classList.add("expanded");
            this.textContent = "Ver menos";
        }
    });
});
</script>
</body>
</html>