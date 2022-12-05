<div id="commands">
    <div id="normatButtons">
        <button class="commandButton" onclick="brewerOpen()">Start new beer production</button>
        <button class="commandButton">que</button>
        <button class="commandButton" onclick="show()">More commands</button>
    </div>

    <div id="extracommands" class="isup">
        <button class="commandButton">Start</button>
        <button class="commandButton">reset</button>
        <button class="commandButton">stop</button>
        <button class="commandButton">abort</button>
        <button class="commandButton">clear</button>
    </div>
</div>
<script>
    let shownC = false;
    function show(){
        if(shownC){
            document.getElementById("extracommands").style.opacity = 0
            shownC = false
        }else {
            shownC = true
            document.getElementById("extracommands").style.opacity = "100%"
        }
    }
</script>
