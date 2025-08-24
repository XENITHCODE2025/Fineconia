<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fineconia - Opiniones y Sugerencias</title>
  <!-- Enlaces a frameworks y librerías externas -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Enlace al archivo CSS propio -->
  @vite('resources/css/ReseñaSySugerencias.css')
</head>
<body>
  <!-- Cabecera con logo y menú de navegación -->
  <header class="header">
    <div class="logo-container">
  <img src="img/LogoCompleto.jpg" alt="Logo" class="responsive-logo">
</div>

    <div class="menu">
      <a href="#" class="nav-link">Gastos e ingresos</a>
      <span class="nombre">Rolando</span>
      <div class="user-icon"><i class="bi bi-person-circle"></i></div>

      <!-- Botón hamburguesa para versión móvil -->
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </header>

  <!-- Menú desplegable para dispositivos móviles -->
  <nav class="mobile-menu" id="mobile-menu">
    <a href="#">Inicio</a>
    <a href="#">Presupuesto</a>
    <a href="#">Consejos</a>
    <a href="#">Herramientas</a>
  </nav>

  <!-- Contenido principal de la página -->
  <main class="contenido">
    <!-- Sección principal con imagen y texto destacado -->
    <section class="py-5 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4">Tu opinión nos importa</h1>
            <p class="lead mb-4">Comparte tu experiencia con Fineconia y ayúdanos a mejorar. Valoramos cada sugerencia para hacer de la educación financiera algo accesible para todas las familias.</p>
            <a href="#review-form" class="btn btn-primary btn-lg">Dejar una reseña</a>
          </div>
          <div class="col-lg-6">
            <div class="image-container">
              <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80" alt="Sugerencias Fineconia">
              <div class="image-overlay">
                <h3>Fineconia Opinión</h3>
                <p>Comparte tus ideas para mejorar</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sección de estadísticas -->
    <section class="py-5">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-3 mb-4">
            <div class="stats-number">4.8</div>
            <p>Calificación promedio</p>
          </div>
          <div class="col-md-3 mb-4">
            <div class="stats-number">1,250+</div>
            <p>Reseñas recibidas</p>
          </div>
          <div class="col-md-3 mb-4">
            <div class="stats-number">95%</div>
            <p>De sugerencias implementadas</p>
          </div>
          <div class="col-md-3 mb-4">
            <div class="stats-number">300+</div>
            <p>Mejoras realizadas</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Sección de reseñas de usuarios -->
    <section class="py-5 bg-light">
      <div class="container">
        <h2 class="section-title">Lo que dicen nuestras familias</h2>
        <div class="row">
          <!-- Reseña 1 -->
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <img src="https://placehold.co/50x50/2f4d4f/FFFFFF?text=J" class="testimonial-img me-3" alt="Usuario">
                  <div>
                    <h5 class="card-title mb-0">Juan Pérez</h5>
                    <div class="rating">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p class="card-text">"Fineconia ha transformado cómo manejamos las finanzas en familia. Las herramientas de ahorro son excelentes y el contenido educativo es claro y práctico."</p>
                <small class="text-muted">Publicado hace 2 días</small>
              </div>
            </div>
          </div>
          
          <!-- Reseña 2 -->
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <img src="https://placehold.co/50x50/2f4d4f/FFFFFF?text=M" class="testimonial-img me-3" alt="Usuario">
                  <div>
                    <h5 class="card-title mb-0">María González</h5>
                    <div class="rating">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </div>
                  </div>
                </div>
                <p class="card-text">"La gamificación hace que aprender sobre finanzas sea divertido para mis hijos. Me gustaría ver más contenido sobre inversiones básicas."</p>
                <small class="text-muted">Publicado hace 1 semana</small>
              </div>
            </div>
          </div>
          
          <!-- Reseña 3 -->
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <img src="https://placehold.co/50x50/2f4d4f/FFFFFF?text=C" class="testimonial-img me-3" alt="Usuario">
                  <div>
                    <h5 class="card-title mb-0">Carlos Rodríguez</h5>
                    <div class="rating">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star"></i>
                    </div>
                  </div>
                </div>
                <p class="card-text">"La app es muy útil para organizar nuestro presupuesto familiar. Sería genial poder exportar reportes en PDF para tener un registro físico."</p>
                <small class="text-muted">Publicado hace 3 días</small>
              </div>
            </div>
          </div>
        </div>
        
        <div class="text-center mt-4">
          <a href="#" class="btn btn-outline-primary">Ver más reseñas</a>
        </div>
      </div>
    </section>

    <!-- Formulario para enviar reseñas -->
    <section id="review-form" class="py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body p-5">
                <h2 class="section-title">Comparte tu experiencia</h2>
                <p class="mb-4">Tu feedback nos ayuda a mejorar Fineconia para todas las familias.</p>
                
                <form>
                  <div class="mb-4">
                    <label class="form-label">Calificación general</label>
                    <div class="rating" id="rating-stars">
                      <i class="bi bi-star fs-3 me-1" data-value="1"></i>
                      <i class="bi bi-star fs-3 me-1" data-value="2"></i>
                      <i class="bi bi-star fs-3 me-1" data-value="3"></i>
                      <i class="bi bi-star fs-3 me-1" data-value="4"></i>
                      <i class="bi bi-star fs-3 me-1" data-value="5"></i>
                    </div>
                    <input type="hidden" id="rating-value" name="rating" value="0">
                  </div>
                  
                  <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" placeholder="Tu nombre">
                  </div>
                  
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="tu@email.com">
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label">¿Qué te gustó de Fineconia?</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="like1" value="content">
                      <label class="form-check-label" for="like1">Contenido educativo</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="like2" value="tools">
                      <label class="form-check-label" for="like2">Herramientas de finanzas</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="like3" value="design">
                      <label class="form-check-label" for="like3">Diseño y usabilidad</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="like4" value="gamification">
                      <label class="form-check-label" for="like4">Elementos gamificados</label>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <label for="suggestion" class="form-label">¿Qué podemos mejorar?</label>
                    <textarea class="form-control" id="suggestion" rows="3" placeholder="Tu sugerencia para mejorar Fineconia..."></textarea>
                  </div>
                  
                  <div class="mb-3">
                    <label for="comment" class="form-label">Tu reseña</label>
                    <textarea class="form-control" id="comment" rows="5" placeholder="Comparte tu experiencia con Fineconia..."></textarea>
                  </div>
                  
                  <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="permission">
                    <label class="form-check-label" for="permission">Acepto que mi reseña sea publicada de forma anónima en el sitio web</label>
                  </div>
                  
                  <button type="submit" class="btn btn-primary btn-lg">Enviar reseña</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sección de preguntas frecuentes -->
    <section class="py-5 bg-light">
      <div class="container">
        <h2 class="section-title text-center">Preguntas frecuentes</h2>
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="accordion" id="faqAccordion">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    ¿Las reseñas son verificadas?
                  </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    Sí, todas las reseñas pasan por un proceso de verificación para garantizar que provienen de usuarios reales de Fineconia.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    ¿Cómo se utilizan las sugerencias?
                  </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    Analizamos todas las sugerencias recibidas y las priorizamos según su impacto y factibilidad. Las ideas más votadas por la comunidad suelen implementarse primero.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    ¿Puedo editar o eliminar mi reseña?
                  </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    Sí, puedes contactarnos a fineconia@gmail.com para solicitar la edición o eliminación de tu reseña en cualquier momento.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Pie de página -->
  <footer class="footer">
    <div class="footer-links">
      <a href="#">Ayuda</a>
      <a href="#">Opiniones y Sugerencias</a>
    </div>
  </footer>

  <!-- Scripts de Bootstrap y funcionalidad personalizada -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
   // Mostrar/Ocultar menú móvil
