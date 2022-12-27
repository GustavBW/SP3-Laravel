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

class CommandController extends Controller
{
    public function command($command, $autoExecute)
    {
        OPCClientController::setMachineCommand($command, $autoExecute == 'true');
        return redirect()->route('home')
            ->with('batches', Batch::all())
            ->with('beerTypes', Beer::all());
    }
}
