async function inventory() {
  const response = await fetch('http://localhost:4242/client/read?nodeNames=Yeast,Hops,Malt,Barley,Wheat,MaintenanceCounter', {
      method: 'GET'
  });
  if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
  }
  const data = await response.json();
  for (const key in data.first) {
      try {
              document.getElementById(key).value = data.first[key].value.value;
              document.getElementById(key + "-text").innerText = key;
              if(key === 'MaintenanceCounter'){
                  document.getElementById(key + "-full").innerText = (data.first[key].value.value / 35000 * 100).toFixed(2)+"%"
              }else{
                  document.getElementById(key + "-full").innerText = (data.first[key].value.value / 35000 * 100).toFixed(2)+"%"
              }
      } catch (ignored) {
      }
  }
}

async function adminStats() {
  const response = await fetch('http://localhost:4242/client/read?nodeNames=BatchId,CurrentRecipe,ProductsFailed,ProductsProduced', {
      method: 'GET',
      // add any additional headers or body data here
  });
  if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
  }
  const data = await response.json();
  document.getElementById("BatchId").innerText = data.first.BatchId.value.value;
  document.getElementById("CurrentRecipe").innerText = data.first.CurrentRecipe.value.value;
  document.getElementById("ProductsFailed").innerText = data.first.ProductsFailed.value.value;
  document.getElementById("ProductsProduced").innerText = data.first.ProductsProduced.value.value;
}

async function serverStatus() {
  const response = await fetch('http://localhost:4242/client/read?nodeNames=CurrentState', {
      method: 'GET',
  });
  if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
  }
  const data = await response.json();
  document.getElementById("CurrentState").innerText = data.first.CurrentState.value.value;
    if(data.first.CurrentState.value.value === 17){
        fetch('localhost:8000/batch/store/current',{
            method: 'POST'
        })
    }
}
