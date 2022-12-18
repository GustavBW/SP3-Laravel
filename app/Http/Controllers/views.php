<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Batch;
use Illuminate\Http\Request;

class views extends Controller
{
    function index(){
        return view("index")->
        with('selected', 'dashboard')->
        with('buttons', True)->
        with('liveData', True);
    }

    function brew(){
        return view("brew")->
        with('selected', 'brew')->
        with('buttons', True)->
        with('liveData', True);
    }

    function admin(){
        return view("admin")->
        with('selected', 'admin')->
        with('buttons', True)->
        with('liveData', True);
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
        with('buttons', false)->
        with('liveData', false)->with("batches", $batches)->with("options", $options);
    }

    function batch($id){

        $machineData = array(
            'type' => 'Pilsner',
            'speed' => 300,
            'startedBy' => User::where('id', 1)->value('name'),
            'status' => "completed",
            'failed' => 99,
            'sucess' => 201,
            'size' => 300,
        );


        return view("batch")->
        with('selected', 'batches')->
        with('buttons', false)->
        with('liveData', false)->
        with('batchId', $id)->
        with('machineData', $machineData);
    }


    ////api
    ///
    ///
    function getDash(){
        $url = "hops:yeast:malt:wheat:barley:maintenance:current_state";
        return $this->get($url);
    }

    function getAdmin(){
        $url = "product_produced:current_Recipe:product_failed:current_state";
        return $this->get($url);
    }

    function getServerS(){
        $url = "current_state";
        return $this->get($url);
    }

    function get($id){
        $url = "http://localhost:5000/api/read/" . $id;
        return file_get_contents($url);
    }

    function post(Request $request){
        $data = $request->json();
    }

    function sendCommand($command){
        Log::info($command);
        // Set the URL of the server you want to send the request to
        $url = 'http://localhost:5000/api/write/set_command';

        $data = "";

        switch ($command) {
            case "reset":
                $data = $this->toArray(1);
                break;
            case "start":
                $data = $this->toArray(2);
                break;
            case "stop":
                $data = $this->toArray(3);
                break;
            case "abort":
                $data = $this->toArray(4);
                break;
            case "clear":
                $data = $this->toArray(5);
                break;
        }
        $response = Http::post($url, $data);
        return $response;
    }

    function toArray($value){
        return array("value" => $value);
    }

    function brewP(request $request){
        /*
         * json object
         * beerType number
         * speed
         * size
         */
    }
}
