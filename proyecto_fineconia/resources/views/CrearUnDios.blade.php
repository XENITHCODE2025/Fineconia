<!DOCTYPE html>    
<html lang="es">    
<head>    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Crear nuevo usuario</title>    

    <!-- Íconos Bootstrap -->    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">    

    @vite('resources/css/CrearUnDios.css')
</head>    

<body>    

<!-- NAVBAR NUEVA -->    
<nav class="navbar">    
  <div class="logo-container" style="max-width: 200px; width: 100%;">    
    <img src="img/LogoCompleto.jpg" alt="Logo">    
  </div>    
  <div class="user-section header-user">    
    <a href="{{ route('fineconia.home') }}" class="nav-link">Home</a>    
  </div>    
</nav>    


<div class="page-container">    

    <div class="title-container">    
        <h1 class="page-title" style="color: black; margin-left: 30px;">Crear nuevo usuario administrativo</h1>    
        <p class="page-description">Complete la información necesaria para registrar y dar permisos al usuario.</p>    
    </div>    

    <div class="flex-wrapper">    

        <div class="form-container">    
            <h3 class="section-title">Datos Personales</h3>    

            <div class="field-group">    
                <div class="field">    
                    <label for="nombre">Nombre</label>    
                    <input type="text" id="nombre">    
                </div>    

                <div class="field">    
                    <label for="apellido">Apellido</label>    
                    <input type="text" id="apellido">    
                </div>    
            </div>    

            <div class="field">    
                <label for="email">Correo Electrónico</label>    
                <input type="email" id="email">    
            </div>    

            <h3 class="section-title">Credenciales de acceso</h3>    

            <div class="field">    
                <label for="password">Contraseña</label>    
                <input type="password" id="password">    
                <small style="color: #160505; font-size: 12px;">Usa al menos 8 caracteres, con una mayúscula, un número y un símbolo.</small>    
            </div>    

            <div class="field">    
                <label for="confirm-password">Confirmar contraseña</label>    
                <input type="password" id="confirm-password">    
            </div>    

            <div style="margin-top: 15px;">    
                <span>Rol:</span>    
                <div class="role-display"><strong>Administrador</strong></div>    
            </div>    

            <h3 class="section-title">Permisos administrativos</h3>    

            <div class="checkbox-group">    
                <input type="checkbox" id="permiso1">    
                <label for="permiso1">Administrar Guías de Educación financiera</label>    
            </div>    
            <div class="checkbox-group">    
                <input type="checkbox" id="permiso2">    
                <label for="permiso2">Administrar Consejos de ahorro</label>    
            </div>    
            <div class="checkbox-group">    
                <input type="checkbox" id="permiso3">    
                <label for="permiso3">Administrar Noticias</label>    
            </div>    

            <div class="btn-container">    
                <button class="btn-cancelar">Cancelar</button>    
                <button class="btn-guardar">Guardar</button>    
            </div>    
        </div>    


        <div class="photo-box">    
            <div>    
                <div class="photo-icon">    
                    <i class="bi bi-person-circle"></i>    
                </div>    
                <button class="btn-upload">Subir Imagen</button>    
            </div>    
        </div>    

    </div>    
</div>    



<script>    
    document.addEventListener('DOMContentLoaded', function() {    
        const guardarBtn = document.querySelector('.btn-guardar');    
        const cancelarBtn = document.querySelector('.btn-cancelar');    
            
        guardarBtn.addEventListener('click', function() {    
            const password = document.getElementById('password').value;    
            const confirmPassword = document.getElementById('confirm-password').value;    
                
            if (password !== confirmPassword) {    
                alert('Las contraseñas no coinciden.');    
                return;    
            }    
                
            alert('Usuario creado exitosamente');    
        });    
            
        cancelarBtn.addEventListener('click', function() {    
            if (confirm('¿Cancelar y borrar todo?')) {    
                document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]').forEach(i => i.value = '');    
                document.querySelectorAll('input[type="checkbox"]').forEach(c => c.checked = false);    
            }    
        });    
    });    
</script>    

</body>    
</html>