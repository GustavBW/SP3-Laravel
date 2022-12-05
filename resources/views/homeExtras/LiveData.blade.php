<div id="currentData" class="">
    <div id="machineData" class="dataItem border">

        <h1>Live Machine Data</h1>
        <div id="temp" class="machineDataItem">
            <img src="{{asset('imgs/temp.png')}}">
            <h2 class="textFormat">Temperature: 25.0</h2>
            <img src="{{asset('imgs/chart.png')}}" class="chart">
        </div>

        <div id="humedity" class="machineDataItem">
            <img src="{{asset('imgs/humedity.png')}}">
            <h2 class="textFormat">Humedity: 20%</h2>
            <img src="{{asset('imgs/chart.png')}}" class="chart">
        </div>

        <div id="vibrations" class="machineDataItem">
            <img src="{{asset('imgs/vib.png')}}">
            <h2 class="textFormat">Vibrations: 0.0</h2>
            <img src="{{asset('imgs/chart.png')}}" class="chart">
        </div>
    </div>

    <div id="productionInfo" class="dataItem border">
        <h1>Current Batch information</h1>

        <div id="batchId" class="batchInfo">
            <img src="{{asset('imgs/batch.png')}}">
            <h2 class="textFormat">Batch ID: 23473</h2>
            <img src="{{asset('imgs/chart.png')}}" class="chart">
        </div>

        <div id="productionSize" class="batchInfo">
            <img src="{{asset('imgs/beer.png')}}">
            <h2 class="textFormat">Production Size: 500</h2>
            <img src="{{asset('imgs/chart.png')}}" class="chart">
        </div>

        <div id="bpm" class="batchInfo">
            <img src="{{asset('imgs/speed.png')}}">
            <h2 class="textFormat">Beers per minute: 69</h2>
            <img src="{{asset('imgs/chart.png')}}" class="chart">
        </div>
    </div>

    <div id="producedData" class="dataItem border">
        <h1>Current batch</h1>

        <div id="produced" class="batchInfo">
            <img src="{{asset('imgs/batch.png')}}">
            <h2 class="textFormat" id="producedT">Produced: 0</h2>
            <img src="{{asset('imgs/chart.png')}}" class="chart">
        </div>

        <div id="producedSuccess" class="batchInfo">
            <img src="{{asset('imgs/accepted.png')}}">
            <h2 class="textFormat" id="accepted">Accepted: 0</h2>
            <img src="{{asset('imgs/chart.png')}}" class="chart">
        </div>

        <div id="producedFail" class="batchInfo">
            <img src="{{asset('imgs/failed.png')}}">
            <h2 id="failed" class="textFormat">Failed: 0</h2>
            <img src="{{asset('imgs/chart.png')}}" class="chart">
        </div>
    </div>
</div>
<script>
    setTimeout(batch(), 1000)
    var produced = 0;
    var failedB = 0;
    function batch(){
        if(produced >= 500){
            return
        }
        if(produced % 10 === 0){
            failedB+=1
            document.getElementById("failed").innerText = "failed: "+failedB
        }else{
            document.getElementById("accepted").innerText = "accepted: "+(produced-failedB)
        }

        produced+=1;
        document.getElementById("producedT").innerText = "produced: "+produced
        setTimeout(batch, 120)
    }
</script>
