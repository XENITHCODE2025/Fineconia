<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $titulo }} - Fineconia</title>

  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Alertify CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

  <!-- Alertify JS -->
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- PDF.js para procesar PDFs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

  <!-- Tipografías -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

  <!-- CSS externo -->
  @vite('resources/css/AquiVerGuia.css')
  
  <style>
    /* Estilos adicionales para el visor PDF optimizado */
    .pdf-viewer-container {
      width: 100%;
      height: 70vh;
      max-height: 600px;
      background: #f8f9fa;
      border-radius: 8px;
      overflow: auto;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    #pdfCanvas {
      max-width: 100%;
      height: auto;
      border-radius: 4px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    /* Mejoras en las animaciones de miniaturas */
    .mini-slide {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      transform-origin: center;
      border: 2px solid transparent;
      border-radius: 8px;
      padding: 8px;
      margin-bottom: 8px;
      background: #fff;
    }
    
    .mini-slide:hover {
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 6px 16px rgba(0,0,0,0.15);
      border-color: #62AF46;
      background: #f8fff8;
    }
    
    .mini-slide.active {
      transform: translateY(-2px) scale(1.03);
      border-color: #62AF46;
      background: #e8f5e8;
      box-shadow: 0 4px 12px rgba(98, 175, 70, 0.3);
    }
    
    .mini-slide img {
      transition: all 0.3s ease;
      border-radius: 4px;
      filter: brightness(0.95);
    }
    
    .mini-slide:hover img,
    .mini-slide.active img {
      filter: brightness(1);
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    
    .mini-slide span {
      transition: all 0.3s ease;
      font-weight: 600;
      color: #31565e;
    }
    
    .mini-slide.active span {
      color: #62AF46;
      font-weight: 700;
    }
    
    /* Efecto de carga para miniaturas */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .mini-slide {
      animation: fadeInUp 0.4s ease forwards;
    }
    
    /* Retirar el contador de páginas */
    .pdf-controls-info {
      display: none;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <header class="header">
    <div class="logo-container" style="max-width: 200px; width: 100%;">
      <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
    </div>

    <!-- BOTÓN DE USUARIO -->
    <div class="user-section" id="btn-user">
      @include('partials.header-user')
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
      const userBtn = document.getElementById('btn-user');
      const userMenu = document.getElementById('userMenu');
      const btnDatos = document.getElementById('btn-datos');
      const btnLogout = document.getElementById('btnLogout');

      userBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isVisible = userMenu.style.display === 'block';
        userMenu.style.display = isVisible ? 'none' : 'block';
      });

      btnDatos.addEventListener('click', () => {
        window.location.href = "{{ route('centro.usuario') }}";
      });

      document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target) && !userBtn.contains(e.target)) {
          userMenu.style.display = 'none';
        }
      });

      btnLogout.addEventListener('click', () => {
        alert('Sesión cerrada');
        userMenu.style.display = 'none';
      });

      const btnObjetivos = document.getElementById('btn-objetivos');
      btnObjetivos.addEventListener('click', () => {
        window.location.href = "{{ route('centro.objetivos') }}";
      });
    </script>
  </header>

  <!-- CONTENIDO -->
  <main class="contenido">
    <section class="guia-container">
      <!-- TÍTULO PRINCIPAL -->
      <div class="titulo-seccion" id="tituloSeccion">
        <i class="fa-solid fa-book-open"></i>
        <div>
          <h2 class="titulo-guia">{{ $categoria }}</h2>
          <p class="subtitulo-guia">{{ $titulo }}</p>
        </div>
      </div>

      <!-- BLOQUE FLEX -->
      <div class="contenido-flex" id="contenidoFlex">

        <!-- SIDEBAR tipo PowerPoint -->
        <aside class="sidebar" id="sidebar">
          <div class="miniaturas" id="miniaturas">
            <!-- Las miniaturas se generarán dinámicamente con JavaScript -->
          </div>
        </aside>

        <!-- CONTENIDO CENTRAL OPTIMIZADO -->
        <div class="contenido-central" id="contenidoCentral">
          <div class="pdf-viewer-container">
            <canvas id="pdfCanvas"></canvas>
          </div>
        </div>

        <!-- BOTONES DE NAVEGACIÓN LATERALES -->
        <div class="navegacion navegacion-izquierda" id="prevBtn">
          <i class="fas fa-chevron-left"></i>
        </div>
        <div class="navegacion navegacion-derecha" id="nextBtn">
          <i class="fas fa-chevron-right"></i>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-links">
        <a href="#">Ayuda</a>
        <a href="#">Sugerencias y opiniones</a>
      </div>
      <div class="footer-contact">
    <a href="mailto:codexenith@gmail.com">
        <i class="fa-regular fa-envelope"></i> codexenith@gmail.com
        </a>

    <a href="https://www.facebook.com/Fineconia" target="_blank">
        <i class="fa-brands fa-facebook"></i> Fineconia
    </a>
