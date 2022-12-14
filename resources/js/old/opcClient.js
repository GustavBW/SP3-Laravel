import {OPCUAClientBase, SessionContext} from "node-opcua";
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

export const nodes = {  //Useless. User ns and other stuff instead "::" er "<Default>"
                        //e.g. "ns=6;s=::Program:FillingInventory"
    admin: {
        CurrentRecipe: "ns=6;s=::Program:Cube.Admin.Parameter[0].Value",
        ProductsProduced: "ns=6;s=::Program:Cube.Admin.ProdProcessedCount",
        ProductsFailed: "ns=6;s=::Program:Cube.Admin.ProdDefectiveCount",
        StopReason: "ns=6;s=::Program:Cube.Admin.StopReason.ID"
    },
    status: {
        CurrentState: "ns=6;s=::Program:Cube.Status.StateCurrent",
        CurrentProductionSpeed: "ns=6;s=::Program:Cube.Status.CurMachSpeed",
        ProductionSpeed: "ns=6;s=::Program:Cube.Status.MachSpeed",
        BatchId: "ns=6;s=::Program:Cube.Status.Parameter[0].Value",
        BatchQuantity: "ns=6;s=::Program:Cube.Status.Parameter[1].Value",
        BatchHumidity: "ns=6;s=::Program:Cube.Status.Parameter[2].Value",
        BatchTemperature: "ns=6;s=::Program:Cube.Status.Parameter[3].Value",
        Vibrations: "ns=6;s=::Program:Cube.Status.Parameter[4].Value"
    },
    command: {
        SetSpeed: "ns=6;s=::Program:Cube.Command.MachSpeed",
        SetCommand: "ns=6;s=::Program:Cube.Command.CntrlCmd",
        Execute: "ns=6;s=::Program:Cube.Command.CmdChangeRequest",
        SetBatchId: "ns=6;s=::Program:Cube.Command.Parameter[0].Value",
        SetRecipe: "ns=6;s=::Program:Cube.Command.Parameter[1].Value",
        SetQuantity: "ns=6;s=::Program:Cube.Command.Parameter[2].Value"
    },
    inventory: {
        isFilling: "ns=6;s=::Program:FillingInventory",
        Barley: "ns=6;s=::Program:Inventory.Barley",
        Hops: "ns=6;s=::Program:Inventory.Hops",
        Malt: "ns=6;s=::Program:Inventory.Malt",
        Wheat: "ns=6;s=::Program:Inventory.Wheat",
        Yeast: "ns=6;s=::Program:Inventory.Yeast"
    },
    maintenance: {
        Counter: "ns=6;s=::Program:Maintenance.Counter",
        Urgent: "ns=6;s=::Program:Maintenance.Trigger"
    }
}

export const client = {
    endpoints: null,
    server: "",
    __session: null,
    DEFAULT_SPEED: 1,
    DEFAULT_AMOUNT: 1,
    DEFAULT_BEER: batchType.PILSNER,
    initialize: async (url, callback) => {
        let onCreateSession = async (error) => {
            callback(error);
        }
        let onConnect = async (error) => {
            if(error == null) {
                client.endpoints = privateClient.getEndpoints();
                client.server = url;
                client.__session = await privateClient.createSession(null,onCreateSession);
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
    executeOrder: async (parameters, callback) => {
        //Check if connected to server. If not, return error
        //set values of null or undefined. (Or not declared on object "parameters")
        let machineCurrentState = await client.getNodeValue(nodes.status.CurrentState,null);
        if(machineCurrentState !== productionState.IDLE){ //Apparently "!==" is the better way to do it but will
                                                            //throw an error if both types aren't int's
            return new Error("Machine is not idle, current state: " + machineCurrentState);
        }

        parameters.speed = parameters.speed || client.DEFAULT_SPEED;
        parameters.amount = parameters.amount || client.DEFAULT_AMOUNT;
        parameters.beerType = parameters.beerType || client.DEFAULT_BEER;

        //Save batch parameters to database
        let dbEntry = db.save(new BatchOrder(parameters));
        //Get assigned id
        parameters.id = parameters.id || dbEntry.id;

        await client.setNodeValue(nodes.command.SetSpeed,parameters.speed,null,null,null);
        await client.setNodeValue(nodes.command.SetQuantity,parameters.amount, null, null, null);
        await client.setNodeValue(nodes.command.SetRecipe, parameters.beerType, null, null, null);


        await client.setNodeValue(nodes.command.Execute,true, null, null, null);
        //set node values

        //return batch id for later queries.
        callback(parameters.id);
    },
    get: async () => {
        return privateClient;
    },
    getInventory: () => {
        return {
            Barley: client.getNodeValue(nodes.inventory.Barley,null),
            Wheat: client.getNodeValue(nodes.inventory.Wheat, null),
            Hops: client.getNodeValue(nodes.inventory.Hops, null),
            Malt: client.getNodeValue(nodes.inventory.Malt, null),
            Yeast: client.getNodeValue(nodes.inventory.Yeast, null)
        }
    },
    awaitValue: async (node, value, callback) => {

    },
    setNodeValue: async (nodeId, value, indexRange, attributeId, callback) => {
        //set value of node
        //https://github.com/node-opcua/node-opcua/issues/970
        const writeValueOptions = {
            nodeId: nodeId,
            value: value,
            indexRange: indexRange,
            attributeId: attributeId
        };
        await client.__session.write(writeValueOptions, callback);
        //privateClient.createSession().then(e => e.write)
    },
    getNodeValue: async (nodeId, callback) => {
        let result = null;
        let func = (value) => {
            result = value;
            callback(value);
        }
        await client.__session.read(nodeId,callback);
        return result.value;
        //privateClient.createSession().then(e => e.read())
    }
}


// Connect to server
// Retrieve Endpoints
// Search endpoints setNode(x,x,value) getNode(return node)

