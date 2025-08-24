<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fineconia - Consejos de Ahorro</title>

  <!-- Bootstrap y librerías de íconos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Archivo de estilos externos -->
  @vite('resources/css/RecomendacionesDeAhorro.css')
</head>
<body>
  <!-- HEADER -->
  <header class="header">
    <!-- Logo -->
    <div class="logo-container">
  <img src="img/LogoCompleto.jpg" alt="Logo" class="responsive-logo">
</div>

    <!-- Menú de navegación -->
    <div class="menu">
      <a href="#" class="nav-link">Ejemplo</a>
      <a href="#" class="nav-link">Ejemplo</a>
      <a href="#" class="nav-link">Ejemplo</a>
      <a href="#" class="nav-link">Ejemplo</a>
      <span class="nombre">Rolando</span>
      <div class="user-icon"><i class="bi bi-person-circle"></i></div>

      <!-- Botón hamburguesa (móvil) -->
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </header>

  <!-- Menú móvil desplegable -->
  <nav class="mobile-menu" id="mobile-menu">
    <a href="#">Inicio</a>
    <a href="#">Presupuesto</a>
    <a href="#">Consejos</a>
    <a href="#">Herramientas</a>
  </nav>

  <!-- CONTENIDO -->
  <main class="contenido">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Consejos de Ahorro</h1>
        <p class="lead mb-4">Aprende estrategias prácticas para ahorrar eficientemente y alcanzar tus metas financieras</p>
        <div class="d-flex justify-content-center flex-wrap gap-2">
          <a href="#daily-tips" class="btn btn-light">Consejos Diarios</a>
          <a href="#strategies" class="btn btn-light">Estrategias</a>
        </div>
      </div>
    </section>

    <!-- Intro Section -->
    <section class="py-5">
      <div class="container">
        <div class="row align-items-center">
          <!-- Texto -->
          <div class="col-lg-6">
            <h2 class="section-title">Transforma tus hábitos financieros</h2>
            <p class="lead">El ahorro es el primer paso hacia la libertad financiera. Pequeños cambios en tus hábitos diarios pueden generar grandes resultados con el tiempo.</p>
            <p>En Fineconia, creemos que cada familia puede construir un futuro financiero sólido mediante prácticas conscientes y sostenibles de ahorro.</p>
          </div>
          <!-- Imagen con overlay -->
          <div class="col-lg-6">
            <div class="image-container">
              <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80" alt="Ahorro consciente - Persona organizando finanzas">
              <div class="image-overlay">
                <h3>Ahorro Consciente</h3>
                <p>Pequeñas decisiones, grandes resultados</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sección Consejos diarios -->
    <section id="daily-tips" class="py-5 bg-light">
      <div class="container">
        <h2 class="section-title text-center">Consejos prácticos para el día a día</h2>
        <p class="text-center mb-5">Pequeños cambios que marcan una gran diferencia en tus finanzas</p>
        
        <div class="row">
                <!-- Tip 1 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <span class="category-badge badge" style="background-color: #2f4d4f">Hogar</span>
                        <div class="card-body text-center">
                            <i class="bi bi-lightbulb tip-icon" style="color: #2f4d4f"></i>
                            <h4 class="card-title">Reduce servicios innecesarios</h4>
                            <p class="card-text">Revisa tus suscripciones y servicios mensuales. Cancela aquellos que no uses regularmente.</p>
                            <div class="mt-4">
                                <h6>Cómo implementarlo:</h6>
                                <ol class="implementation-steps text-start">
                                    <li>Revisa tus gastos mensuales</li>
                                    <li>Identifica suscripciones poco utilizadas</li>
                                    <li>Cancela al menos una este mes</li>
                                </ol>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-success">Ahorro estimado: $10-$50/mes</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tip 2 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <span class="category-badge badge" style="background-color: #2f4d4f">Alimentación</span>
                        <div class="card-body text-center">
                            <i class="bi bi-cup-hot tip-icon" style="color: #2f4d4f"></i>
                            <h4 class="card-title">Prepara comida en casa</h4>
                            <p class="card-text">Llevar comida al trabajo y reducir comida para llevar puede ahorrarte cientos mensuales.</p>
                            <div class="mt-4">
                                <h6>Cómo implementarlo:</h6>
                                <ol class="implementation-steps text-start">
                                    <li>Planifica tus comidas semanales</li>
                                    <li>Dedica 2 horas los domingos a preparar</li>
                                    <li>Invierte en recipientes prácticos</li>
                                </ol>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-success">Ahorro estimado: $100-$300/mes</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tip 3 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <span class="category-badge badge" style="background-color: #2f4d4f">Transporte</span>
                        <div class="card-body text-center">
                            <i class="bi bi-bicycle tip-icon" style="color: #2f4d4f"></i>
                            <h4 class="card-title">Transporte alternativo</h4>
                            <p class="card-text">Usa transporte público, bicicleta o comparte viajes cuando sea posible para ahorrar en gasolina y mantenimiento.</p>
                            <div class="mt-4">
                                <h6>Cómo implementarlo:</h6>
                                <ol class="implementation-steps text-start">
                                    <li>Identifica trayectos alternativos</li>
                                    <li>Prueba una app de ride-sharing</li>
                                    <li>Usa bicicleta 2 días por semana</li>
                                </ol>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-success">Ahorro estimado: $50-$150/mes</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tip 4 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <span class="category-badge badge" style="background-color: #2f4d4f">Compras</span>
                        <div class="card-body text-center">
                            <i class="bi bi-cart-check tip-icon" style="color: #2f4d4f"></i>
                            <h4 class="card-title">Regla de 24 horas</h4>
                            <p class="card-text">Antes de comprar algo no esencial, espera 24 horas. Muchas compras impulsivas se evitan con este simple paso.</p>
                            <div class="mt-4">
                                <h6>Cómo implementarlo:</h6>
                                <ol class="implementation-steps text-start">
                                    <li>Crea una lista de deseos</li>
                                    <li>Espera un día antes de comprar</li>
                                    <li>Evalúa si realmente lo necesitas</li>
                                </ol>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-success">Ahorro estimado: $50-$200/mes</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tip 5 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <span class="category-badge badge" style="background-color: #2f4d4f">Energía</span>
                        <div class="card-body text-center">
                            <i class="bi bi-lightning-charge tip-icon" style="color: #2f4d4f"></i>
                            <h4 class="card-title">Eficiencia energética</h4>
                            <p class="card-text">Apaga luces y desconecta dispositivos que no uses. Considera cambiar a bombillas LED y electrodomésticos eficientes.</p>
                            <div class="mt-4">
                                <h6>Cómo implementarlo:</h6>
                                <ol class="implementation-steps text-start">
                                    <li>Revisa tu factura de luz</li>
                                    <li>Reemplaza 5 bombillas con LED</li>
                                    <li>Usa regletas con interruptor</li>
                                </ol>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-success">Ahorro estimado: $15-$40/mes</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tip 6 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <span class="category-badge badge" style="background-color: #2f4d4f">Entretenimiento</span>
                        <div class="card-body text-center">
                            <i class="bi bi-film tip-icon" style="color: #2f4d4f"></i>
                            <h4 class="card-title">Entretenimiento low-cost</h4>
                            <p class="card-text">Explora opciones gratuitas o de bajo costo como parques, bibliotecas, eventos comunitarios y noches en casa.</p>
                            <div class="mt-4">
                                <h6>Cómo implementarlo:</h6>
                                <ol class="implementation-steps text-start">
                                    <li>Busca eventos gratuitos en tu ciudad</li>
                                    <li>Crea tradiciones de entretenimiento en casa</li>
                                    <li>Intercambia libros y juegos con amigos</li>
                                </ol>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-success">Ahorro estimado: $30-$100/mes</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Estrategias de ahorro -->
    <section id="strategies" class="py-5">
      <div class="container">
        <h2 class="section-title text-center">Estrategias de ahorro efectivas</h2>
        <p class="text-center mb-5">Encuentra el método que mejor se adapte a tus objetivos</p>
        
        <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Método 50/30/20</h3>
                            <div class="d-flex align-items-center mb-3">
                                <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: #2f4d4f">
                                    <i class="bi bi-pie-chart"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Distribución inteligente</h6>
                                    <small>Para organización básica de presupuesto</small>
                                </div>
                            </div>
                            <p>Divide tus ingresos después de impuestos en tres categorías:</p>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 50%">50% Necesidades</div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 30%">30% Deseos</div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 20%">20% Ahorro</div>
                            </div>
                            <h6>Cómo implementar:</h6>
                            <ul>
                                <li>Calcula tus ingresos netos mensuales</li>
                                <li>Clasifica tus gastos en las tres categorías</li>
                                <li>Ajusta hasta alcanzar los porcentajes objetivo</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Reto de ahorro progresivo</h3>
                            <div class="d-flex align-items-center mb-3">
                                <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: #2f4d4f">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Ahorro incremental</h6>
                                    <small>Para crear el hábito gradualmente</small>
                                </div>
                            </div>
                            <p>Ahorra una cantidad creciente cada semana durante un año:</p>
                            <div class="text-center mb-3">
                                <span class="display-6 text-success">$1,378</span>
                                <p>ahorrados en un año</p>
                            </div>
                            <h6>Cómo implementar:</h6>
                            <ul>
                                <li>Semana 1: ahorra $1</li>
                                <li>Semana 2: ahorra $2</li>
                                <li>Continúa aumentando $1 cada semana</li>
                                <li>Semana 52: ahorra $52</li>
                            </ul>
                            <div class="text-center">
                                <small class="text-muted">Total después de 52 semanas: $1,378</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Ahorro automático</h3>
                            <div class="d-flex align-items-center mb-3">
                                <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: #2f4d4f">
                                    <i class="bi bi-arrow-repeat"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Transferencia programada</h6>
                                    <small>Para ahorro sin esfuerzo consciente</small>
                                </div>
                            </div>
                            <p>Configura transferencias automáticas a una cuenta de ahorros separada:</p>
                            <div class="text-center mb-3">
                                <i class="bi bi-bank display-4" style="color: #2f4d4f"></i>
                            </div>
                            <h6>Cómo implementar:</h6>
                            <ul>
                                <li>Abre una cuenta exclusiva para ahorros</li>
                                <li>Programa transferencia el día de tu pago</li>
                                <li>Comienza con un 5-10% de tus ingresos</li>
                                <li>Aumenta el porcentaje gradualmente</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Desafío de no gastar</h3>
                            <div class="d-flex align-items-center mb-3">
                                <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background-color: #2f4d4f">
                                    <i class="bi bi-calendar-x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Días sin gastos</h6>
                                    <small>Para reducir gastos impulsivos</small>
                                </div>
                            </div>
                            <p>Selecciona días específicos donde no realizarás ningún gasto opcional:</p>
                            <div class="text-center mb-3">
                                <span class="badge p-2" style="background-color: #2f4d4f">Lunes sin gastos</span>
                                <span class="badge p-2 mx-1" style="background-color: #2f4d4f">Miércoles sin gastos</span>
                                <span class="badge p-2" style="background-color: #2f4d4f">Viernes sin gastos</span>
                            </div>
                            <h6>Cómo implementar:</h6>
                            <ul>
                                <li>Elige 2-3 días a la semana sin gastos opcionales</li>
                                <li>Prepárate con comida y entretenimiento en casa</li>
                                <li>Registra el dinero ahorrado esos días</li>
                                <li>Transfiere lo ahorrado a tu cuenta de ahorros</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final Tips -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow">
                        <div class="card-body p-5">
                            <h2 class="section-title text-center">Consejos finales para el éxito en el ahorro</h2>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="d-flex mb-4">
                                        <div class="me-3">
                                            <i class="bi bi-1-circle fs-3" style="color: #2f4d4f"></i>
                                        </div>
                                        <div>
                                            <h5>Establece metas específicas</h5>
                                            <p>Define objetivos claros y alcanzables (viaje, emergencias, educación) con fechas y cantidades concretas.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex mb-4">
                                        <div class="me-3">
                                            <i class="bi bi-2-circle fs-3" style="color: #2f4d4f"></i>
                                        </div>
                                        <div>
                                            <h5>Celebra los pequeños logros</h5>
                                            <p>Reconoce cada hito alcanzado para mantener la motivación. ¡Cada peso ahorrado te acerca a tu meta!</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="d-flex mb-4">
                                        <div class="me-3">
                                            <i class="bi bi-3-circle fs-3" style="color: #2f4d4f"></i>
                                        </div>
                                        <div>
                                            <h5>Revisa y ajusta regularmente</h5>
                                            <p>Analiza tu progreso mensualmente y adapta tu estrategia según cambios en tus ingresos o gastos.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex mb-4">
                                        <div class="me-3">
                                            <i class="bi bi-4-circle fs-3" style="color: #2f4d4f"></i>
                                        </div>
                                        <div>
                                            <h5>Involucra a toda la familia</h5>
                                            <p>Haz del ahorro un proyecto familiar donde todos contribuyan con ideas y esfuerzos.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Mostrar/Ocultar menú móvil
    document.getElementById("menu-toggle").addEventListener("click", function () {
      document.getElementById("mobile-menu").classList.toggle("active");
    });

    // Cerrar menú si se cambia a pantalla grande
    function checkScreenSize() {
      const mobileMenu = document.getElementById("mobile-menu");
      if (window.innerWidth > 768 && mobileMenu.classList.contains("active")) {
        mobileMenu.classList.remove("active");
      }
    }
    window.addEventListener("load", checkScreenSize);
    window.addEventListener("resize", checkScreenSize);
  </script>
</body>
</html>