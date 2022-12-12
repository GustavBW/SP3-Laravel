<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

/**
 * Controller using JS PHP interop to communicate with the opcClient module.
 */
class OPCClientController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    static $OpcApiIp = "10.126.71.25";
    static $OpcApiPort = "4242";

    /**
     * Initializes client to connect to given ip.
     * Returns connection status code.
     */
    public function initialize($ip, $port)
    {
        $response = Http::post(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client/initialize",
        ['protocol' => 'opc.tcp', 'ip' => $ip, 'port' => $port]);
        return $response;
    }

    /**
     * Gets the current machine status.
     * @return httpResponse
     */
    public function getMachineStatus()
    {
        $response = Http::get(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client");
        return $response;
    }

    /**
     * Returns an array containing the levels of each resource,
     * in order:
     * @return
     */
    public function getInventoryStatus()
    {
        $response = Http::get(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client/read",
        ['nodeNames' => 'InventoryIsFilling_Barley_Hops_Malt_Wheat_Yeast']);
        return $response;
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
