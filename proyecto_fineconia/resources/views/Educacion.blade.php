<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Educación Financiera - Fineconia</title>

  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Fuentes -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

  <!-- AlertifyJS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css">
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    .guia-portada-container {
      width: 100%;
      height: 160px;
      /* fija la altura del espacio de la portada */
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f0f0f0;
      /* opcional: color de fondo para portadas vacías */
      border-bottom: 1px solid #ddd;
      /* opcional: separación visual */
    }

    .guia-portada-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }


    body {
      background-color: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* HEADER */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #31565e;
      padding: 15px 30px;
      color: white;
      flex-wrap: wrap;
    }

    .logo-container {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo-container img {
      width: 140px;
      height: auto;
      object-fit: contain;
    }

    .logo-container h1 {
      font-size: 22px;
      font-weight: 700;
      color: white;
    }

    .user-section {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-icon {
      font-size: 26px;
      cursor: pointer;
      color: white;
    }

    .user-icon:hover {
      color: #f9b924;
    }

    /* CONTENIDO */
    .contenido {
      flex: 1;
      padding: 30px 40px;
    }

    .contenido h2 {
      color: #62AF46;
      font-size: 26px;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    .contenido h2 i {
      color: #62AF46;
    }

    /* BUSCADOR */
    .buscador {
      display: flex;
      align-items: center;
      gap: 15px;
      flex-wrap: wrap;
      margin-bottom: 15px;
      position: relative;
    }

    .buscador input {
      flex: 1;
      max-width: 250px;
      padding: 10px 35px 10px 35px;
      border: 1px solid #000;
      border-radius: 8px;
      font-family: 'Open Sans', sans-serif;
    }

    .buscador input::placeholder {
      color: #A49696;
    }

    .buscador i.fa-search {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #A49696;
    }

    .buscador select {
      padding: 10px;
      border: 1px solid #000;
      border-radius: 8px;
      font-family: 'Open Sans', sans-serif;
    }

    .buscador label {
      font-weight: 600;
      color: #000;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .buscador button {
      background: none;
      border: none;
      cursor: pointer;
      color: #000;
      font-size: 22px;
    }

    .buscador button:hover {
      transform: scale(1.1);
    }

    .error-text {
      color: #DE3B3B;
      font-size: 14px;
      margin-top: 5px;
      display: none;
    }

    /* GRID DE GUIAS */
    .guias-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 25px;
      background: #fff;
      border: 1px solid #D0D0D0;
      border-radius: 10px;
      padding: 15px;
      max-height: 500px;
      overflow-y: auto;
    }

    .guia {
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      background-color: #fdfdfd;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
    }

    .guia:hover {
      transform: scale(1.02);
    }

    .guia img {
      width: 100%;
      height: 160px;
      object-fit: cover;
    }

    .guia-info {
      padding: 15px;
    }

    .guia-info .marca {
      color: #3ba64c;
      font-weight: 600;
      font-size: 13px;
      margin-bottom: 3px;
      font-family: 'Open Sans', sans-serif;
    }

    .guia-info .tipo-guia {
      color: #000;
      font-size: 13px;
      display: flex;
      align-items: center;
      gap: 5px;
      font-family: 'Open Sans', sans-serif;
    }

    .guia-info h3 {
      font-size: 17px;
      margin-top: 10px;
      margin-bottom: 12px;
      font-weight: 700;
      color: #000;
      font-family: 'Poppins', sans-serif;
    }

    .guia-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 15px 15px 15px;
    }

    .btn-iniciar {
      background-color: #31565e;
      color: white;
      border: none;
      padding: 7px 20px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
    }

    .btn-iniciar:hover {
      background-color: #3b6e76;
    }

    .btn-favorito {
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      color: #000;
      font-size: 18px;
    }

    .btn-favorito.activo {
      color: #000000;
    }

    .sin-resultados {
      text-align: center;
      color: #000;
      font-weight: 500;
      margin-top: 15px;
    }

    /* LINEA DIVISORA */
    .linea-divisora {
      width: 100%;
      height: 1px;
      background-color: #000;
      margin-top: 40px;
    }

    /* FOOTER */
    .footer {
      background-color: #31565e;
      color: #fff;
      padding: 25px 20px;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      max-width: 1200px;
      margin: 0 auto;
      flex-wrap: wrap;
      gap: 20px;
    }

    .footer-links,
    .footer-contact {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .footer-links a,
    .footer-contact a {
      color: #fff;
      text-decoration: none;
      font-size: 15px;
      font-family: 'Poppins', sans-serif;
    }

    .footer-links a:hover,
    .footer-contact a:hover {
      text-decoration: underline;
    }

    @media (max-width: 992px) {
      .guias-container {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .guias-container {
        grid-template-columns: 1fr;
      }
    }

    /* Resaltar búsqueda */
    .resaltado {
      background-color: #F9B924;
      padding: 0 2px;
      border-radius: 2px;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <header class="header">
    <div class="logo-container" style="max-width: 200px; width: 100%;">
      <img src="img/LogoCompleto.jpg" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
    </div>
    <div class="user-section">
      @include('partials.header-user') {{-- ← nuevo partial --}}
    </div>
  </header>

  <!-- CONTENIDO -->
  <main class="contenido">
    <h2><i class="fa-solid fa-book-open"></i> Educación Financiera</h2>

    <!-- BUSCADOR -->
    <div class="buscador">
      <i class="fa fa-search"></i>
      <input id="busqueda" type="text" placeholder="Buscar guía">
      <label for="categoria">Categorías:</label>
      <select id="categoria">
        <option value="todas">Todas</option>
        <option>Finanzas basicas</option>
        <option>Ahorro y metas</option>
        <option>Credito y deudas</option>
        <option>Inversion y futuro</option>
        <option>Economia en la vida diaria</option>
        <option>Seguridad financiera</option>
        <option>Finanzas familiares</option>
        <option>Emprendimiento y trabajo</option>
      </select>
      <label for="favoritos">Favoritos:</label>
      <button id="favoritos"><i class="fa-regular fa-star"></i></button>
    </div>
    <p id="error-text" class="error-text">Ingrese al menos una palabra</p>

    <p id="mensaje-favoritos" class="sin-resultados" style="display:none;">Aún no tienes guías guardadas como favoritas</p>
    <p id="sin-resultados" class="sin-resultados" style="display:none;">No se han encontrado resultados para su búsqueda</p>

<!-- CONTENEDOR GUIAS -->
<div id="guias" class="guias-container">
  @foreach($guias as $guia)
  <div class="guia" data-path="{{ $guia['ruta'] }}" data-categoria="{{ $guia['categoria'] }}">

    {{-- Contenedor para la miniatura o portada --}}
    <div class="guia-portada-container"
         style="display: flex; justify-content: center; align-items: center; width: 100%; height: 220px; overflow: hidden; background-color: #f8f8f8; border-radius: 8px;">
      @php
        $urlPortada = $guia['miniatura'] ? Storage::url($guia['miniatura']) : asset('img/portada-pdf.png');
      @endphp

      <img
        src="{{ $urlPortada }}"
        alt="Portada {{ $guia['titulo'] }}"
        class="guia-portada"
        style="width: 100%; height: 100%; object-fit: contain; display: block;">
    </div>

    <div class="guia-info">
      <div class="marca">FINECONIA</div>
      <div class="tipo-guia">
        <i class="fa-solid fa-book-open"></i> Guía | {{ $guia['categoria'] }}
      </div>
      <h3>{{ $guia['titulo'] }}</h3>
    </div>

    <div class="guia-footer">
      <button
        class="btn-iniciar"
        onclick="window.open('{{ Storage::url($guia['ruta']) }}', '_blank')">
        Iniciar
      </button>
      <button class="btn-favorito">
        <i class="fa-regular fa-star"></i>
      </button>
    </div>
  </div>
  @endforeach
</div>

  </main>

  <div class="linea-divisora"></div>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-links">
        <a href="#">Ayuda</a>
        <a href="#">Sugerencias y opiniones</a>
      </div>
      <div class="footer-contact">
        <a href="mailto:fineconia@gmail.com"><i class="fa-regular fa-envelope"></i> fineconia@gmail.com</a>
        <a href="#"><i class="fa-brands fa-facebook"></i> Fineconia</a>
      </div>
    </div>
  </footer>

<script>
document.addEventListener('DOMContentLoaded', async () => {
  const inputBusqueda = document.getElementById('busqueda');
  const categoriaSelect = document.getElementById('categoria');
  const contenedorGuias = document.getElementById('guias');
  const sinResultados = document.getElementById('sin-resultados');
  const errorText = document.getElementById('error-text');
  const mensajeFavoritos = document.getElementById('mensaje-favoritos');
  const btnFavoritosTop = document.getElementById('favoritos');
  let mostrarFavoritos = false;
  let favoritosGuardados = [];

  // --- Cargar favoritos desde base de datos ---
  try {
    const res = await fetch('/favoritos');
    if (res.ok) {
      favoritosGuardados = await res.json();
    }
  } catch (err) {
    console.error('Error al cargar favoritos:', err);
  }

  // --- Resalta coincidencias ---
  function resaltarTexto(texto, busqueda) {
    if (!busqueda) return texto;
    const regex = new RegExp(`(${busqueda})`, 'gi');
    return texto.replace(regex, '<span class="resaltado">$1</span>');
  }

  // --- Aplica filtros de búsqueda, categoría y favoritos ---
  function filtrarGuias() {
    const valorBusqueda = inputBusqueda.value.trim().toLowerCase();
    const categoriaSeleccionada = categoriaSelect.value.toLowerCase();
    const guias = contenedorGuias.querySelectorAll('.guia');
    let hayResultados = false;
    let hayFavoritos = false;

    guias.forEach((g) => {
      const titulo = g.querySelector('h3');
      const tituloOriginal = titulo.dataset.original || titulo.textContent;
      titulo.dataset.original = tituloOriginal;

      const categoria = g.dataset.categoria.toLowerCase();
      const path = g.dataset.path;
      const esFavorita = favoritosGuardados.includes(path);

      const cumpleBusqueda =
        valorBusqueda === '' ||
        tituloOriginal.toLowerCase().includes(valorBusqueda) ||
        categoria.includes(valorBusqueda);
      const cumpleCategoria =
        categoriaSeleccionada === 'todas' || categoria === categoriaSeleccionada;
      const cumpleFavoritos = !mostrarFavoritos || esFavorita;

      const mostrar = cumpleBusqueda && cumpleCategoria && cumpleFavoritos;

      if (mostrar) {
        g.style.display = 'block';
        titulo.innerHTML = resaltarTexto(tituloOriginal, valorBusqueda);
        hayResultados = true;
      } else {
        g.style.display = 'none';
      }

      if (esFavorita) hayFavoritos = true;
    });

    // --- Mostrar mensajes según el resultado ---
    if (mostrarFavoritos && !hayFavoritos) {
      mensajeFavoritos.style.display = 'block';
      mensajeFavoritos.style.textAlign = 'center';
      mensajeFavoritos.style.color = '#000';
      sinResultados.style.display = 'none';
    } else {
      mensajeFavoritos.style.display = 'none';
      sinResultados.style.display = hayResultados ? 'none' : 'block';
    }

    return { hayResultados, valorBusqueda };
  }

  // --- Inicializar botones de favoritos ---
  document.querySelectorAll('.btn-favorito').forEach((btn) => {
    const guia = btn.closest('.guia');
    const path = guia.dataset.path;

    if (favoritosGuardados.includes(path)) {
      guia.classList.add('favorita');
      btn.classList.add('activo');
      btn.innerHTML = '<i class="fa-solid fa-star"></i>';
    }

    btn.addEventListener('click', async () => {
      try {
        const res = await fetch('/favorito/toggle', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({ guia_path: path })
        });

        const result = await res.json();

        if (result.status === 'added') {
          guia.classList.add('favorita');
          btn.classList.add('activo');
          btn.innerHTML = '<i class="fa-solid fa-star"></i>';
          if (!favoritosGuardados.includes(path)) favoritosGuardados.push(path);
          alertify.success("Guía agregada a favoritos con éxito.");
        } else {
          guia.classList.remove('favorita');
          btn.classList.remove('activo');
          btn.innerHTML = '<i class="fa-regular fa-star"></i>';
          favoritosGuardados = favoritosGuardados.filter(p => p !== path);
          alertify.success("Guía desagregada de favoritos con éxito.");
        }

        if (mostrarFavoritos) filtrarGuias();
      } catch (err) {
        console.error('Error al cambiar favorito:', err);
      }
    });
  });

  // --- Filtro de favoritos ---
  btnFavoritosTop.addEventListener('click', () => {
    mostrarFavoritos = !mostrarFavoritos;
    btnFavoritosTop.innerHTML = mostrarFavoritos
      ? '<i class="fa-solid fa-star"></i>'
      : '<i class="fa-regular fa-star"></i>';
    filtrarGuias();
    alertify.success('Listado de favoritos obtenido con éxito.');
  });

  // --- Búsqueda solo al presionar Enter ---
  inputBusqueda.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
      const busqueda = inputBusqueda.value.trim();
      if (busqueda === '') {
        errorText.style.display = 'block';
      } else {
        errorText.style.display = 'none';
        const { hayResultados } = filtrarGuias();
        if (hayResultados) {
          alertify.success('Búsqueda completada con éxito.');
        } else {
          alertify.error('No se han encontrado resultados para su búsqueda.');
        }
      }
    }
  });

  // --- Restaurar guías al borrar búsqueda ---
  inputBusqueda.addEventListener('input', () => {
    if (inputBusqueda.value.trim() === '') {
      errorText.style.display = 'none';
      filtrarGuias(); // vuelve a mostrar todas las guías
    }
  });

  // --- Cambio de categoría ---
  categoriaSelect.addEventListener('change', filtrarGuias);

  // --- Cargar favoritos al inicio ---
  filtrarGuias();
});
</script>
</body>

</html>