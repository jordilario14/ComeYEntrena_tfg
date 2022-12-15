<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\Aliment;
use App\Models\Exercise;
use App\Models\Meal;
use App\Models\Day;

use App\Models\Meal_aliment;
use App\Models\Day_exercise;

use App\Models\Nutritional_plan;
use App\Models\Training_plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;

class TrainerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_TRAINER');

    }

    public function remove_exercise_pe(Request $request)
    {
        $day_exercise = Day_exercise::where('id', $request->day_exercise)->first();

        if ($day_exercise == null) {
            return response()->json([
                'error' => true,
                'messages' => "No se ha encontrado el ejercicio seleccionado.",
                "route" => null,
            ], 200);
        }

        $user = $day_exercise->day->training_plan->user;

        $day_exercise->delete();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('training-plan', $user->id),
        ], 200);

    }

    public function remove_aliment_pn(Request $request)
    {
        $meal_aliment = Meal_aliment::where('id', $request->meal_aliment)->first();

        if ($meal_aliment == null) {
            return response()->json([
                'error' => true,
                'messages' => "No se ha encontrado el alimento seleccionado.",
                "route" => null,
            ], 200);
        }

        $user = $meal_aliment->meal->nutritional_plan->user;

        $meal_aliment->delete();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('nutritional-plan', $user->id),
        ], 200);

    }

    public function remove_day(Request $request)
    {
        $day = Day::where('id', $request->day)->first();

        if ($day == null) {
            return response()->json([
                'error' => true,
                'messages' => "No se ha encontrado el día seleccionado",
                "route" => null,
            ], 200);
        }

        if ($day->day_exercises != null) {
            foreach ($day->day_exercises as $day_exercise) {
                $day_exercise->delete();
            }
        }

        $user = $day->training_plan->user;

        $day->delete();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('training-plan', $user->id),
        ], 200);
    }

    public function remove_meal(Request $request)
    {
        $meal = Meal::where('id', $request->meal)->first();

        if ($meal == null) {
            return response()->json([
                'error' => true,
                'messages' => "No se ha encontrado la comida seleccionada",
                "route" => null,
            ], 200);
        }

        if ($meal->meal_aliments != null) {
            foreach ($meal->meal_aliments as $meal_aliment) {
                $meal_aliment->delete();
            }
        }

        $user = $meal->nutritional_plan->user;

        $meal->delete();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('nutritional-plan', $user->id),
        ], 200);
    }

    public function edit_exercise_pe(Request $request)
    {
        $rules = [
            'exercise' => 'max:10000|integer|required',
            'series' => 'max:6|integer|required',
            'reps' => 'max:50|integer|required',
            'rir' => 'max:10|string|required',

        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'exercise.max' => "El ejercicio debe ser inferior a 10000.",
            'exercise.required' => "El ejercicio no puede estar vacío.",
            'exercise.integer' => "El ejercicio tiene un formato incorrecto.",
            'series.max' => "Las series deben ser inferiores a 6.",
            'series.required' => "Las series son un campo obligatorio.",
            'series.integer' => "Las series tienen un formato incorrecto. Deben de ser un valor entero.",
            'reps.max' => "Las repeticiones deben ser inferiores a 50.",
            'reps.required' => "Las repeticiones son un campo obligatorio.",
            'reps.integer' => "Las repeticiones tienen un formato incorrecto. Deben de ser un valor entero.",
            'rir.max' => "El rir tiene un formato incorrecto",
            'rir.required' => "El rir es un campo obligatorio.",
            'rir.string' => "El rir tiene un formato incorrecto",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $day = Day::where('id', $request->day)->first();
        $exercise = Exercise::where('id', $request->exercise)->first();

        if ($day == null || $exercise == null) {
            return response()->json([
                'error' => true,
                'messages' => "No se han encontrado los datos para llevar a cabo su petición",
                "route" => null,
            ], 200);
        }

        $day_exercise = Day_exercise::where('id', $request->day_exercise)->first();
        $day_exercise->exercise_id = $exercise->id;
        $day_exercise->series = $request->series;
        $day_exercise->repetitions = $request->reps;
        $day_exercise->rir = $request->rir;
        $day_exercise->save();

        return response()->json([
            'error' => false,
            'messages' => "Se ha modificado el ejercicio del día correctamente.",
            "route" => route('training-plan', $day->training_plan->user),
        ], 200);

    }

    public function edit_aliment_pn(Request $request)
    {
        $rules = [
            'aliment' => 'max:10000|integer|required',
            'quantity' => 'max:999|numeric|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'aliment.max' => "El alimento debe ser inferior a 10000.",
            'aliment.required' => "El alimento no puede estar vacío.",
            'aliment.integer' => "El alimento tiene un formato incorrecto.",
            'quantity.max' => "La cantidad debe ser inferior a 999.",
            'quantity.required' => "La cantidad no puede estar vacía.",
            'quantity.numeric' => "La cantidad tiene un formato incorrecto. Debe de ser un valor numérico.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $meal = Meal::where('id', $request->meal)->first();
        $aliment = Aliment::where('id', $request->aliment)->first();

        if ($meal == null || $aliment == null) {
            return response()->json([
                'error' => true,
                'messages' => "No se han encontrado los datos para llevar a cabo su petición",
                "route" => null,
            ], 200);
        }

        $meal_aliment = Meal_aliment::where('id', $request->meal_aliment)->first();
        $meal_aliment->aliment_id = $aliment->id;
        $meal_aliment->cuantity = $request->quantity;
        $meal_aliment->save();

        return response()->json([
            'error' => false,
            'messages' => "Se ha modificado el alimento de la comida correctamente.",
            "route" => route('nutritional-plan', $meal->nutritional_plan->user),
        ], 200);

    }

    public function add_exercise_pe(Request $request)
    {
        $rules = [
            'exercise' => 'max:10000|integer|required',
            'series' => 'max:6|integer|required',
            'reps' => 'max:50|integer|required',
            'rir' => 'max:10|string|required',

        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'exercise.max' => "El ejercicio debe ser inferior a 10000.",
            'exercise.required' => "El ejercicio no puede estar vacío.",
            'exercise.integer' => "El ejercicio tiene un formato incorrecto.",
            'series.max' => "Las series deben ser inferiores a 6.",
            'series.required' => "Las series son un campo obligatorio.",
            'series.integer' => "Las series tienen un formato incorrecto. Deben de ser un valor entero.",
            'reps.max' => "Las repeticiones deben ser inferiores a 50.",
            'reps.required' => "Las repeticiones son un campo obligatorio.",
            'reps.integer' => "Las repeticiones tienen un formato incorrecto. Deben de ser un valor entero.",
            'rir.max' => "El rir tiene un formato incorrecto",
            'rir.required' => "El rir es un campo obligatorio.",
            'rir.string' => "El rir tiene un formato incorrecto",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $day = Day::where('id', $request->day)->first();
        $exercise = Exercise::where('id', $request->exercise)->first();

        if ($day == null || $exercise == null) {
            return response()->json([
                'error' => true,
                'messages' => "No se han encontrado los datos para llevar a cabo su petición",
                "route" => null,
            ], 200);
        }

        $day_exercise = new Day_exercise;
        $day_exercise->day_id = $day->id;
        $day_exercise->exercise_id = $exercise->id;
        $day_exercise->series = $request->series;
        $day_exercise->repetitions = $request->reps;
        $day_exercise->rir = $request->rir;
        $day_exercise->save();

        return response()->json([
            'error' => false,
            'messages' => "Se ha añadido el ejercicio al día correctamente.",
            "route" => route('training-plan', $day->training_plan->user),
        ], 200);

    }
    public function add_aliment_pn(Request $request)
    {
        $rules = [
            'aliment' => 'max:10000|integer|required',
            'quantity' => 'max:999|numeric|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'aliment.max' => "El alimento debe ser inferior a 10000.",
            'aliment.required' => "El alimento no puede estar vacío.",
            'aliment.integer' => "El alimento tiene un formato incorrecto.",
            'quantity.max' => "La cantidad debe ser inferior a 999.",
            'quantity.required' => "La cantidad no puede estar vacía.",
            'quantity.numeric' => "La cantidad tiene un formato incorrecto. Debe de ser un valor numérico.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $meal = Meal::where('id', $request->meal)->first();
        $aliment = Aliment::where('id', $request->aliment)->first();

        if ($meal == null || $aliment == null) {
            return response()->json([
                'error' => true,
                'messages' => "No se han encontrado los datos para llevar a cabo su petición",
                "route" => null,
            ], 200);
        }

        $meal_aliment = new Meal_aliment;
        $meal_aliment->meal_id = $meal->id;
        $meal_aliment->aliment_id = $aliment->id;
        $meal_aliment->cuantity = $request->quantity;
        $meal_aliment->save();

        return response()->json([
            'error' => false,
            'messages' => "Se ha añadido el alimento a la comida correctamente.",
            "route" => route('nutritional-plan', $meal->nutritional_plan->user),
        ], 200);

    }

    public function training_plan_index(Request $request)
    {
        $client = User::where('id', $request->client)->first();
        $exercises = Exercise::get();


        return view('trainer.train_plan')->with([
            'user' => $client,
            'exercises' => $exercises
        ]);
    }

    public function nutritional_plan_index(Request $request)
    {
        $client = User::where('id', $request->client)->first();
        $aliments = Aliment::get();

        $pn_macros = app();
        $pn_macros = $pn_macros->make('stdClass');

        $pn_macros->kcal = 0;
        $pn_macros->protein =0;
        $pn_macros->glucids =0;
        $pn_macros->lipids =0;

        foreach ($client->nutritional_plan->meals as $meal) {
            foreach ($meal->meal_aliments as $meal_aliment) {
                $pn_macros->kcal = $pn_macros->kcal + floatval($meal_aliment->cuantity) * intval($meal_aliment->aliment->kcal);
                $pn_macros->protein =$pn_macros->protein + floatval($meal_aliment->cuantity) * intval($meal_aliment->aliment->protein);
                $pn_macros->glucids =$pn_macros->glucids + floatval($meal_aliment->cuantity) * intval($meal_aliment->aliment->glucids);
                $pn_macros->lipids =$pn_macros->lipids + floatval($meal_aliment->cuantity) * intval($meal_aliment->aliment->lipids);
            }
        }


        return view('trainer.nutri_plan')->with([
            'user' => $client,
            'aliments' => $aliments,
            'macros' => $pn_macros
        ]);
    }


    public function add_day(Request $request)
    {
        $rules = [
            'day_note' => 'max:255|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'day_note.max' => "El nombre debe tener como máximo 255 caracteres.",
            'day_note.required' => "El nombre del día es un campo requerido.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $training_plan = Training_plan::where('id', $request->train_plan)->first();

        if ($training_plan == null) {
            return response()->json([
                'error' => true,
                'messages' => "El cliente no tiene creado un plan de entrenamiento.",
                "route" => null,
            ], 200);
        }

        $day = new Day;
        $day->day_note = $request->day_note;
        $day->training_plan_id = $training_plan->id;
        $day->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('training-plan', $day->training_plan->user->id),
        ], 200);
    }

    public function add_meal(Request $request)
    {
        $rules = [
            'meal_note' => 'max:255|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'meal_note.max' => "El nombre debe tener como máximo 255 caracteres.",
            'meal_note.required' => "El nombre de la comida es un campo requerido.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $nutritional_plan = Nutritional_plan::where('id', $request->nutri_plan)->first();
        if ($nutritional_plan == null) {
            return response()->json([
                'error' => true,
                'messages' => "El cliente no tiene creado un plan nutricional.",
                "route" => null,
            ], 200);
        }

        $meal = new Meal;
        $meal->meal_note = $request->meal_note;
        $meal->nutritional_plan_id = $nutritional_plan->id;
        $meal->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('nutritional-plan', $meal->nutritional_plan->user->id),
        ], 200);
    }
    public function edit_day(Request $request)
    {
        $rules = [
            'day_note' => 'max:255|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'day_note.max' => "El nombre debe tener como máximo 255 caracteres.",
            'day_note.required' => "El nombre del día es un campo requerido.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $day = Day::where('id', $request->day_id)->first();

        if ($day == null) {
            return response()->json([
                'error' => true,
                'messages' => "Ese día no se ha encontrado en la base de datos.",
                "route" => null,
            ], 200);
        }

        $day->day_note = $request->day_note;
        $day->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('training-plan', $day->training_plan->user->id),
        ], 200);
    }
    public function edit_meal(Request $request)
    {
        $rules = [
            'meal_note' => 'max:255|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'meal_note.max' => "El nombre debe tener como máximo 255 caracteres.",
            'meal_note.required' => "El nombre de la comida es un campo requerido.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $meal = Meal::where('id', $request->meal_id)->first();

        if ($meal == null) {
            return response()->json([
                'error' => true,
                'messages' => "Esa comida no se ha encontrado en la base de datos.",
                "route" => null,
            ], 200);
        }

        $meal->meal_note = $request->meal_note;
        $meal->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('nutritional-plan', $meal->nutritional_plan->user->id),
        ], 200);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function exercises_index(Request $request)
    {
        $ejercios = Exercise::get();

        return view('trainer.exercises')->with(['ejercicios' => $ejercios]);
    }

    public function aliments_index(Request $request)
    {

        $aliments = Aliment::get();

        return view('trainer.aliments')->with(['alimentos' => $aliments]);
    }

    public function clients_index(Request $request)
    {
        $clients = User::clients();

        return view('trainer.clients')->with(['clients' => $clients]);
    }

    public function remove_exercise(Request $request)
    {
        $exercise = Exercise::where('id', $request->exercise)->first();

        if ($exercise) {
            $exercise->delete();

            return response()->json([
                'error' => false,
                'messages' => null,
                "route" => route('exercises'),
            ], 200);

        } else {
            return response()->json([
                'error' => true,
                'messages' => 'No hay un ejercicio con ese identificador.',
                "route" => route('exercises'),
            ], 200);
        }
    }

    public function remove_aliment(Request $request)
    {
        $aliment = Aliment::where('id', $request->aliment)->first();

        if ($aliment) {
            $aliment->delete();

            return response()->json([
                'error' => false,
                'messages' => null,
                "route" => route('aliments'),
            ], 200);

        } else {
            return response()->json([
                'error' => true,
                'messages' => 'No hay un alimento con ese identificador.',
                "route" => route('aliment'),
            ], 200);
        }
    }

    public function add_exercise(Request $request)
    {
        $rules = [
            'name' => 'max:255|required',
            'muscleGroup' => 'max:255|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'name.max' => "El nombre debe tener como máximo 255 caracteres.",
            'name.required' => "El nombre del ejercicio es un campo requerido.",
            'muscleGroup.required' => "El grupo muscular es un campo requerido.",
            'muscleGroup.max' => "El grupo muscular debe tener como máximo 255 caracteres.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $name = $request->name;
        $muscleGroup = $request->muscleGroup;

        $ejercicio = new Exercise;
        $ejercicio->name = $name;
        $ejercicio->muscle_group = $muscleGroup;
        $ejercicio->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('exercises'),
        ], 200);
    }

    public function add_aliment(Request $request)
    {
        $rules = [
            'name' => 'max:255|required',
            'measure' => 'required|in:0,1',
            'kcalories' => 'integer|max_digits:10|required',
            'protein' => 'integer|max_digits:10|required',
            'glucids' => 'integer|max_digits:10|required',
            'lipids' => 'integer|max_digits:10|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'name.max' => "El nombre debe tener como máximo 255 caracteres.",
            'name.required' => "El nombre del alimento es un campo requerido.",
            'measure.required' => "La medida del alimento es un campo requerido.",
            'measure.in' => "La medida del alimento no tiene un valor válido.",
            'kcalories.required' => "Las calorias són un campo requerido.",
            'kcalories.max_digits' => "Las calorias deben tener como máximo 10 dígitos.",
            'kcalories.integer' => "Las calorias deben ser un número entero.",
            'protein.required' => "La proteína és un campo requerido.",
            'protein.max_digits' => "La proteína debe tener como máximo 10 dígitos.",
            'protein.integer' => "La proteína debe ser un número entero.",
            'glucids.required' => "Los glúcidos són un campo requerido.",
            'glucids.max_digits' => "Los glúcidos deben tener como máximo 10 dígitos.",
            'glucids.integer' => "Los glúcidos deben ser un número entero.",
            'lipids.required' => "Los lípidos són un campo requerido.",
            'lipids.max_digits' => "Los lípidos deben tener como máximo 10 dígitos.",
            'lipids.integer' => "Los lípidos deben ser un número entero.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $name = $request->name;
        $measure = $request->measure == '0' ? "ml." : "g.";
        $kcal = $request->kcalories;
        $protein = $request->protein;
        $glucids = $request->glucids;
        $lipids = $request->lipids;

        $alimento = new Aliment;
        $alimento->name = $name;
        $alimento->measure = $measure;
        $alimento->kcal = $kcal;
        $alimento->protein = $protein;
        $alimento->glucids = $glucids;
        $alimento->lipids = $lipids;
        $alimento->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('aliments'),
        ], 200);
    }

    public function edit_aliment(Request $request)
    {
        $rules = [
            'name' => 'max:255|required',
            'measure' => 'required|in:0,1',
            'kcalories' => 'integer|max_digits:10|required',
            'protein' => 'integer|max_digits:10|required',
            'glucids' => 'integer|max_digits:10|required',
            'lipids' => 'integer|max_digits:10|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'name.max' => "El nombre debe tener como máximo 255 caracteres.",
            'name.required' => "El nombre del ejercicio es un campo requerido.",
            'measure.required' => "La medida del alimento es un campo requerido.",
            'measure.in' => "La medida del alimento no tiene un valor válido.",
            'kcalories.required' => "Las calorias són un campo requerido.",
            'kcalories.max_digits' => "Las calorias deben tener como máximo 10 dígitos.",
            'kcalories.integer' => "Las calorias deben ser un número entero.",
            'protein.required' => "La proteína és un campo requerido.",
            'protein.max_digits' => "La proteína debe tener como máximo 10 dígitos.",
            'protein.integer' => "La proteína debe ser un número entero.",
            'glucids.required' => "Los glúcidos són un campo requerido.",
            'glucids.max_digits' => "Los glúcidos deben tener como máximo 10 dígitos.",
            'glucids.integer' => "Los glúcidos deben ser un número entero.",
            'lipids.required' => "Los lípidos són un campo requerido.",
            'lipids.max_digits' => "Los lípidos deben tener como máximo 10 dígitos.",
            'lipids.integer' => "Los lípidos deben ser un número entero.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $name = $request->name;
        $measure = $request->measure == '0' ? "ml." : "g.";
        $kcal = $request->kcalories;
        $protein = $request->protein;
        $glucids = $request->glucids;
        $lipids = $request->lipids;

        $alimento = Aliment::where('id', $request->aliment)->first();

        if (!$alimento) {
            return response()->json([
                'error' => true,
                'messages' => "El alimento seleccionado no existe.",
                "route" => null,
            ], 200);
        }

        $alimento->name = $name;
        $alimento->measure = $measure;
        $alimento->kcal = $kcal;
        $alimento->protein = $protein;
        $alimento->glucids = $glucids;
        $alimento->lipids = $lipids;
        $alimento->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('aliments'),
        ], 200);
    }

    public function edit_exercise(Request $request)
    {
        $rules = [
            'name' => 'max:255|required',
            'muscleGroup' => 'max:255|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'name.max' => "El nombre debe tener como máximo 255 caracteres.",
            'name.required' => "El nombre del ejercicio es un campo requerido.",
            'muscleGroup.required' => "El grupo muscular es un campo requerido.",
            'muscleGroup.max' => "El grupo muscular debe tener como máximo 255 caracteres.",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $name = $request->name;
        $muscleGroup = $request->muscleGroup;

        $ejercicio = Exercise::where('id', $request->exercise)->first();

        if (!$ejercicio) {
            return response()->json([
                'error' => true,
                'messages' => "El ejercicio seleccionado no existe.",
                "route" => null,
            ], 200);
        }

        $ejercicio->name = $name;
        $ejercicio->muscle_group = $muscleGroup;
        $ejercicio->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route" => route('exercises'),
        ], 200);
    }

    public function add_client(Request $request)
    {
        $rules = [
            'name' => 'max:255|required',
            'surname' => 'nullable|max:255',
            'tel' => 'nullable|integer|max:999999999',
            'email' => 'required|email|unique:users|max:255',
            'weight' => 'nullable|numeric|max:999',
            'height' => 'nullable|integer|max:999',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'name.max' => "El nombre debe tener como máximo 255 caracteres.",
            'name.required' => "El nombre del cliente es un campo requerido.",
            'surname.max' => "Los apellidos deben tener como máximo 255 caracteres.",
            'tel.integer' => "El número de teléfono debe ser un número entero (Sin espacios ni caractéres especiales).",
            'weight.max' => "El teléfono debe ser inferior a 999999999.",
            'email.required' => "El email debe de tener cómo máximo 255 caracteres.",
            'email.email' => "El email no tiene un formato correcto.",
            'email.unique' => "Este email ya ha sido registrado.",
            'email.max' => "El email debe tener como máximo 255 caracteres.",
            'weight.max_digits' => "El peso debe ser inferior a 999.",
            'weight.numeric' => "El peso debe ser un número (Kilogramos).",
            'height.max_digits' => "La altura debe ser inferior a 999.",
            'height.integer' => "La altura deve ser un número entero (Centímetros).",
        ]);

        if (!$v->passes()) {
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route" => null,
            ], 200);
        }

        $nutritional_plan = new Nutritional_plan;
        $nutritional_plan->save();

        $training_plan = new Training_plan;
        $training_plan->save();


        $name = $request->name;
        $surname = $request->surname;
        $tel = $request->tel;
        $email = $request->email;
        $weight = $request->weight;
        $height = $request->height;
        $password = Str::random(8);

        $client = new User;
        $client->name = $name;
        $client->surname = $surname;
        $client->tf_number = $tel;
        $client->weight = $weight;
        $client->height = $height;
        $client->email = $email;
        $client->email_verified_at = date("Y-m-d H:i:s");
        $client->role_id = 11;
        $client->disabled = false;
        $client->my_interests = null;
        $client->about_me = null;
        $client->remember_token = null;
        $client->nutritional_plan_id = $nutritional_plan->id;
        $client->training_plan_id = $training_plan->id;
        $client->password = Hash::make($password);
        $client->save();

        $nutritional_plan->user_id = $client->id;
        $nutritional_plan->save();

        $training_plan->user_id = $client->id;
        $training_plan->save();

        Mail::to($client->email)->send(new SendPassword($password, $client));

        return response()->json([
            'error' => false,
            'messages' => $v->messages(),
            "route" => route('clients'),
        ], 200);
    }

    public function ban_client(Request $request)
    {
        $client = User::where('id', $request->client)->where('role_id', '<>', 1)->first();

        if ($client) {
            $client->disabled = !$client->disabled;
            $client->save();

            return response()->json([
                'error' => false,
                'messages' => null,
                "route" => route('clients'),
            ], 200);

        } else {
            return response()->json([
                'error' => true,
                'messages' => 'No hay un cliente con ese identificador.',
                "route" => route('clients'),
            ], 200);
        }
    }
}
