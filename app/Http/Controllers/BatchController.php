<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Beer;
use App\Models\FinishedBatch;

class BatchController extends Controller
{

    //Return view of all batches
    public function index()
    {
        $batches = Batch::all();
        return view('batches.index', compact('batches'));
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
        Batch::create([
            'beer_id' => $request->beer_id,
            'production_speed' => $request->production_speed,
            'size' => $request->size,
            'user_id' => $request->user_id
        ]);
        return redirect('batch');
    }
  
    //Show specific batch
    public function show($id)
    {
        $batch = Batch::findOrFail($id);
        return view('batches.show', compact('batch'));
    }

    //Not sure if implemented correctly
    public function history()
    {
        $batchResults = FinishedBatch::all();
        return view('batches.history')->with('batchResults', $batchResults);
    }
}
