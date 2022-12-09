
@extends('layouts.app')

@section('content')
<div class="part-1-body">
    <div class="text-align-centered-phone">
        <h1 class="title-cye align-centered-phone" >
            Formulario de recuperación de contraseña
        </h1>
    </div>

    <div class="text-align-center-no-flex">
        <label for="email_rec_pw" class="input-label">E-mail</label>
        <input type="email" name="email_rec_pw" id="email_rec_pw" class="input">
    </div>

    <div class="text-align-center-no-flex">
        <label for="new_password" class="input-label">Nueva contraseña</label>
        <input type="password" name="new_password" id="new_password" class="input">
    </div>

    <div class="text-align-center-no-flex">
        <label for="new_password_confirmation" class="input-label">Confirmación de la nueva contraseña</label>
        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="input">
    </div>

    <input type="hidden" value="{{$hash}}" id="hash_pw">

    <div class="flex-custom">
        <div class="button-table"  onclick="location.href='{{ route('index') }}'">
            <img class="icon-button-table"  src="{{ asset('img/icons/back.png') }}" alt="">
            <span class="text-cye-default link-return">
                Inicio
            </span>
        </div>
        <div class="button-table change-password" >
            <span class="text-cye-default link-return save-about-me">
                Enviar
            </span>
            <img class="icon-button-table"  src="{{ asset('img/icons/save.png') }}" alt="">
        </div>
    </div>
</div>

@endsection