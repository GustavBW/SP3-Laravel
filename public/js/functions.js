async function getLiveData(fetchCall) {
    const response = await fetchCall;
    const data = await response.json();
    const { first: nodes, second: message } = data;
    if (Object.keys(nodes).length === 0) {
      return;
    }
  
    for (const [nodeName, node] of Object.entries(nodes)) {
      let progress = document.getElementById(nodeName);
      if (progress !== null) {
        if (
          nodeName === "current_state" ||
          nodeName === "product_produced" ||
          nodeName === "current_Recipe" ||
          nodeName === "product_failed"
        ) {
          progress.innerText = serverStatus[node.value];
        } else {
          const text = document.getElementById(`${nodeName}-text`);
          const full = document.getElementById(`${nodeName}-full`);
  
          progress.value = node.value;
          text.innerText = nodeName;
          full.innerText = `${(node.value / 35000) * 100
  
        }
      }
    }
  }

/*async function getLiveData(var1){
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
}*/

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
