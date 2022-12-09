<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPassword;
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
                'messages' => $v->messages()->first(),
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

    public function fg_password(Request $request)
    {
        $token = csrf_token();
        $rules = [
            'email' => 'required|email|exists:users'
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'email.required' => "El email es un campo requerido.",
            'email.email' => "El email no tiene un formato correcto.",
            'email.exists' => "El usuario no existe en nuestra base de datos."
        ]);

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "token"=>$token,
                "route"=>null
            ], 200);
        }

        $user = User::where('email', $request->email)->first();
        $hash = md5($request->email.$user->password);
        //dd(Hash::check(md5($request->email."cye_fg_pw"), $hash));
        $url = route('auth.new-password-hashed', $hash);
        

        Mail::to($request->email)->send(new ForgotPassword($url));

        return response()->json([
            'error' => false,
            'messages' => null,
            "token"=>$token,
            "route"=>null
            //'route' => route('index')
        ], 200);
    }

    public function fg_password_hash(Request $request)
    {
        return view('auth.recovery_password_form')->with('hash', $request->hash);
        
    }

    public function change_password(Request $request){

        $token = csrf_token();
        $rules = [
            'email' => 'required|email|exists:users',
            'new_password' => 'required|min:8|confirmed'
        ];

        $v = Validator::make($request->input(), $rules, $messages = [
            'email.required' => "El email es un campo requerido.",
            'email.email' => "El email no tiene un formato correcto.",
            'email.exists' => "El usuario no existe en nuestra base de datos.",
            'new_password.required' => "La contraseña es un campo requerido.",
            'new_password.min' => "La contraseña debe de tener una longitud superior a 8 caracteres.",
            'new_password.confirmed' => "Las contraseñas no coinciden.",

        ]);

        if(!$v->passes()){
            return response()->json([
                'error' => true,
                'messages' => $v->messages()->first(),
                "token"=>$token,
                "route"=>null
            ], 200);
        }
        
        $user = User::where('email', $request->email)->first();

        $hash = md5($request->email.$user->password);

        if ($hash == $request->hash) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'error' => false,
                'messages' => null,
                "token"=>$token,
                "route"=>route('index')
            ], 200);
        }

        return response()->json([
            'error' => true,
            'messages' => "El hash proporcionado no coincide con el vinculado a tu cuenta.",
            "token"=>$token,
            "route"=>null
        ], 200);
    }
}
