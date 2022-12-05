<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controller using JS PHP interop to communicate with the opcClient module.
 */
class OPCClientController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Initializes client to connect to given ip.
     * Returns connection status code.
     */
    public function initialize($ip)
    {
        return 200;
    }

    /**
     * Gets the current machine status.
     * @return int
     */
    public function getMachineStatus(): int
    {
        return 69;
    }

    /**
     * Returns an array containing the levels of each resource,
     * in order:
     * @return int[]
     */
    public function getInventoryStatus()
    {
        return [0,1,2,3,4];
    }

    /**
     * Will execute the batch by given id.
     * @param $id
     * @return int
     */
    public function executeBatch($id)
    {
        $batch = Batch::find($id);

        if($batch != null){
            return 200;
        }

        return 404;
    }


}
