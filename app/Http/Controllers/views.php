<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\User;
use App\Models\Batch;
use Illuminate\Http\Request;
use App\Models\FinishedBatch;
use App\Http\Controllers\OPCClientController;

class views extends Controller
{


    function admin(){
        return view("admin")->
        with('selected', 'admin');
    }

    function batches(){
        $options = array(
            '0' => 'Pilsner',
            '1' => 'Wheat',
            '2' => 'IPA',
            '3' => 'Stout',
            '4' => 'Ale',
            '5' => 'Alcohol Free'
        );

        $batches = Batch::all();
        return view("batches")
            ->with("batches", $batches)
            ->with("options", $options);
    }

    function batch($id){
        $batch = Batch::find($id);
        if($batch == null){
            abort(404);
        }

        return view("batch")->
        with('selected', 'batches')->
        with('batch', $batch)->
        with('result', FinishedBatch::find($id));
    }
}
