<div class="holder" id="brewerDiv">
    <form class="FormBrewer">
        <a class="close" onclick="brewerClose()">Close</a>
        <h3>Brew new beer</h3>
        <select>
            <option>Beer Type</option>
            <option>Pilsner</option>
            <option>Ipa</option>
            <option>Lager</option>
        </select>
        <input type="number" placeholder="Beer Production Size">
        <a onclick="showAdvancedB()">Advanced</a>
        <section id="advancedSection">
            <p>Production speed</p>
            <input type="range" min="0" max="200" value="100" oninput="rangeValue.innerText = this.value">
            <p id="rangeValue">100</p>
        </section>
        <button>Start new brew</button>
    </form>
</div>
<script>
    let showAdvanced = true;

    function showAdvancedB(){
        if(showAdvanced){
            document.getElementById("advancedSection").style.opacity = "100%";
            showAdvanced = false;
        }else{
            document.getElementById("advancedSection").style.opacity = 0;
            showAdvanced = true;
        }
    }


    function brewerOpen(){
        document.getElementById("brewerDiv").style.opacity = "100%";
        document.getElementById("brewerDiv").style.zIndex = 100;
    }

    function brewerClose(){
        document.getElementById("brewerDiv").style.opacity = 0;
        document.getElementById("brewerDiv").style.zIndex = -1000;
    }
</script>
