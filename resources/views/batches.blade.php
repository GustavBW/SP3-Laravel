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
                <a href="/batch/{{ $batch->id }}">id: {{ $batch->id }}</a>
                <h3>Type: {{ $options[$batch->beer_id] }}</h3>
            </div>
        @endforeach
    </div>
@endsection
@section("script")
    <script>
        const options = {
            'Pilsner': '0',
            'Wheat': '1',
            'IPA': '2',
            'Stout': '3',
            'Ale': '4',
            'Alcohol Free': '5'
        };
    </script>
@endsection
