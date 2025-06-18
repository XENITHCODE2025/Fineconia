<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ajustar Presupuesto</title>

  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css">
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  @vite('resources/css/RegistrosPresupuesto.css')
</head>
<body>
  <!-- Header / Navbar -->
  <header class="header">
    <div class="logo">
      <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" style="height:50px;">
    </div>
    <div class="menu">
      <a href="{{ route('presupuesto') }}" class="nav-link">Presupuesto</a>
      <span class="nombre">{{ auth()->user()->name }}</span>
      <div class="user-icon"><i class="bi bi-person-circle"></i></div>
    </div>
  </header>

  <!-- Contenido -->
  <main class="contenido" style="max-width:1200px; width:95%; margin:20px auto;">
    <div class="titulo-contenedor">
      <h1>Ajustar Presupuesto</h1>
    </div>

    <!-- Filtros -->
    <div class="busqueda" style="display:flex; gap:10px; align-items:center; margin-bottom:15px;">
      <input type="text" id="buscador"
             placeholder="Buscar por categoría"
             style="flex:1; padding:8px; border-radius:6px; border:1px solid #ccc;">
      <input type="month" id="filtro-mes"
             placeholder="Filtrar por mes y año"
             style="padding:8px; border-radius:6px; border:1px solid #ccc;"/>
    </div>

    @php
      $meses = [
        1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
        5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
        9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
      ];
    @endphp

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Mes / Año</th>
            <th>Categoría</th>
            <th>Presupuesto</th>
            <th>Restante</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($presupuestos as $pre)
            @php
              $mesNum = str_pad($pre->mes, 2, '0', STR_PAD_LEFT);
              $year   = $pre->created_at->format('Y');
            @endphp
            <tr data-mes="{{ $mesNum }}" data-year="{{ $year }}">
              <td>
                {{ $meses[$pre->mes] ?? 'Mes desconocido' }} {{ $year }}
              </td>
              <td>{{ $pre->categoriaGasto->nombre ?? 'Sin categoría' }}</td>
              <td>${{ number_format($pre->monto, 2) }}</td>
              <td>${{ number_format($pre->restante, 2) }}</td>
              <td>
                <i class="bi bi-pencil-square edit-btn"
                   data-id="{{ $pre->id_Presupuesto }}"
                   data-monto="{{ $pre->monto }}"
                   style="cursor:pointer; color:#1d4d4f; font-size:1.4rem; margin-right:8px;" title="Editar"></i>
                <form class="delete-form d-inline"
                      action="{{ route('presupuestos.destroy', $pre->id_Presupuesto) }}"
                      method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" title="Eliminar" style="background:none;border:none;color:red;cursor:pointer">
                    <i class="bi bi-trash-fill" style="font-size:1.4rem;"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr class="no-data">
              <td colspan="5" style="text-align:center; padding:20px; font-style:italic;">
                Sin presupuestos aún.
              </td>
            </tr>
          @endforelse
          <tr class="no-results" style="display:none;">
            <td colspan="5" style="text-align:center; padding:20px; font-style:italic;">
              No se encontraron resultados.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer" style="margin-top:40px; text-align:center;">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const buscador   = document.getElementById('buscador');
    const filtroMes  = document.getElementById('filtro-mes');
    const filasAll   = Array.from(document.querySelectorAll('tbody tr')).filter(r => !r.classList.contains('no-data') && !r.classList.contains('no-results'));
    const rowNoData  = document.querySelector('tr.no-data');
    const rowNoRes   = document.querySelector('tr.no-results');
    const mesesMap   = @json($meses);

    function filtrar() {
      const texto    = buscador.value.toLowerCase();
      const filtroV  = filtroMes.value; // "YYYY-MM"
      let visibleCount = 0;
      let hasFilters = texto || filtroV; // Verificar si hay filtros aplicados

      filasAll.forEach(fila => {
        const cat        = fila.children[1].textContent.toLowerCase();
        const mes        = fila.dataset.mes;            
        const year       = fila.dataset.year;
        const rowVal     = year + '-' + mes;

        const okCat = texto ? cat.includes(texto) : true;
        const okMes = filtroV ? rowVal === filtroV : true;

        if (okCat && okMes) {
          fila.style.display = '';
          visibleCount++;
        } else {
          fila.style.display = 'none';
        }
      });

      // Mostrar mensaje solo cuando hay filtros aplicados y no hay resultados
      if (hasFilters && visibleCount === 0 && filasAll.length > 0) {
        rowNoRes.style.display = '';
      } else {
        rowNoRes.style.display = 'none';
      }

      // Mantener el mensaje de "Sin presupuestos" si no hay datos iniciales
      if (rowNoData) {
        rowNoData.style.display = (filasAll.length === 0 ? '' : 'none');
      }
    }

    buscador.addEventListener('input', filtrar);
    filtroMes.addEventListener('change', filtrar);
    filtrar(); // Llamar inicialmente para aplicar cualquier filtro en la URL

    document.querySelectorAll('.delete-form').forEach(form => {
      form.addEventListener('submit', e => {
        e.preventDefault();
        alertify.confirm(
          'Eliminar presupuesto',
          '¿Deseas eliminar este registro?',
          () => form.submit(),
          () => {}
        ).set({ labels:{ ok:'Sí', cancel:'No' }});
      });
    });

    @if(session('success')) alertify.success("{{ session('success') }}"); @endif
    @if(session('error'))   alertify.error("{{ session('error') }}");   @endif

    document.querySelectorAll('.edit-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const monto = btn.dataset.monto;
        alertify.prompt(
          'Actualizar presupuesto',
          'Nuevo monto:',
          monto,
          (evt, value) => {
            if (isNaN(value) || Number(value) < 0) {
              alertify.error('Monto inválido'); return;
            }
            fetch(`/presupuestos/${id}`, {
              method: 'PUT',
              headers: {
                'Content-Type':'application/json', 'X-CSRF-TOKEN':'{{ csrf_token() }}'
              },
              body: JSON.stringify({ monto: value })
            })
            .then(r => r.ok? r.json(): Promise.reject())
            .then(() => location.reload())
            .catch(() => alertify.error('Error al actualizar'));
          },
          () => {}
        ).set({ labels:{ ok:'Guardar', cancel:'Cancelar' }});
      });
    });
  });
  </script>
</body>
</html>