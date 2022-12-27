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
                <h3>Batch ID: {{$batch->id}}</h3>
                <h3>Type: {{$batch->beer_id}}</h3>
                <h3>Size: {{$batch->size}}</h3>
                <h3>Speed: {{$batch->production_speed}}</h3>
                <h3>Started by: {{$batch->user_id}}</h3>
                <h3>Batch status: {{$batch->status}}</h3>
                <form action="{{ route('destroyBatch', ['id'=> $batch->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger w-100" id="delete">Delete batch</button>
                    </form>

                <form action="{{route('batch.execute',['id' => $batch->id])}}" method="POST">
                    @csrf
                    <button type="submit">Execute batch</button>
                </form>
                @if($executionResult != null)
                    <p>Error:</p>
                    <p>{{data_get($executionResult,'errorMessage','Invalid response')}}</p>
                @endif

            </div>
        </div>
        <div class="chart item">
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
        let success = 0;
        let failures = 0;
        @if($result != null)
            success = {{$result->brewed}}
            failures = {{$result->failed}}
        @endif
    </script>
@endsection
