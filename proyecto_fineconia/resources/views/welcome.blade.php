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

    @vite('resources/css/welcome.css')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo-container">
            <img src="img/LogoCompleto.jpg" alt="Logo" style="height: 100px;">
        </div>
        <div class="right-side">
            <div class="nav-links">
                <a class="btn nav-link" id="finanzas_personales">Finanzas Personales</a>
                <a class="btn nav-link" id="gastos_ingresos">Gastos e Ingresos</a>
                <a class="btn nav-link" id="presupuestos">Presupuestos</a>
                <a class="btn nav-link" id="ahorros">Ahorro</a>
            </div>
             @include('partials.header-user')  {{-- ← nuevo partial --}}
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
                    movimiento,
                    agrega fechas y notas si lo deseas. Este registro será la base para generar reportes precisos y
                    llevar
                    un control total de tu flujo de efectivo.
                </p>
                <div class="divider"></div>
                <div class="buttons-container">
                    <a href="{{ route('gastos.create') }}" class="btn btn-expense"><i class="bi bi-dash-circle"></i>
                        Añadir Gasto</a>
                    <a href="{{ route('ingresos.create') }}" class="btn btn-income"><i class="bi bi-plus-circle"></i>
                        Añadir Ingreso</a>
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
                    gastando
                    o recibiendo dinero. Puedes elegir ver tus movimientos por día, semana o mes, lo que te da
                    flexibilidad
                    para analizar patrones o detectar excesos.
                </p>
                <div class="divider"></div>
                <div class="buttons-container">
                    <!-- Botón Ver Reporte -->
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
                    vs.
                    gastos o diferentes categorías entre sí, y descubre de forma visual cómo se comporta tu economía a
                    lo
                    largo del tiempo.
                </p>
                <div class="divider"></div>
                <div class="buttons-container">
                    
                   <button onclick="window.location.href=`{{ route('graficas') }}`"
        class="btn btn-dark">
    <i class="bi bi-graph-up"></i>Ver Gráficas</button>

                </div>
            </div>
        </section>
    </div>
    
    <!-- Últimas transacciones -->
    <section class="transactions-section">
         </div>  {{-- ← cierra .section-container --}}

    {{-- 🔸 SALDO / TOTAL DE INGRESOS 🔸 --}}
    @if(isset($saldoDisponible))
        <div style="
            max-width: 900px;
            margin: 0 auto 25px;
            background: #1d4d4f;
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 1.05rem;
            font-weight: 600;">
            Saldo actual: ${{ number_format($saldoDisponible, 2) }}
        </div>
    @endif
        <h3 class="transactions-title">Últimas Transacciones</h3>
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px; gap: 10px; flex-wrap: wrap;">
            <input type="text" id="buscador" placeholder="Buscar por fecha, descripción o categoría"
                style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

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
                    <td style="display: flex; gap: 10px;">

                        <!-- BOTON EDITAR -->
                        <a href="#" class="edit-btn" data-tipo="{{ $transaccion->tipo }}"
                            data-id="{{ $transaccion->tipo == 'Gasto' ? $transaccion->id_Gasto : $transaccion->id_Ingreso }}"
                            data-descripcion="{{ $transaccion->descripcion }}"
                            data-categoria="{{ $transaccion->categoria }}" data-monto="{{ $transaccion->monto }}"
                            style="color: #1d4d4f; text-decoration: none; font-size: 16px;">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <!-- BOTONO ELIMINAR -->
                        <form class="delete-form"
                            data-url="{{ route($transaccion->tipo == 'Gasto' ? 'gastos.destroy' : 'ingresos.destroy', $transaccion->tipo == 'Gasto' ? $transaccion->id_Gasto : $transaccion->id_Ingreso) }}"
                            method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="background: none; border: none; color: red; cursor: pointer; padding: 0;">
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
    document.querySelectorAll('.edit-btn').forEach(boton => {
        boton.addEventListener('click', function(e) {
            e.preventDefault();

            const tipo = this.dataset.tipo;
            const id = this.dataset.id;
            const descripcionActual = this.dataset.descripcion;
            const montoActual = this.dataset.monto;
            const categoriaActual = this.dataset.categoria;

            const categoriasGasto = ['Alimentación', 'Transporte', 'Vivienda', 'Entretenimiento',
                'Salud', 'Educación', 'Otros'
            ];
            const categoriasIngreso = ['Salario', 'Freelance', 'Inversión', 'Regalo', 'Reembolso',
                'Otros'
            ];
            const categorias = tipo === 'Gasto' ? categoriasGasto : categoriasIngreso;

            let optionsHTML = '';
            categorias.forEach(cat => {
                const selected = cat === categoriaActual ? 'selected' : '';
                optionsHTML += `<option value="${cat}" ${selected}>${cat}</option>`;
            });

            // Generar IDs únicos cada vez
            const uniqueSuffix = Math.floor(Math.random() * 100000);
            const inputIdDesc = `desc-${id}-${uniqueSuffix}`;
            const inputIdMonto = `monto-${id}-${uniqueSuffix}`;
            const selectIdCat = `cat-${id}-${uniqueSuffix}`;

            // Generar contenido dinámico cada vez que se abre
            const modalContent = `
            <label>Descripción:</label><br>
            <input id="${inputIdDesc}" type="text" value="${descripcionActual}" style="width: 100%; margin-bottom: 10px;"><br>
            <label>Categoría:</label><br>
            <select id="${selectIdCat}" style="width: 100%; margin-bottom: 10px;">${optionsHTML}</select><br>
            <label>Monto:</label><br>
            <input id="${inputIdMonto}" type="number" value="${montoActual}" style="width: 100%; margin-bottom: 10px;">
        `;

            alertify.confirm(
                `Editar ${tipo}`,
                modalContent,
                function() {
                    const descripcion = document.getElementById(inputIdDesc).value;
                    const categoria = document.getElementById(selectIdCat).value;
                    const monto = document.getElementById(inputIdMonto).value;

                    const url = tipo === 'Gasto' ? `/gastos/${id}` : `/ingresos/${id}`;

                    fetch(url, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            descripcion,
                            categoria,
                            monto
                        })
                    }).then(response => {
                        if (response.ok) {
                            alertify.success(`${tipo} actualizado`);
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            alertify.error(`Error al actualizar ${tipo}`);
                        }
                    });
                },
                function() {
                    alertify.error('Cancelado');
                }
            ).set('labels', {
                ok: 'Guardar',
                cancel: 'Cancelar'
            });

            // Esperar a que el modal se renderice
            setTimeout(() => {
                const guardarBtn = document.querySelector('.ajs-button.ajs-ok');
                guardarBtn.disabled = true;

                const descInput = document.getElementById(inputIdDesc);
                const catSelect = document.getElementById(selectIdCat);
                const montoInput = document.getElementById(inputIdMonto);

                const activarBotonSiCambia = () => {
                    const descModificado = descInput.value !== descripcionActual;
                    const catModificado = catSelect.value !== categoriaActual;
                    const montoModificado = montoInput.value !== montoActual;
                    guardarBtn.disabled = !(descModificado || catModificado ||
                        montoModificado);
                };

                montoInput.addEventListener('keypress', (e) => {
                    if (!/[0-9.]/.test(e.key)) e.preventDefault();
                    if (e.key === '.' && montoInput.value.includes('.')) e
                        .preventDefault();
                });

                montoInput.addEventListener('input', () => {
                    montoInput.value = montoInput.value.replace(/[^0-9.]/g, '');
                    const parts = montoInput.value.split('.');
                    if (parts.length > 2) {
                        montoInput.value = parts[0] + '.' + parts.slice(1).join('');
                    }
                    activarBotonSiCambia();
                });

                descInput.addEventListener('input', activarBotonSiCambia);
                catSelect.addEventListener('change', activarBotonSiCambia);
            }, 100);
        });
    });
    </script>



</body>

</html>