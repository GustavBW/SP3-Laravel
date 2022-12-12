<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Beer;
use App\Models\FinishedBatch;

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
        $batch->save();
        return redirect('batch');
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
        $batch = Batch::find($id);
        return view('batches.show', compact('batch'));
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
        return view('batches.edit')->with('batch', $batch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $batch = Batch::find($id);
        $batch->update([
            'beer_id' => $request->beer_id,
            'production_speed' => $request->production_speed,
            'size' => $request->size,
            'user_id' => $request->user_id
        ]);
        return redirect('batch');
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
        return redirect('batch');
    }

    /**
     * Returns a view showing all queued batches
     * @return View
     */
    /**public function queue()
    {
        $queuedBatches = QueuedBatch::all();
        return view('batches.queue')->with('queuedBatches', $queuedBatches);
    }*/

    /**
     * Returns a view showing all finished batches and their results
     * @return View
     */
    public function history()
    {
        $batchResults = FinishedBatch::all();
        return view('batches.history')->with('batchResults', $batchResults);
    }

    /**
     * Adds batch by given id to the QueuedBatches table to be executed
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function execute($id)
    {
        /**$batch = Batch::find($id);
        $queuedBatch = new QueuedBatch([
            'batch_id' => $batch->id
        ]);
        $queuedBatch->save();
        return redirect('batches.queue')->with('queuedBatches', QueuedBatch::all());*/
    }


}
