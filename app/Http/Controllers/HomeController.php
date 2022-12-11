<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

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
        return view('trainer.home');
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
            "route"=>route('profile')
        ], 200);
    } 
    
    public function change_my_data(Request $request)
    {
        $token = csrf_token();

        $rules = [
            'tel' => 'nullable|integer|max_digits:9',
            'weight' => 'nullable|numeric|max:999',
            'height' => 'nullable|integer|max:999',
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'tel.max_digits' => "El número de teléfono debe tener como máximo 9 dígitos.",
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
            "route"=>route('profile')
        ], 200);
    }  
}
