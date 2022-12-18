@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/batch.css')}}">
@endsection

@section("body")
    <a href="{{route('batches')}}">Back</a>
    <div class="batchInfo">
        <h1>Batch</h1>
    </div>
    <div class="batchInfo center">
        <div class="item info">
            <div>
                <h2>Batch info</h2>
                <h3>Batch ID: {{$batchId}}</h3>
                <h3>Type: {{$machineData['type']}}</h3>
                <h3>Speed: {{$machineData['speed']}}</h3>
                <h3>Started by: {{$machineData['startedBy']}}</h3>
                <h3>Batch status: {{$machineData['status']}}</h3>
            </div>
        </div>
        <div class="chart item">
                <h4>Total Production: {{$machineData['size']}}</h4>
                <canvas id="doughnut"></canvas>
                <canvas id="myChart"></canvas>
        </div>
        <div class="item">

        </div>
    </div>
@endsection
@section("script")
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const doughnutChart = document.getElementById('doughnut');
        const doughnutData = {
            labels: [
                'sucess',
                'failed'
            ],
            datasets: [{
                label: 'Produced',
                data: [{{$machineData['sucess']}},{{$machineData['failed']}}],
                backgroundColor: [
                    '#6E644E',
                    '#2E3033'
                ],
                hoverOffset: 4
            }]
        };

        newChart(doughnutChart, 'doughnut', doughnutData) //doughnut chart

        function newChart(ctx, type, data){
            new Chart(ctx, {
                type: type,
                data: data,
            });
        }
    </script>
@endsection
