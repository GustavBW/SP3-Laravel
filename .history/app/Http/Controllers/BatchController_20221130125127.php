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
        return view('/batches/create');
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
            'name' => $request->name,
            'production_speed' => $request->production_speed,
            'recipe' => $request->recipe
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Returns a view showing all queued batches
     * @return View
     */
    public function queue()
    {

    }

    /**
     * Returns a view showing all finished batches and their results
     * @return View
     */
    public function history()
    {

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
