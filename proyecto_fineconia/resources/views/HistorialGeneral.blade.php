<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial General - Fineconia</title>

  <!-- ICONOS BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Tipografías -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@400;700&family=Roboto+Slab:wght@400;600&display=swap" rel="stylesheet">

  @vite('resources/css/HistorialGeneral.css')
</head>

<body>

<!-- NAV -->
<nav class="navbar">
  <div class="logo-container">
    <img src="{{ asset('img/LogoCompleto.jpg') }}" alt="Logo">
  </div>

  <div class="user-section header-user">
    <a href="{{ route('fineconia.home') }}" class="nav-link">Home</a>
  </div>
</nav>

<!-- CONTENIDO -->
<div class="contenido">

  <div class="header-line">
    <h2 class="titulo">Historial General</h2>
    <button class="btn-exportar">Exportar</button>
  </div>

  <table>
    <thead>
      <tr>
        <th>FECHA</th>
        <th>HORA</th>
        <th>ACCIÓN</th>
        <th>DETALLE</th>
        <th>USUARIO</th>
      </tr>
    </thead>

    <tbody>
      <tr><td>2025-01-10</td><td>08:15</td><td>Inicio de sesión</td><td>Usuario ingresó al sistema</td><td>Karen</td></tr>
      <tr><td>2025-01-10</td><td>11:01</td><td>Añadió ingreso</td><td>Se agregó un ingreso de $150</td><td>Karen</td></tr>
      <tr><td>2025-01-11</td><td>10:40</td><td>Añadió gasto</td><td>Se registró un gasto de $25 en Comida</td><td>Karen</td></tr>
      <tr><td>2025-01-12</td><td>09:30</td><td>Eliminó ingreso</td><td>Se eliminó un ingreso de $250</td><td>Karen</td></tr>
      <tr><td>2025-01-12</td><td>09:42</td><td>Eliminó gasto</td><td>Se eliminó un gasto de $35 de Comida</td><td>Karen</td></tr>
      <tr><td>2025-01-13</td><td>14:07</td><td>Actualizó perfil</td><td>Cambió foto de perfil</td><td>Karen</td></tr>
      <tr><td>2025-01-13</td><td>16:27</td><td>Actualizó perfil</td><td>Cambió nombre de usuario</td><td>Karen</td></tr>
      <tr><td>2025-01-14</td><td>11:20</td><td>Me gusta en economía</td><td>Marcó como me gusta la noticia económica ‘Inflación familiar baja’</td><td>Karen</td></tr>
      <tr><td>2025-01-14</td><td>11:32</td><td>Comentario en economía</td><td>Comentó: ‘Muy útil para el ahorro’</td><td>Karen</td></tr>
      <tr><td>2025-01-15</td><td>15:06</td><td>Añadió favorito</td><td>Guardó la guía ‘Cómo planificar un presupuesto familiar’</td><td>Karen</td></tr>
      <tr><td>2025-01-16</td><td>17:30</td><td>Exportó reporte</td><td>Exportó documento de reporte detallado de gastos e ingresos</td><td>Karen</td></tr>
      <tr><td>2025-01-16</td><td>18:00</td><td>Exportó historial</td><td>Exportó el documento del historial general de actividades</td><td>Karen</td></tr>
    </tbody>
  </table>

</div>

</body>
</html>