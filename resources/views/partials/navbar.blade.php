<nav class="navbar navbar-expand-lg navbar-light bg-light zindexNav">
  <div class="container-fluid">
    <!-- Logo o título de la aplicación -->
    <a class="navbar-brand" href="{{ route('dashboard') }}">Mi Aplicación</a>

    <!-- Botón para colapsar la navbar en pantallas pequeñas -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido de la navbar -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Opciones de navegación -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Puedes agregar enlaces aquí si lo deseas -->
      </ul>

      <!-- Sección de usuario -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="me-2">{{ Auth::user()->name }}</span>
            <img src="{{ asset('assets/img/avatars/abstract-user-flat-4.png') }}" alt="Avatar" class="rounded-circle" width="30" height="30">
          </a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <!-- Opción para cerrar sesión -->
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Cerrar sesión
            </a>
            <!-- Formulario oculto para logout -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>