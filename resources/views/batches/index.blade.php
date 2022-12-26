@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/batches.css')}}">
@endsection

@section("body")
    <h1>Batches</h1>
    <div class="items">
        @foreach ($batches as $batch)
            <div class="item">
                <h3>Batch</h3>
                <a href="{{route('batch', ['id' => $batch->id])}}">id: {{ $batch->id }}</a>
                <h3>Type: {{ $beerTypes[$batch->beer_id -1]->type}}</h3>
            </div>
        @endforeach
    </div>
@endsection
@section("script")
    <script>
        document.getElementById("batches").classList.add("selected");
    </script>
@endsection
