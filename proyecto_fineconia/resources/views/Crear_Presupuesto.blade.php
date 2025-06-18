<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Presupuesto - Fineconia</title>

    <!-- Iconos & Alertify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Tu CSS con Vite -->
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
          <a href="{{ route('presupuesto') }}" class="nav-link">Presupuesto</a>
        </div>
        <div style="color:white; font-weight:bold;">
          {{ auth()->user()->name }}
        </div>
        <div class="user-icon"><i class="bi bi-person-circle"></i></div>
      </div>
    </nav>

    <!-- Formulario -->
    <div class="form-presupuesto nuevo-estilo">
      <h2>Nuevo Presupuesto</h2>

      <!-- Saldo disponible -->
      <div class="saldo-container">
        <label>Tu saldo:</label>
        <div class="saldo-box">${{ number_format($saldoDisponible, 2) }}</div>
      </div>

      <form method="POST" action="{{ route('presupuestos.store') }}">
        @csrf

        {{-- 1) Selector de mes (mes actual → diciembre) --}}
        <div class="fila">
          <label for="mes">Mes:</label>
          <select name="mes" id="mes" required>
            <option value="">-- Selecciona mes --</option>
            @foreach($mesesDisponibles as $num => $nombre)
              <option 
                value="{{ $num }}" 
                {{ old('mes') == $num ? 'selected' : '' }}>
                {{ $nombre }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- 2) Hasta 7 presupuestos: categoría + monto --}}
        @for($i = 0; $i < 7; $i++)
          <div class="fila">
            <select name="presupuestos[{{ $i }}][categoria_id]">
              <option value="">Seleccione una categoría</option>
              @foreach($categorias as $cat)
                <option 
                  value="{{ $cat->id_categoriaGasto }}"
                  {{ old("presupuestos.$i.categoria_id") == $cat->id_categoriaGasto ? 'selected' : '' }}>
                  {{ $cat->nombre }}
                </option>
              @endforeach
            </select>

            <input 
              type="number"
              name="presupuestos[{{ $i }}][monto]"
              step="0.01"
              placeholder="Monto ($)"
              value="{{ old("presupuestos.$i.monto") }}" />
          </div>
        @endfor

        {{-- 3 Botones --}}
        <div class="botones">
          <button type="submit" class="guardar">Guardar</button>
          <a href="{{ route('presupuesto') }}" class="cancelar">Cancelar</a>
        </div>
      </form>
    </div>

    <!-- Alertify: mensajes de éxito o error -->
    @if(session('success'))
      <script>
        alertify.success("{{ session('success') }}");
      </script>
    @endif
    @if($errors->any())
      <script>
        @foreach($errors->all() as $e)
          alertify.error("{{ $e }}");
        @endforeach
      </script>
    @endif
</body>
</html>
