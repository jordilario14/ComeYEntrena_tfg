@extends('layouts.app')

@section('content')
<div class="part-1-body flex-centered">
    <div class="card-profile width-100">
        <div class="card-header-profile width-100 text-left dflex padded-3-rem-et">
            <img class="trainer-img-profile" src="{{ asset('img/trainer.png') }}" alt="">
        </div>

        <div class="width-100 text-left dflex padded-3-rem">
            <div class="text-align-centered-phone">
                <h1 class="title-cye align-centered-phone" >
                    {{ Auth::user()->name . " " . Auth::user()->surname }}
                </h1>
            </div>
        </div>

        <div>
            <span class="text-cye-default current mgr-1 link-profile" target="#aboutMe">Acerca de mi</span>

            <span class="text-cye-default mgr-1 mgl-1 link-profile" target="#security">Seguridad</span>

            <span class="text-cye-default mgl-1 link-profile" target="#myData">Mis datos</span>
        </div>
        <hr class="hr-separador">

        <div class="width-100 text-left padded-3-rem" id="aboutMe">
            <div class="text-align-centered">
                <h1 class="title-cye-secondary align-centered-phone" >
                    Acerca de mi
                </h1>
                <label for="about-me-ta" class="input-label">Sobre mi</label>
                <textarea class="input-ta margin-bottom-2" id="about-me-ta" cols="30" rows="10">{{ Auth::user()->about_me }}</textarea>


                <label for="my-interests-ta" class="input-label">Mis intereses</label>
                <textarea class="input-ta margin-bottom-2"  id="my-interests-ta"  cols="30" rows="10">{{ Auth::user()->my_interests }}</textarea>

                <div class="flex-custom">
                    <div class="button-table"  onclick="location.href='{{ route('home') }}'">
                        <img class="icon-button-table"  src="{{ asset('img/icons/back.png') }}" alt="">
                        <span class="text-cye-default link-return">
                            Inicio
                        </span>
                    </div>
                    <div class="button-table about-me-btn" >
                        <span class="text-cye-default link-return save-about-me">
                            Guardar
                        </span>
                        <img class="icon-button-table"  src="{{ asset('img/icons/save.png') }}" alt="">
                    </div>
                </div>
            </div>

        </div>

        <div class="width-100 text-left padded-3-rem link-profile-hidden" id="security">
            <div class="text-align-centered">
                <h1 class="title-cye-secondary align-centered-phone margin-0-impt" >
                    Seguridad
                </h1>
                <small class="text-cye-default wrap-text">
                    Si quieres modificar únicamente un dato, deja el que no quieras cambiar vacío (Sin espacios ni ningún caracter)
                </small>


                <label for="email" class="input-label margin-top-2-rem">E-mail</label>
                <input disabled type="text" name="email" id="email" value="{{ Auth::user()->email }}" class="input margin-0-impt">
                <label for="new-email" class="input-label">Nuevo E-mail</label>
                <input type="text" name="new-email" id="new-email" class="input margin-0-impt">
                <label for="new-email_confirmation" class="input-label">Confirmación del nuevo E-mail</label>
                <input type="text" name="new-email_confirmation" id="new-email_confirmation" class="input ">

                <label for="password" class="input-label">Contraseña</label>
                <input disabled type="password" name="password" id="password" value="********" class="input margin-0-impt">
                <label for="new-password" class="input-label">Nueva contraseña</label>
                <input type="password" name="new-password" id="new-password" class="input margin-0-impt">
                <label for="new-password_confirmation" class="input-label">Confirmación de la nueva contraseña</label>
                <input type="password" name="new-password_confirmation" id="new-password_confirmation" class="input margin-bottom-2">

                <div class="flex-custom">
                    <div class="button-table"  onclick="location.href='{{ route('home') }}'">
                        <img class="icon-button-table"  src="{{ asset('img/icons/back.png') }}" alt="">
                        <span class="text-cye-default link-return">
                            Inicio
                        </span>
                    </div>
                    <div class="button-table" >
                        <span class="text-cye-default link-return save-security">
                            Guardar
                        </span>
                        <img class="icon-button-table"  src="{{ asset('img/icons/save.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="width-100 text-left padded-3-rem link-profile-hidden" id="myData">
            <div class="text-align-centered">
                <h1 class="title-cye-secondary align-centered-phone margin-0-impt" >
                    Mis datos
                </h1>

                <label for="tel" class="input-label margin-top-2-rem">Teléfono</label>
                <input type="number" name="tel" id="tel" value="{{ Auth::user()->tf_number }}" class="input margin-0-impt">

                <label for="weight" class="input-label margin-top-2-rem">Peso (kg.)</label>
                <input type="number" name="weight" id="weight" value="{{ Auth::user()->weight }}" class="input margin-0-impt">

                <label for="height" class="input-label margin-top-2-rem">Altura (cm.)</label>
                <input type="number" name="height" id="height" value="{{ Auth::user()->height }}" class="input margin-bottom-2">

                <div class="flex-custom">
                    <div class="button-table"  onclick="location.href='{{ route('home') }}'">
                        <img class="icon-button-table"  src="{{ asset('img/icons/back.png') }}" alt="">
                        <span class="text-cye-default link-return">
                            Inicio
                        </span>
                    </div>
                    <div class="button-table my-data-btn" >
                        <span class="text-cye-default link-return save-my-data">
                            Guardar
                        </span>
                        <img class="icon-button-table"  src="{{ asset('img/icons/save.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>



    </div>

</div>
@endsection
