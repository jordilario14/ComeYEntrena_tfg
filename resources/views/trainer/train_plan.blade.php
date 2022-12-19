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
                    <input type="hidden" name="train-plan-id" id="train-plan-id" value="{{ $user->training_plan->id }}">
                    <h1 class="title-cye align-centered-phone ai-buttons">
                        Plan de entrenamiento
                        <img class="icon-button-table addDay" src="{{ asset('img/icons/add.png') }}" alt="">
                    </h1>

                </div>

                @forelse ($user->training_plan->days as $key=>$day)
                    <h1 class="title-cye-secondary align-centered-phone margin-0-impt">
                        {{ $day->day_note }}
                        <img class="icon-button-table addExercisePe" target="{{ $key }}"
                            src="{{ asset('img/icons/add.png') }}" alt="">
                        <img class="icon-button-table removeDay" target="{{ $day->id }}"
                            src="{{ asset('img/icons/remove_line.png') }}" alt="">
                        <img class="icon-button-table editDay" target="{{ $key }}"
                            src="{{ asset('img/icons/note.png') }}" alt="">
                    </h1>

                    <div class="class-table-div text-left">

                        <table class="table table-design dataToSearch">
                            <tbody>
                                <tr>
                                    <th scope="col">Ejercicio</th>
                                    <th scope="col">Grupo muscular</th>
                                    <th scope="col" class="text-right">
                                    </th>
                                </tr>


                                @forelse ($day->day_exercises as $key_ma=>$day_exercise)
                                    <tr>
                                        <td class="text-cye-default" scope="row"> {{ $day_exercise->exercise->name }}
                                        </td>
                                        <td class="text-cye-default wrap-text">{{ $day_exercise->exercise->muscle_group }}</td>
                                        <td class="text-right text-cye-default">
                                            <div class="button-table">
                                                <img class="icon-button-table view_exercise_pe" target="{{ $key }}"
                                                    targetma={{ $key_ma }} src="{{ asset('img/icons/view.png') }}"
                                                    alt="">
                                                <img class="icon-button-table edit_exercise_pe" target="{{ $key }}"
                                                    targetma={{ $key_ma }} src="{{ asset('img/icons/edit.png') }}"
                                                    alt="">
                                                <img class="icon-button-table remove_exercise_pe"
                                                    target={{ $day_exercise->id }}
                                                    src="{{ asset('img/icons/remove.png') }}" alt="">
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="3" class="text-center text-cye-default">No hay ejercicios en este día.
                                    </td>
                                @endforelse

                            </tbody>
                        </table>


                    </div>

                @empty
                    <h1 class="title-cye-secondary align-centered-phone margin-bottom-2">
                        No hay dias en este plan de entrenamiento.
                    </h1>
                @endforelse

                <div class="button-table" onclick="location.href='{{ route('clients') }}'">
                    <img class="icon-button-table" src="{{ asset('img/icons/back.png') }}" alt="">
                    <span class="text-cye-default link-return">
                        Atrás
                    </span>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="view-day-exercise-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ver ejercicio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <label for="name-view-exercise-pe" class="input-label">Nombre: </label>
                        <span class="name-view-exercise-pe text-cye-default wrap-text" id="name-view-exercise-pe"
                            name="name-view-exercise-pe">
                        </span>

                        <label for="mc-group-view-exercise-pe" class="input-label">Grupo muscular: </label>
                        <span class="mc-group-view-exercise-pe text-cye-default wrap-text" id="mc-group-view-exercise-pe"
                            name="mc-group-view-exercise-pe">
                        </span>

                        <label for="series-view-exercise-pe" class="input-label">Series: </label>
                        <span class="series-view-exercise-pe text-cye-default wrap-text" id="series-view-exercise-pe"
                            name="series-view-exercise-pe">
                        </span>

                        <label for="reps-view-exercise-pe" class="input-label">Repeticiones.: </label>
                        <span class="reps-view-exercise-pe text-cye-default wrap-text" id="reps-view-exercise-pe"
                            name="reps-view-exercise-pe">
                        </span>

                        <label for="muscl-view-exercise-pe" class="input-label">Grupo muscular: </label>
                        <span class="muscl-view-exercise-pe text-cye-default wrap-text" id="muscl-view-exercise-pe"
                            name="muscl-view-exercise-pe">
                        </span>

                        <label for="rir-view-exercise-pe" class="input-label">R.I.R.: </label>
                        <span class="rir-view-exercise-pe text-cye-default wrap-text" id="rir-view-exercise-pe"
                            name="rir-view-exercise-pe">
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

        <div class="modal" tabindex="-1" id="add-day-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Añadir día</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <label for="note-add-day" class="input-label">Nota</label>
                        <input type="text" name="note-add-day" id="note-add-day" class="input">
                        <br>
                    </div>

                    <div class="modal-footer">
                        <div class="w-100 flex-centered">
                            <button type="button" class="button-modal-accept add-day-button"
                                id="add-day-button">Guardar</button>
                        </div>
                        <div class="w-100 flex-centered">
                            <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="edit-exercise-pe-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar ejercicio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="name-edit-exercise" class="input-label">Ejercicio</label>
                        <select class="input" name="name-edit-exercise" id="name-edit-exercise">
                            @foreach ($exercises as $exercise)
                                <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                            @endforeach
                        </select>

                        <label for="series-edit-exercise" class="input-label">Series</label>
                        <input type="number" name="series-edit-exercise" id="series-edit-exercise" class="input">

                        <label for="reps-edit-exercise" class="input-label">Repeticiones</label>
                        <input type="number" name="reps-edit-exercise" id="reps-edit-exercise" class="input">

                        <label for="rir-edit-exercise" class="input-label">R.I.R.</label>
                        <input type="text" name="rir-edit-exercise" id="rir-edit-exercise" class="input">

                        <input type="hidden" name="id_day_edit" value="" id="id_day_edit">
                        <input type="hidden" name="id_day_exercise_edit" value="" id="id_day_exercise_edit">
                        <br>
                    </div>

                    <div class="modal-footer">
                        <div class="w-100 flex-centered">
                            <button type="button" class="button-modal-accept edit-exercise-pe-button"
                                id="edit-exercise-pe-button">Guardar</button>
                        </div>
                        <div class="w-100 flex-centered">
                            <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal" tabindex="-1" id="add-exercise-pe-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Añadir ejercicio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="name-add-exercise" class="input-label">Ejercicio</label>
                        <select class="input" name="name-add-exercise" id="name-add-exercise">
                            @foreach ($exercises as $exercise)
                                <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                            @endforeach
                        </select>


                        <label for="series-add-exercise" class="input-label">Series</label>
                        <input type="number" name="series-add-exercise" id="series-add-exercise" class="input">

                        <label for="reps-add-exercise" class="input-label">Repeticiones</label>
                        <input type="number" name="reps-add-exercise" id="reps-add-exercise" class="input">

                        <label for="rir-add-exercise" class="input-label">R.I.R.</label>
                        <input type="text" name="rir-add-exercise" id="rir-add-exercise" class="input">

                        <input type="hidden" name="id_day" value="" id="id_day">

                        <br>
                    </div>

                    <div class="modal-footer">
                        <div class="w-100 flex-centered">
                            <button type="button" class="button-modal-accept add-exercise-pe-button"
                                id="add-exercise-pe-button">Guardar</button>
                        </div>
                        <div class="w-100 flex-centered">
                            <button type="button" class="button-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="edit-day-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar dia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <label for="note-edit-day" class="input-label">Nota</label>
                        <input type="text" name="note-edit-day" id="note-edit-day" class="input">

                        <input type="hidden" name="id_day" value="" id="id_day">
                        <br>
                    </div>

                    <div class="modal-footer">
                        <div class="w-100 flex-centered">
                            <button type="button" class="button-modal-accept edit-day-button"
                                id="edit-day-button">Guardar</button>
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
