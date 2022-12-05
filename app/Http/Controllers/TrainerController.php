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
