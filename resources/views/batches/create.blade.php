@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/brew.css')}}">
@endsection
@section("body")
    <div id="content">
    <h1>Brew</h1>
        <form style="row-gap: 1vh; display: grid;" action="{{ route('batch.store') }}" method="post">
            @csrf
            <label for="beerType">Select Type</label>
            <select onchange="beerType()" id="beerType" name="beerType">
            <option disabled selected value = "0">Select beer type</option>
            @foreach($beers as $name => $value)
                    <option value="{{ $value }}">{{ $name }}</option>
                    @endforeach
            </select>

            <label for="quantity">Select batch size</label>
            <input name="size"type="number" id="quantity" placeholder="quantity" value="300" onkeyup="updateSpeed()"/>
            <label for="speedC" id="speed-display">Current speed:</label>
            <input name="speed" type="number" id="speedC" value="50" onkeyup="changeSpeed()"/>
            <label for="speed"></label>
            <input type="range" id="speed" min="1" max="600" value="300" oninput="updateSpeed()"/>

            <div style="display: flex;">
                <input type="checkbox" id="checkbox" name="checkbox" >
                <label for="checkbox">Run at optimal speed</label>
            </div>

            <p id="timerTakes">Est time: </p>
            <button type="submit">Add production</button>
        </form>
    </div>
@endsection
@section("script")
    <script>
        document.getElementById("beerType").value = 0
        const range = document.getElementById('speed');
        const num = document.getElementById('speedC');
        const checkbox = document.getElementById('checkbox');
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                switch (document.getElementById("beerType").value) {
                case "1": //Pilsner
                    changeSpeedVal({{App\Http\Controllers\BatchController::getOptimalSpeed(1)}})
                    break
                case '2': //Wheat
                    changeSpeedVal({{App\Http\Controllers\BatchController::getOptimalSpeed(2)}})
                    break
                case '3': //IPA
                    changeSpeedVal({{App\Http\Controllers\BatchController::getOptimalSpeed(3)}})
                    break
                case '4': //Stout
                    changeSpeedVal({{App\Http\Controllers\BatchController::getOptimalSpeed(4)}})
                    break
                case '5': //Ale
                    changeSpeedVal({{App\Http\Controllers\BatchController::getOptimalSpeed(5)}})
                    break
                case '6': //Alcohol Free
                    changeSpeedVal({{App\Http\Controllers\BatchController::getOptimalSpeed(6)}})
                    break
                }
                range.disabled = true;
            } else {
                range.disabled = false;
                num.disabled = false;
            }
        });

        function write(variable, type){
            fetch('http://localhost:5000/api/write/'+type, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    value: variable,
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error(error);
                });
        }


        updateSpeed()

        function beertype(){
            switch (document.getElementById("beerType").value) {
                case "0": //Pilsner
                    speed({{App\Http\Controllers\BatchController::getMaxSpeed(1)}})
                    break
                case '1': //Wheat
                    speed({{App\Http\Controllers\BatchController::getMaxSpeed(2)}})
                    break
                case '2': //IPA
                    speed({{App\Http\Controllers\BatchController::getMaxSpeed(3)}})
                    break
                case '3': //Stout
                    speed({{App\Http\Controllers\BatchController::getMaxSpeed(4)}})
                    break
                case '4': //Ale
                    speed({{App\Http\Controllers\BatchController::getMaxSpeed(5)}})
                    break
                case '5': //Alcohol Free
                    speed({{App\Http\Controllers\BatchController::getMaxSpeed(6)}})
                    break
            }
        }

        function speed(maxSpeed){
            formerMax = document.getElementById("speed").max
            value = document.getElementById("speed").value
            document.getElementById("speed").max = maxSpeed
            if(value > maxSpeed){
                document.getElementById("speed").value = maxSpeed
            }
            updateSpeed()
        }

        function changeSpeedVal(val){
            document.getElementById("speed").value = val
            updateSpeed()
        }

        function changeSpeed(){
            document.getElementById("speed").value = document.getElementById("speedC").value
            updateSpeed()
        }

        function updateSpeed() {
            let speed = document.getElementById('speed').value;
            document.getElementById('speedC').value = speed;
            estTime()
        }

        function estTime(){
            var quantity = document.getElementById("quantity").value
            var speed = document.getElementById('speed').value

            seconds = (quantity/speed)*60
            var minutes = Math.floor(seconds / 60);
            var hours = Math.floor(minutes / 60);

            // Calculate the remaining seconds
            var remainingSeconds = Math.floor(seconds % 60);
            minutes %= 60

            answer = "Est time: H:"+hours+" M:"+minutes+" S:"+remainingSeconds

            document.getElementById("timerTakes").innerText = answer
            return answer
        }

        function post(){
            estTimeVar = ""
            switch (document.getElementById("beerType").value) {
                case "0": //Pilsner
                    estTimeVar = trueCost(4,2,1,4,1)
                    break
                case '1': //Wheat
                    estTimeVar = trueCost(1,4,1,3,6)
                    break
                case '2': //IPA
                    estTimeVar = trueCost(4,1,5,1,4)
                    break
                case '3': //Stout
                    estTimeVar = trueCost(3,4,6,2,1)
                    break
                case '4': //Ale
                    estTimeVar = trueCost(4,6,2,8,2)
                    break
                case '5': //Alcohol Free
                    estTimeVar = trueCost(1,1,4,0,5)
                    break
            }
            const obj = {
                "beerType": document.getElementById("beerType").value,
                "speed": document.getElementById("speed").value,
                "size": document.getElementById("quantity").value
            };
            fetch('{{route("batch.store")}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(obj)
            })
                .then(response => response.json())
                .then(data => console.table(data));
        }

        function trueCost(barley, hops, malt, yeast, wheat){
            quantity = document.getElementById("quantity").value

            const ingredients = new Map();

            ingredients.set('barley', quantity * barley);
            ingredients.set('hops', quantity * hops);
            ingredients.set('malt', quantity * malt);
            ingredients.set('yeast', quantity * yeast);
            ingredients.set('wheat', quantity * wheat);
            func("barley", ingredients)
            func("hops", ingredients)
            func("malt", ingredients)
            func("yeast", ingredients)
            func("wheat", ingredients)
        }

        function func(var1, ingredients){
            console.log((var1).innerText = var1+": "+ ingredients.get(var1))
        }
        document.getElementById("brew").classList.add("selected");
    </script>
@endsection
