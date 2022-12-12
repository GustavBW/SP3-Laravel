<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    function ingredientsFill() {
        OPCClientController::getInventoryStatus();
        $ingredients = new Ingredients([
            'barley' => $request->barley,
            'hops' => $request->hops,
            'yeast' => $request->yeast,
            'malt' => $request->malt,
            'wheat' => $request->wheat
        ]);
        $ingredients->save();
        
    }
}
