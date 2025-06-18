<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Gasto - Fineconia</title>

  <!-- Iconos & AlertifyJS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- Tu CSS -->
  @vite('resources/css/formulario-gastos.css')
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo-container">
      <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" class="logo">
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
    <h2>REGISTRAR GASTO</h2>
  </header>

  <!-- Formulario -->
  <div class="form-container">
    <h3 class="form-title"><i class="bi bi-dash-circle"></i> Nuevo Gasto</h3>

    <form action="{{ route('gastos.store') }}" method="POST" id="gasto-form">
      @csrf

      <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
      </div>

      <div class="form-group">
        <label for="descripcion">
          Descripción (máx. 255 caracteres):
          <span id="desc-counter">0/255</span>
        </label>
        <input type="text" id="descripcion" name="descripcion" maxlength="255" required>
      </div>

      <div class="form-group">
        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id" required>
          <option value="">Seleccione una categoría</option>
          @foreach($presupuestos as $pre)
            <option value="{{ $pre->categoria_id }}">
              {{ $pre->categoriaGasto->nombre ?? 'Sin categoría' }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" min="0" step="0.01" required>
      </div>

      <div class="buttons-container">
        <button type="submit" class="btn btn-save">Guardar</button>
        <a href="{{ route('gastos-ingresos') }}" class="btn btn-cancel">Cancelar</a>
      </div>
    </form>
  </div>

  <!-- AlertifyJS mensajes -->
  <script>
    @if(session('success'))
      alertify.success("{{ session('success') }}");
    @endif
    @if($errors->any())
      alertify.error("Por favor completa correctamente el formulario.");
      @foreach($errors->all() as $error)
        alertify.error("{{ $error }}");
      @endforeach
    @endif

    // Contador de caracteres para Descripción
    const descInput = document.getElementById('descripcion');
    const descCounter = document.getElementById('desc-counter');
    descInput.addEventListener('input', () => {
      const len = descInput.value.length;
      descCounter.textContent = `${len}/255`;
    });
  </script>

  <!-- Toggle menú hamburguesa -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const btnMenu = document.querySelector('.hamburger');
      const menu    = document.querySelector('.nav-links');
      btnMenu.addEventListener('click', () => menu.classList.toggle('active'));
    });
  </script>

  <!-- Navegación -->
  <script>
    document.getElementById('finanzas_personales').onclick = () =>
      window.location.href = "{{ route('finanzas.personales') }}";
    document.getElementById('gastos_ingresos').onclick = () =>
      window.location.href = "{{ route('gastos-ingresos') }}";
    document.getElementById('presupuestos').onclick = () =>
      window.location.href = "{{ route('presupuesto') }}";
    document.getElementById('ahorros').onclick = () =>
      window.location.href = "{{ route('ahorro') }}";
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
</body>

</html>
