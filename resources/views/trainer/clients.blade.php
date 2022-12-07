@extends('layouts.app')

@section('content')
<div class="part-1-body">
    <div class="text-align-centered-phone">
        <h1 class="title-cye align-centered-phone" >
            Clientes
        </h1>
    </div>

    <div class="text-align-centered-phone">
        <input type="search" placeholder="Busca un cliente" class="Buscador searchTerm" />
    </div>

    <div class="class-table-div text-left">

        <table class="table table-design dataToSearch">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col" class="text-right">
                    <div class="button-table">
                        <img class="icon-button-table addClient" src="{{ asset('img/icons/add.png') }}" alt="">
                    </div>
                </th>
              </tr>
            </thead>
            <tbody>
                @forelse ($clients as $key=>$client)
                    <tr>
                        <th class="text-cye-default" scope="row"> {{$client->id}} </th>
                        <td class="text-cye-default wrap-text">{{$client->name." ".$client->surname}}</td>
                        <td class="text-right text-cye-default">
                            <div class="button-table">
                                <img class="icon-button-table nutritionalViewClient" src="{{ asset('img/icons/nutritional.png') }}" alt="">
                                <img class="icon-button-table trainingViewClient" src="{{ asset('img/icons/training.png') }}" alt="">
                                <img class="icon-button-table viewClient" target="{{$key}}" src="{{ asset('img/icons/view.png') }}" alt="">
                                <img class="icon-button-table banUnbanClient" arrTarget="{{ $key }}" target="{{$client->id}}" src="
                                @if ($client->disabled == 0)
                                    {{ asset('img/icons/ban.png') }}
                                @else
                                    {{ asset('img/icons/unban.png') }}
                                @endif


                                " alt="">
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="3" class="text-center text-cye-default">No hay clientes en la base de datos.</td>
                @endforelse

            </tbody>
          </table>

          <div class="button-table" onclick="location.href='{{ route('home') }}'">
            <img class="icon-button-table"  src="{{ asset('img/icons/back.png') }}" alt="">
            <span class="text-cye-default link-return">
                Atrás
            </span>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="add-client-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alta cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="name-add" class="input-label">Nombre</label>
                    <input type="text" name="name-add" id="name-add" class="input">

                    <label for="surname-add" class="input-label">Apellidos</label>
                    <input type="text" name="surname-add" id="surname-add" class="input">

                    <label for="tel-add" class="input-label">Teléfono</label>
                    <input type="number" name="tel-add" id="tel-add" class="input ">

                    <label for="email-add" class="input-label">Email</label>
                    <input type="text" name="email-add" id="email-add" class="input ">

                    <label for="weight-add" class="input-label">Peso (kg.)</label>
                    <input type="number" name="weight-add" id="weight-add" class="input">

                    <label for="height-add" class="input-label">Altura (cm.)</label>
                    <input type="number" name="height-add" id="height-add" class="input margin-0-impt">
                </div>

                <div class="modal-footer">
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-accept add-client-button" id="add-client-button">Guardar</button>
                    </div>
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="view-client-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ver Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="name-view" class="input-label">Nombre: </label>
                    <span class="name-view text-cye-default wrap-text" id="name-view" name="name-view">
                    </span>

                    <label for="surname-view" class="input-label">Apellidos: </label>
                    <span class="surname-view text-cye-default wrap-text" id="surname-view" name="surname-view">
                    </span>

                    <label for="tel-view" class="input-label">Teléfono: </label>
                    <span class="tel-view text-cye-default wrap-text" id="tel-view" name="tel-view">
                    </span>

                    <label for="email-view" class="input-label">Email: </label>
                    <span class="email-view text-cye-default wrap-text" id="email-view" name="email-view">
                    </span>

                    <label for="weight-view" class="input-label">Peso (kg.): </label>
                    <span class="weight-view text-cye-default wrap-text" id="weight-view" name="weight-view">
                    </span>

                    <label for="height-view" class="input-label">Altura (cm.): </label>
                    <span class="height-view text-cye-default wrap-text" id="height-view" name="height-view">
                    </span>

                    <label for="interests-view" class="input-label">Intereses: </label>
                    <span class="interests-view text-cye-default wrap-text" id="interests-view" name="interests-view">
                    </span>

                    <label for="about-view" class="input-label">Sobre el cliente: </label>
                    <span class="about-view text-cye-default wrap-text" id="about-view" name="about-view">
                    </span>

                    <label for="state-view" class="input-label">Estado: </label>
                    <span class="state-view text-cye-default wrap-text" id="state-view" name="state-view">
                    </span>


                </div>

                <div class="modal-footer">
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

<script>
    var clients = @json($clients);
    console.log(clients);
</script>
@endsection
