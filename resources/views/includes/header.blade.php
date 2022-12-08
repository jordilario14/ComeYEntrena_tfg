<nav class="navbar-expand-lg navbar-light header-cye">
    <div class="zero-padding container-fluid margin-right-5 separated-flex">
        <div>
            <span onclick="location.href='{{ route('index') }}'" class="title-main">
                Come y Entrena
            </span>
        </div>
        <div>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    <div class="separated-bt collapse navbar-collapse " id="navbarNavDropdown">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 login-ul">
            @if (Request::is('/'))
                <li class="nav-item pr2">
                    <span class="logIn text-cye-default btn-header" target="#main-title" id="home-header">
                        Inicio
                    </span>
                </li>
                <li class="nav-item plr2">
                    <span class="logIn text-cye-default btn-header" target="#about-title" id="about-header">
                        Sobre nosotros
                    </span>
                </li>
                <li class="nav-item pl2">
                    <span class="logIn text-cye-default btn-header" target="#location-title" id="location-header">
                        Dónde estamos
                    </span>
                </li>
            @endif

        </ul>
        @guest
            <span class="logIn text-cye-default" id="login-link">
                Iniciar sesión
            </span>
        @endguest
        @auth
            <ul class="navbar-nav  mb-2 mb-lg-0 login-ul">
                <li class="nav-item pr2">
                    <a class="logIn text-cye-default wrap-text" href={{ route('profile') }}>
                        {{ Auth::user()->name." ".Auth::user()->surname }}
                    </a>
                </li>
                <li class="nav-item pl2">
                    <a class="logIn text-cye-default" href={{ route('auth.logout') }}>
                        Cerrar sesión
                    </a>
                </li>
            </ul>
        @endauth
    </div>
    <hr class="hr-separador">
</nav>

@guest
<div class="modal" tabindex="-1" id="login-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Iniciar sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <label for="email" class="input-label">E-mail</label>
                <input type="text" name="email" id="email" class="input">

                <label for="password" class="input-label">Contraseña</label>
                <input type="password" name="password" id="password" class="input margin-0-impt">

                <br>
                <small class="small-password" onclick="location.href='{{ route('forgot-password') }}'">
                    ¿Has olvidado tu contraseña?
                </small>

            </div>

            <div class="modal-footer">
                <div class="w-100 flex-centered">
                    <button type="button" class="button-modal-accept" id="log-in-button-action">Acceder</button>
                </div>
                <div class="w-100 flex-centered">
                    <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </div>
            <div class="centered-middle loading-login-hidden" id="loading-login-hidden">
                <div class="loader-line"></div>
            </div>

        </div>
    </div>
</div>
@endguest
