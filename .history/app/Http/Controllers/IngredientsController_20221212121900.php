<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Http\Controllers\OPCClientController;

class IngredientsController extends Controller
{
    function ingredientsFill(Request $request) {
        $request->input("Barley")->input("value");
        foreach($nodes as $node) {
            $object = json_decode($node);

        }
        
        $value = $object->barley();
        $ingredients = new Ingredients([
            'barley' => $nodes->barley,
            'hops' => $nodes->hops,
            'yeast' => $nodes->yeast,
            'malt' => $nodes->malt,
            'wheat' => $nodes->wheat
        ]);
        $ingredients->save();
    }
}
