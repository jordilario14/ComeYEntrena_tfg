@extends('layouts.app')

@section('content')
<div class="part-1-body flex-centered">
    <div class="card-profile width-100">
        <div class="card-header-profile width-100 text-left dflex padded-3-rem-et">
            <img class="trainer-img-profile" src="{{ asset('img/trainer.png') }}" alt="">
        </div>

        <div class="width-100 text-left dflex padded-3-rem">
            <div class="text-align-centered-phone">
                <h1 class="title-cye-pn align-centered-phone" >
                    {{ $user->name . " " . $user->surname }}
                </h1>
            </div>
        </div>

        <hr class="hr-separador">

        <div class="width-100 text-left padded-3-rem" >
            <div class="text-align-centered-phone">
                <input type="hidden" name="nutri-plan-id" id="nutri-plan-id" value="{{ $user->nutritional_plan->id }}">
                <h1 class="title-cye align-centered-phone ai-buttons" >
                    Plan nutricional
                    <img class="icon-button-table addMeal" src="{{ asset('img/icons/add.png') }}" alt="">
                </h1>

            </div>

            @forelse ($user->nutritional_plan->meals as $key=>$meal)
                <h1 class="title-cye-secondary align-centered-phone margin-0-impt" >
                    {{ $meal->meal_note }}
                    <img class="icon-button-table addAlimentPn" target="{{ $key }}" src="{{ asset('img/icons/add.png') }}" alt="">
                    <img class="icon-button-table removeMeal" src="{{ asset('img/icons/remove_line.png') }}" alt="">
                    <img class="icon-button-table editMeal" target="{{ $key }}" src="{{ asset('img/icons/note.png') }}" alt="">

                </h1>
            @empty
                <h1 class="title-cye-secondary align-centered-phone margin-0-impt" >
                    No hay comidas en este plan nutricional.
                </h1>
            @endforelse

            <hr class="hr-separador">
        </div>
    </div>



<div class="modal" tabindex="-1" id="add-meal-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir comida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <label for="note-add-meal" class="input-label">Nota</label>
                <input type="text" name="note-add-meal" id="note-add-meal" class="input">
                <br>
            </div>

            <div class="modal-footer">
                <div class="w-100 flex-centered">
                    <button type="button" class="button-modal-accept add-meal-button" id="add-meal-button">Guardar</button>
                </div>
                <div class="w-100 flex-centered">
                    <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="add-aliment-pn-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir alimento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="name-add-aliment" class="input-label">Alimento</label>
                <select class="input" name="name-add-aliment" id="name-add-aliment" >
                    @foreach ($aliments as $aliment)
                        <option value="{{ $aliment->id }}">{{ $aliment->name }}</option>
                    @endforeach
                  </select>

                <label for="cuant_add_aliment" class="input-label">Porciones (100g. / 100ml.)</label>
                <input type="number" name="cuant_add_aliment" id="cuant_add_aliment" class="input">

                <input type="hidden" name="id_meal" value="" id="id_meal">

                <br>
            </div>

            <div class="modal-footer">
                <div class="w-100 flex-centered">
                    <button type="button" class="button-modal-accept add-aliment-pn-button" id="add-aliment-pn-button">Guardar</button>
                </div>
                <div class="w-100 flex-centered">
                    <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="edit-meal-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar comida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <label for="note-edit-meal" class="input-label">Nota</label>
                <input type="text" name="note-edit-meal" id="note-edit-meal" class="input">

                <input type="hidden" name="id_meal" value="" id="id_meal">
                <br>
            </div>

            <div class="modal-footer">
                <div class="w-100 flex-centered">
                    <button type="button" class="button-modal-accept edit-meal-button" id="edit-meal-button">Guardar</button>
                </div>
                <div class="w-100 flex-centered">
                    <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>
</div>

</div>


<script>
    var user = @json($user);
</script>
@endsection
