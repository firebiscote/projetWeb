@extends('template')
@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Titre : {{ $offer->name }}</p>
        </header>
        <div class="card-content">
            <div class="content">
                <p>Année de sortie : {{ $locality }}</p>
                <hr>
                <p>Promo :</p>
                <ul>
                    @foreach($offer->promotions as $promotion)
                    <li>{{ $promotion->name }}</li>
                    @endforeach
                </ul>
                <hr>
                <p>Description :</p>
                <p>{{ $offer->comment }}</p>
            </div>
        </div>
    </div>
@endsection