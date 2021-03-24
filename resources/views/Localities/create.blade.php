@extends('template')
@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Création d'un locality</p>
        </header>
        <div class="card-content">
            <div class="content">
                <form action="{{ route('localities.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Nom</label>
                        <div class="control">
                          <input class="input @error('name') is-danger @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="nom du locality">
                        </div>
                        @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <div class="control">
                          <button class="button is-link">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection