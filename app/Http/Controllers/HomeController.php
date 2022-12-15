<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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
    public function index()
    {

        if (Auth::user()->role_id == 1) {
            return view('trainer.home');
        }else {
            return view('client.home');
        }

    }

    public function profile_index(Request $request)
    {
        return view('auth.profile');
    }

    public function change_about_me(Request $request)
    {
        $token = csrf_token();

        $user = Auth::user();

        $user->my_interests = $request->my_interests;
        $user->about_me = $request->about_me;

        $user->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "token"=>$token,
            "route"=>route('profile')
        ], 200);
    }

    public function change_my_data(Request $request)
    {
        $token = csrf_token();

        $rules = [
            'tel' => 'nullable|integer|max:999999999',
            'weight' => 'nullable|numeric|max:999',
            'height' => 'nullable|integer|max:999',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'tel.max' => "El número de teléfono debe ser inferior a 999999999",
            'tel.integer' => "El número de teléfono debe ser un número entero (Sin espacios ni caractéres especiales).",
            'weight.max' => "El peso debe debe ser inferior a 999.",
            'weight.numeric' => "El peso debe ser un número (Kilogramos).",
            'height.max' => "La altura debe ser inferior a 999.",
            'height.integer' => "La altura deve ser un número entero (Centímetros).",
        ]);

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "token"=>$token,
                "route"=>null
            ], 200);
        }


        $user = Auth::user();

        $user->tf_number = $request->tel;
        $user->weight = $request->weight;
        $user->height = $request->height;

        $user->save();

        return response()->json([
            'error' => false,
            'messages' => null,
            "token"=>$token,
            "route"=>route('profile')
        ], 200);
    }
    public function change_security(Request $request)
    {
        $token = csrf_token();
        $rules = [
            'email' => 'nullable|max:255',
            'password' => 'nullable|max:255'
        ];
        if ((trim($request->email) == null && trim($request->password) == null) || (trim($request->email) == Auth::user()->email  && trim($request->password) == null)) {
            return response()->json([
                'error' => false,
                'messages' => "No se ha modificado ningun dato.",
                "route"=>route('profile')
            ], 200);
        }else if((trim($request->email) != null && trim($request->password) == null)){
            $rules = [
                'email' => 'required|email|unique:users|confirmed|max:255',
                'password' => 'nullable|max:255'
            ];
        }else if((trim($request->email) == null && trim($request->password) != null)){
            $rules = [
                'email' => 'nullable|max:255',
                'password' => 'min:8|max:255|confirmed'
            ];
        }else{
            $rules = [
                'email' => 'required|email|unique:users|confirmed|max:255',
                'password' => 'min:8|max:255|confirmed'
            ];
        }

        $v = Validator::make($request->input(), $rules, $messages = [
            'email.max' => "El email no puede tener más de 255 caracteres.",
            'email.required' => "El email es requerido.",
            'email.email' => "El email no tiene un formato correcto.",
            'email.unique' => "El email ya está registrado.",
            'email.confirmed' => "Los emails no coinciden.",
            'password.max' => "La contraseña no puede tener más de 255 caracteres.",
            'password.required' => "La contraseña es requerida.",
            'password.min' => "La contraseña no puede tener menos de 8 caracteres.",
            'password.confirmed' => "Las contraseñas no coinciden.",

        ]);

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "route"=>null,
                "token"=>$token
            ], 200);
        }
        $user = Auth::user();

        if(trim($request->email) != null){
            $user->email = trim($request->email);
            $user->save();
        }

        if(trim($request->password) != null){
            $user->password=Hash::make(trim($request->password));
            $user->save();
        }

        return response()->json([
            'error' => false,
            'messages' => "Se han cambiado los datos correctamente.",
            "route"=>route('profile'),
            "token"=>$token
        ], 200);
    }

}
