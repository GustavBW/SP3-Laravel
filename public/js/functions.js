async function getLiveData(var1){
    if(var1 ===""){
        return
    }

    fetch("/api/"+var1, {
        method: "GET"
    })
        .then(async response => {
            return await response.json();
        })
        .then(json => {
            for (const [key, value] of Object.entries(json)) {

                let progress = document.getElementById(key);
                if(progress !== null){
                    if(key === "current_state" || key === "product_produced" || key === "current_Recipe" || key === "product_failed"){
                        progress.innerText = serverStatus[value]
                    }else {
                        const text = document.getElementById(key+"-text");
                        const full = document.getElementById(key+"-full");

                        progress.value = value
                        text.innerText = key
                        full.innerText = ((value/35000)*100).toFixed(2)+"%"
                    }
                }
            }
        });
}

const serverStatus = {
    0   : 'Deactivated',
    1   : 'Clearing',
    2   : 'Stopped',
    3   : 'Starting',
    4   : 'Idle',
    5   : 'Suspended',
    6   : 'Execute',
    7   : 'Stopping',
    8   : 'Aborting',
    9   : 'Aborted',
    10  : 'Holding',
    11  : 'Held',
    15  : 'Resetting',
    16  : 'Completing',
    17  : 'Complete',
    18  : 'Deactivating',
    19  : 'Activating',
}
