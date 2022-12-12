<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Http\Controllers\OPCClientController;

class IngredientsController extends Controller
{
    function ingredientsFill()
    {
        // Create an instance of the OPCClientController class
        $opcClient = new OPCClientController();

        // Get the response from the getInventoryStatus() method
        $response = $opcClient->getInventoryStatus();

        // Use the json_decode() function to convert the JSON string into a PHP object
        $responseData = json_decode($response);

        // Create an Ingredients object and initialize its properties using the values from the response data
        $ingredients = new Ingredients([
            'barley' => $responseData->barley,
            'hops' => $responseData->hops,
            'yeast' => $responseData->yeast,
            'malt' => $responseData->malt,
            'wheat' => $responseData->wheat,
        ]);
        $ingredients->save();

        return $ingredients;
    }
}

//to get individuel values from the ingredients object use ->
// $ingredients->barley or $ingredients->hops   etc.

