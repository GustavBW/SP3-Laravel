<script>
    window.executeCommand = (name) => {
        console.log("executing command: " + name);
        fetch('http://localhost:8000/machine', {
            method: "post",
            body: JSON.stringify({command: name, autoExecute: true}),
            headers: {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*'
            }
        })
            .then(data => document.getElementById('statusMessage').innerHTML = JSON.parse(data).errorMessage)
            .catch(error => document.getElementById('statusMessage').innerHTML = JSON.parse(error).errorMessage)
    }
</script>

<div style="display:flex; justify-content: center; column-gap: 1vw; padding: 1vh" class="buts">
        <button onclick="executeCommand('reset')" class="buttons">Reset</button>
        <button onclick="executeCommand('start')" class="buttons">Start</button>
        <button onclick="executeCommand('stop')" class="buttons">Stop</button>
        <button onclick="executeCommand('abort')" class="buttons">Abort</button>
        <button onclick="executeCommand('clear')" class="buttons">Clear</button>
    <p id="statusMessage"></p>
</div>