</div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      try {
        const pdfUrl = "{{ $urlArchivo }}";
        if (!pdfUrl) throw new Error("No se proporcionó URL del PDF");

        // Configurar PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

        // Cargar el PDF
        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        const pdf = await loadingTask.promise;
        const totalPages = pdf.numPages;

        let currentPage = 1;
        const canvas = document.getElementById('pdfCanvas');
        const ctx = canvas.getContext('2d');
        const miniaturasDiv = document.getElementById('miniaturas');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        // Renderizar una página en el canvas principal
        async function renderPage(pageNum) {
          const page = await pdf.getPage(pageNum);
          
          // Calcular escala para que el PDF se ajuste al contenedor
          const container = document.querySelector('.pdf-viewer-container');
          const containerWidth = container.clientWidth - 40; // 40px de padding
          const viewport = page.getViewport({ scale: 1.0 });
          const scale = Math.min(containerWidth / viewport.width, 1.2); // Escala máxima de 1.2
          
          const scaledViewport = page.getViewport({ scale: scale });
          canvas.width = scaledViewport.width;
          canvas.height = scaledViewport.height;

          await page.render({
            canvasContext: ctx,
            viewport: scaledViewport
          }).promise;

          currentPage = pageNum;
          updateButtons();
          updateActiveThumbnail();
        }

        // Actualizar estado de botones
        function updateButtons() {
          prevBtn.style.opacity = currentPage <= 1 ? '0.4' : '1';
          nextBtn.style.opacity = currentPage >= totalPages ? '0.4' : '1';
          prevBtn.style.pointerEvents = currentPage <= 1 ? 'none' : 'auto';
          nextBtn.style.pointerEvents = currentPage >= totalPages ? 'none' : 'auto';
        }

        // Generar miniaturas con animación escalonada
        async function generateThumbnails() {
          miniaturasDiv.innerHTML = '';
          const maxThumbnails = Math.min(totalPages, 12); // Máximo 12 miniaturas
          
          for (let i = 1; i <= maxThumbnails; i++) {
            const page = await pdf.getPage(i);
            const viewport = page.getViewport({ scale: 0.12 }); // Escala más pequeña para miniaturas
            const thumbCanvas = document.createElement('canvas');
            const thumbCtx = thumbCanvas.getContext('2d');
            thumbCanvas.width = viewport.width;
            thumbCanvas.height = viewport.height;

            await page.render({ canvasContext: thumbCtx, viewport }).promise;

            const thumb = document.createElement('div');
            thumb.className = 'mini-slide';
            if (i === 1) thumb.classList.add('active');

            // Añadir delay escalonado para la animación
            thumb.style.animationDelay = `${i * 0.1}s`;

            const img = document.createElement('img');
            img.src = thumbCanvas.toDataURL();
            img.alt = `Página ${i}`;
            
            const span = document.createElement('span');
            span.textContent = `Pág. ${i}`;

            thumb.appendChild(img);
            thumb.appendChild(span);
            
            // Añadir efecto de clic con feedback
            thumb.addEventListener('click', function() {
              // Efecto de clic momentáneo
              this.style.transform = 'scale(0.95)';
              setTimeout(() => {
                this.style.transform = '';
                renderPage(i);
              }, 150);
            });
            
            miniaturasDiv.appendChild(thumb);
          }
        }

        // Resalta la miniatura activa con transición suave
        function updateActiveThumbnail() {
          const thumbs = document.querySelectorAll('.mini-slide');
          thumbs.forEach((t, i) => {
            const isActive = i + 1 === currentPage;
            t.classList.toggle('active', isActive);
          });
        }

        // Navegación por botones con feedback
        prevBtn.addEventListener('click', function() {
          if (currentPage > 1) {
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
              this.style.transform = '';
              renderPage(currentPage - 1);
            }, 150);
          }
        });

        nextBtn.addEventListener('click', function() {
          if (currentPage < totalPages) {
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
              this.style.transform = '';
              renderPage(currentPage + 1);
            }, 150);
          }
        });

        // Navegación por teclado
        document.addEventListener('keydown', (e) => {
          if (e.key === 'ArrowLeft' && currentPage > 1) renderPage(currentPage - 1);
          if (e.key === 'ArrowRight' && currentPage < totalPages) renderPage(currentPage + 1);
        });

        // Inicializar todo
        await generateThumbnails();
        await renderPage(1);
        updateButtons();

        console.log(`PDF cargado correctamente (${totalPages} páginas).`);
      } catch (error) {
        console.error("Error al cargar el PDF:", error);
        alertify?.error("No se puede visualizar la guía: " + error.message);
      }
    });
  </script>
</body>
</html>