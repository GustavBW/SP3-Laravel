<?php

namespace App\Http\Controllers;

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

}
