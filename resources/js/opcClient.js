import {OPCUAClientBase} from "node-opcua";
const { OPCUAClient } = require("node-opcua");

const privateClient = new OPCUAClient.create({});

//client.initialize(url, setErrorText)

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

export const client = {
    nodes: {
        CommandTrigger: "id"
    },
    endpoints: null,
    server: "",
    DEFAULT_SPEED: 1,
    DEFAULT_AMOUNT: 1,
    DEFAULT_BEER: batchType.PILSNER,
    initialize: async (url, callback) => {
        let onConnect = (error) => {
            if(error != null) {
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
    },
    getNode: (node, callback) => {

    }
}


// Connect to server
// Retrieve Endpoints
// Search endpoints setNode(x,x,value) getNode(return node)

