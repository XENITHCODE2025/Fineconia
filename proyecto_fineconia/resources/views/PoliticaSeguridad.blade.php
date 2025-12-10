<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Política y Privacidad - Fineconia</title>

  <!-- Bootstrap y iconos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />

  <!-- Tipografías -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Roboto+Slab&display=swap" rel="stylesheet">

  @vite('resources/css/PoliticaSeguridad.css')
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <div class="d-flex justify-content-between w-100">

        <!-- LOGO -->
        <div class="logo-container" style="max-width: 200px; width: 100%;">
          <img src="{{ asset('img/LogoConDerecho.jpg') }}" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
        </div>

        <!-- ELEMENTOS DEL NAV -->
        <div class="d-flex align-items-center gap-3 nav-elements-container">
          <button class="btn btn-link nav-link">Quienes somos</button>
          <button class="btn btn-link nav-link">Opinión / Sugerencias</button>
          <button class="btn btn-link nav-link">Ayuda</button>
          <button class="btn btn-custom" id="btn-registro">Regístrate</button>
          <button class="btn btn-custom" id="btn-login">Iniciar sesión</button>
        </div>
      </div>
    </div>
  </nav>

  <!-- CONTENIDO CENTRAL -->
  <div class="container-policy">

    <h1 class="policy-title">Política y Privacidad</h1>

    <!-- FORMULARIO DE POLÍTICAS -->
    <div class="policy-form">

      <h2 class="policy-form-title">Política de Seguridad</h2>

      <h3 class="policy-form-subtitle">Políticas de seguridad de Fineconia (Anexos)</h3>

      <div class="policy-text">

          @foreach ($secciones as $sec)

          @if($sec->titulo)
          <h2 class="policy-form-title">{{ $sec->titulo }}</h2>
          @endif

          @if($sec->subtitulo)
          <h3 class="policy-form-subtitle">{{ $sec->subtitulo }}</h3>
          @endif

          <p class="policy-text">{!! nl2br(e($sec->contenido)) !!}</p>

          @endforeach
    </div>

  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.getElementById("btn-registro").addEventListener("click", function() {
      window.location.href = "{{ route('register') }}";
    });

    document.getElementById("btn-login").addEventListener("click", function() {
      window.location.href = "{{ route('login') }}";
    });
  </script>
</body>

</html>