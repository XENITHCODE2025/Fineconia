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
      <!-- Enlace “Gastos e ingresos” -->
      <a href="{{ route('gastos-ingresos') }}" 
         class="text-white text-decoration-underline me-3">
        Gastos e ingresos
      </a>

      <!-- Aquí incluimos el partial que muestra nombre + icono de usuario -->
      @include('partials.header-user')
      {{-- 
         Por ejemplo, en 'partials/header-user.blade.php' podrías tener algo así:
        
         <i class="bi bi-person-circle fs-4"></i>
      --}}
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

    <main class="container mt-5" id="contenedorGraficas"></main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <script>
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

    let grafico; // instancia de Chart.js

    const randomColor = () => `hsl(${Math.floor(Math.random()*360)},70%,65%)`;

    /* ——— Construye la vista de Gastos/Ingresos por mes ——— */
    function construirGraficaPorMes(tipo) {
        const mesSeleccionado = selMes.value; // "YYYY-MM"
        const urlBase = (tipo === 'gastos') ?
            "{{ route('graficas.gastos.data') }}" :
            "{{ route('graficas.ingresos.data') }}";

        fetch(`${urlBase}?mes=${mesSeleccionado}`)
            .then(response => response.json())
            .then(dataset => {
                if (grafico) {
                    grafico.destroy();
                    grafico = null;
                }
                contenedor.innerHTML = '';

                const items = dataset[mesSeleccionado] || [];
                const card = document.createElement('div');
                card.className = 'card shadow-sm mb-4';

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
              <canvas id="pieChartMes" width="500" height="500" style="width:500px;height:500px"></canvas>
              ${items.length === 0
                ? '<p class="text-center text-muted mt-3">No hay datos para este mes.</p>'
                : ''}
            </div>
          `;
                contenedor.appendChild(card);

                if (!items.length) return;

                // Agrupar por categoría
                const agrup = new Map();
                items.forEach(i => {
                    agrup.set(i.categoria, (agrup.get(i.categoria) || 0) + Number(i.total));
                });
                const labels = [...agrup.keys()];
                const values = [...agrup.values()];
                const colors = labels.map(() => randomColor());
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
            })
            .catch(() => alertify?.error('Error al cargar datos'));
    }

    /* ——— Construye la vista Mixta (Ingresos vs Gastos) ——— */
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

                // Obtener meses únicos de INGRESOS y GASTOS
                const mesesUnicos = [...new Set([
                    ...data.ingresos.map(i => i.mes),
                    ...data.gastos.map(g => g.mes)
                ])].sort();

                // Etiquetas legibles
                const nombresMeses = [
                    'Enero', 'Febrero', 'Marzo', 'Abril',
                    'Mayo', 'Junio', 'Julio', 'Agosto',
                    'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ];
                const etiquetasLegibles = mesesUnicos.map(mesClave => {
                    const [anio, mesNum] = mesClave.split('-');
                    return `${nombresMeses[Number(mesNum) - 1]} ${anio}`;
                });

                // Mapear totales
                const ingresosPorMes = mesesUnicos.map(mesClave => {
                    const reg = data.ingresos.find(i => i.mes === mesClave);
                    return reg ? parseFloat(reg.total) : 0;
                });
                const gastosPorMes = mesesUnicos.map(mesClave => {
                    const reg = data.gastos.find(g => g.mes === mesClave);
                    return reg ? parseFloat(reg.total) : 0;
                });

                // Crear tarjeta + canvas
                const card = document.createElement('div');
                card.className = 'card shadow-sm mb-4';

                card.innerHTML = `
            <div class="card-header bg-white fw-semibold">
              Ingresos vs Gastos
            </div>
            <div class="card-body">
              <canvas id="barraIngresosGastos" width="700" height="400" style="width:100%;max-width:700px;height:400px"></canvas>
              ${mesesUnicos.length === 0
                ? '<p class="text-center text-muted mt-3">No hay datos para el rango indicado.</p>'
                : ''}
            </div>
          `;
                contenedor.appendChild(card);

                if (!mesesUnicos.length) return;

                const ctxBar = card.querySelector('#barraIngresosGastos').getContext('2d');
                grafico = new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: etiquetasLegibles,
                        datasets: [{
                                label: 'Ingresos',
                                data: ingresosPorMes,
                                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                                borderRadius: 5
                            },
                            {
                                label: 'Gastos',
                                data: gastosPorMes,
                                backgroundColor: 'rgba(255, 99, 132, 0.8)',
                                borderRadius: 5
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 14
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 200
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error al cargar datos Mixto:', error));
    }

    /* ——— Manejadores de botones ——— */
    btnMixto.addEventListener('click', () => {
        // Estilos de botones
        [btnMixto, btnGastos, btnIngresos].forEach(b => b.className = 'btn btn-outline-secondary');
        btnMixto.classList.replace('btn-outline-secondary', 'btn-primary');

        // Mostrar filtro rango, ocultar filtro mes
        filtroMesContainer.style.display = 'none';
        filtroRangoContainer.style.display = 'flex';

        // Cargar gráfica Mixta sin filtros iniciales
        construirGraficaMixta();
    });

    btnGastos.addEventListener('click', () => {
        [btnMixto, btnGastos, btnIngresos].forEach(b => b.className = 'btn btn-outline-secondary');
        btnGastos.classList.replace('btn-outline-secondary', 'btn-primary');

        // Mostrar filtro mes, ocultar filtro rango
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

    /* ——— Filtros de aplicación ——— */
    btnFiltrarMes.addEventListener('click', () => {
        const tipoActual = btnGastos.classList.contains('btn-primary') ? 'gastos' : 'ingresos';
        construirGraficaPorMes(tipoActual);
    });

    btnFiltrarRango.addEventListener('click', () => {
        const inicio = fechaInicio.value;
        const fin = fechaFin.value;
        construirGraficaMixta(inicio, fin);
    });

    // Carga inicial: mostrar Gastos de mes actual
    document.addEventListener('DOMContentLoaded', () => {
        btnMixto.click();
    });
    document.getElementById('gastos_ingresos').addEventListener('click', function() {
    window.location.href = "{{ route('gastos-ingresos') }}";
     });

    </script>
</body>

</html>