@extends('layouts.app')

@section('content')

<div class="part-1-body">

    <div class="flex-custom">
        <div>
            <h1 class="title-cye-1st" id="main-title">
                Una buena preparación <br> requiere buena nutrición.
            </h1>

            <p class="text-cye-1st margin-bottom-2 paragraph-limit justified-left">
                En Come y Entrena creemos que la base de un buen entreno
                requiere prepararse correctamente y seguir una dieta
                personalizada. Gracias a nuestro servicio podrás acceder
                fácilmente al plan de entrenamiento y nutricional asignado
                por tu nutricionista.
            </p>

            <div class="w-100 align-centered-phone">
                <button type="button" class="button-home" id="login-link-body">Comenzar rutina</button>
            </div>

        </div>
        <div class="hide-on-small-md">
            <img class="home-img-nut" src="{{ asset('img/inicio_img.png') }}" alt="">
        </div>
    </div>


    <div class="w-100 flex-centered" id="about-title">
        <div class="vl"></div>
    </div>

    <h1 class="title-cye flex-centered" >
        Y nosotros, ¿Quiénes somos?
    </h1>
    <div class="flex-centered">
        <p class="text-cye-default margin-bottom-2 paragraph-limit text-center">
            Come y Entrena nace en el 2022 con el objetivo de facilitar a los clientes un entorno amigable e intuitivo en el que pueden acceder a su preparación, métricas, etc.
            <br>
            Además, proporciona un espacio al cliente para tener contacto directo con el preparador.
        </p>
    </div>

    <div class="w-100 flex-centered">
        <div class="vl"></div>
    </div>
</div>

<div class="part-2-body">
    <div class="flex-centered">
        <h1 class="title-cye-white">
            ¿A qué nos dedicamos?
        </h1>
    </div>


<div class="flex-sp-bt">
        <div >
            <div class="flexbox-column">
                <img class="img_home" src="{{ asset('img/icons/tenedor.png') }}" alt="">
            </div>
            <span class="text-home-img">
                Come
            </span>
        </div>
        <div>
            <div class="flexbox-column">
                <img class="img_home" src="{{ asset('img/icons/pesa.png') }}" alt="">
            </div>
            <span class="text-home-img">
                Entrena
            </span>
        </div>
        <div>
            <div class="flexbox-column">
                <img class="img_home" src="{{ asset('img/icons/sueño.png') }}" alt="">
            </div>
            <span class="text-home-img">
                Descansa
            </span>
        </div>
    </div>
    <div class="w-100 flex-centered pt-3">
        <div class="vl-white"></div>
    </div>
    <div class="flex-centered">
        <h1 class="title-cye-white">
            Conoce a nuestros profesionales
        </h1>
    </div>
</div>

<div class="part-3-body">
    <div class="flex-centered ">
        <div class="card-custom-home flex-centered ">
            <div>
                <img class="img-card-home" src="{{asset('img/trainer.png')}}" alt="">
            </div>
            <div>
                <h1 class="title-cye-card">
                    Jordi Segura Lario
                </h1>

                <p class="text-cye-default margin-bottom-2 paragraph-limit text-left">
                    Preparador personal con 4 años de experiencia. Certificado por NCSA.
                </p>

            </div>
        </div>
    </div>

    <div class="w-100 flex-centered">
        <div class="vl"></div>
    </div>

    <div class="mt-6">
        <h1 class="title-cye flex-centered" id="location-title">
            ¿Dónde estamos?
        </h1>

        <div class="flex-centered padded-5-rem">
            <p class="text-cye-default margin-bottom-2 paragraph-limit text-center">
                Actualmente no disponemos de sedes físicas, cualquier duda o consulta será respondida a través de nuestras redes i nuestro correo electrónico.
            </p>
        </div>
    </div>


</div>

@endsection
