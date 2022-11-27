<nav class="navbar navbar-expand-lg navbar-light golmar-header">
    <div class="container-fluid margin-left-5 margin-right-5">
        <div>
            <span href="{{ route('index') }}" class="title-main">
                Come y Entrena
            </span>
        </div>
        <div>
            @guest
                <span class="logIn" id="login-link">
                    Iniciar sesión
                </span>
            @endguest

            @auth
                DD   
            @endauth
        </div>
    </div>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<hr class="hr-separador">