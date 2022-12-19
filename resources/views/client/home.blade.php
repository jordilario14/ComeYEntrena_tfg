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
                    <h1 class="title-cye-card">
                        Jordi Segura Lario
                    </h1>

                    <p class="text-cye-default margin-bottom-2 paragraph-limit text-left">
                        Preparador personal con 4 años de experiencia. Certificado por NCSA.
                    </p>

                </div>
        </div>
        <hr class="hr-separador">

    </div>
    <div class="row-custom pb-5">
        <div class="column-center-img-1 ">
            <div class="button-img-home-img-4 centered-middle text-align-centered-phone" onclick="location.href='{{ route('pn-client') }}'">
                <h1 class="title-home-white">
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

@endsection
