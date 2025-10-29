
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fineconia</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
 @vite('resources/css/Bienvenida.css')
</head>
<body>
  <div class="header">
    <div class="top-bar">
      <div class="logo-container">
       <img src="img/LogoCompleto.jpg"  alt="Logo"  style="height: 100px;">
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

    <div class="menu-item">
      <span>Mis Objetivos</span>
      <i class="bi bi-chevron-right"></i>
    </div>

    <div class="menu-item">
      <span>Ayuda</span>
      <i class="bi bi-chevron-right"></i>
    </div>

    <button class="logout-btn" id="btnLogout">Cerrar sesión</button>
  </div>
</div>

<!-- ÍCONOS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
/* 🎨 VARIABLES DE CONTROL */
:root {
  --menu-top: 70px;      /* posición vertical del desplegable */
  --menu-right: 30px;    /* posición horizontal del desplegable */
  --menu-text-color: #000; /* color principal del texto */
  --menu-bg: #fff;       /* color del fondo del menú */
  --menu-hover: #f7f7f7; /* color de fondo al pasar el mouse */
  --menu-accent: #31565e; /* color de detalles y bordes */
}

/* MENÚ DESPLEGABLE */
.user-menu {
  position: absolute;
  top: var(--menu-top);
  right: var(--menu-right);
  display: none;
  z-index: 9999;
  background-color: transparent;
}

/* CAJA DEL MENÚ */
.menu-container {
  background-color: var(--menu-bg);
  width: 300px;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 6px 16px rgba(0,0,0,0.25);
  animation: fadeIn 0.25s ease;
  color: var(--menu-text-color);
}

/* CABECERA DEL MENÚ */
.menu-header {
  display: flex;
  align-items: center;
  padding: 15px 20px;
  border-bottom: 1px solid #ddd;
}

.menu-header i {
  font-size: 28px;
  color: var(--menu-accent);
  margin-right: 10px;
}

.menu-header span {
  font-size: 17px;
  font-weight: 500;
  color: var(--menu-text-color);
}

/* ELEMENTOS DEL MENÚ */
.menu-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 14px 20px;
  font-size: 16px;
  cursor: pointer;
  border-bottom: 1px solid #f0f0f0;
  transition: background-color 0.2s;
  color: var(--menu-text-color);
}

.menu-item:hover {
  background-color: var(--menu-hover);
}

.menu-item:last-of-type {
  border-bottom: none;
}

.menu-item i {
  font-size: 18px;
  color: var(--menu-text-color);
}

/* BOTÓN DE CERRAR SESIÓN */
.logout-btn {
  display: block;
  width: calc(100% - 40px);
  margin: 20px auto;
  padding: 10px 0;
  background: transparent;
  border: 1px solid var(--menu-accent);
  color: var(--menu-text-color);
  font-size: 15px;
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.logout-btn:hover {
  background-color: var(--menu-accent);
  color: #fff;
}

/* ANIMACIÓN DE APARICIÓN */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

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