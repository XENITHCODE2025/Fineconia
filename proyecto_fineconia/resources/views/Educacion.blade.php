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


  <!-- Estilos externos -->
  @vite('resources/css/Educacion.css')

</head>

<body>
  <!-- HEADER -->
  <header class="header">
    <div class="logo-container" style="max-width: 200px; width: 100%;">
      <img src="img/LogoCompleto.jpg" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
    </div>
    <div class="user-section">

      @include('partials.header-user')
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
      <!-- Ejemplo de guía -->
      <div class="guia" data-categoria="Finanzas básicas">
        <img src="img/presupuesto.jpg" alt="Guía Presupuesto Familiar">
        <div class="guia-info">
          <div class="marca">FINECONIA</div>
          <div class="tipo-guia"><i class="fa-solid fa-book-open"></i> Guía | Educación Financiera</div>
          <h3>Cómo crear tu primer presupuesto familiar</h3>
        </div>
        <div class="guia-footer">
          <a href="{{ route('educacion.financiera.inicio') }}" class="btn-iniciar">Iniciar</a>
          <button class="btn-favorito"><i class="fa-regular fa-star"></i></button>
        </div>
      </div>

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


  <!-- JS -->
  <script>
    const inputBusqueda = document.getElementById('busqueda');
    const categoriaSelect = document.getElementById('categoria');
    const contenedorGuias = document.getElementById('guias');
    const sinResultados = document.getElementById('sin-resultados');
    const errorText = document.getElementById('error-text');
    const mensajeFavoritos = document.getElementById('mensaje-favoritos');
    const btnFavoritosTop = document.getElementById('favoritos');
    let mostrarFavoritos = false;

    function resaltarTexto(texto, busqueda) {
      if (!busqueda) return texto;
      const regex = new RegExp(`(${busqueda})`, 'gi');
      return texto.replace(regex, '<span class="resaltado">$1</span>');
    }

    function filtrarGuias() {
      const valorBusqueda = inputBusqueda.value.trim().toLowerCase();
      const categoriaSeleccionada = categoriaSelect.value.toLowerCase();
      const guias = contenedorGuias.querySelectorAll('.guia');
      let hayResultados = false;
      let hayFavoritos = false;

      guias.forEach(g => {
        const tituloOriginal = g.querySelector('h3').dataset.original || g.querySelector('h3').textContent;
        g.querySelector('h3').dataset.original = tituloOriginal;

        const categoria = g.dataset.categoria.toLowerCase();
        const esFavorita = g.classList.contains('favorita');

        const cumpleBusqueda = valorBusqueda === '' || tituloOriginal.toLowerCase().includes(valorBusqueda) || categoria.includes(valorBusqueda);
        const cumpleCategoria = categoriaSeleccionada === 'todas' || categoria === categoriaSeleccionada;
        const cumpleFavoritos = !mostrarFavoritos || esFavorita;

        const mostrar = cumpleBusqueda && cumpleCategoria && cumpleFavoritos;

        if (mostrar) {
          g.style.display = 'block';
          g.querySelector('h3').innerHTML = resaltarTexto(tituloOriginal, valorBusqueda);
          hayResultados = true;
        } else {
          g.style.display = 'none';
        }

        if (esFavorita) hayFavoritos = true;
      });

      if (mostrarFavoritos && !hayFavoritos) {
        mensajeFavoritos.style.display = 'block';
        sinResultados.style.display = 'none';
      } else {
        mensajeFavoritos.style.display = 'none';
        sinResultados.style.display = hayResultados ? 'none' : 'block';
      }
    }

    inputBusqueda.addEventListener('input', filtrarGuias);

    inputBusqueda.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        if (inputBusqueda.value.trim() === '') {
          errorText.style.display = 'block';
        } else {
          errorText.style.display = 'none';
          filtrarGuias();
        }
      }
    });

    categoriaSelect.addEventListener('change', filtrarGuias);

    btnFavoritosTop.addEventListener('click', () => {
      mostrarFavoritos = !mostrarFavoritos;
      btnFavoritosTop.innerHTML = mostrarFavoritos ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
      filtrarGuias();
    });

    document.querySelectorAll('.btn-favorito').forEach(btn => {
      btn.addEventListener('click', () => {
        const guia = btn.closest('.guia');
        guia.classList.toggle('favorita');
        btn.classList.toggle('activo');
        if (btn.classList.contains('activo')) {
          btn.innerHTML = '<i class="fa-solid fa-star"></i>';
          alertify.success("Guía agregada a favoritos con éxito.");
        } else {
          btn.innerHTML = '<i class="fa-regular fa-star"></i>';
          alertify.success("Guía desagregada de favoritos con éxito.");
        }
        if (mostrarFavoritos) filtrarGuias();
      });
    });

    document.querySelectorAll('.btn-iniciar').forEach(btn => {
      btn.addEventListener('click', () => {
        window.location.href = 'guia.html';
      });
    });
  </script>
</body>

</html>