<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gráfica de Presupuestos – Fineconia</title>

  <!-- Bootstrap & Chart.js -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

  <!-- Iconos & Alertify -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  @vite('resources/css/GraficasPre.css')

  <style>
    .chart-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 400px;
    }
    .chart-box {
      width: 100%;
      height: 100%;
      position: relative;
    }
    @media (max-width: 768px) {
      .chart-container {
        min-height: 300px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="d-flex justify-content-between align-items-center p-3 shadow-sm text-white" style="background:#31565E;">
    <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" style="height:50px;">
    <div class="d-flex align-items-center ms-auto">
      <a href="{{ route('presupuesto') }}" class="text-white text-decoration-underline me-3">Presupuesto</a>
      @include('partials.header-user')
    </div>
  </header>

  <main class="container my-5">
    <h3 class="text-center mb-4" style="color:#31565E;">Distribución de Presupuestos</h3>

    <!-- FILTROS (mes + categoría) -->
    <div class="card mb-4 shadow-sm p-3">
      <h5><i class="bi bi-funnel-fill me-2"></i>Filtros</h5>
      <div class="row g-3 align-items-end">
        <!-- Mes -->
        <div class="col-md-6">
          <label for="monthFilter" class="form-label">Mes / Año</label>
          <input type="month" id="monthFilter" class="form-control"/>
        </div>
        <!-- Categoría -->
        <div class="col-md-6">
          <label for="categoryFilter" class="form-label">Categoría</label>
          <select id="categoryFilter" class="form-select">
            <option value="">Todas</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id_categoriaGasto }}">{{ $cat->nombre }}</option>
            @endforeach
          </select>
        </div>
        <!-- Botones -->
        <div class="col-12 text-end">
          <button id="applyFilter" class="btn btn-success me-2">
            <i class="bi bi-check-lg me-1"></i> Aplicar
          </button>
          <button id="resetFilter" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-counterclockwise"></i> Reiniciar
          </button>
        </div>
      </div>
    </div>

    <!-- GRÁFICA -->
    <div class="card shadow-sm p-4 chart-container">
      <div class="chart-box">
        <canvas id="piePresupuesto"></canvas>
      </div>
      <p id="sinDatos" class="text-muted mt-3 d-none text-center">
        No hay datos disponibles para esos filtros.
      </p>
    </div>
  </main>

  <script>
    const ctx = document.getElementById('piePresupuesto').getContext('2d');
    let chart = null;
    const randomColor = () => `hsl(${Math.random()*360},70%,65%)`;

    function loadChartData(month = null, category = null) {
      let url = "{{ route('graficas.presupuesto.data') }}";
      const params = new URLSearchParams();
      if (month)    params.append('month', month);
      if (category) params.append('category', category);
      if (params.toString()) url += `?${params.toString()}`;

      fetch(url)
        .then(res => res.json())
        .then(data => {
          if (chart) chart.destroy();
          const noData = document.getElementById('sinDatos');
          if (!data.length) {
            noData.classList.remove('d-none');
            return;
          }
          noData.classList.add('d-none');

          const labels = data.map(d => d.categoria);
          const values = data.map(d => d.total);
          const colors = labels.map(() => randomColor());

          // Determinar posición de la leyenda según el tamaño de pantalla
          const legendPosition = window.innerWidth > 768 ? 'right' : 'bottom';
          
          chart = new Chart(ctx, {
            type: 'pie',
            data: { labels, datasets: [{ data: values, backgroundColor: colors, borderWidth: 1 }] },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              layout: {
                padding: {
                  top: 20,
                  bottom: 20,
                  left: 20,
                  right: 20
                }
              },
              plugins: {
                legend: {
                  position: legendPosition,
                  align: 'center',
                  labels: {
                    padding: 15,
                    boxWidth: 15,
                    font: {
                      size: window.innerWidth > 576 ? 12 : 10
                    },
                    generateLabels(chart) {
                      const total = chart.data.datasets[0].data.reduce((a,b)=>a+b,0);
                      return chart.data.labels.map((label,i)=> {
                        const val = chart.data.datasets[0].data[i];
                        const percentage = ((val/total)*100).toFixed(1);
                        return {
                          text: window.innerWidth > 400 ? 
                            `${label}: $${val.toFixed(2)} (${percentage}%)` :
                            `${label}: ${percentage}%`,
                          fillStyle: chart.data.datasets[0].backgroundColor[i],
                          index: i
                        };
                      });
                    }
                  }
                },
                tooltip: {
                  callbacks: {
                    label: function(context) {
                      const label = context.label || '';
                      const value = context.raw || 0;
                      const total = context.dataset.data.reduce((a, b) => a + b, 0);
                      const percentage = Math.round((value / total) * 100);
                      return `${label}: $${value.toFixed(2)} (${percentage}%)`;
                    }
                  }
                },
                title: {
                  display: true,
                  text: `Presupuestos ${document.getElementById('monthFilter').value || ''}`,
                  color: '#31565E',
                  font: { 
                    size: window.innerWidth > 576 ? 16 : 14, 
                    weight: 'bold',
                    lineHeight: 1.4
                  },
                  padding: {
                    top: 10,
                    bottom: 20
                  }
                }
              }
            }
          });

          // Redibujar al cambiar tamaño de pantalla
          window.addEventListener('resize', function() {
            if (chart) {
              chart.options.plugins.legend.position = window.innerWidth > 768 ? 'right' : 'bottom';
              chart.update();
            }
          });
        })
        .catch(() => alertify.error('Error al cargar los datos.'));
    }

    document.addEventListener('DOMContentLoaded', () => {
      const monthSel    = document.getElementById('monthFilter');
      const categorySel = document.getElementById('categoryFilter');
      const btnApply    = document.getElementById('applyFilter');
      const btnReset    = document.getElementById('resetFilter');

      // Precarga mes actual en YYYY-MM
      const now = new Date();
      const yy  = now.getFullYear();
      const mm  = String(now.getMonth()+1).padStart(2,'0');
      monthSel.value = `${yy}-${mm}`;

      // Carga inicial con mes actual
      loadChartData(mm, '');

      btnApply.addEventListener('click', () => {
        const m = monthSel.value ? monthSel.value.split('-')[1] : null;
        loadChartData(m, categorySel.value || null);
      });

      btnReset.addEventListener('click', () => {
        monthSel.value = `${yy}-${mm}`;
        categorySel.value = '';
        loadChartData(mm, null);
      });
    });
  </script>
</body>
</html>