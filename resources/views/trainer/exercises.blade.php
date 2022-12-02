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
                <th scope="col">Grupo muscular</th>
                <th scope="col" class="text-right">  
                    <div class="button-table">
                        <img class="icon-button-table" src="{{ asset('img/icons/add.png') }}" alt="">
                    </div>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
        <table class="table-design">
            <thead>
                    <td class="padded-1-rem">
                        #
                    </td>
                    <td class="padded-1-rem">
                        Nombre
                    </td>
                    <td class="padded-1-rem">
                        Grupo muscular
                    </td>
                    <td class="padded-1-rem text-right">
                        <div class="button-table">
                            <img class="icon-button-table" src="{{ asset('img/icons/add.png') }}" alt="">
                        </div>
                    </td>
            </thead>
        </table>
    </div>
</div>

@endsection
