<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Http\Controllers\OPCClientController;

class IngredientsController extends Controller
{
    function ingredientsFill() {
        $nodes = OPCClientController::getInventoryStatus();
        //retunerer en array med alle nodes
        //Vi skal have deres værdier
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
