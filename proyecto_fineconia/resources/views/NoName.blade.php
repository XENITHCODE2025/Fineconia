<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Política y Privacidad - Fineconia</title>

  <!-- Bootstrap y iconos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />

  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
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

    .container-policy {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 4rem 1rem;
    }

    .policy-title {
      font-size: 2rem;
      font-weight: bold;
      color: #1f2f30;
    }

    /* Estilo para bajar solo los elementos de navegación */
    .nav-elements-container {
      align-items: flex-end !important;
      padding-bottom: 1.9rem; /* Ajusta este valor según cuánto quieras bajarlos */
    }

    /* Estilo para el enlace Cerrar */
    .btn-cerrar {
      color: #1f2f30;
      font-weight: 500;
      text-decoration: none;
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
    }

    .btn-cerrar:hover {
      text-decoration: underline;
      color: #31565e;
    }

    @media (max-width: 768px) {
      .navbar .nav-link {
        margin: 0 0.5rem;
      }

      .btn-custom {
        padding: 0.3rem 0.8rem;
        font-size: 0.9rem;
      }

      .policy-title {
        font-size: 1.6rem;
        text-align: center;
      }
      
      .nav-elements-container {
        padding-bottom: 0.5rem;
      }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <div class="d-flex justify-content-between w-100">
        <!-- LOGO - se mantiene en su posición original -->
        <div class="logo-container" style="max-width: 200px; width: 100%;">
          <img src="{{ asset('img/LogoConDerecho.jpg') }}" alt="Logo" style="height: 100px; width: 100%; object-fit: contain;">
        </div>

        <!-- Contenedor de elementos de navegación - se mueve hacia abajo -->
        <div class="d-flex align-items-center gap-3 nav-elements-container">
          <button class="btn btn-link nav-link btn-cerrar" id="btn-cerrar">Cerrar</button>
        </div>
      </div>
    </div>
  </nav>

  <!-- CONTENIDO CENTRAL -->
  <div class="container-policy">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.getElementById("btn-cerrar").addEventListener("click", function() {
      // Aquí puedes agregar la funcionalidad para cerrar
      // Por ejemplo: window.close(); o redireccionar a otra página
      window.history.back(); // Regresa a la página anterior
    }); 
  </script>
</body>
</html>