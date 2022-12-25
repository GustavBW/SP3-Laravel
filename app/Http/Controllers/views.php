<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Batch;
use Illuminate\Http\Request;
use App\Models\FinishedBatch;

class views extends Controller
{
    function index(){
        return view("index")->
        with('selected', 'dashboard')->
        with('buttons', True)->
        with('liveData', True)->
        with('serverStatus', OPCClientController::getMachineStatus());
    }

    function brew(){
        $beers = Beer::pluck('optimal_production_speed', 'id');
        return view("brew")->
        with('selected', 'brew');
    }

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
        return view("batches")->
        with('selected', 'batches')->
        with('liveData', false)->with("batches", $batches)->with("options", $options);
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