document.getElementById("menu-toggle").addEventListener("click", function () {
  document.getElementById("mobile-menu").classList.toggle("active");
});

// Función para verificar el tamaño de pantalla y cerrar menú si es necesario
function checkScreenSize() {
  const mobileMenu = document.getElementById("mobile-menu");
  if (window.innerWidth > 768 && mobileMenu.classList.contains("active")) {
    mobileMenu.classList.remove("active");
  }
}

// Ejecutar al cargar y al redimensionar
window.addEventListener("load", checkScreenSize);
window.addEventListener("resize", checkScreenSize);

// Funcionalidad para las estrellas de valoración
const stars = document.querySelectorAll('#rating-stars i');
const ratingValue = document.getElementById('rating-value');

stars.forEach(star => {
  star.addEventListener('mouseover', selectStars);
  star.addEventListener('click', setRating);
});

function selectStars(e) {
  const hoverValue = e.target.getAttribute('data-value');
  stars.forEach(star => {
    const starValue = star.getAttribute('data-value');
    if (starValue <= hoverValue) {
      star.classList.remove('bi-star');
      star.classList.add('bi-star-fill');
    } else {
      star.classList.remove('bi-star-fill');
      star.classList.add('bi-star');
    }
  });
}

function setRating(e) {
  const clickValue = e.target.getAttribute('data-value');
  ratingValue.value = clickValue;
  
  stars.forEach(star => {
    const starValue = star.getAttribute('data-value');
    if (starValue <= clickValue) {
      star.classList.remove('bi-star');
      star.classList.add('bi-star-fill');
    } else {
      star.classList.remove('bi-star-fill');
      star.classList.add('bi-star');
    }
  });
}
  </script>
</body>
</html>