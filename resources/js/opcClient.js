import {OPCUAClientBase} from "node-opcua";
const { OPCUAClient } = require("node-opcua");
const privateClient = new OPCUAClient.create({});

export const batchType = {
    PILSNER: 0,
    WHEAT: 1,
    IPA: 2,
    STOUT: 3,
    ALE: 4,
    ALCOHOL_FREE: 5
};
export const productionState = {
    DEACTIVATED: 0,
    CLEARING: 1,
    STOPPED: 2,
    STARTING: 3,
    IDLE: 4,
    SUSPENDED: 5,
    EXECUTE: 6,
    STOPPING: 7,
    ABORTING: 8,
    ABORTED: 9,
    HOLDING: 10,
    HELD: 11,
    RESETTING: 15,
    COMPLETING: 16,
    COMPLETE: 17,
    DEACTIVATING: 18,
    ACTIVATING: 19
};
const nodePath = "Root/Objects/PLC/Modules/<Default>/Program/Cube/";
export const nodes = {  //Useless. User ns and other stuff instead
    path: nodePath,     //e.g. "ns=6;s=::Program:FillingInventory"
    admin: {
        CurrentRecipe: nodePath + "Admin/Parameter[0]/Value",
        ProductsProduced: nodePath + "Admin/ProdProcessedCount",
        ProductsFailed: nodePath + "Admin/ProdDefectiveCount",
        StopReason: nodePath + "Admin/StopReason/ID"
    },
    status: {
        CurrentState: nodePath + "Status/StateCurrent",
        CurrentProductionSpeed: nodePath + "Status/MachSpeed",
        ProductionSpeed: nodePath + "Status/CurMachSpeed",
        BatchId: nodePath + "Status/Parameter[0]/Value",
        BatchQuantity: nodePath + "Status/Parameter[1]/Value",
        BatchHumidity: nodePath + "Status/Parameter[2]/Value",
        BatchTemperature: nodePath + "Status/Parameter[3]/Value",
        Vibrations: nodePath + "Status/Parameter[4]/Value"
    },
    command: {
        SetSpeed: nodePath + "Command/MachSpeed",
        SetCommand: nodePath + "Command/CntrlCmd",
        Execute: nodePath + "Command/CmdChangeRequest",
        SetBatchId: nodePath + "Command/Parameter[0]/Value",
        SetRecipe: nodePath + "Command/Parameter[1]/Value",
        SetQuantity: nodePath + "Command/Parameter[2]/Value"
    },
    inventory: {
        Barley: nodePath + "Inventory/Barley",
        Hops: nodePath + "Inventory/Hops",
        Malt: nodePath + "Inventory/Malt",
        Wheat: nodePath + "Inventory/Wheat",
        Yeast: nodePath + "Inventory/Yeast"
    },
    maintenance: {
        Counter: nodePath + "Maintenance/Counter",
        Urgent: nodePath + "Maintenance/Trigger"
    }
}

export const client = {
    endpoints: null,
    server: "",
    DEFAULT_SPEED: 1,
    DEFAULT_AMOUNT: 1,
    DEFAULT_BEER: batchType.PILSNER,
    initialize: async (url, callback) => {
        let onConnect = (error) => {
            if(error == null) {
                client.endpoints = privateClient.getEndpoints();
                client.server = url;
            }
            callback(error);
        }
        await privateClient.connect(url, onConnect);
    },
    //executeOrder: (beerType, amount, batchId, callback) => {
        //check status 17
        //Set beer type
        //Set batch size
        //Set batch id
        //Set cmd type start
        //Change cmd request
    //},
    executeOrder: (parameters, callback) => {
        //Check if connected to server. If not, return error
        //set values of null or undefined. (Or not declared on object "parameters")
        parameters.speed = parameters.speed || client.DEFAULT_SPEED;
        parameters.amount = parameters.amount || client.DEFAULT_AMOUNT;
        parameters.beerType = parameters.beerType || client.DEFAULT_BEER;

        //Save batch parameters to database
        let dbEntry = db.save(new BatchOrder(parameters));
        //Get assigned id
        parameters.id = parameters.id || dbEntry.id;

        //set node values

        //return batch id for later queries.
        callback(parameters.id);
    },
    get: async () => {
        return privateClient;
    },
    getInventory: () => {
        return {
            beer1: "function call to opcua server"
        }
    },
    awaitValue: async (node, value, callback) => {

    },
    setNode: (node, value, callback) => {
        //set value of node
        //https://github.com/node-opcua/node-opcua/issues/970
    },
    getNode: (node, callback) => {

    }
}


// Connect to server
// Retrieve Endpoints
// Search endpoints setNode(x,x,value) getNode(return node)

