{{-- resources/views/partials/header-user.blade.php --}}
<style>
  .header-user {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
  }
  .header-user .user-name-text {
    color: #fff;
    font-weight: bold;
    font-size: 0.75rem;
    margin-right: .1rem;
  }
  .header-user .user-icon i {
    color: #fff;
    font-size: 1.5rem;
  }
</style>

<div class="header-user">
  @auth
    <span class="user-name-text">
      {{ Auth::user()->name }}
    </span>
  @endauth

  <div class="user-icon">
    <i class="bi bi-person-circle"></i>
  </div>
</div>
