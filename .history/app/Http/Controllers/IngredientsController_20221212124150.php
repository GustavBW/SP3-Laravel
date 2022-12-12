<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Http\Controllers\OPCClientController;

class IngredientsController extends Controller
{
    function ingredientsFill(Request $request) {
       
        $opc = OpcClientController::getInventoryStatus();
        $barley = json_decode($opc->input("Barley")->input("value"));

        $ingredients = new Ingredients([
            'barley' => $request->input("Barley")->input("value"),
            'hops' => $request->input("Hops")->input("value"),
            'yeast' => $request->input("Yeast")->input("value"),
            'malt' => $request->input("Malt")->input("value"),
            'wheat' => $request->input("Wheat")->input("value")
        ]);
        $ingredients->save();
    }

    function ingredientsUpdate(){

    }
}
