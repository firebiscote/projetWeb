@extends('template')
@section('css')
    <style>
        .card-footer {
            justify-content: center;
            align-items: center;
            padding: 0.4em;
        }
        select, .is-info {
            margin: 0.3em;
        }
    </style>
@endsection
@section('content')
    @if(session()->has('info'))
        <div class="notification is-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">offers</p>
            <div class="select">
                <select onchange="window.location.href = this.value">
                    <option value="{{ route('offers.index') }}" @unless($slug) selected @endunless>Toutes catégories</option>
                    @foreach($localities as $locality)
                        <option value="{{ route('offers.locality', $locality->slug) }}" {{ $slug == $locality->slug ? 'selected' : '' }}>{{ $locality->name }}</option>
                    @endforeach
                </select>
            </div>
            <a class="button is-info" href="{{ route('offers.create') }}">Créer un offer</a>
        </header>
        <div class="card-content">
            <div class="content">
                <table class="table is-hoverable">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                        <tr @if($offer->deleted_at) class="has-background-grey-lighter" @endif>
                            <td><strong>{{ $offer->name }}</strong></td>
                                <td>
                                    @if($offer->deleted_at)
                                        <form action="{{ route('offers.restore', $offer->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="button is-primary" type="submit">Restaurer</button>
                                        </form>
                                    @else
                                        <a class="button is-primary" href="{{ route('offers.show', $offer->id) }}">Voir</a>
                                    @endif
                                </td>
                                <td>
                                    @if($offer->deleted_at)
                                    @else
                                        <a class="button is-warning" href="{{ route('offers.edit', $offer->id) }}">Modifier</a>
                                    @endif
                                </td>
                            <td>
                                <form action="{{ route($offer->deleted_at? 'offers.force.destroy' : 'offers.destroy', $offer->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button is-danger" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="card-footer is-centered">
            {{ $offers->links() }}
        </footer>
    </div>
@endsection