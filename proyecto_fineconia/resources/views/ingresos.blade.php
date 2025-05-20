<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Ingreso - Fineconia</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- AlertifyJS CSS y JS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  @vite(['resources/css/ingresos.css'])
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo-container">
      <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" style="height: 50px;">
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
    <h2>REGISTRAR INGRESO</h2>
  </header>

  <!-- Formulario -->
  <div class="form-container">
    <h3 class="form-title"><i class="bi bi-plus-circle"></i> Nuevo Ingreso</h3>

    <form action="{{ route('ingresos.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>
      </div>

      <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion" required>
      </div>

      <div class="form-group">
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria" required>
          <option value="">Seleccione una categoría</option>
          <option value="Salario">Salario</option>
          <option value="Freelance">Freelance</option>
          <option value="Inversiones">Inversiones</option>
          <option value="Regalo">Regalo</option>
          <option value="Reembolso">Reembolso</option>
          <option value="Otros">Otros</option>
        </select>
      </div>

      <div class="form-group">
        <label for="monto">Monto:</label>
        <input type="number" name="monto" id="monto" min="0" step="0.01" required>
      </div>

      <div class="buttons-container">
        <button type="submit" class="btn btn-save">Guardar</button>
        <a href="{{ url('/') }}" class="btn btn-cancel">Cancelar</a>
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