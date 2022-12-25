<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Info;
use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Beer;
use App\Models\FinishedBatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        $id = $this->store($request);
        $json = OPCClientController::executeBatch($id);
        Log::info($json);
    }

    //Show specific batch
    public function show($id)
    {
        $batch = Batch::find($id);
        if($batch == null){
            abort(404);
        }
        return view('batches.show')
            ->with('batch',$batch)
            ->with('result', FinishedBatch::find($id));
    }

    //Not sure if implemented correctly
    public function history()
    {
        $batchResults = FinishedBatch::all();

        return view('batches.history')->with('batchResults', $batchResults);
    }

    public function destroy($id) {
        $batch = Batch::find($id);
        $batch->delete();
        $finishedBatch = DB::Table('finished_batches')->where('batch_id', $id);

        if($finishedBatch!=null) {
            $finishedBatch->delete();
        }

        return redirect()->route('home');
    }

    public function edit($id){
        $batch = Batch::find($id);

        return view('batches.edit')->with('batch', $batch);
    }

    public function update($id, Request $request){
        $batch = Batch::find($id);
        $batch->update([
            'beer_id' => $request->input('beer_id'),
            'production_speed' => $request->input('production_speed'),
            'size' => $request->input('size'),
            'user_id' => Auth::user()->id
        ]);
        
        return redirect()->route('batches', ['id' => $batch->id]);
    }

    public static function storeResultSet($id, $successful, $failed) {
        DB::table('finished_batches')->insert([
            'batch_id'=>$id,
            'successful_products'=>$successful,
            'failed_products' => $failed
        ]);
    }
    public static function getOptimalSpeed($id) {
        $speed = DB::table('beers')->where('id', $id)->value('optimal_production_speed');
        return $speed;
    }
}
