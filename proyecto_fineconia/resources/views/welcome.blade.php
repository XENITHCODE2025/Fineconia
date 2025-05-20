<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gastos e Ingresos - Fineconia</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Alertify CSS y JS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f5f5f5;
      color: #333;
    }

    /* Navbar */
    .navbar {
      background-color: #1d4d4f;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo-container {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo {
      width: 32px;
      height: 32px;
    }

    .brand {
      color: white;
      font-weight: bold;
      font-size: 20px;
    }

    .right-side {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .nav-links {
      display: flex;
      gap: 25px;
    }

    .nav-link {
      color: white;
      text-decoration: none;
      font-size: 14px;
    }

    .nav-link:hover {
      text-decoration: underline;
    }

    .user-icon {
      font-size: 28px;
      color: white;
    }

    /* Header */
    .header {
      background-color: #1d4d4f;
      padding: 30px 20px;
      text-align: center;
    }

    .header h2 {
      color: white;
      font-size: 28px;
      margin-bottom: 15px;
      letter-spacing: 1px;
    }

    .header p {
      color: #e0e0e0;
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.5;
    }

    /* Sections */
    .section-container {
      max-width: 900px;
      margin: 30px auto;
      padding: 0 20px;
    }

    .section {
      margin-bottom: 30px;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .section-header {
      padding: 12px;
      text-align: center;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .section-body {
      background-color: #fdfdfd;
      color: #333;
      padding: 25px;
    }

    .section-body p {
      margin-bottom: 20px;
      line-height: 1.5;
      font-size: 14px;
    }

    .buttons-container {
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .btn {
      padding: 10px 20px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 14px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-expense {
      background-color: #ffebee;
      color: #d32f2f;
    }

    .btn-expense:hover {
      background-color: #ffcdd2;
    }

    .btn-income {
      background-color: #e8f5e9;
      color: #388e3c;
    }

    .btn-income:hover {
      background-color: #c8e6c9;
    }

    .btn-dark {
      background-color: #1d4d4f;
      color: rgb(255, 255, 255);
    }

    .btn-dark:hover {
      background-color: #555;
    }

    /* Transactions table */
    .transactions-section {
      background-color: white;
      padding: 25px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      max-width: 900px;
      margin: 30px auto;
    }

    .transactions-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    th {
      background-color: #f0f0f0;
      padding: 10px;
      text-align: left;
      font-weight: 600;
    }

    td {
      padding: 12px 10px;
      border-bottom: 1px solid #eee;
    }

    .expense {
      color: #d32f2f;
    }

    .income {
      color: #388e3c;
    }

    .type-badge {
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      color: white;
    }

    .badge-expense {
      background-color: #d32f2f;
    }

    .badge-income {
      background-color: #388e3c;
    }

    /* Divider */
    .divider {
      height: 1px;
      background-color: #eee;
      margin: 20px 0;
    }

    /* Colores de contenedores */
    .transactions-header {
      background-color: #1d4d4f;
      color: white;
    }

    .reports-header {
      background-color: #1d4d4f;
      color: white;
    }

    .charts-header {
      background-color: #1d4d4f;
      color: white;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo-container">
      <img src="img/LogoCompleto.jpg"  alt="Logo"  style="height: 100px;">
    </div>
    <div class="right-side">
      <div class="nav-links">
        <a class="btn nav-link" id ="finanzas_personales">Finanzas Personales</a>
        <a class="btn nav-link" id="gastos_ingresos">Gastos e Ingresos</a>
        <a class="btn nav-link" id="presupuestos">Presupuestos</a>
        <a class="btn nav-link" id="ahorros">Ahorro</a>
      </div>
      <div class="user-icon"><i class="bi bi-person-circle"></i></div>
    </div>
  </nav>

  <!-- Header -->
  <header class="header">
    <h2>GASTOS E INGRESOS</h2>
    <p>
      En esta sección puedes llevar el control de todo tu dinero: cuánto ganas, cuánto gastas y en qué lo haces.
      Accede a herramientas que te ayudarán a entender mejor tu comportamiento financiero y a tomar decisiones
      informadas para mejorar tu economía personal.
    </p>
  </header>

  <!-- Main content -->
  <div class="section-container">
    <!-- Registrar transacciones -->
    <section class="section">
      <div class="section-header transactions-header">
        <i class="bi bi-cash-stack"></i>
        Registrar transacciones
      </div>
      <div class="section-body">
        <p>
          Aquí podrás ingresar todos tus ingresos y gastos del mes de forma detallada. Categoriza cada movimiento,
          agrega fechas y notas si lo deseas. Este registro será la base para generar reportes precisos y llevar
          un control total de tu flujo de efectivo.
        </p>
        <div class="divider"></div>
        <div class="buttons-container">
          <a href="{{ route('gastos.create') }}" class="btn btn-expense"><i class="bi bi-dash-circle"></i> Añadir Gasto</a>
          <a href="{{ route('ingresos.create') }}" class="btn btn-income"><i class="bi bi-plus-circle"></i> Añadir Ingreso</a>
        </div>
      </div>
    </section>

    <!-- Reportes detallados -->
    <section class="section">
      <div class="section-header reports-header">
        <i class="bi bi-file-earmark-text"></i>
        Reportes detallados
      </div>
      <div class="section-body">
        <p>
          Consulta informes organizados por períodos de tiempo para saber exactamente cuándo y cómo estás gastando
          o recibiendo dinero. Puedes elegir ver tus movimientos por día, semana o mes, lo que te da flexibilidad
          para analizar patrones o detectar excesos.
        </p>
        <div class="divider"></div>
        <div class="buttons-container">
          <button class="btn btn-dark"><i class="bi bi-eye"></i> Ver Reporte</button>
        </div>
      </div>
    </section>

    <!-- Gráficas comparativas -->
    <section class="section">
      <div class="section-header charts-header">
        <i class="bi bi-bar-chart-line"></i>
        Gráficas comparativas
      </div>
      <div class="section-body">
        <p>
          Visualiza tu información financiera con gráficas comparativas claras e intuitivas. Compara ingresos vs.
          gastos o diferentes categorías entre sí, y descubre de forma visual cómo se comporta tu economía a lo
          largo del tiempo.
        </p>
        <div class="divider"></div>
        <div class="buttons-container">
          <button class="btn btn-dark"><i class="bi bi-graph-up"></i> Ver Gráfica</button>
        </div>
      </div>
    </section>
  </div>
  <!-- Últimas transacciones -->
  <section class="transactions-section">
    <h3 class="transactions-title">Últimas Transacciones</h3>
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; gap: 10px; flex-wrap: wrap;">
      <input type="text" id="buscador" placeholder="Buscar por fecha, descripción o categoría" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

      <select id="filtro-tipo" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
        <option value="todos">Todos</option>
        <option value="Gasto">Solo Gastos</option>
        <option value="Ingreso">Solo Ingresos</option>
      </select>
    </div>
    <table>
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Descripción</th>
          <th>Categoría</th>
          <th>Monto</th>
          <th>Tipo</th>
          <th>Acción</th> <!-- Nueva columna -->
        </tr>
      </thead>
      <tbody>
        @foreach($transacciones as $transaccion)
        <tr>
          <td>{{ \Carbon\Carbon::parse($transaccion->fecha)->format('d/m/Y') }}</td>
          <td>{{ $transaccion->descripcion }}</td>
          <td>{{ $transaccion->categoria }}</td>
          <td class="{{ $transaccion->tipo == 'Gasto' ? 'expense' : 'income' }}">
            {{ $transaccion->tipo == 'Gasto' ? '-' : '+' }}${{ number_format($transaccion->monto, 2) }}
          </td>
          <td>
            <span class="type-badge {{ $transaccion->tipo == 'Gasto' ? 'badge-expense' : 'badge-income' }}">
              {{ $transaccion->tipo }}
            </span>
          </td>
          <td> <!-- Aquí agregamos el formulario de eliminación -->
            <form class="delete-form"
              data-url="{{ route($transaccion->tipo == 'Gasto' ? 'gastos.destroy' : 'ingresos.destroy', $transaccion->tipo == 'Gasto' ? $transaccion->id_Gasto : $transaccion->id_Ingreso) }}"
              method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" style="background: none; border: none; color: red; cursor: pointer;">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </section>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const forms = document.querySelectorAll('.delete-form');

      forms.forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();

          alertify.confirm(
            'Eliminar Transacción',
            '¿Estás seguro de que deseas eliminar esta transacción?',
            function() {
              // Crear un nuevo formulario e insertarlo para enviar
              const hiddenForm = document.createElement('form');
              hiddenForm.method = 'POST';
              hiddenForm.action = form.dataset.url;

              // Agrega el token CSRF
              const csrf = document.createElement('input');
              csrf.type = 'hidden';
              csrf.name = '_token';
              csrf.value = form.querySelector('[name="_token"]').value;

              const method = document.createElement('input');
              method.type = 'hidden';
              method.name = '_method';
              method.value = 'DELETE';

              hiddenForm.appendChild(csrf);
              hiddenForm.appendChild(method);
              document.body.appendChild(hiddenForm);
              hiddenForm.submit();
            },
            function() {
              // Cancelado
            }
          ).set('labels', {
            ok: 'Sí',
            cancel: 'No'
          });
        });
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const buscador = document.getElementById('buscador');
      const filtroTipo = document.getElementById('filtro-tipo');
      const filas = document.querySelectorAll('table tbody tr');

      function filtrarTabla() {
        const texto = buscador.value.toLowerCase();
        const tipoSeleccionado = filtroTipo.value;

        filas.forEach(fila => {
          const fecha = fila.children[0].textContent.toLowerCase();
          const descripcion = fila.children[1].textContent.toLowerCase();
          const categoria = fila.children[2].textContent.toLowerCase();
          const tipo = fila.children[4].textContent.trim(); // "Gasto" o "Ingreso"

          const coincideTexto = fecha.includes(texto) || descripcion.includes(texto) || categoria.includes(texto);
          const coincideTipo = tipoSeleccionado === 'todos' || tipo === tipoSeleccionado;

          if (coincideTexto && coincideTipo) {
            fila.style.display = '';
          } else {
            fila.style.display = 'none';
          }
        });
      }

      buscador.addEventListener('input', filtrarTabla);
      filtroTipo.addEventListener('change', filtrarTabla);
    });
  </script>

  <!-- Enlaces a las vistas de Finanzas Personales, Gastos e Ingresos, Presupuesto y Ahorro -->
<script>
  document.getElementById('finanzas_personales').addEventListener('click', function() {
    window.location.href = "{{ route('finanzas.personales') }}";
  });
  document.getElementById('gastos_ingresos').addEventListener('click', function() {
    window.location.href = "{{ route('gastos-ingresos') }}";
  })
  document.getElementById('presupuestos').addEventListener('click', function() {
    window.location.href = "{{ route('presupuesto') }}";
  });
  document.getElementById('ahorros').addEventListener('click', function() {
    window.location.href = "{{ route('ahorro') }}";
  });
</script>
</body>
</html>