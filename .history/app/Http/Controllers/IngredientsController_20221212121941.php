<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Http\Controllers\OPCClientController;

class IngredientsController extends Controller
{
    function ingredientsFill(Request $request) {
        
        
        $value = $object->barley();
        $ingredients = new Ingredients([
            'barley' => $request->input("Barley")->input("value"),
            'hops' => $request->input("Hops")->input("value"),
            'yeast' => $nodes->yeast,
            'malt' => $nodes->malt,
            'wheat' => $nodes->wheat
        ]);
        $ingredients->save();
    }
}
