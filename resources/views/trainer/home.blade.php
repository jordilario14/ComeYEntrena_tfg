@extends('layouts.app')

@section('content')
<div class="part-1-body">
    <div class="text-align-centered-phone">
        <h1 class="title-cye align-centered-phone" >
            Panel de control
        </h1>
    </div>

    <div class="row-custom mb-4-phone">
        <div class="column-img-2-end padding-right-20px mb-4-phone">
            <div class="button-img-home-img-1 centered-middle" onclick="location.href='{{ route('exercises') }}'">
                <h1 class="title-home-white">
                    Ejercicios
                 </h1>
                {{-- <img class="img-col-2 " src="{{ asset('img/discos.jpg') }}" alt=""> --}}
            </div>

        </div>

        <div class="column-img-2-start padding-left-20px mb-4-phone">
            <div class="button-img-home-img-2 centered-middle">
                <h1 class="title-home-white">
                   Alimentos
                </h1>
                {{-- <img class="img-col-2" src="{{ asset('img/nutricion.jpg') }}" alt=""> --}}
            </div>

        </div>

    </div>
    <div class="row-custom pb-5">
        <div class="column-center-img-1 ">
            <div class="button-img-home-img-3 centered-middle">
                <h1 class="title-home-white">
                    Clientes
                 </h1>
                {{-- <img class="img-col-1" src="{{ asset('img/gimnasio.jpg') }}" alt=""> --}}
            </div>
        </div>
    </div>
</div>

@endsection
