@extends('layouts.app')

@section('content')
    <div class="part-1-body flex-centered">
        <div class="card-profile width-100">
            <div class="card-header-profile width-100 text-left dflex padded-3-rem-et">
                <img class="client-img-profile" src="{{ asset('img/client.png') }}" alt="">
            </div>

            <div class="width-100 text-left dflex padded-3-rem">
                <div class="text-align-centered-phone">
                    <h1 class="title-cye-pn align-centered-phone">
                        {{ $user->name . ' ' . $user->surname }}
                    </h1>
                </div>
            </div>

            <hr class="hr-separador">

            <div class="width-100 text-left padded-3-rem">
                <div class="text-align-centered-phone">
                    <input type="hidden" name="nutri-plan-id" id="nutri-plan-id" value="{{ $user->nutritional_plan->id }}">
                    <h1 class="title-cye align-centered-phone ai-buttons">
                        Plan nutricional
                        <img class="icon-button-table addMeal" src="{{ asset('img/icons/add.png') }}" alt="">
                    </h1>

                </div>

                @forelse ($user->nutritional_plan->meals as $key=>$meal)
                    <h1 class="title-cye-secondary align-centered-phone margin-0-impt">
                        {{ $meal->meal_note }}
                        <img class="icon-button-table addAlimentPn" target="{{ $key }}"
                            src="{{ asset('img/icons/add.png') }}" alt="">
                        <img class="icon-button-table removeMeal" target="{{ $meal->id }}"
                            src="{{ asset('img/icons/remove_line.png') }}" alt="">
                        <img class="icon-button-table editMeal" target="{{ $key }}"
                            src="{{ asset('img/icons/note.png') }}" alt="">
                    </h1>

                    <div class="class-table-div text-left">

                        <table class="table table-design dataToSearch">
                            <tbody>
                                <tr>
                                    <th scope="col">Alimento</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col" class="text-right">
                                    </th>
                                </tr>

                                @forelse ($meal->meal_aliments as $key_ma=>$meal_aliment)
                                    <tr>
                                        <td class="text-cye-default" scope="row"> {{ $meal_aliment->aliment->name }}
                                        </td>
                                        <td class="text-cye-default wrap-text">{{ floatval($meal_aliment->cuantity) * 100 }}
                                            {{ $meal_aliment->aliment->measure }}</td>
                                        <td class="text-right text-cye-default">
                                            <div class="button-table">
                                                <img class="icon-button-table view_aliment_pn" target="{{ $key }}"
                                                    targetma={{ $key_ma }} src="{{ asset('img/icons/view.png') }}"
                                                    alt="">
                                                <img class="icon-button-table edit_aliment_pn" target="{{ $key }}"
                                                    targetma={{ $key_ma }} src="{{ asset('img/icons/edit.png') }}"
                                                    alt="">
                                                <img class="icon-button-table remove_aliment_pn"
                                                    target={{ $meal_aliment->id }}
                                                    src="{{ asset('img/icons/remove.png') }}" alt="">
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="3" class="text-center text-cye-default">No hay alimentos en esta comida.
                                    </td>
                                @endforelse

                            </tbody>
                        </table>


                    </div>

                @empty
                    <h1 class="title-cye-secondary align-centered-phone margin-bottom-2">
                        No hay comidas en este plan nutricional.
                    </h1>
                @endforelse

                <hr class="hr-separador">

                <h1 class="title-cye-secondary align-centered-phone margin-0-impt">
                    Resumen
                </h1>

                <div class="class-table-div text-left">
                    <table class="table table-design dataToSearch">
                        <thead>
                            <tr>
                                <th scope="col">Kcal</th>
                                <th scope="col">Proteína</th>
                                <th scope="col">Glúcidos</th>
                                <th scope="col">Lípidos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-cye-default" scope="row"> {{ $macros->kcal }} </td>
                                <td class="text-cye-default" scope="row"> {{ $macros->protein }} </td>
                                <td class="text-cye-default" scope="row"> {{ $macros->glucids }} </td>
                                <td class="text-cye-default" scope="row"> {{ $macros->lipids }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="button-table" onclick="location.href='{{ route('clients') }}'">
                    <img class="icon-button-table" src="{{ asset('img/icons/back.png') }}" alt="">
                    <span class="text-cye-default link-return">
                        Atrás
                    </span>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="view-meal-aliment-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ver alimento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <label for="name-view-aliment-pn" class="input-label">Nombre: </label>
                        <span class="name-view-aliment-pn text-cye-default wrap-text" id="name-view-aliment-pn"
                            name="name-view-aliment-pn">
                        </span>

                        <label for="measure-view-aliment-pn" class="input-label">Medida: </label>
                        <span class="measure-view-aliment-pn text-cye-default wrap-text" id="measure-view-aliment-pn"
                            name="measure-view-aliment-pn">
                        </span>

                        <label for="kcal-view-aliment-pn" class="input-label">Kcal.: </label>
                        <span class="kcal-view-aliment-pn text-cye-default wrap-text" id="kcal-view-aliment-pn"
                            name="kcal-view-aliment-pn">
                        </span>

                        <label for="protein-view-aliment-pn" class="input-label">Proteínas: </label>
                        <span class="protein-view-aliment-pn text-cye-default wrap-text" id="protein-view-aliment-pn"
                            name="protein-view-aliment-pn">
                        </span>

                        <label for="lipids-view-aliment-pn" class="input-label">Lípidos: </label>
                        <span class="lipids-view-aliment-pn text-cye-default wrap-text" id="lipids-view-aliment-pn"
                            name="lipids-view-aliment-pn">
                        </span>


                        <label for="glucids-view-aliment-pn" class="input-label">Glúcidos: </label>
                        <span class="glucids-view-aliment-pn text-cye-default wrap-text" id="glucids-view-aliment-pn"
                            name="glucids-view-aliment-pn">
                        </span>


                        <label for="quantity-view-aliment-pn" class="input-label">Raciones (100 g./ml.): </label>
                        <span class="quantity-view-aliment-pn text-cye-default wrap-text" id="quantity-view-aliment-pn"
                            name="quantity-view-aliment-pn">
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
                            <button type="button" class="button-modal-accept add-meal-button"
                                id="add-meal-button">Guardar</button>
                        </div>
                        <div class="w-100 flex-centered">
                            <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="edit-aliment-pn-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar alimento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="name-edit-aliment" class="input-label">Alimento</label>
                        <select class="input" name="name-edit-aliment" id="name-edit-aliment">
                            @foreach ($aliments as $aliment)
                                <option value="{{ $aliment->id }}">{{ $aliment->name }}</option>
                            @endforeach
                        </select>

                        <label for="cuant_edit_aliment" class="input-label">Porciones (100g. / 100ml.)</label>
                        <input type="number" name="cuant_edit_aliment" id="cuant_edit_aliment" class="input">

                        <input type="hidden" name="id_meal_edit" value="" id="id_meal_edit">
                        <input type="hidden" name="id_meal_aliment_edit" value="" id="id_meal_aliment_edit">


                        <br>
                    </div>

                    <div class="modal-footer">
                        <div class="w-100 flex-centered">
                            <button type="button" class="button-modal-accept edit-aliment-pn-button"
                                id="edit-aliment-pn-button">Guardar</button>
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
                        <select class="input" name="name-add-aliment" id="name-add-aliment">
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
                            <button type="button" class="button-modal-accept add-aliment-pn-button"
                                id="add-aliment-pn-button">Guardar</button>
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
                            <button type="button" class="button-modal-accept edit-meal-button"
                                id="edit-meal-button">Guardar</button>
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
