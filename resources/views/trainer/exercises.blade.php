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
                        <img class="icon-button-table addExercise" src="{{ asset('img/icons/add.png') }}" alt="">
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
                                <img class="icon-button-table viewExercise" target="{{$key}}" src="{{ asset('img/icons/view.png') }}" alt="">
                                <img class="icon-button-table editExercise" target="{{$key}}" src="{{ asset('img/icons/edit.png') }}" alt="">
                                <img class="icon-button-table removeExercise" target="{{$ejercicio->id}}" src="{{ asset('img/icons/remove.png') }}" alt="">
                            </div>
                        </td>
                    </tr>
                @empty
                    <td>No hay ejercicios en la base de datos.</td>
                @endforelse

            </tbody>
          </table>
    </div>

    <div class="modal" tabindex="-1" id="add-exercise-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Añadir ejercicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
         
                    <label for="name-add" class="input-label">Nombre</label>
                    <input type="name-add" name="name-add" id="name-add" class="input">
    
                    <label for="muscle-group-add" class="input-label">Grupo muscular</label>
                    <input type="muscle-group-add" name="muscle-group-add" id="muscle-group-add" class="input margin-0-impt">
                    <br>
                </div>
    
                <div class="modal-footer">
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-accept add-exercise-button" id="add-exercise-button">Guardar</button>
                    </div>
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    </div>
    
                </div>               
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="edit-exercise-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar ejercicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
         
                    <label for="name-edit" class="input-label">Nombre</label>
                    <input type="name-edit" name="name-edit" id="name-edit" class="input">
    
                    <label for="muscle-group-edit" class="input-label">Grupo muscular</label>
                    <input type="muscle-group-edit" name="muscle-group-edit" id="muscle-group-edit" class="input margin-0-impt">
                    <br>
                </div>

                <input type="hidden" name="exercise-id-edit" id="exercise-id-edit" class="exercise-id-edit">
    
                <div class="modal-footer">
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-accept edit-exercise-button" id="edit-exercise-button">Guardar</button>
                    </div>
                    <div class="w-100 flex-centered">
                        <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    </div>
    
                </div>               
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="view-exercise-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar ejercicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
         
                    <label for="name-view" class="input-label">Nombre: </label>
                    <span class="name-view text-cye-default" id="name-view" name="name-view">
                    </span>
    
                    <label for="muscle-group-view" class="input-label">Grupo muscular: </label>
                    <span class="muscle-group-view text-cye-default" id="muscle-group-view" name="muscle-group-view">
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
    var exercises = @json($ejercicios)
</script>
@endsection