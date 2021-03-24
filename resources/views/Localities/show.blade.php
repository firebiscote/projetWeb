@extends('template')
@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Titre : {{ $locality->name }}</p>
        </header>
    </div>
@endsection