<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

/**
 * A controller used to interface between a JAVA api using the MILO library to communicate with the server.
 */
class OPCClientController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    static $OpcApiIp = "192.168.0.174"; //replace with ip of API
    static $OpcApiPort = "4242";

    /**
     * Initializes client to connect to the given ip.
     * Returns connection status code as a json string with fields
     * "status" (http response status) and "error" (string).
     *
     * Return json:
     *
     * {
     *      "status": <number>,
     *      "error": <message>
     * }
     */
    public static function initialize($ip, $port)
    {
        $response = Http::dump()
        ->withBody(json_encode(['protocol' => 'opc.tcp', 'ip' => $ip, 'port' => $port]), 'application/json')
        ->post(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client/initialize")
        ->json_decode();
        return $response;
    }

    /**
     * Gets the current machine status as a json string with fields:
     * "machineStatus" (int), "translation" (string), "errorMessage" (string), "vibrations" (uaNode), "faulty" (boolean).
     *
     * Return json:
     *
     * {
     *      "machineStatus": \<number (value of node CurrentState)>,
     *      "translation": <string (what this status means)>,
     *      "errorMessage": <string (any error encountered)>,
     *      "vibrations": <uaNode (JSON-OBJECT), fields: "value", "serverTime", ...>,
     *      "faulty": <boolean (true if there's a fundamental error, say there's no connection)>
     * }
     */
    public static function getMachineStatus()
    {
        $response = Http::get(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client")
        ->json_decode();
        return $response;
    }
    /**
     * Sets the machine's current command to $command.
     * If $autoExecute is true, it will trigger the command change request, executing set command.
     *
     * returns a MachineStatus json object. (as seen above)
     */
    public static function setMachineCommand(String $command, bool $autoExecute)
    {
        return Http::dump()
            ->withBody(json_encode(['autoExecute' => $autoExecute]), 'application/json')
            ->post(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client/" . $command)
            ->json_decode();
    }

    /**
     * Expects a list of names as seen in the Enum "KnownNodes" which can be retrieved from anywhere using the
     * "getResource($name)" method below.
     * If an empty string is given or no string at all, it will return all available nodes.
     *
     * Returns a touple of a Map (key: NodeName, Value: uaNode) and a message containing any errors encountered.
     *
     * Return json:
     *
     * {
     *      "first": {
     *                  "nodeName_1": <uaNode (JSON-OBJECT), fields: "value", "serverTime", ...>,
     *                  "nodeName_2": <uaNode (JSON-OBJECT), fields: "value", "serverTime", ...>,
     *                  ..
     *                  "nodeName_n": <uaNode (JSON-OBJECT), fields: "value", "serverTime", ...>
     *              },
     *      "second": <message>
     * }
     *
     * @param $nodeNames, an underscore separated list of nodeNames.
     */
    public static function readNodes(String $nodeNames)
    {
        return Http::get(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client/read",
        ['nodeNames'=>$nodeNames]);
    }

    /**
     * Writes a value to a node.
     * @param $nodeName String - name of node as seen in KnownNodes accessible from anywhere using the
     * "getResource($name)" method.
     * @param $dataType String - the type of data e.g. int, float, short, long, string or bool
     * @param $value - any. An error will be returned if the node can't be written to OR the type of $value is interpreted incorrectly.
     *
     * Return json:
     *
     * {
     *      "status": <http status code>,
     *      "error": <message>
     * }
     *
     */
    public static function writeToNode(String $nodeName, $value, String $dataType)
    {
        return Http::dump()
        ->withBody(json_encode(['nodeName' => $nodeName, 'value' => $value, 'dataType' => $dataType]), 'application/json')
        ->post(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client/write")
        ->json_decode();
    }

    /**
     * Exactly the same as "readNodes" except it reads the values of specifik nodes, these being:
     * "InventoryIsFilling", "Barley", "Hops", "Malt", "Wheat" and "Yeast" in order.
     * It does this through the preprepared api call "/client/inventory",
     */
    public static function getInventoryStatus()
    {
        return Http::get(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client/inventory");
    }

    /**
     * Returns the information available on a given resource as touple with fields "first" and "second".
     * "first" being the name of the resource, "second" an array of strings.
     * @param String $name
     *
     * Return json:
     *
     * {
     *      "first": <name of resource (string)>
     *      "second": <fields in resource (JSON-ARRAY)>
     * }
     */
    public static function getResource(String $name)
    {
        return Http::get(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client/resource/".$name);
    }

    /**
     * Will execute the batch by given id.
     * @param $id
     *
     * Return json: MachineStatus
     *
     * {
     *      "machineStatus": \<number (value of node CurrentState)>,
     *      "translation": <string (what this status means)>,
     *      "errorMessage": <string (any error encountered)>,
     *      "vibrations": <uaNode (JSON-OBJECT), fields: "value", "serverTime", ...>,
     *      "faulty": <boolean (true if there's a fundamental error, say there's no connection)>
     * }
     */
    public static function executeBatch($id)
    {
        $batch = Batch::find($id);

        if($batch != null){
            return Http::dump()
            ->withBody(json_encode(['id' => $id, 'beerType' => 0, 'batchSize' => $batch->size, 'speed' => $batch->production_speed]), 'application/json')
            ->post(self::$OpcApiIp . ":" . self::$OpcApiPort . "/client/execute")
            ->json_decode();
        }

        return 404;
    }

    /**
     * Retuns a comforting message confirming that the API server is alive and well. If that is the case.
     * Also known as a heartbeat server-stability confirmation.
     */
    public static function sanityCheck()
    {
        return Http::get(self::$OpcApiIp . ":" . self::$OpcApiPort . "/sanity");
    }


}
