<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fineconia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .navbar {
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      padding: 1rem 0;
    }

    .navbar .nav-link {
      color: #1f2f30;
      font-weight: 500;
      margin: 0 1rem;
    }

    .btn-custom {
      background-color: #31565e;
      color: white;
      border-radius: 5px;
      padding: 0.3rem 1rem;
      margin-left: 0.5rem;
    }

    .hero {
      background-color: #396471;
      color: white;
      border-radius: 10px;
      padding: 3rem 2rem;
      margin: 3rem auto;
      text-align: center;
      max-width: 1200px;
      width: 90%;
    }

    .section-title {
      font-size: 2rem;
      font-weight: bold;
      text-align: center;
      margin: 3rem 0 2rem;
    }

    .info-section {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.5rem;
      padding: 1rem;
      margin: 2rem auto;
      max-width: 1200px;
      width: 90%;
    }

    .card-info {
      background-color: #396471;
      color: white;
      border-radius: 10px;
      padding: 2rem;
      text-align: center;
      height: 100%;
      margin-bottom: 1.5rem;
    }

    .card-info i {
      font-size: 2rem;
      color: white;
      margin-bottom: 1rem;
    }

    .card-info h5 {
      color: #ffc107;
      font-weight: bold;
    }

    footer {
      background-color: #1f2f30;
      color: white;
      padding: 2rem 1rem;
      margin-top: auto;
    }

    footer a {
      color: white;
    }

    .btn-link.nav-link {
      border: none;
      background: none;
      font-weight: 500;
      color: #1f2f30;
      cursor: pointer;
      padding: 0;
    }

    .btn-link.nav-link:hover {
      text-decoration: underline;
    }

    .container {
      margin-bottom: 3rem;
      flex: 1;
    }

    .policy-section {
      background-color: #f8f9fa;
      padding: 2rem;
      margin: 2rem auto;
      max-width: 1200px;
      width: 90%;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .contact-section {
      background-color: #f8f9fa;
      padding: 2rem;
      margin: 2rem auto;
      max-width: 1200px;
      width: 90%;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
      .container {
        margin-bottom: 2rem;
      }
      
      .hero {
        margin: 1.5rem auto;
        padding: 2rem 1rem;
      }
      
      .section-title {
        margin: 2rem 0 1.5rem;
      }
      
      .info-section {
        grid-template-columns: 1fr;
        gap: 1rem;
        margin: 1.5rem auto;
      }
      
      .card-info {
        padding: 1.5rem;
        margin-bottom: 1rem;
      }
      
      footer {
        margin-top: 2rem;
        padding: 1.5rem 1rem;
      }
      
      .policy-section,
      .contact-section {
        padding: 1.5rem;
        margin: 1.5rem auto;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg">
    <div class="container justify-content-between align-items-center">
      <img src="img/LogoConDerecho.jpg" alt="Logo" style="height: 100px;">

      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-link nav-link">Quienes somos</button>
        <button class="btn btn-link nav-link">Opinión / Sugerencias</button>
        <button class="btn btn-link nav-link">Ayuda</button>
        <button class="btn btn-custom" id="btn-registro">Registrate</button>
        <button class="btn btn-custom" id="btn-login">Iniciar sesión</button>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="hero">
      <div class="row align-items-center">
        <div class="col-md-4 text-center">
         <img src="Img/Negocios.jpg"  alt="Negocios"  style="height: 315px;">
        </div>
        <div class="col-md-8">
          <h1 class="fw-bold mb-3">FINECONIA</h1>
          <p>
            Fineconia es un espacio pensado para que las familias aprendan juntas sobre finanzas y economía. Con un enfoque simple y accesible, promueve hábitos responsables como el ahorro, la planificación y el consumo consciente, ayudando a construir un futuro financiero más estable.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="section-title">¿Quienes somos?</div>

    <div class="info-section">
      <div class="card-info">
        <i class="bi bi-people"></i>
        <h5>Nuestra Historia</h5>
        <p>Fineconia es una aplicación pensada para ayudar a las familias a aprender sobre finanzas y economía de forma sencilla, cercana y útil.</p>
      </div>
      <div class="card-info">
        <i class="bi bi-eye"></i>
        <h5>Visión</h5>
        <p>Ser la plataforma favorita de las familias para alcanzar estabilidad y crecimiento económico, fomentando hábitos financieros saludables desde la infancia hasta la adultez.</p>
      </div>
      <div class="card-info">
        <i class="bi bi-people-fill"></i>
        <h5>Nuestro Equipo</h5>
        <p>Somos un equipo comprometido con la educación financiera familiar. Nos une la pasión por enseñar, diseñar y crear soluciones digitales que realmente aporten valor a quienes más lo necesitan: las familias.</p>
      </div>
      <div class="card-info">
        <i class="bi bi-bullseye"></i>
        <h5>Misión</h5>
        <p>Ofrecer educación financiera práctica, clara y accesible, que permita a las familias organizar sus ingresos, ahorrar con propósito y tomar decisiones económicas conscientes y sostenibles.</p>
      </div> 
    </div>
  </div>

  <!-- Contact Section -->
  <div class="contact-section">
    <div class="row">
      <div class="col-12 text-center">
        <h5>Contactos y Redes Sociales</h5>
        <p><i class="bi bi-envelope"></i> fineconia@gmail.com</p>
        <p><i class="bi bi-telephone"></i> +503 1234-5678</p>
        <p><i class="bi bi-geo-alt"></i> Usulután, El Salvador</p>
      </div>
    </div>
  </div>

  <!-- New Policy Section -->
  <div class="policy-section">
    <div class="row">
      <div class="col-12">
        <h5 class="text-center">Política y Privacidad</h5>
        <p class="text-center">Información sobre nuestras políticas de privacidad y términos de servicio.</p>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <!-- Footer content can be added here if needed -->
    </div>
  </footer>

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