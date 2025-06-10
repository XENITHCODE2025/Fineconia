<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Presupuesto - Fineconia</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Tu hoja de estilo con Vite --}}
    @vite(['resources/css/Crear_Presupuesto.css'])
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo-container">
            <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo Fineconia">
        </div>
        <div class="right-side">
            <div class="nav-links">
                <a href="{{ route('presupuesto') }}" class="nav-link">Gastos e Ingresos</a>
            </div>
            <div style="color:white; font-weight:bold;">{{ auth()->user()->name }}</div>
            <div class="user-icon"><i class="bi bi-person-circle"></i></div>
        </div>
    </nav>

    <!-- Formulario de nuevo presupuesto -->
    <div class="form-presupuesto">
        <h2>Nuevo Presupuesto</h2>

        <p class="saldo">
            Tu Saldo: <b>${{ number_format($saldoDisponible, 2) }}</b>
        </p>

        <form method="POST" action="{{ route('presupuestos.store') }}">
            @csrf

            <label for="categoria_id">Categoría:</label>
            <select id="categoria_id" name="categoria_id" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id_categoriaGasto }}">{{ $cat->nombre }}</option>
                @endforeach
            </select>

            <label for="monto">Monto:</label>
            <input type="number" id="monto" name="monto" min="0" step="0.01" required>

            <div class="form-buttons">
                <button type="submit" class="btn-success">Guardar</button>
                <a href="{{ route('presupuesto') }}" class="btn-danger">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer-nav">
        <div class="footer-links">
            <a href="#" class="footer-link">Ayuda</a>
            <a href="#" class="footer-link">Opiniones y Sugerencias</a>
        </div>
    </footer>

    {{-- Alertify mensajes --}}
    @if(session('success'))
        <script>alertify.success("{{ session('success') }}");</script>
    @endif
    @if($errors->any())
        @foreach($errors->all() as $e)
            <script>alertify.error("{{ $e }}");</script>
        @endforeach
    @endif
</body>
</html>
