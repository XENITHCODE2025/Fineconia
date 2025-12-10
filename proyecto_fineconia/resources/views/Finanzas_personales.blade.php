<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Finanzas Personales</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  @vite('resources/css/Secciones.css')


  <!-- ÍCONOS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
 
</head>

<body>
  <div class="header">
    <div class="top-bar">
      <div class="logo-container">
        <img src="img/LogoCompleto.jpg" alt="Logo" style="height: 100px;">
      </div>
      <!-- BOTÓN DE USUARIO -->
      <div class="user-section" id="btn-user">
        @include('partials.header-user') {{-- ← partial del usuario --}}
      </div>

      <!-- DESPLEGABLE DEL MENÚ USUARIO -->
      <div class="user-menu" id="userMenu">
        <div class="menu-container">
          <div class="menu-header">
            <i class="bi bi-person-circle"></i>
            <span>{{ Auth::user()->name }}</span>
          </div>

          <div class="menu-item" id="btn-datos">
            <span>Datos Generales</span>
            <i class="bi bi-chevron-right"></i>
          </div>

          <div class="menu-item" id="btn-objetivos">
            <a href="{{ route('centro.objetivos') }}" style="text-decoration: none; color: inherit;">
              <span>Mis Objetivos</span>
              <i class="bi bi-chevron-right"></i>
            </a>
          </div>

               <div class="menu-item" id="btn-historial">
    <a href="{{ route('centro.historial') }}" style="text-decoration: none; color: inherit;">
      <span>Historial General</span>
      <i class="bi bi-chevron-right"></i>
    </a>
</div>

          <a href="{{ url('/ayuda') }}" class="menu-item" style="text-decoration: none; color: inherit;">
  <span>Ayuda</span>
  <i class="bi bi-chevron-right"></i>
</a>

          <form id="logoutForm" method="POST" action="{{ route('logout') }}">
  @csrf
  <button type="submit" class="logout-btn">Cerrar sesión</button>
</form>

        </div>
      </div>

      <script>
  const logoutForm = document.getElementById('logoutForm');
  logoutForm.addEventListener('submit', () => {
    // Eliminar cualquier dato local almacenado
    localStorage.removeItem('token');
    localStorage.removeItem('usuario');
    sessionStorage.clear();
  });
</script>

      <script>
        const userBtn = document.getElementById('btn-user');
        const userMenu = document.getElementById('userMenu');
        const btnDatos = document.getElementById('btn-datos');
        const btnLogout = document.getElementById('btnLogout');

        // Mostrar / ocultar menú al hacer clic en el botón del usuario
        userBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          const isVisible = userMenu.style.display === 'block';
          userMenu.style.display = isVisible ? 'none' : 'block';
        });

        // Redirigir al hacer clic en "Datos Generales"
        btnDatos.addEventListener('click', () => {
          window.location.href = "{{ route('centro.usuario') }}";
        });

        // Cerrar menú si se hace clic fuera
        document.addEventListener('click', (e) => {
          if (!userMenu.contains(e.target) && !userBtn.contains(e.target)) {
            userMenu.style.display = 'none';
          }
        });

        // Simulación de cierre de sesión
        btnLogout.addEventListener('click', () => {
          alert('Sesión cerrada');
          userMenu.style.display = 'none';
        });

        // Redirigir al hacer clic en "Mis Objetivos"
        const btnObjetivos = document.getElementById('btn-objetivos');
        btnObjetivos.addEventListener('click', () => {
          window.location.href = "{{ route('centro.objetivos') }}";
        });

                const btnHistorial = document.getElementById('btn-historial');
btnHistorial.addEventListener('click', () => {
  window.location.href = "{{ route('centro.historial') }}";
});
      </script>
    </div>
    <div class="logo-container" style="justify-content: center; margin-top: 10px;">
      <div class="logo">FINANZAS PERSONALES</div>
    </div>
    <div class="subtitle">
      Tu espacio para organizar y mejorar tu salud financiera. Accedé a tus Gastos e Ingresos, Presupuestos y Ahorros para tomar decisiones más inteligentes.
    </div>
  </div>

  <div class="main-container">
    <div class="section">
      <h2 class="section-title">
        <span class="section-icon money-icon"></span>
        Gastos e Ingresos
      </h2>
      <p class="section-text">
        Registrá tus entradas y salidas de dinero día a día. Clasificá por categorías (alimentación, transporte, ocio, etc.)
      </p>
      <button class="btn" id="btn-gastos-ingresos">Acceder</button>
    </div>

    <div class="section">
      <h2 class="section-title">
        <span class="section-icon budget-icon"></span>
        Presupuesto
      </h2>
      <p class="section-text">
        Establecé cuánto querés gastar por categoría cada mes. Ajustá límites, recibí alertas si te pasás y compará tu presupuesto planificado con lo que realmente gastás.
      </p>
      <button class="btn" id="btn-presupuesto">Acceder</button>
    </div>

    <div class="section">
      <h2 class="section-title">
        <span class="section-icon savings-icon"></span>
        Ahorro
      </h2>
      <p class="section-text">
        Fijá metas de ahorro (como un viaje o una emergencia). Seguimiento visual de tu progreso, consejos personalizados y opción de ahorrar automáticamente lo que te sobra del presupuesto.
      </p>
      <button class="btn" id="btn-ahorro">Acceder</button>
    </div>
  </div>

  <div class="footer">
    Ayuda Opiniones y Sugerencias
  </div>
  <!-- Enlace a la vista de Finanzas Personales -->
  <script>
    document.getElementById('btn-gastos-ingresos').addEventListener('click', function() {
      window.location.href = "{{ route('gastos-ingresos') }}";
    });

    document.getElementById('btn-presupuesto').addEventListener('click', function() {
      window.location.href = "{{ route('presupuesto') }}";
    });

    document.getElementById('btn-ahorro').addEventListener('click', function() {
      window.location.href = "{{ route('ahorro') }}";
    });
  </script>

</body>

</html>