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
            <a href="{{ route('gastos-ingresos') }}" class="nav-link">Gastos e Ingresos</a>
            <span class="nombre">{{ auth()->user()->name }}</span>
            <div class="user-icon"><i class="bi bi-person-circle"></i></div>
        </div>
    </header>

    <!-- Contenido -->
    <main class="contenido">
        <div class="titulo-contenedor">
            <h1>Ajustar Presupuesto</h1>
        </div>

        <div class="busqueda">
            <input type="text" id="buscador" placeholder="Buscar por categoría">
            <button><i class="fas fa-chevron-down"></i></button>
        </div>

        <!-- … encabezado idéntico … -->

        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Categoría</th>
                    <th>Presupuesto</th>
                    <th>Restante</th> {{-- ← NUEVO --}}
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($presupuestos as $pre)
                <tr>
                    <td>{{ $pre->created_at->format('d/m/Y') }}</td>
                    <td>{{ $pre->categoriaGasto->nombre ?? 'Sin categoría' }}</td>
                    <td>${{ number_format($pre->monto,   2) }}</td>
                    <td>${{ number_format($pre->restante,2) }}</td> {{-- ← NUEVO --}}

                    <td>
                        <i class="fas fa-pen edit-btn" data-id="{{ $pre->id_Presupuesto }}"
                            data-monto="{{ $pre->monto }}" style="cursor:pointer"></i>

                        {{-- Eliminar --}}
                        <form class="delete-form d-inline"
                            action="{{ route('presupuestos.destroy', $pre->id_Presupuesto) }}" method="POST"
                            style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" title="Eliminar"
                                style="background:none;border:none;color:#c0392b;cursor:pointer">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    {{-- ahora la tabla tiene 5 columnas --}}
                    <td colspan="5" style="text-align:center;">Sin presupuestos aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <a href="#">Ayuda</a>
            <a href="#">Opiniones y Sugerencias</a>
        </div>
    </footer>

    <!-- Buscador en vivo -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        /* --- buscador en vivo --- */
        const buscador = document.getElementById('buscador');
        const filas = document.querySelectorAll('tbody tr');

        buscador.addEventListener('input', () => {
            const texto = buscador.value.toLowerCase();
            filas.forEach(fila => {
                const cat = fila.children[1].textContent.toLowerCase();
                fila.style.display = cat.includes(texto) ? '' : 'none';
            });
        });

        /* --- confirmación de borrado --- */
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', e => {
                e.preventDefault();

                alertify.confirm(
                    'Eliminar presupuesto',
                    '¿Estás seguro de que deseas eliminar este registro?',
                    () => form.submit(), // OK
                    () => {} // Cancelar
                ).set('labels', {
                    ok: 'Sí',
                    cancel: 'No'
                });

            });
        });

        /* --- mensajes flash --- */
        @if(session('success'))
        alertify.success("{{ session('success') }}");
        @endif

        @if(session('error'))
        alertify.error("{{ session('error') }}");
        @endif

    });
    </script>

    <!-- Editar Presupuesto -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        /* --- abrir modal al hacer clic en el lápiz --- */
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const monto = btn.dataset.monto;

                alertify.prompt(
                    'Actualizar presupuesto',
                    'Nuevo monto:',
                    monto,
                    function(evt, value) { // OK
                        if (isNaN(value) || Number(value) < 0) {
                            alertify.error('Monto inválido');
                            return;
                        }

                        fetch(`/presupuestos/${id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    monto: value
                                })
                            })
                            .then(r => {
                                if (!r.ok) throw new Error();
                                return r.json();
                            })
                            .then(() => location.reload()) // recarga o actualiza fila
                            .catch(() => alertify.error('Error al actualizar'));
                    },
                    function() {
                        /* Cancelado */ }
                ).set({
                    labels: {
                        ok: 'Guardar',
                        cancel: 'Cancelar'
                    }
                });
            });
        });

    });
    </script>


</body>

</html>