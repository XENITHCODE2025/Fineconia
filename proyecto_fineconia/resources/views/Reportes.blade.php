<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reportes Detallados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @vite('resources/css/Reportes.css')
</head>

<body>

    <div class="header">
        <div class="logo">
            <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" style="height: 50px;">
        </div>
        <div class="menu">
            <a href="#" id="gastos_ingresos" class="underline">Gastos e ingresos</a>
             @include('partials.header-user')  {{-- ← nuevo partial --}}
        </div>
    </div>

    <div class="content">
        <div class="report-title">REPORTES DETALLADOS</div>
        <div class="search-bar">
            <input type="text" placeholder="Buscar por descripción o categoría" />
            <div class="dropdown">
                <button id="btnFiltro">Filtrar ▾</button>
                <div class="dropdown-content">
                    <a href="#" data-filtro="">Todos</a>
                    <a href="#" data-filtro="gasto">Gastos</a>
                    <a href="#" data-filtro="ingreso">Ingresos</a>
                </div>
            </div>
        </div>

        <div class="report-list" id="listaReportes">

            <button class="report-button">
                <div>
                    <div class="info">Gasto</div>
                    <div class="sub">Medicinas</div>
                </div>
                <div class="info">21 Mayo 2025</div>
            </button>
            <button class="report-button">
                <div>
                    <div class="info">Gasto</div>
                    <div class="sub">Medicinas</div>
                </div>
                <div class="info">21 Mayo 2025</div>
            </button>
        </div>
    </div>

    <div class="footer">
        <div class="footer-links">
            <a href="#">Ayuda</a>
            <a href="#">Opiniones y Sugerencias</a>
        </div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const lista = document.getElementById('listaReportes');
        const inputBuscar = document.querySelector('.search-bar input');
        const filtroLinks = document.querySelectorAll('.dropdown-content a');
        const btnFiltro = document.getElementById('btnFiltro');

        let filtroTipo = ''; // '', 'gasto', 'ingreso'

        const plantillaCard = (t) => {
            // Formatear la hora:  "3:51 p.m."  /  "11:07 a.m."
            const hora = t.hora
                .toLowerCase() // am / pm
                .replace('am', 'a.m.')
                .replace('pm', 'p.m.');

            return `
      <div class="card">
        <div class="card-head">
          <span class="titulo">${t.tipo}</span>
          <span class="fecha">${t.fecha}</span>
          <span class="flecha">▾</span>
        </div>
        <div class="card-sub">${t.descripcion}</div>
        <div class="detalles">
          <div><strong>Tipo</strong><br>${t.tipo}</div>
          <div><strong>Categoría</strong><br>${t.categoria}</div>
          <div><strong>Descripción</strong><br>${t.descripcion}</div>
          <div><strong>Monto</strong><br>$${Number(t.monto).toFixed(2)}</div>
          <div><strong>Hora</strong><br>${hora}</div>
        </div>
      </div>`;
        };


        const renderCards = (datos) => {
            lista.innerHTML = datos.length ?
                datos.map(plantillaCard).join('') :
                '<p class="sin-res">Sin resultados</p>';

            // Añade interactividad a cada tarjeta
            lista.querySelectorAll('.card').forEach(card => {
                card.addEventListener('click', () => {
                    card.classList.toggle('abierta');
                    card.querySelector('.flecha').textContent =
                        card.classList.contains('abierta') ? '▴' : '▾';
                });
            });
        };

        const fetchDatos = () => {
            const params = new URLSearchParams();
            if (filtroTipo) params.append('tipo', filtroTipo);
            if (inputBuscar.value.trim()) params.append('buscar', inputBuscar.value.trim());

            fetch(`/transacciones?${params}`)
                .then(r => r.json())
                .then(renderCards)
                .catch(() => alert('Error al cargar transacciones'));
        };

        // buscador en vivo
        inputBuscar.addEventListener('input', fetchDatos);

        // menú de filtro
        filtroLinks.forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                filtroTipo = link.dataset.filtro;
                btnFiltro.innerHTML = `Filtrar (${link.textContent}) ▾`;
                fetchDatos();
            });
        });

        fetchDatos(); // carga inicial
    });

    document.getElementById('gastos_ingresos').addEventListener('click', function() {
    window.location.href = "{{ route('gastos-ingresos') }}";
  })
    </script>


</body>

</html>