<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Plantilla principal</title>
  @vite('resources/css/ConsejosDeAhorro.css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <!-- Fuente Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <!-- Fuente Open Sans -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

</head>
<body>
  <header class="header">
    <!-- Logo -->
    <div class="logo-container">
      <img src="img/LogoCompleto.jpg" alt="Logo" class="responsive-logo">
    </div>

    <!-- Menú de navegación -->
    <div class="menu">
      <a href="{{ route('ahorro') }}" class="nav-link {{ request()->routeIs('ahorro') ? 'active' : '' }}">Ahorro</a>
      <a href="{{ route('consejos.ahorro') }}" class="nav-link active">Consejos</a>
      <a href="{{ route('objetivos.nuevo') }}" class="nav-link {{ request()->routeIs('objetivos.*') ? 'active' : '' }}">Objetivos</a>
      <a href="{{ route('graficas.ahorro') }}" class="nav-link {{ request()->is('graficas') ? 'active' : '' }}">Gráficas</a>
    </div>

    <div class="menu-toggle" id="menu-toggle">
    <i class="fas fa-bars"></i>
  </header>

  <!-- Menú desplegable (móvil) -->
  <nav class="mobile-menu" id="mobile-menu">
    <a href="{{ route('ahorro') }}" class="mobile-nav-link">Ahorro</a>
    <a href="{{ route('consejos.ahorro') }}" class="mobile-nav-link active">Consejos</a>
    <a href="{{ route('objetivos.nuevo') }}" class="mobile-nav-link">Objetivos</a>
    <a href="{{ route('graficas.ahorro') }}" class="mobile-nav-link">Gráficas</a>
  </nav>

  <main class="contenido">
    <section class="titulo-consejos">
      <h2>CONSEJOS DE AHORRO</h2>
    </section>

    <p class="subtexto-consejos">
      Ahorrar te da seguridad, estabilidad y te ayuda a cumplir tus metas sin deudas.
    </p>

    <section class="consejos-grid">
      <!-- Lado izquierdo: categorías -->
      <div class="categorias">
<section class="filtro-consejos">
  <!-- Botón de categorías -->
  <select id="filtro-categoria">
    <option value="todas">Categorías</option>
    <option value="presupuesto">Presupuesto</option>
    <option value="compras">Compras Inteligentes</option>
    <option value="energia">Energía y Servicio</option>
    <option value="metas">Metas de ahorro</option>
    <option value="familiar">Familiar</option>
  </select>

  <!-- Caja de búsqueda con mensaje de error -->
  <div class="busqueda-container">
    <input type="text" id="buscador-consejos" placeholder="Buscar consejo..." />
    <p id="mensaje-error" class="mensaje-error"></p>
  </div>
</section>


        <!-- Presupuesto -->
       
<div class="categoria" data-categoria="presupuesto">
  <i class="bi bi-clipboard2-check"></i>
  <span>Presupuesto</span>
  <i class="bi bi-chevron-down flecha"></i>
</div>
<ul class="consejos-lista" data-categoria="presupuesto">
  @foreach($consejosBySlug['presupuesto'] as $c)
    <li
      data-id="{{ $c->id }}"
      data-titulo="{{ $c->titulo }}"
      data-descripcion="{{ $c->descripcion }}"
      data-subconsejos='@json($c->subconsejos ?? [])'>
      <strong>Consejo {{ $loop->iteration }}:</strong> {{ $c->titulo }}
    </li>
  @endforeach

  @if($consejosBySlug['presupuesto']->isEmpty())
    <li class="empty">No hay consejos en esta categoría.</li>
  @endif
</ul>

<!-- Compras Inteligentes -->
<div class="categoria" data-categoria="compras">
  <i class="bi bi-cart3"></i>
  <span>Compras Inteligentes</span>
  <i class="bi bi-chevron-down flecha"></i>
</div>
<ul class="consejos-lista" data-categoria="compras">
  @foreach($consejosBySlug['compras'] as $c)
    <li 
      data-id="{{ $c->id }}"
      data-titulo="{{ $c->titulo ?? '' }}"
      data-descripcion="{{ $c->descripcion ?? '' }}"
      data-subconsejos='@json($c->subconsejos ?? [])'>
      <strong>Consejo {{ $loop->iteration }}:</strong> {{ $c->titulo ?? '' }}
    </li>
  @endforeach

  @if($consejosBySlug['compras']->isEmpty())
    <li class="empty">No hay consejos en esta categoría.</li>
  @endif
</ul>

<!-- Energía y Servicio -->
<div class="categoria" data-categoria="energia">
  <i class="bi bi-lightbulb"></i>
  <span>Energía y Servicio</span>
  <i class="bi bi-chevron-down flecha"></i>
</div>
<ul class="consejos-lista" data-categoria="energia">
  @foreach($consejosBySlug['energia'] as $c)
    <li
      data-id="{{ $c->id }}"
      data-titulo="{{ $c->titulo }}"
      data-descripcion="{{ $c->descripcion }}"
      data-subconsejos='@json($c->subconsejos ?? [])'>
      <strong>Consejo {{ $loop->iteration }}:</strong> {{ $c->titulo }}
    </li>
  @endforeach

  @if($consejosBySlug['energia']->isEmpty())
    <li class="empty">No hay consejos en esta categoría.</li>
  @endif
</ul>

<!-- Metas de ahorro -->
<div class="categoria" data-categoria="metas">
  <i class="bi bi-flag"></i>
  <span>Metas de ahorro</span>
  <i class="bi bi-chevron-down flecha"></i>
</div>
<ul class="consejos-lista" data-categoria="metas">
  @foreach($consejosBySlug['metas'] as $c)
    <li
      data-id="{{ $c->id }}"
      data-titulo="{{ $c->titulo }}"
      data-descripcion="{{ $c->descripcion }}"
      data-subconsejos='@json($c->subconsejos ?? [])'>
      <strong>Consejo {{ $loop->iteration }}:</strong> {{ $c->titulo }}
    </li>
  @endforeach

  @if($consejosBySlug['metas']->isEmpty())
    <li class="empty">No hay consejos en esta categoría.</li>
  @endif
</ul>

<!-- Familiar -->
<div class="categoria" data-categoria="familiar">
  <i class="bi bi-people"></i>
  <span>Familiar</span>
  <i class="bi bi-chevron-down flecha"></i>
</div>
<ul class="consejos-lista" data-categoria="familiar">
  @foreach($consejosBySlug['familiar'] as $c)
    <li
      data-id="{{ $c->id }}"
      data-titulo="{{ $c->titulo }}"
      data-descripcion="{{ $c->descripcion }}"
      data-subconsejos='@json($c->subconsejos ?? [])'>
      <strong>Consejo {{ $loop->iteration }}:</strong> {{ $c->titulo }}
    </li>
  @endforeach

  @if($consejosBySlug['familiar']->isEmpty())
    <li class="empty">No hay consejos en esta categoría.</li>
  @endif
</ul>



</div>

      <!-- Cuadro derecho -->
      <div id="tarjeta-contenido" class="tarjeta">
       <h3 id="consejo-titulo">Selecciona una categoria para visualizar sus consejos aqui.</h3>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
  document.getElementById("menu-toggle").addEventListener("click", function () {
  document.getElementById("mobile-menu").classList.toggle("active");
});

function checkScreenSize() {
  const mobileMenu = document.getElementById("mobile-menu");
  if (window.innerWidth > 768 && mobileMenu.classList.contains("active")) {
    mobileMenu.classList.remove("active");
  }
}

window.addEventListener("load", () => {
  checkScreenSize();
  // Al cargar la página, aplicamos la clase default-style para el h3
  document.getElementById('consejo-titulo').classList.add('default-style');
});

window.addEventListener("resize", checkScreenSize);

document.querySelectorAll('.mobile-nav-link').forEach(link => {
  link.addEventListener('click', function () {
    document.getElementById('mobile-menu').classList.remove('active');
  });
});

// Expandir categoría (solo una abierta a la vez)
document.querySelectorAll('.categoria').forEach(categoria => {
  categoria.addEventListener('click', () => {
    const cat = categoria.dataset.categoria;

    // Cerrar otras listas
    document.querySelectorAll('.consejos-lista.visible').forEach(lista => {
      if (lista.dataset.categoria !== cat) {
        lista.classList.remove('visible');
      }
    });

    // Abrir/cerrar la seleccionada
    const lista = document.querySelector(`.consejos-lista[data-categoria="${cat}"]`);
    if (lista) {
      lista.classList.toggle('visible');
    }
  });
});



// Cambiar contenido y resaltar de la tarjeta consejos
document.querySelectorAll('.consejos-lista li').forEach(item => {
  item.addEventListener('click', () => {
    document.querySelectorAll('.consejos-lista li').forEach(li => li.classList.remove('activo'));
    item.classList.add('activo');

    const titulo = item.dataset.titulo || '';
    const descripcion = item.dataset.descripcion || '';
    let subconsejos = [];

    try {
      subconsejos = JSON.parse(item.dataset.subconsejos || "[]");
    } catch (e) {
      subconsejos = [];
    }

    const tarjeta = document.getElementById('tarjeta-contenido');
    tarjeta.innerHTML = `
      <h3 id="consejo-titulo">${titulo}. ${descripcion}</h3>
      <ul class="subconsejos-list">
        ${subconsejos.length > 0 
            ? subconsejos.map(s => `<li>${s}</li>`).join('')
            : '<li>No hay subconsejos disponibles</li>'
        }
      </ul>
    `;
  });
});





  </script>
<script>
const filtroCategoria = document.getElementById('filtro-categoria');
const buscador = document.getElementById('buscador-consejos');
const mensajeError = document.getElementById('mensaje-error');
const todasLasCategorias = document.querySelectorAll('.consejos-lista');
const tarjeta = document.getElementById('tarjeta-contenido');

// Cambia a false si prefieres que coincida con ANY (OR) en lugar de ALL (AND)
const matchAllKeywords = true;

// Normaliza texto: quita acentos, deja minúsculas y elimina puntuación extra
function normalizeText(s) {
  return String(s || '')
    .normalize('NFD')                         // separar letras + diacríticos
    .replace(/[\u0300-\u036f]/g, '')         // quitar diacríticos
    .toLowerCase()
    .replace(/[^a-z0-9\s]/g, ' ')            // quitar puntuación (deja espacios)
    .replace(/\s+/g, ' ')
    .trim();
}

// Escape para evitar inyección al insertar HTML (si usas innerHTML)
function escapeHtml(str) {
  return String(str || '')
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function ejecutarBusqueda() {
  const categoriaSeleccionada = filtroCategoria.value || 'todas';
  const textoRaw = buscador.value || '';
  const textoBusquedaNormalized = normalizeText(textoRaw);

  // dividir en palabras clave
  const palabrasClave = textoBusquedaNormalized.split(/\s+/).filter(Boolean);

  // Mostrar error si no hay palabra (pero igual limpiamos los campos después)
  if (palabrasClave.length === 0) {
    mensajeError.textContent = "Ingrese al menos una palabra";
    mensajeError.classList.add("visible");

    // limpiar campos según requisito (siempre limpiar al presionar Enter)
    buscador.value = "";
    filtroCategoria.value = "todas";
    return;
  } else {
    mensajeError.classList.remove("visible");
  }

  const resultados = [];

  todasLasCategorias.forEach(lista => {
    const cat = lista.dataset.categoria || lista.getAttribute('data-categoria') || '';

    if (categoriaSeleccionada === 'todas' || categoriaSeleccionada === cat) {
      lista.querySelectorAll('li').forEach(li => {
        // Fallback: usa data-* si existe, si no toma el textContent del <li> o subelementos
        const tituloRaw = li.dataset.titulo || li.getAttribute('data-titulo') ||
                          (li.querySelector('.titulo') ? li.querySelector('.titulo').textContent : '') ||
                          li.textContent || '';
        const descripcionRaw = li.dataset.descripcion || li.getAttribute('data-descripcion') ||
                               (li.querySelector('.descripcion') ? li.querySelector('.descripcion').textContent : '') ||
                               '';

        const fuente = normalizeText(`${tituloRaw} ${descripcionRaw}`);

        // AND (todas) o OR (cualquiera)
        const coincide = matchAllKeywords
          ? palabrasClave.every(p => fuente.includes(p))
          : palabrasClave.some(p => fuente.includes(p));

        if (coincide) {
          resultados.push({
            titulo: tituloRaw.trim(),
            descripcion: descripcionRaw.trim()
          });
        }
      });
    }
  });

  // Mostrar resultados con contador
  if (resultados.length > 0) {
    tarjeta.innerHTML = `
      <h3 id="consejo-titulo">Resultados de la búsqueda (${resultados.length}):</h3>
      <ul class="subconsejos-list">
        ${resultados.map(r =>
          `<li><strong>${escapeHtml(r.titulo)}:</strong> ${escapeHtml(r.descripcion)}</li>`
        ).join('')}
      </ul>
    `;
  } else {
    tarjeta.innerHTML = `<h3 id="consejo-titulo">No se han encontrado resultados para tu búsqueda</h3>`;
  }

  // ✅ Limpiar los campos siempre (independientemente de si hubo resultados)
  buscador.value = "";
  filtroCategoria.value = "todas";
}

// Ejecutar búsqueda al presionar Enter
buscador.addEventListener('keydown', e => {
  if (e.key === 'Enter') {
    e.preventDefault();
    ejecutarBusqueda();
  }
});

// Si tienes un botón de buscar (id="btn-buscar"), conectar también
const btnBuscar = document.getElementById('btn-buscar');
if (btnBuscar) {
  btnBuscar.addEventListener('click', ejecutarBusqueda);
}
</script>


</body>
</html>