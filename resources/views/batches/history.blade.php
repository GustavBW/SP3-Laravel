@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/batches.css')}}">
@endsection

@section("body")
    <h1>Finished Batches</h1>
    <div class="items">
        @foreach ($batchResults as $batchResult)
            <div class="item">
                <h3>Finished Batches</h3>
                <a href="{{route('batch', ['id' => $batchResult->id])}}">id: {{ $batchResult->id }}</a>
            </div>
        @endforeach
    </div>
@endsection