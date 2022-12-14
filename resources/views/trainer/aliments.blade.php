@extends('layouts.app')

@section('content')
<div class="part-1-body">
    <div class="text-align-centered-phone">
        <h1 class="title-cye align-centered-phone" >
            Alimentos
        </h1>
    </div>

    <div class="text-align-centered-phone">
        <input type="search" placeholder="Busca un alimento" class="Buscador searchTerm" />
    </div>

    <div class="class-table-div text-left">

        <table class="table table-design dataToSearch">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col" class="text-right">
                    <div class="button-table">
                        <img class="icon-button-table addAliment" src="{{ asset('img/icons/add.png') }}" alt="">
                    </div>
                </th>
              </tr>
            </thead>
            <tbody>
                @forelse ($alimentos as $key=>$alimento)
                    <tr>
                        <th class="text-cye-default" scope="row"> {{$alimento->id}} </th>
                        <td class="text-cye-default wrap-text">{{$alimento->name}}</td>
                        <td class="text-right text-cye-default">
                            <div class="button-table">
                                <img class="icon-button-table viewAliment" target="{{$key}}" src="{{ asset('img/icons/view.png') }}" alt="">
                                <img class="icon-button-table editAliment" target="{{$key}}" src="{{ asset('img/icons/edit.png') }}" alt="">
                                <img class="icon-button-table removeAliment" target="{{$alimento->id}}" src="{{ asset('img/icons/remove.png') }}" alt="">
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="3" class="text-center text-cye-default">No hay alimentos en la base de datos.</td>
                @endforelse

            </tbody>
          </table>

          <div class="button-table" onclick="location.href='{{ route('home') }}'">
            <img class="icon-button-table viewAliment"  src="{{ asset('img/icons/back.png') }}" alt="">
            <span class="text-cye-default link-return">
                Atrás
            </span>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="add-aliment-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Añadir alimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="name-add" class="input-label">Nombre</label>
                    <input type="text" name="name-add" id="name-add" class="input">

                    <label for="measure-add" class="input-label">Medida</label>
                    <select class="input" name="measure-add" id="measure-add" >
                        <option value="0">ml.</option>
                        <option value="1">g.</option>
                    </select>

                    <label for="kcal-add" class="input-label">Kcal. (Por 100 gramos)</label>
                    <input type="number" name="kcal-add" id="kcal-add" class="input">

                    <label for="prot-add" class="input-label">Proteínas (Por 100 gramos)</label>
                    <input type="number" name="prot-add" id="prot-add" class="input ">

                    <label for="lip-add" class="input-label">Lípidos (Por 100 gramos)</label>
                    <input type="number" name="lip-add" id="lip-add" class="input ">

                    <label for="gluc-add" class="input-label">Glúcidos (Por 100 gramos)</label>
                    <input type="number" name="gluc-add" id="gluc-add" class="input margin-0-impt">
                </div>

                <div class="modal-footer">
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-accept add-aliment-button" id="add-aliment-button">Guardar</button>
                    </div>
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="edit-aliment-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar alimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="name-edit" class="input-label">Nombre</label>
                    <input type="text" name="name-edit" id="name-edit" class="input">

                    <label for="measure-edit" class="input-label">Medida</label>
                    <select class="input" name="measure-edit" id="measure-edit" >
                        <option value="0">ml.</option>
                        <option value="1">g.</option>
                    </select>

                    <label for="kcal-edit" class="input-label">Kcal. (Por 100 gramos)</label>
                    <input type="number" name="kcal-edit" id="kcal-edit" class="input">

                    <label for="prot-edit" class="input-label">Proteínas (Por 100 gramos)</label>
                    <input type="number" name="prot-edit" id="prot-edit" class="input ">

                    <label for="lip-edit" class="input-label">Lípidos (Por 100 gramos)</label>
                    <input type="number" name="lip-edit" id="lip-edit" class="input ">

                    <label for="gluc-edit" class="input-label">Glúcidos (Por 100 gramos)</label>
                    <input type="number" name="gluc-edit" id="gluc-edit" class="input margin-0-impt">
                </div>

                <input type="hidden" name="aliment-id-edit" id="aliment-id-edit" class="aliment-id-edit">

                <div class="modal-footer">
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-accept edit-aliment-button" id="edit-aliment-button">Guardar</button>
                    </div>
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="view-aliment-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ver alimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="name-view" class="input-label">Nombre: </label>
                    <span class="name-view text-cye-default wrap-text" id="name-view" name="name-view">
                    </span>

                    <label for="measure-view" class="input-label">Medida</label>
                    <span class="name-view text-cye-default wrap-text" id="measure-view" name="measure-view">
                    </span>


                    <label for="kcal-view" class="input-label">KCal. (Por 100 gramos): </label>
                    <span class="kcal-view text-cye-default wrap-text" id="kcal-view" name="kcal-view">
                    </span>

                    <label for="prot-view" class="input-label">Proteinas (Por 100 gramos): </label>
                    <span class="prot-view text-cye-default wrap-text" id="prot-view" name="prot-view">
                    </span>

                    <label for="lip-view" class="input-label">Lípidos (Por 100 gramos): </label>
                    <span class="lip-view text-cye-default wrap-text" id="lip-view" name="lip-view">
                    </span>

                    <label for="gluc-view" class="input-label">Glúcidos (Por 100 gramos): </label>
                    <span class="gluc-view text-cye-default wrap-text" id="gluc-view" name="gluc-view">
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
    var aliments = @json($alimentos)
</script>
@endsection
