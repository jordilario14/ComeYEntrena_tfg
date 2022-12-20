@extends('layouts.app')

@section('content')
<div class="part-1-body">
    <div class="mb-4-phone">
        <h1 class="title-cye align-centered-phone" >
            Tu entrenador:
        </h1>

        <div class="flex-start ">

                <div>
                    <img class="img-card-home-ix" src="{{asset('img/trainer.png')}}" alt="">
                </div>
                <div>
                    <h1 class="title-cye-card" >
                        {{ $trainer->name." ".$trainer->surname }}
                    </h1>

                    <p class="text-cye-default margin-bottom-2 paragraph-limit text-left">
                        {{ $trainer->about_me }}
                    </p>

                </div>
        </div>

        <div>
            <span class="text-cye-default current mgr-1 link-client" target="#cpanel">Panel de control</span>

            <span class="text-cye-default mgr-1 mgl-1 link-client" target="#support">Soporte</span>
        </div>

        <hr class="hr-separador">

    </div>
    <div id="cpanel" >
        <div class="row-custom pb-5">
            <div class="column-center-img-1 ">
                <div class="button-img-home-img-4 centered-middle text-align-centered-phone" onclick="location.href='{{ route('pn-client') }}'">
                    <h1 class="title-home-white ">
                        Plan nutricional
                     </h1>
                    {{-- <img class="img-col-1" src="{{ asset('img/gimnasio.jpg') }}" alt=""> --}}
                </div>
            </div>
        </div>

        <div class="row-custom pb-5">
            <div class="column-center-img-1 ">
                <div class="button-img-home-img-3 centered-middle text-align-centered-phone" onclick="location.href='{{ route('pe-client') }}'">
                    <h1 class="title-home-white">
                        Plan de entrenamiento
                     </h1>
                    {{-- <img class="img-col-1" src="{{ asset('img/gimnasio.jpg') }}" alt=""> --}}
                </div>
            </div>
        </div>
    </div>

    <div id="support" class="link-profile-hidden">
        <div class="width-100 text-center dflex">
            <div class="width-100 text-align-centered">
                <h1 class="title-cye align-centered-phone" >
                    ¿Tienes alguna duda?
                </h1>
                <p class="wrap-text text-cye-default">
                    En Come Y Entrena nos esforzamos para que el sitio web sea totalmente transparente y sencillo de utilizar. Haciendo accesible el plan nutricional y de entrenamiento directamente desde la pantalla de inicio. Pero siempre puedes tener alguna que otra duda.
                </p>
            </div>
        </div>

        <div class="width-100 text-center dflex">
            <div class=" width-100 text-align-centered">
                <h1 class="title-cye align-centered-phone" >
                    Contacta con tu preparador
                </h1>
                <p class="wrap-text text-cye-default">
                    Si tienes cualquier pregunta, contacta con tu preparador mediante el teléfono o el correo electrónico a continuación:
                </p>

            </div>

        </div>


        <div class="width-100 text-center flex-sp-bt-ph">
            <div class="text-cye-default">
                <img class="img-spp" src="{{ asset('img/icons/ws.png') }}" alt="">
                {{ $trainer->tf_number }}
            </div>
            <div class="text-cye-default">
                <img class="img-spp" src="{{ asset('img/icons/Mail.png') }}" alt="">
                {{ $trainer->email }}
            </div>
        </div>

    </div>


</div>

@endsection
