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

  @vite('resources/css/Educacion.css')

  <!-- ÍCONOS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <!-- HEADER -->
  <header class="header">
    <div class="logo-container" style="max-width: 200px; width: 100%;">
      <img src="img/LogoCompleto.jpg" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
    </div>
    <!-- BOTÓN DE USUARIO -->
    <div class="user-section" id="btn-user">
      @include('partials.header-user') {{-- ← partial del usuario --}}
    </div>

    <!-- DESPLEGABLE DEL MENÚ USUARIO -->
    <div class="user-menu" id="userMenu">
      <div class="menu-container">
        <div class="menu-header">
          <i class="bi bi-person-circle"></i>
          <span>{{ Auth::user()->name }}</span>
        </div>

        <div class="menu-item" id="btn-datos">
          <span>Datos Generales</span>
          <i class="bi bi-chevron-right"></i>
        </div>

         <div class="menu-item" id="btn-objetivos">
            <a href="{{ route('centro.objetivos') }}" style="text-decoration: none; color: inherit;">
              <span>Mis Objetivos</span>
              <i class="bi bi-chevron-right"></i>
            </a>
          </div>

        <div class="menu-item">
          <span>Ayuda</span>
          <i class="bi bi-chevron-right"></i>
        </div>

        <form id="logoutForm" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn">Cerrar sesión</button>
        </form>

      </div>
    </div>

    <script>
      const userBtn = document.getElementById('btn-user');
      const userMenu = document.getElementById('userMenu');
      const btnDatos = document.getElementById('btn-datos');
      const btnLogout = document.getElementById('btnLogout');

      // Mostrar / ocultar menú al hacer clic en el botón del usuario
      userBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isVisible = userMenu.style.display === 'block';
        userMenu.style.display = isVisible ? 'none' : 'block';
      });

      // Redirigir al hacer clic en "Datos Generales"
      btnDatos.addEventListener('click', () => {
        window.location.href = "{{ route('centro.usuario') }}";
      });

      // Cerrar menú si se hace clic fuera
      document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target) && !userBtn.contains(e.target)) {
          userMenu.style.display = 'none';
        }
      });

      // Simulación de cierre de sesión
      btnLogout.addEventListener('click', () => {
        alert('Sesión cerrada');
        userMenu.style.display = 'none';
      });

      // Redirigir al hacer clic en "Mis Objetivos"
      const btnObjetivos = document.getElementById('btn-objetivos');
      btnObjetivos.addEventListener('click', () => {
        window.location.href = "{{ route('centro.objetivos') }}";
      });
    </script>
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
            onclick="window.location.href='{{ route('ruta.guia') }}'">
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

        return {
          hayResultados,
          valorBusqueda
        };
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
              body: JSON.stringify({
                guia_path: path
              })
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
        btnFavoritosTop.innerHTML = mostrarFavoritos ?
          '<i class="fa-solid fa-star"></i>' :
          '<i class="fa-regular fa-star"></i>';
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
            const {
              hayResultados
            } = filtrarGuias();
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