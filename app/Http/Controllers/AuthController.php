<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;
use Mail;
use Carbon\Carbon;
use DB;
use Hash;
use Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
//use App\Notifications\PasswordRecovery;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login_action(Request $request){
        session()->regenerate();
        $token = csrf_token();
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string'
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'password.required' => "La contraseña es un campo requerido.",
            'password.string' => "La contraseña debe de ser una cadena de caracteres o números.",
            'email.required' => "El email es un campo requerido.",
            'email.email' => "El email no tiene un formato correcto.",
        ]);

        if(!$v->passes()){
            return response()->json([
                'logged' => false,
                'email' => $request->email,
                'messages' => $v->messages(),
                "token"=>$token,
                "route"=>null
            ], 200);
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
        if (Auth::attempt($credentials, ($request->remember == 'on') ? true : false)) {
            if($user->disabled == 0){
                return response()->json([
                    'logged' => true,
                    'email' => $request->input('email'),
                    'messages' => null,
                    "token"=>$token,
                    "route"=>route('home')
                    //'route' => route('index')
                ], 200);
            }else{
                Session::flush();
                Auth::logout();

                return response()->json([
                    'logged' => false,
                    'email' => $request->input('email'),
                    'messages' => "La cuenta a la que intenta acceder ha sido bloqueada.",
                    "token"=>$token,
                    "route"=>null
                ], 200);
            }
        }

        return response()->json([
            'logged' => false,
            'email' => $request->input('email'),
            'messages' => "Los datos introducidos son incorrectos.",
            "token"=>$token,
            "route"=>null
        ], 200);


        //dd($request->email);
    }

    public function logout_action(Request $request){
        Session::flush();

        Auth::logout();

        return redirect()->route('index');
    }
}
