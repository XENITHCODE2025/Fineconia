{{-- resources/views/Graficas.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas – Fineconia</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    @vite('resources/css/Graficas.css')

    <style>
        /* Panel del selector de color */
        #chartColorPanel {
            position: absolute; /* por defecto: relativo al contenedor, lo cambiamos a fixed en barras */
            display: none;
            z-index: 9999;
            width: 260px;
            padding: 8px;
            background: #ffffff;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .15);
            border: 1px solid #e0e0e0;
        }

        #colorPalette {
            width: 100%;
            height: 150px;
            cursor: crosshair;
            border-radius: 4px;
        }

        #colorHue {
            width: 100%;
            margin-top: 8px;
            -webkit-appearance: none;
            appearance: none;
            height: 8px;
            border-radius: 4px;
            background: linear-gradient(90deg,
                red 0%,
                yellow 16%,
                lime 33%,
                cyan 50%,
                blue 66%,
                magenta 83%,
                red 100%);
            outline: none;
        }

        #colorHue::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #444;
            cursor: pointer;
        }

        #colorHue::-moz-range-thumb {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #444;
            cursor: pointer;
        }

        #colorPreview {
            width: 100%;
            height: 24px;
            border-radius: 4px;
            margin-top: 6px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Header CON FONDO VERDE -->
    <header class="d-flex justify-content-between align-items-center p-3 shadow-sm text-white"
        style="background-color: #31565E;">
        <div>
            <img src="img/LogoCompleto.jpg" alt="Logo" style="height:50px">
        </div>

        <!-- Bloque derecho: enlace + usuario -->
        <div class="d-flex align-items-center">
            <a href="{{ route('gastos-ingresos') }}"
               class="text-white text-decoration-underline me-3">
                Gastos e ingresos
            </a>
            @include('partials.header-user')
        </div>
    </header>

    <div class="content">
        <div class="report-title">Graficas</div>
    </div>

    <nav class="container mt-4">
        <div class="btn-group w-100">
            <button class="btn btn-outline-secondary" id="btnMixto">Mixto</button>
            <button class="btn btn-outline-secondary" id="btnGastos">Gastos</button>
            <button class="btn btn-outline-secondary" id="btnIngresos">Ingresos</button>
        </div>

        {{-- Selector de mes (solo para Gastos/Ingresos) --}}
        <div class="row g-2 mt-3" id="filtroMesContainer">
            <div class="col-auto">
                <label for="selMes" class="form-label mb-1">Filtrar por Mes</label>
                <input type="month" id="selMes" class="form-control" value="{{ now()->format('Y-m') }}">
            </div>
            <div class="col-auto d-flex align-items-end">
                <button id="btnFiltrarMes" class="btn btn-outline-primary">Aplicar</button>
            </div>
        </div>

        {{-- Filtros de fecha (solo para Mixto) --}}
        <div class="row g-2 mt-3" id="filtroRangoContainer" style="display: none;">
            <div class="col-auto">
                <label for="fechaInicio" class="form-label mb-1"><strong>Desde:</strong></label>
                <input type="date" id="fechaInicio" class="form-control">
            </div>
            <div class="col-auto">
                <label for="fechaFin" class="form-label mb-1"><strong>Hasta:</strong></label>
                <input type="date" id="fechaFin" class="form-control">
            </div>
            <div class="col-auto d-flex align-items-end">
                <button id="btnFiltrarRango" class="btn btn-outline-primary">Filtrar</button>
            </div>
        </div>
    </nav>

    <!-- contenedorGraficas es relativo para posicionar el panel en pastel -->
    <main class="container mt-5 position-relative" id="contenedorGraficas"></main>

    <!-- PANEL PERSONALIZADO PARA CAMBIO DE COLOR -->
    <div id="chartColorPanel">
        <canvas id="colorPalette"></canvas>
        <input type="range" id="colorHue" min="0" max="360" value="180">
        <div id="colorPreview"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const contenedor = document.getElementById('contenedorGraficas');
        const selMes = document.getElementById('selMes');
        const btnFiltrarMes = document.getElementById('btnFiltrarMes');
        const fechaInicio = document.getElementById('fechaInicio');
        const fechaFin = document.getElementById('fechaFin');
        const btnFiltrarRango = document.getElementById('btnFiltrarRango');
        const btnMixto = document.getElementById('btnMixto');
        const btnGastos = document.getElementById('btnGastos');
        const btnIngresos = document.getElementById('btnIngresos');
        const filtroMesContainer = document.getElementById('filtroMesContainer');
        const filtroRangoContainer = document.getElementById('filtroRangoContainer');

        // Panel color
        const colorPanel   = document.getElementById('chartColorPanel');
        const colorPalette = document.getElementById('colorPalette');
        const colorHue     = document.getElementById('colorHue');
        const colorPreview = document.getElementById('colorPreview');

        let grafico;      // instancia de Chart.js
        let colorCtx;     // contexto 2d de la paleta
        let colorTarget = null; // { chart, datasetIndex, index, tipo, etiquetaKey }

        const randomColor = () => `hsl(${Math.floor(Math.random()*360)},70%,65%)`;

        // ---------- UTILIDADES PARA GUARDAR/LEER COLORES (PERMANENTES) ----------

        function saveColorKey(key, color) {
            try {
                localStorage.setItem('fineconia_color_' + key, color);
            } catch (e) {
                console.warn('No se pudo guardar el color en localStorage', e);
            }
        }

        function loadColorKey(key) {
            try {
                return localStorage.getItem('fineconia_color_' + key);
            } catch (e) {
                console.warn('No se pudo leer el color en localStorage', e);
                return null;
            }
        }

        // ---------- UTILIDADES COLOR ----------

        function hslToHex(h, s, l){
            s /= 100; l /= 100;
            const k = n => (n + h / 30) % 12;
            const a = s * Math.min(l, 1 - l);
            const f = n => {
                const v = l - a * Math.max(-1, Math.min(k(n) - 3, Math.min(9 - k(n), 1)));
                return Math.round(255 * v).toString(16).padStart(2, '0');
            };
            return `#${f(0)}${f(8)}${f(4)}`;
        }

        // Dibuja la paleta (blanco -> color -> negro)
        function drawPalette() {
            const w = colorPalette.width = colorPalette.clientWidth;
            const h = colorPalette.height = colorPalette.clientHeight;

            if (!colorCtx) colorCtx = colorPalette.getContext('2d');

            const hue = parseInt(colorHue.value, 10);
            const base = hslToHex(hue, 100, 50);

            // De blanco a color (horizontal)
            const gradH = colorCtx.createLinearGradient(0, 0, w, 0);
            gradH.addColorStop(0, '#ffffff');
            gradH.addColorStop(1, base);
            colorCtx.fillStyle = gradH;
            colorCtx.fillRect(0, 0, w, h);

            // De transparente a negro (vertical)
            const gradV = colorCtx.createLinearGradient(0, 0, 0, h);
            gradV.addColorStop(0, 'rgba(0,0,0,0)');
            gradV.addColorStop(1, 'rgba(0,0,0,1)');
            colorCtx.fillStyle = gradV;
            colorCtx.fillRect(0, 0, w, h);
        }

        function pickColorFromPalette(evt) {
            if (!colorCtx || !colorTarget) return;
            const rect = colorPalette.getBoundingClientRect();
            const x = evt.clientX - rect.left;
            const y = evt.clientY - rect.top;
            const data = colorCtx.getImageData(x, y, 1, 1).data;
            const r = data[0], g = data[1], b = data[2];
            const hex = "#" + [r,g,b].map(v => v.toString(16).padStart(2,'0')).join('');

            colorPreview.style.backgroundColor = hex;

            const { chart, datasetIndex, index, etiquetaKey } = colorTarget;
            const dataset = chart.data.datasets[datasetIndex];

            if (Array.isArray(dataset.backgroundColor)) {
                dataset.backgroundColor[index] = hex;
            } else {
                dataset.backgroundColor = hex;
            }

            // ✅ Guardar color de forma permanente por clave
            if (etiquetaKey) {
                saveColorKey(etiquetaKey, hex);
            }

            chart.update();
        }

        colorHue.addEventListener('input', () => {
            drawPalette();
        });

        colorPalette.addEventListener('click', pickColorFromPalette);

        function hideColorPanel() {
            colorPanel.style.display = 'none';
            colorTarget = null;
        }

        // -------- POSICIONES DEL PANEL --------

        // 1) Barras -> centro FIJO de la pantalla
        function showColorPanelForBar(chart) {
            colorPanel.style.position = 'fixed';
            colorPanel.style.left = '50%';
            colorPanel.style.top  = '50%';
            colorPanel.style.transform = 'translate(-50%, -50%)';
            colorPanel.style.display = 'block';
            drawPalette();
        }

        // 2) Pastel ("Salario") -> debajo del texto/recuadro de la leyenda "Salario"
        function showColorPanelForPieSalario(chart, index) {
            const legend = chart.legend;
            if (!legend || !legend.legendHitBoxes || !legend.legendHitBoxes[index]) {
                // si algo falla, lo mostramos centrado como fallback
                showColorPanelForBar(chart);
                return;
            }

            const canvasRect = chart.canvas.getBoundingClientRect();
            const contRect   = contenedor.getBoundingClientRect();
            const hitBox = legend.legendHitBoxes[index];

            const legendCenterX = canvasRect.left + hitBox.left + hitBox.width / 2;
            const legendBottomY = canvasRect.top + hitBox.top + hitBox.height;

            const leftInsideContainer = legendCenterX - contRect.left - (colorPanel.offsetWidth / 2);
            const topInsideContainer  = legendBottomY - contRect.top + 8;

            colorPanel.style.position = 'absolute';
            colorPanel.style.transform = 'none';
            colorPanel.style.left = `${leftInsideContainer}px`;
            colorPanel.style.top  = `${topInsideContainer}px`;
            colorPanel.style.display = 'block';

            drawPalette();
        }

        // ------------ COMPORTAMIENTO CLICK EN GRÁFICAS ------------

        function añadirCambioColorPorClick(chart, tipo) {
            chart.options.onClick = (evt) => {
                const points = chart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
                if (!points.length) return;

                const firstPoint = points[0];

                if (tipo === 'pie') {
                    const label = chart.data.labels[firstPoint.index];
                    // Sólo permitir el selector para "Salario", como ya tenías
                    if (label !== 'Salario') {
                        return;
                    }
                    colorTarget = {
                        chart,
                        datasetIndex: firstPoint.datasetIndex,
                        index: firstPoint.index,
                        tipo: 'pie',
                        // clave para guardar color de este segmento
                        etiquetaKey: `pie_${label}`
                    };
                    showColorPanelForPieSalario(chart, firstPoint.index);
                    return;
                }

                if (tipo === 'bar') {
                    const labelMes = chart.data.labels[firstPoint.index]; // ej. "Enero 2025"
                    const datasetLabel = chart.data.datasets[firstPoint.datasetIndex].label; // 'Ingresos' o 'Gastos'
                    const etiquetaKey = `bar_${labelMes}_${datasetLabel}`;

                    colorTarget = {
                        chart,
                        datasetIndex: firstPoint.datasetIndex,
                        index: firstPoint.index,
                        tipo: 'bar',
                        etiquetaKey
                    };
                    showColorPanelForBar(chart);
                    return;
                }
            };
            chart.update();
        }

        // ------------ GRÁFICAS ------------

        function construirGraficaPorMes(tipo) {
            const mesSeleccionado = selMes.value; // "YYYY-MM"
            const urlBase = (tipo === 'gastos')
                ? "{{ route('graficas.gastos.data') }}"
                : "{{ route('graficas.ingresos.data') }}";

            fetch(`${urlBase}?mes=${mesSeleccionado}`)
                .then(response => response.json())
                .then(dataset => {
                    if (grafico) {
                        grafico.destroy();
                        grafico = null;
                    }
                    contenedor.innerHTML = '';
                    hideColorPanel();

                    const items = dataset[mesSeleccionado] || [];
                    const card = document.createElement('div');
                    card.className = 'card shadow-sm mb-4 position-relative';

                    const [anio, nroMes] = mesSeleccionado.split('-');
                    const mesesES = [
                        'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
                        'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
                    ];
                    const fechaLegible = `${mesesES[Number(nroMes) - 1]} ${anio}`;

                    card.innerHTML = `
                        <div class="card-header bg-white fw-semibold">
                          ${tipo === 'gastos' ? 'Gastos' : 'Ingresos'} – ${fechaLegible}
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                          <small class="text-muted mb-2">
                            Toca la gráfica o el segmento (por ejemplo, "Salario") para abrir el selector de color y personalizarla.
                          </small>
                          <canvas id="pieChartMes" width="500" height="500" style="width:500px;height:500px"></canvas>
                          ${items.length === 0
                            ? '<p class="text-center text-muted mt-3">No hay datos para este mes.</p>'
                            : ''}
                        </div>
                    `;
                    contenedor.appendChild(card);

                    if (!items.length) return;

                    const agrup = new Map();
                    items.forEach(i => {
                        agrup.set(i.categoria, (agrup.get(i.categoria) || 0) + Number(i.total));
                    });
                    const labels = [...agrup.keys()];
                    const values = [...agrup.values()];

                    // Colores: usamos color guardado (si existe) o random
                    const colors = labels.map(label => {
                        const saved = loadColorKey(`pie_${label}`);
                        return saved || randomColor();
                    });

                    const ctx = card.querySelector('#pieChartMes').getContext('2d');

                    grafico = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels,
                            datasets: [{
                                data: values,
                                backgroundColor: colors,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: false,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    position: 'right',
                                    labels: {
                                        generateLabels: chart => {
                                            const data = chart.data;
                                            const dataset = data.datasets[0];
                                            const total = dataset.data.reduce((sum, v) => sum + v, 0);
                                            return data.labels.map((label, i) => {
                                                const value = dataset.data[i];
                                                const pct = ((value / total) * 100).toFixed(1);
                                                return {
                                                    text: `${label}: $${value.toFixed(2)} (${pct}%)`,
                                                    fillStyle: dataset.backgroundColor[i],
                                                    strokeStyle: '#fff',
                                                    lineWidth: 1,
                                                    hidden: false,
                                                    index: i
                                                };
                                            });
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label(ctx) {
                                            const sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                            const val = ctx.raw;
                                            const pct = ((val / sum) * 100).toFixed(1);
                                            return `${ctx.label}: $${val.toFixed(2)} (${pct}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // El selector sólo aparecerá si el segmento clickeado es "Salario"
                    añadirCambioColorPorClick(grafico, 'pie');
                })
                .catch(() => alertify?.error('Error al cargar datos'));
        }

        function construirGraficaMixta(inicio = '', fin = '') {
            let url = "{{ route('graficas.ingresos-gastos') }}";
            if (inicio && fin) {
                url += `?inicio=${inicio}&fin=${fin}`;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (grafico) {
                        grafico.destroy();
                        grafico = null;
                    }
                    contenedor.innerHTML = '';
                    hideColorPanel();

                    const mesesUnicos = [...new Set([
                        ...data.ingresos.map(i => i.mes),
                        ...data.gastos.map(g => g.mes)
                    ])].sort();

                    const nombresMeses = [
                        'Enero', 'Febrero', 'Marzo', 'Abril',
                        'Mayo', 'Junio', 'Julio', 'Agosto',
                        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];
                    const etiquetasLegibles = mesesUnicos.map(mesClave => {
                        const [anio, mesNum] = mesClave.split('-');
                        return `${nombresMeses[Number(mesNum) - 1]} ${anio}`;
                    });

                    const ingresosPorMes = mesesUnicos.map(mesClave => {
                        const reg = data.ingresos.find(i => i.mes === mesClave);
                        return reg ? parseFloat(reg.total) : 0;
                    });
                    const gastosPorMes = mesesUnicos.map(mesClave => {
                        const reg = data.gastos.find(g => g.mes === mesClave);
                        return reg ? parseFloat(reg.total) : 0;
                    });

                    const card = document.createElement('div');
                    card.className = 'card shadow-sm mb-4 position-relative';
card.innerHTML = `
    <div class="card-header bg-white fw-semibold">
      Ingresos vs Gastos
    </div>
    <div class="card-body">
      <small class="text-muted d-block mb-2 text-center">
        Toca una barra para abrir el selector de color y cambiar el color de ese mes.
      </small>
      <canvas id="barraIngresosGastos" width="700" height="400" style="width:100%;max-width:700px;height:400px"></canvas>
      ${mesesUnicos.length === 0
        ? '<p class="text-center text-muted mt-3">No hay datos para el rango indicado.</p>'
        : ''}
    </div>
`;
                    contenedor.appendChild(card);

                    if (!mesesUnicos.length) return;

                    const ctxBar = card.querySelector('#barraIngresosGastos').getContext('2d');

                    const baseColorIngresos = 'rgba(54, 162, 235, 0.8)';
                    const baseColorGastos   = 'rgba(255, 99, 132, 0.8)';

                    // Para permitir guardar color por barra (mes+tipo)
                    const bgIngresos = etiquetasLegibles.map(label => {
                        const saved = loadColorKey(`bar_${label}_Ingresos`);
                        return saved || baseColorIngresos;
                    });

                    const bgGastos = etiquetasLegibles.map(label => {
                        const saved = loadColorKey(`bar_${label}_Gastos`);
                        return saved || baseColorGastos;
                    });

                    grafico = new Chart(ctxBar, {
                        type: 'bar',
                        data: {
                            labels: etiquetasLegibles,
                            datasets: [
                                {
                                    label: 'Ingresos',
                                    data: ingresosPorMes,
                                    backgroundColor: bgIngresos,
                                    borderRadius: 5
                                },
                                {
                                    label: 'Gastos',
                                    data: gastosPorMes,
                                    backgroundColor: bgGastos,
                                    borderRadius: 5
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: { font: { size: 14 } }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: { stepSize: 200 }
                                }
                            }
                        }
                    });

                    // Selector para barras: centro de la pantalla
                    grafico.options.onClick = (evt) => {
                        const points = grafico.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
                        if (!points.length) return;

                        const firstPoint = points[0];
                        const index = firstPoint.index;
                        const datasetIndex = firstPoint.datasetIndex;

                        const labelMes = grafico.data.labels[index];
                        const datasetLabel = grafico.data.datasets[datasetIndex].label; // 'Ingresos' o 'Gastos'
                        const etiquetaKey = `bar_${labelMes}_${datasetLabel}`;

                        colorTarget = {
                            chart: grafico,
                            datasetIndex,
                            index,
                            tipo: 'bar',
                            etiquetaKey
                        };

                        showColorPanelForBar(grafico);
                    };

                    grafico.update();
                })
                .catch(error => console.error('Error al cargar datos Mixto:', error));
        }

        // ------------ BOTONES ------------

        btnMixto.addEventListener('click', () => {
            [btnMixto, btnGastos, btnIngresos].forEach(b => b.className = 'btn btn-outline-secondary');
            btnMixto.classList.replace('btn-outline-secondary', 'btn-primary');

            filtroMesContainer.style.display = 'none';
            filtroRangoContainer.style.display = 'flex';

            construirGraficaMixta();
        });

        btnGastos.addEventListener('click', () => {
            [btnMixto, btnGastos, btnIngresos].forEach(b => b.className = 'btn btn-outline-secondary');
            btnGastos.classList.replace('btn-outline-secondary', 'btn-primary');

            filtroMesContainer.style.display = 'flex';
            filtroRangoContainer.style.display = 'none';

            construirGraficaPorMes('gastos');
        });

        btnIngresos.addEventListener('click', () => {
            [btnMixto, btnGastos, btnIngresos].forEach(b => b.className = 'btn btn-outline-secondary');
            btnIngresos.classList.replace('btn-outline-secondary', 'btn-primary');

            filtroMesContainer.style.display = 'flex';
            filtroRangoContainer.style.display = 'none';

            construirGraficaPorMes('ingresos');
        });

        btnFiltrarMes.addEventListener('click', () => {
            const tipoActual = btnGastos.classList.contains('btn-primary') ? 'gastos' : 'ingresos';
            construirGraficaPorMes(tipoActual);
        });

        btnFiltrarRango.addEventListener('click', () => {
            const inicio = fechaInicio.value;
            const fin = fechaFin.value;
            construirGraficaMixta(inicio, fin);
        });

        const gastosIngresosBtn = document.getElementById('gastos_ingresos');
        if (gastosIngresosBtn) {
            gastosIngresosBtn.addEventListener('click', function() {
                window.location.href = "{{ route('gastos-ingresos') }}";
            });
        }

        // Cerrar panel si se hace click fuera del panel y fuera de las gráficas
        document.addEventListener('click', (e) => {
            if (!colorPanel) return;

            const clickEnPanel  = colorPanel.contains(e.target);
            const clickEnCanvas = e.target.closest('canvas');

            if (!clickEnPanel && !clickEnCanvas) {
                hideColorPanel();
            }
        });

        // disparar vista inicial
        btnMixto.click();
    });
    </script>
</body>

</html>