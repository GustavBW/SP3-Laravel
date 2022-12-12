<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    function ingredientsFill() {
        $nodes = OPCClientController::getInventoryStatus();
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
