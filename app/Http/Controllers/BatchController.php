<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Info;
use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Beer;
use App\Models\FinishedBatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BatchController extends Controller
{
    //Return view of all batches
    public function index()
    {
        $batches = Batch::all();
        return view('batches.index')->with('batches', $batches);
    }

    //Create batch with specific beer id
    public function create()
    {
        $beers = Beer::pluck('id');
        return view('batches.create')->with('beer_id', $beers);
    }



    //Store created batch
    public function store(Request $request)
    {
        $batch = new Batch();
        $batch->beer_id = $request->input('beer_id');
        $batch->production_speed = $request->input('production_speed');
        $batch->size = $request->input('size');
        $batch->user_id = Auth::user()->id;
        $batch->save();

        return $batch->id;
    }
    public function storeAndExecute($request)
    {
        /*$id = $this->store($request);
        $json = OPCClientController::executeBatch($id);
        Log::info($json);*/
    }

    //Show specific batch
    public function show($id)
    {
        $batch = Batch::find($id);
        if($batch == null){
            abort(404);
        }
        return view('batch')
            ->with('batch',$batch)
            ->with('result', FinishedBatch::find($id));
    }

    //Not sure if implemented correctly
    public function history()
    {
        $batchResults = FinishedBatch::all();
        return view('batches.history')->with('batchResults', $batchResults);
    }
}
