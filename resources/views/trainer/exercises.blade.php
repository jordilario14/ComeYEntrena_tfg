@extends('layouts.app')

@section('content')
<div class="part-1-body">
    <div class="text-align-centered-phone">
        <h1 class="title-cye align-centered-phone" >
            Ejercicios
        </h1>
    </div>

    <div class="text-align-centered-phone">
        <input type="search" placeholder="Busca un ejercicio" class="Buscador" />
    </div>

    <div class="class-table-div text-left">

        <table class="table table-design">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col" class="hide-on-small-md-table">Grupo muscular</th>
                <th scope="col" class="text-right">  
                    <div class="button-table">
                        <img class="icon-button-table" src="{{ asset('img/icons/add.png') }}" alt="">
                    </div>
                </th>
              </tr>
            </thead>
            <tbody>
                @forelse ($ejercicios as $key=>$ejercicio)
                    <tr>
                        <th scope="row"> {{$ejercicio->id}} </th>
                        <td>{{$ejercicio->name}}</td>
                        <td class="hide-on-small-md-table">{{$ejercicio->muscle_group}}</td>
                        <td class="text-right">
                            <div class="button-table">
                                <img class="icon-button-table" src="{{ asset('img/icons/view.png') }}" alt="">
                                <img class="icon-button-table" src="{{ asset('img/icons/edit.png') }}" alt="">
                                <img class="icon-button-table" src="{{ asset('img/icons/remove.png') }}" alt="">

                            </div>
                        </td>
                    </tr>
                @empty
                    <td>No hay ejercicios en la base de datos.</td>
                @endforelse

            </tbody>
          </table>
    </div>
</div>

@endsection