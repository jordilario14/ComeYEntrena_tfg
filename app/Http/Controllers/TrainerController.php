<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Exercise;
use App\Models\Aliment;

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

    public function remove_exercise(Request $request)
    {
        $exercise = Exercise::where('id', $request->exercise)->first();

        if ($exercise) {
            $exercise->delete();

            return response()->json([
                'error' => false,
                'messages' => null,
                "route"=>route('exercises')
            ], 200);

        }else{
            return response()->json([
                'error' => true,
                'messages' => 'No hay un ejercicio con ese identificador.',
                "route"=>route('exercises')
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
                "route"=>route('aliments')
            ], 200);

        }else{
            return response()->json([
                'error' => true,
                'messages' => 'No hay un alimento con ese identificador.',
                "route"=>route('aliment')
            ], 200);
        }
    }

    public function add_exercise(Request $request)
    {
        $rules = [
            'name' => 'max:255|required',
            'muscleGroup' => 'max:255|required'
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'name.max' => "El nombre debe tener como máximo 255 caracteres.",
            'name.required' => "El nombre del ejercicio es un campo requerido.",
            'muscleGroup.required' => "El grupo muscular es un campo requerido.",
            'muscleGroup.max' => "El grupo muscular debe tener como máximo 255 caracteres.",
        ]);

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages(),
                "route"=>null
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
            'messages' => $v->messages(),
            "route"=>route('exercises')
        ], 200);
    }

    public function add_aliment(Request $request)
    {
        $rules = [
            'name' => 'max:255|required',
            'kcalories' => 'integer|max_digits:10|required',
            'protein' => 'integer|max_digits:10|required',
            'glucids' => 'integer|max_digits:10|required',
            'lipids' => 'integer|max_digits:10|required'
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'name.max' => "El nombre debe tener como máximo 255 caracteres.",
            'name.required' => "El nombre del ejercicio es un campo requerido.",
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

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages(),
                "route"=>null
            ], 200);
        }



        $name = $request->name;
        $kcal = $request->kcalories;
        $protein = $request->protein;
        $glucids = $request->glucids;
        $lipids = $request->lipids;

        $alimento = new Aliment;
        $alimento->name = $name;
        $alimento->kcal = $kcal;
        $alimento->protein = $protein;
        $alimento->glucids = $glucids;
        $alimento->lipids = $lipids;
        $alimento->save();

        return response()->json([
            'error' => false,
            'messages' => $v->messages(),
            "route"=>route('aliments')
        ], 200);
    }

    public function edit_aliment(Request $request)
    {
        $rules = [
            'name' => 'max:255|required',
            'kcalories' => 'integer|max_digits:10|required',
            'protein' => 'integer|max_digits:10|required',
            'glucids' => 'integer|max_digits:10|required',
            'lipids' => 'integer|max_digits:10|required'
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'name.max' => "El nombre debe tener como máximo 255 caracteres.",
            'name.required' => "El nombre del ejercicio es un campo requerido.",
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

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages(),
                "route"=>null
            ], 200);
        }

        $name = $request->name;
        $kcal = $request->kcalories;
        $protein = $request->protein;
        $glucids = $request->glucids;
        $lipids = $request->lipids;

        $alimento = Aliment::where('id', $request->aliment)->first();

        if (!$alimento) {
            return response()->json([
                'error' => true,
                'messages' => "El alimento seleccionado no existe.",
                "route"=>null
            ], 200);
        }

        $alimento->name = $name;
        $alimento->kcal = $kcal;
        $alimento->protein = $protein;
        $alimento->glucids = $glucids;
        $alimento->lipids = $lipids;
        $alimento->save();

        return response()->json([
            'error' => false,
            'messages' => $v->messages(),
            "route"=>route('aliments')
        ], 200);
    }


    public function edit_exercise(Request $request)
    {
        $rules = [
            'name' => 'max:255|required',
            'muscleGroup' => 'max:255|required'
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'name.max' => "El nombre debe tener como máximo 255 caracteres.",
            'name.required' => "El nombre del ejercicio es un campo requerido.",
            'muscleGroup.required' => "El grupo muscular es un campo requerido.",
            'muscleGroup.max' => "El grupo muscular debe tener como máximo 255 caracteres.",
        ]);

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages(),
                "route"=>null
            ], 200);
        }

        $name = $request->name;
        $muscleGroup = $request->muscleGroup;

        $ejercicio = Exercise::where('id', $request->exercise)->first();

        if (!$ejercicio) {
            return response()->json([
                'error' => true,
                'messages' => "El ejercicio seleccionado no existe.",
                "route"=>null
            ], 200);
        }


        $ejercicio->name = $name;
        $ejercicio->muscle_group = $muscleGroup;
        $ejercicio->save();

        return response()->json([
            'error' => false,
            'messages' => $v->messages(),
            "route"=>route('exercises')
        ], 200);
    }
}
