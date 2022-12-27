
<div style="display:flex; justify-content: center; column-gap: 1vw; padding: 1vh" class="buts">
        <a href="{{route('machine.command', ['command' => 'reset', 'autoExecute' => 'true'])}}" class="buttons">Reset</a>
        <a href="{{route('machine.command', ['command' => 'start', 'autoExecute' => 'true'])}}" class="buttons">Start</a>
        <a href="{{route('machine.command', ['command' => 'stop', 'autoExecute' => 'true'])}}" class="buttons">Stop</a>
        <a href="{{route('machine.command', ['command' => 'abort', 'autoExecute' => 'true'])}}" class="buttons">Abort</a>
        <a href="{{route('machine.command', ['command' => 'clear', 'autoExecute' => 'true'])}}" class="buttons">Clear</a>
    <p id="statusMessage"></p>
</div>



