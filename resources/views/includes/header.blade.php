{{-- <nav class="header-cye">
  <div class="container-fluid margin-left-5 margin-right-5">
    <div>
      <span href="{{ route('index') }}" class="title-main">
          Come y Entrena
      </span>
   
    </div>
  </div>


  <div class="separated-bt">
    <div>
      <span class="logIn pr2">
        Inicio
      </span>

      <span class="logIn plr2">
        Sobre nosotros
      </span>

      <span class="logIn pl2">
        Dónde estamos
      </span>
    </div>
    <div>
      @guest
        <span class="logIn" id="login-link">
          Iniciar sesión
        </span>
      @endguest
    </div>
  </div>
  <hr class="hr-separador">

</nav>

 --}}

 <nav class="navbar-expand-lg navbar-light header-cye">
  <div class="container-fluid margin-left-5 margin-right-5 separated-flex">

    <div>
      <span href="{{ route('index') }}" class="title-main">
        Come y Entrena
      </span>
    </div>

    <div>
      <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

 </div>
 <div class="separated-bt collapse navbar-collapse " id="navbarNavDropdown">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0 login-ul">
    <li class="nav-item pr2">
      <span class="logIn">
        Inicio
      </span>
    </li>
    <li class="nav-item plr2">
      <span class="logIn">
        Sobre nosotros
      </span>
    </li>
    <li class="nav-item pl2">
      <span class="logIn ">
        Dónde estamos
      </span>
    </li>
  </ul>
  @guest
  <span class="logIn" id="login-link">
    Iniciar sesión
  </span>
@endguest
</div>
{{--  <div class="separated-bt collapse navbar-collapse" id="navbarNavDropdown">
  <div>
    <ul class="navbar-nav login-ul">
      <li class="nav-item pr2">
        <span class="logIn">
          Inicio
        </span>
      </li>
      <li class="nav-item plr2">
        <span class="logIn">
          Sobre nosotros
        </span>
      </li>
      <li class="nav-item pl2">
        <span class="logIn ">
          Dónde estamos
        </span>
      </li>

    </ul>

    @guest
      <span class="logIn navbar-text" id="login-link">
        Iniciar sesión
      </span>
    @endguest
  </div>
</div> --}}
<hr class="hr-separador">

</nav>


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
        <small class="small-password">
            ¿Has olvidado tu contraseña?
        </small>

      </div>

      <div class="modal-footer">
        <div class="w-100 flex-centered">
            <button type="button" class="button-modal-accept">Acceder</button>
        </div>
        <div class="w-100 flex-centered">
            <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
        </div>
        
      </div>
    </div>
  </div>
</div>