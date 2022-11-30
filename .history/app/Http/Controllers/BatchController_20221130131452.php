<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::all();
        return view('batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beers = Beer::all();
        return view('batches.create')->with('beer_id', $beers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $batch = new Batch([
            'beer_id' => $request->beer_id,
            'production_speed' => $request->production_speed,
            'size' => $request->size,
            'user_id' => $request->user_id
        ]);
        
    }

    /**
     * Shows the information available on the batch.
     * Contains BatchResult, if any
     * Contains QueuedBatch, if any
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $batch = Batch::find($id);
        return view('batches.edit')->with('batch', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        $batch->update([
            'beer_id' => $request->beer_id,
            'production_speed' => $request->production_speed,
            'size' => $request->size,
            'user_id' => $request->user_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batch = Batch::find($id);
        $batch->destroy();
        return redirect('index');
    }

    /**
     * Returns a view showing all queued batches
     * @return View
     */
    public function queue()
    {
        $queuedBatches = QueuedBatch::all();
        return view('batches.queue')->with('queuedBatches', $queuedBatches);
    }

    /**
     * Returns a view showing all finished batches and their results
     * @return View
     */
    public function history()
    {
        $batchResults = FinishedBatches::all();
        return view('batches.history')->with('batchResults', $batchResults);
    }

    /**
     * Adds batch by given id to the QueuedBatches table to be executed
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function execute($id)
    {

    }


}
