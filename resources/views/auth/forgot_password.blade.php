
@extends('layouts.app')

@section('content')
<div class="part-1-body">
    <div class="text-align-centered-phone">
        <h1 class="title-cye align-centered-phone" >
            Recuperar contraseña
        </h1>
    </div>

    <div class="text-align-center-no-flex">
        <label for="email_fg_pw" class="input-label">E-mail</label>
        <input type="email" name="email_fg_pw" id="email_fg_pw" class="input">
    </div>

    <div class="flex-custom">
        <div class="button-table"  onclick="location.href='{{ route('index') }}'">
            <img class="icon-button-table"  src="{{ asset('img/icons/back.png') }}" alt="">
            <span class="text-cye-default link-return">
                Inicio
            </span>
        </div>
        <div class="button-table send-forgot-password" >
            <span class="text-cye-default link-return save-about-me">
                Enviar
            </span>
            <img class="icon-button-table"  src="{{ asset('img/icons/save.png') }}" alt="">
        </div>
    </div>
</div>

@endsection