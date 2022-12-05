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
                        <th scope="row"> {{$alimento->id}} </th>
                        <td>{{$alimento->name}}</td>
                        <td class="text-right">
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
            <span class="text-cye-default">
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
    
                    <label for="kcal-add" class="input-label">Kcal</label>
                    <input type="number" name="kcal-add" id="kcal-add" class="input">
                    
                    <label for="prot-add" class="input-label">Proteínas (g.)</label>
                    <input type="number" name="prot-add" id="prot-add" class="input ">

                    <label for="lip-add" class="input-label">Lípidos (g.)</label>
                    <input type="number" name="lip-add" id="lip-add" class="input ">

                    <label for="gluc-add" class="input-label">Glúcidos (g.)</label>
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
    
                    <label for="muscle-group-edit" class="input-label">Grupo muscular</label>
                    <input type="text" name="muscle-group-edit" id="muscle-group-edit" class="input margin-0-impt">
                    <br>
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
                    <h5 class="modal-title">Editar alimento</h5>
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
    var aliments = @json($alimentos)
</script>
@endsection