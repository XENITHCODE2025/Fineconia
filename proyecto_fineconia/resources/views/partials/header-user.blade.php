
{{-- Bloque: Icono + Nombre de usuario --}}
@auth
    <span style="font-weight:bold; font-size:0.75rem; margin-right:.1rem">
        {{ Auth::user()->name }}
    </span>
@endauth

<div class="user-icon">
    <i class="bi bi-person-circle"></i>
</div>
