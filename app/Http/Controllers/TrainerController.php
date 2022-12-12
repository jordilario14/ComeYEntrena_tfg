<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Exercise;
use App\Models\Aliment;
use App\Models\Meal;

use App\Models\User;
use App\Models\Nutritional_plan;

use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Str;
use App\Mail\SendPassword;
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
    }

    public function add_aliment_pn(Request $request)
    {
        dd($request);
    }

    public function nutritional_plan_index(Request $request)
    {
        $client = User::where('id', $request->client)->first();
        $aliments = Aliment::get();
        return view('trainer.nutri_plan')->with([
            'user' => $client,
            'aliments' => $aliments
        ]);
    }

    public function add_meal(Request $request)
    {
        $rules = [
            'meal_note' => 'max:255|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'meal_note.max' => "El nombre debe tener como máximo 255 caracteres.",
            'meal_note.required' => "El nombre del ejercicio es un campo requerido.",
        ]);

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route"=>null
            ], 200);
        }

        $nutritional_plan = Nutritional_plan::where('id', $request->nutri_plan)->first();
        if($nutritional_plan == null){
            return response()->json([
                'error' => true,
                'messages' => "El cliente no tiene creado un plan nutricional.",
                "route"=>null
            ], 200);
        }

        $meal = new Meal;
        $meal->meal_note = $request->meal_note;
        $meal->nutritional_plan_id = $nutritional_plan->id;
        $meal->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route"=>route('nutritional-plan', $meal->nutritional_plan->user->id)
        ], 200);
    }

    public function edit_meal(Request $request)
    {
        $rules = [
            'meal_note' => 'max:255|required',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'meal_note.max' => "El nombre debe tener como máximo 255 caracteres.",
            'meal_note.required' => "El nombre del ejercicio es un campo requerido.",
        ]);

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route"=>null
            ], 200);
        }

        $meal = Meal::where('id', $request->meal_id)->first();

        if($meal == null){
            return response()->json([
                'error' => true,
                'messages' => "Esa comida no se ha encontrado en la base de datos.",
                "route"=>null
            ], 200);
        }

        $meal->meal_note = $request->meal_note;
        $meal->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "route"=>route('nutritional-plan', $meal->nutritional_plan->user->id)
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
                'messages' => $v->messages()->first(),
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
            'messages' => null,
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
                'messages' => $v->messages()->first(),
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
            'messages' => null,
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
                'messages' => $v->messages()->first(),
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
            'messages' => null,
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
                'messages' => $v->messages()->first(),
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
            'messages' => null,
            "route"=>route('exercises')
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

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route"=>null
            ], 200);
        }

        $nutritional_plan = new Nutritional_plan;

        $nutritional_plan->save();

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
        $client->remember_token=null;
        $client->nutritional_plan_id = $nutritional_plan->id;
        $client->password=Hash::make($password);
        $client->save();

        $nutritional_plan->user_id = $client->id;
        $nutritional_plan->save();

        Mail::to($client->email)->send(new SendPassword($password, $client));

        return response()->json([
            'error' => false,
            'messages' => $v->messages(),
            "route"=>route('clients')
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
                "route"=>route('clients')
            ], 200);

        }else{
            return response()->json([
                'error' => true,
                'messages' => 'No hay un cliente con ese identificador.',
                "route"=>route('clients')
            ], 200);
        }
    }
}
