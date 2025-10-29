
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Finanzas Personales</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  @vite('resources/css/Secciones.css')
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
  --menu-top: 95px;      /* posición vertical del desplegable */
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
      <button class="btn" id = "btn-presupuesto">Acceder</button>
    </div>

    <div class="section">
      <h2 class="section-title">
        <span class="section-icon savings-icon"></span>
        Ahorro
      </h2>
      <p class="section-text">
        Fijá metas de ahorro (como un viaje o una emergencia). Seguimiento visual de tu progreso, consejos personalizados y opción de ahorrar automáticamente lo que te sobra del presupuesto.
      </p>
      <button class="btn" id = "btn-ahorro">Acceder</button>
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