<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fineconia</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  @vite('resources/css/Bienvenida.css')

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



          <div class="menu-item">
            <span>Ayuda</span>
            <i class="bi bi-chevron-right"></i>
          </div>

          <form id="logoutForm" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Cerrar sesión</button>
          </form>
        </div>
      </div>

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
      </script>
    </div>
    <div class="logo-container" style="justify-content: center; margin-top: 10px;">
      <div class="logo">FINECONIA</div>
    </div>
    <div class="nav-buttons">
      <button class="nav-btn">Finanzas <span>▼</span></button>
      <button class="nav-btn">Educación Financiera</button>
      <button class="nav-btn">Economía</button>
    </div>
  </div>

  <div class="welcome-section">
    <div class="welcome-title">¡Bienvenidos a Fineconia!</div>
    <div class="welcome-text">
      Tu espacio para aprender, organizar y crecer en familia. Aquí descubrirás herramientas sencillas para manejar tus finanzas, ahorrar juntos y entender la economía de forma clara y práctica.
    </div>
    <div class="welcome-image">
      <img src="img/Bienvenida.jpg" alt="Bienvenida a Fineconia">
    </div>
  </div>

  <div class="section-title">¿Qué vas a encontrar?</div>

  <div class="feature-cards">
    <div class="card">
      <div class="card-title">Finanzas Personales</div>
      <div class="card-text">Organiza tus gastos e ingresos, crea presupuestos y alcanza tus metas de ahorro.</div>
      <button class="btn" id="btn-finanzas-personales">Acceder</button>

    </div>

    <div class="card">
      <div class="card-title">Finanzas Compartidas</div>
      <div class="card-text">Administra el dinero en familia agregando miembros, estableciendo objetivos comunes y tomando decisiones juntos.</div>
      <button class="btn">Acceder</button>
    </div>

    <div class="card">
      <div class="card-title">Finanzas Gamificadas</div>
      <div class="card-text">Aprende jugando: completa misiones, supera retos financieros y gana recompensas mientras fortaleces tus hábitos.</div>
      <button class="btn">Acceder</button>
    </div>

    <div class="card">
      <div class="card-title">Educación Financiera</div>
      <div class="card-text">
        Accede a cursos, guías y simuladores para aprender sobre dinero, inversión y planificación.
      </div>
      <a href="{{ route('educacion') }}" style="text-decoration: none;">
        <button class="btn">Acceder</button>
      </a>
    </div>


    <div class="card">
      <div class="card-title">Economía</div>
      <div class="card-text">Mantente informado con artículos actualizados sobre finanzas y economía, filtrados por sector e interés.</div>
      <button class="btn">Acceder</button>
    </div>

    <div class="card">
      <div class="card-title">Asistente Financiero con IA</div>
      <div class="card-text">Cuenta con el apoyo de un asistente financiero con IA.</div>
      <button class="btn">Usar</button>
    </div>
  </div>

  <div class="footer">
    Ayuda Opiniones y Sugerencias
  </div>

  <!-- Enlace a la vista de Finanzas Personales -->
  <script>
    document.getElementById('btn-finanzas-personales').addEventListener('click', function() {
      window.location.href = "{{ route('finanzas.personales') }}";
    });
  </script>


</body>

</html>