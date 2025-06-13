{{-- resources/views/GraficasPresupuesto.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gráfica de Presupuestos – Fineconia</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>


  @vite('resources/css/Graficas.css')
</head>
<body class="bg-light">
  <header class="d-flex justify-content-between align-items-center p-3 shadow-sm text-white"
        style="background:#31565E">
  <img src="{{ asset('img/LogoCompleto.jpg') }}" style="height:50px" alt="Logo">

  <!-- Contenedor para alinear a la derecha -->
  <div class="d-flex align-items-center ms-auto">
    <a href="{{ route('presupuesto') }}"
       class="text-white text-decoration-underline me-3">Presupuesto</a>
        @include('partials.header-user') 
  </div>
</header>


  <main class="container my-5">
      <h3 class="text-center mb-4">Distribución de Presupuestos</h3>

      <div class="card shadow-sm p-4 d-flex justify-content-center">
        
          <canvas id="piePresupuesto"
        width="600" height="600"
        class="mx-auto d-block"
        style="width:600px;height:600px"></canvas>


          <p id="sinDatos" class="text-center text-muted mt-3 d-none">
              Aún no has creado presupuestos.
          </p>
      </div>
  </main>

  <script>
    const ctx = document.getElementById('piePresupuesto').getContext('2d');
    let chart;
    const randomColor = () => `hsl(${Math.random()*360},70%,65%)`;

    fetch("{{ route('graficas.presupuesto.data') }}")
      .then(r => r.json())
      .then(datos => {
        if (!datos.length) {
          document.getElementById('sinDatos').classList.remove('d-none');
          return;
        }

        const labels = datos.map(d => d.categoria);
        const values = datos.map(d => d.total);
        const colors = labels.map(() => randomColor());

        chart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels,
            datasets: [
              { data: values, backgroundColor: colors, borderWidth: 1 }
            ]
          },
          options: {
            responsive: false,       // ← respeta 320 × 320
            maintainAspectRatio: true,
            plugins: {
              legend: {
                position: 'right',
                labels: {
                  generateLabels(chart) {
                    const total = chart.data.datasets[0].data.reduce((a,b)=>a+b,0);
                    return chart.data.labels.map((l,i)=>{
                      const val = chart.data.datasets[0].data[i];
                      return {
                        text: `${l}: $${val.toFixed(2)} (${(val/total*100).toFixed(1)}%)`,
                        fillStyle: chart.data.datasets[0].backgroundColor[i],
                        strokeStyle: '#fff',
                        lineWidth: 1,
                        index: i
                      };
                    });
                  }
                }
              },
              tooltip: {
                callbacks: {
                  label(ctx) {
                    const total = ctx.dataset.data.reduce((a,b)=>a+b,0);
                    const val   = ctx.raw;
                    return `${ctx.label}: $${val.toFixed(2)} (${(val/total*100).toFixed(1)}%)`;
                  }
                }
              }
            }
          }
        });
      })
      .catch(() => alert('Error al cargar presupuestos'));
  </script>

</body>
</html>
