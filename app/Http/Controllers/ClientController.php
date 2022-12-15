<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Aliment;
use App\Models\Exercise;
class ClientController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_CLIENT');

    }

    public function pn_client(Request $request)
    {
        $client = Auth::user();
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


        return view('client.nutri_plan')->with([
            'user' => $client,
            'aliments' => $aliments,
            'macros' => $pn_macros
        ]);
    }
    public function pe_client(Request $request)
    {
        $exercises = Exercise::get();
        return view('client.train_plan')->with([
            'user' => Auth::user(),
            'exercises' => $exercises
        ]);
    }
}
