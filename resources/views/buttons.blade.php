
<div style="display:flex; justify-content: center; column-gap: 1vw; padding: 1vh" class="buts">
        <button onclick="executeCommand('reset')" class="buttons">Reset</button>
        <button onclick="executeCommand('start')" class="buttons">Start</button>
        <button onclick="executeCommand('stop')" class="buttons">Stop</button>
        <button onclick="executeCommand('abort')" class="buttons">Abort</button>
        <button onclick="executeCommand('clear')" class="buttons">Clear</button>
    <p id="statusMessage"></p>
</div>

<script>
    function executeCommand (name) {
        fetch({{route('machine.command')}}, {
            method: "post",
            body: JSON.stringify({command: name, autoExecute: true})
        })
            .then(data => document.getElementById('statusMessage').innerHTML = (data.json()).errorMessage)
            .catch(error => document.getElementById('statusMessage').innerHTML = (error.json()).errorMessage)
    }
</script>

