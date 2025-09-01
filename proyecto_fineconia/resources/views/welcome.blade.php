<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gastos e Ingresos - Fineconia</title>

    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Alertify -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Tu CSS -->
    @vite('resources/css/welcome.css')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo-container">
            <img src="img/LogoCompleto.jpg" alt="Logo" class="logo">
        </div>

        <!-- Botón hamburguesa (móvil) -->
        <button class="hamburger" type="button" aria-label="Menú">
            <i class="bi bi-list"></i>
        </button>

        <div class="right-side">
            <div class="nav-links">
                {{-- Usuario primero en móvil --}}
                @auth
                <a href="#" class="nav-link user-name">{{ Auth::user()->name }}</a>
                @endauth

                <a class="btn nav-link" id="finanzas_personales">Finanzas Personales</a>
                <a class="btn nav-link" id="gastos_ingresos">Gastos e Ingresos</a>
                <a class="btn nav-link" id="presupuestos">Presupuestos</a>
                <a class="btn nav-link" id="ahorros">Ahorro</a>
            </div>

            {{-- Partial de usuario (desktop) --}}
            <div class="header-user">
                @include('partials.header-user')
            </div>
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
                    Aquí podrás ingresar todos tus ingresos y gastos del mes de forma detallada. Categoriza cada
                    movimiento, agrega fechas y notas si lo deseas. Este registro será la base para generar reportes
                    precisos y llevar un control total de tu flujo de efectivo.
                </p>
                <div class="divider"></div>
                <div class="buttons-container">
                    <a href="{{ route('gastos.create') }}" class="btn btn-expense">
                        <i class="bi bi-dash-circle"></i> Añadir Gasto
                    </a>
                    <a href="{{ route('ingresos.create') }}" class="btn btn-income">
                        <i class="bi bi-plus-circle"></i> Añadir Ingreso
                    </a>
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
                    Consulta informes organizados por períodos de tiempo para saber exactamente cuándo y cómo estás
                    gastando o recibiendo dinero. Puedes elegir ver tus movimientos por día, semana o mes.
                </p>
                <div class="divider"></div>
                <div class="buttons-container">
                    <a href="{{ route('reportes') }}" class="btn btn-dark">
                        <i class="bi bi-eye"></i> Ver Reporte
                    </a>
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
                    Visualiza tu información financiera con gráficas comparativas claras e intuitivas. Compara ingresos
                    vs. gastos y descubre patrones a lo largo del tiempo.
                </p>
                <div class="divider"></div>
                <div class="buttons-container">
                    <button onclick="window.location.href=`{{ route('graficas') }}`" class="btn btn-dark">
                        <i class="bi bi-graph-up"></i> Ver Gráficas
                    </button>
                </div>
            </div>
        </section>
    </div>

    <!-- Últimas transacciones -->
    <section class="transactions-section">
        @if(isset($saldoDisponible))
        <div class="saldo-banner">
            Saldo actual: ${{ number_format($saldoDisponible, 2) }}
        </div>
        @endif

        <h3 class="transactions-title">Últimas Transacciones</h3>
        <div class="filter-bar">
            <input type="text" id="buscador" placeholder="Buscar por fecha, descripción o categoría">
            <select id="filtro-tipo">
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
                    <th>Acción</th>
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
                    <td class="action-cell">
                        @php
                        $filaId = $transaccion->tipo === 'Gasto'
                        ? $transaccion->id_Gasto
                        : $transaccion->id_Ingreso;
                        $rutaEliminar = $transaccion->tipo === 'Gasto'
                        ? route('gastos.destroy', $filaId)
                        : route('ingresos.destroy', $filaId);
                        @endphp

                        <a href="javascript:void(0)" class="edit-btn" data-tipo="{{ $transaccion->tipo }}"
                            data-id="{{ $filaId }}" data-descripcion="{{ $transaccion->descripcion }}"
                            data-categoria="{{ $transaccion->categoria }}" data-monto="{{ $transaccion->monto }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form class="delete-form" data-url="{{ $rutaEliminar }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle menú hamburguesa -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnMenu = document.querySelector('.hamburger');
        const menu = document.querySelector('.nav-links');
        btnMenu.addEventListener('click', () => menu.classList.toggle('active'));
    });
    </script>

    <!-- Confirmación y buscador (igual que antes) -->
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

    <!-- BUSCADOR -->
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

                const coincideTexto = fecha.includes(texto) || descripcion.includes(texto) || categoria
                    .includes(texto);
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

    <!-- UPDATE  -->
    <script>
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();

            const tipo = btn.dataset.tipo; // “Gasto” | “Ingreso”
            const id = btn.dataset.id;
            const descActual = btn.dataset.descripcion;
            const catActual = btn.dataset.categoria;
            const montoActual = btn.dataset.monto;

            // ---------- Construir HTML del modal ----------
            let contenido = '';
            if (tipo === 'Gasto') {
                const inpIdMonto = `monto-${id}-${Date.now()}`;
                contenido = `
                <label>Monto:</label><br>
                <input id="${inpIdMonto}" type="number" value="${montoActual}"
                       style="width:100%;margin-bottom:10px;">
            `;
                alertify.confirm(`Editar ${tipo}`, contenido,
                    () => {
                        const nuevoMonto = document.getElementById(inpIdMonto).value;
                        fetch(`/gastos/${id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    monto: nuevoMonto
                                })
                            })
                            .then(r => r.ok ? location.reload() :
                                alertify.error('No se pudo actualizar'))
                    },
                    () => {}
                ).set('labels', {
                    ok: 'Guardar',
                    cancel: 'Cancelar'
                });
            } else {
                /* Ingreso */
                const suf = Date.now();
                const inpDesc = `desc-${id}-${suf}`;
                const inpMonto = `monto-${id}-${suf}`;
                const selCat = `cat-${id}-${suf}`;

                const opciones = @json(\App\Models\CategoriaIngreso::pluck('nombre','id_categoriaIngreso'));
                let optsHtml = '';
                for (const [idCat, nombre] of Object.entries(opciones)) {
                    optsHtml +=
                        `<option value="${idCat}" ${nombre===catActual?'selected':''}>${nombre}</option>`;
                }

                contenido = `
              <label>Descripción:</label><br>
              <input id="${inpDesc}"  type="text"   value="${descActual}"  style="width:100%;margin-bottom:10px;"><br>
              <label>Categoría:</label><br>
              <select id="${selCat}" style="width:100%;margin-bottom:10px;">${optsHtml}</select><br>
              <label>Monto:</label><br>
              <input id="${inpMonto}" type="number" value="${montoActual}" style="width:100%;margin-bottom:10px;">
            `;

                alertify.confirm(`Editar ${tipo}`, contenido,
                    () => {
                        fetch(`/ingresos/${id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    descripcion: document.getElementById(inpDesc).value,
                                    categoria_id: document.getElementById(selCat).value,
                                    monto: document.getElementById(inpMonto).value
                                })
                            })
                            .then(r => r.ok ? location.reload() :
                                alertify.error('No se pudo actualizar, por que ya tienes un presupuesto creado.'));
                    },
                    () => {}
                ).set('labels', {
                    ok: 'Guardar',
                    cancel: 'Cancelar'
                });
            }
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Selecciona el contenedor del partial
        const headerUser = document.querySelector('.header-user');

        if (!headerUser) return;

        // Función que muestra/oculta según ancho
        function toggleHeaderUser() {
            if (window.innerWidth <= 768) {
                headerUser.style.display = 'none';
            } else {
                headerUser.style.display = '';
            }
        }

        // Ejecuta al cargar…
        toggleHeaderUser();

        // …y cada vez que se redimensiona la ventana
        window.addEventListener('resize', toggleHeaderUser);
    });




</script>
<script>
@if(session('success'))
    alertify.success("{{ session('success') }}");
@endif

@if(session('error'))
    alertify.error("{{ session('error') }}");
@endif
</script>


    

</html>