async function inventory() {
  console.log("called");
  const response = await fetch('http://localhost:8000/api/read/inventory', {
      method: 'GET'
  });
  if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
  }
  const data = await response.json();
  for (const key in data.first) {
      try {
          if (!(key === "InventoryIsFilling")) {
              document.getElementById(key).value = data.first[key].value.value;
              document.getElementById(key + "-text").innerText = key;
              document.getElementById(key + "-full").innerText =
                  (data.first[key].value.value / 35000 * 100).toFixed(2)+"%"
          }
      } catch (ignored) {}
  }
}

async function adminStats() {
  const response = await fetch('http://localhost:8000/api/read/nodes/BatchId,CurrentRecipe,ProductsFailed,ProductsProduced', {
      method: 'GET',
      // add any additional headers or body data here
  });
  if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
  }
  const data = await response.json();
  x = 60000/data.first.ProductionSpeed.value.value
  //console.table(data.first);
  document.getElementById("BatchId").innerText = data.first.BatchId.value.value;
  document.getElementById("CurrentRecipe").innerText = data.first.CurrentRecipe.value.value;
  document.getElementById("ProductsFailed").innerText = data.first.ProductsFailed.value.value;
  document.getElementById("ProductsProduced").innerText = data.first.ProductsProduced.value.value;
}

async function isDone() {
  const response = await fetch('http://localhost:8000/api/read/nodes/CurrentState', {
      method: 'GET',
      // add any additional headers or body data here
  });
  if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
  }
  const data = await response.json();
  let state = data.first.CurrentState.value.value;
  if(state === 17){
      console.log('done')
  }else if(state === 6){
      console.log('not done')
  }
}

async function serverStatus() {
  const response = await fetch('http://localhost:8000/api/read/nodes/CurrentState', {
      method: 'GET',
      // add any additional headers or body data here
  });
  if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
  }
  const data = await response.json();
  x = 60000/data.first.ProductionSpeed.value.value
  document.getElementById("CurrentState").innerText =
      data.first.CurrentState.value.value;
}