@extends('template')
@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Modification d'un locality</p>
        </header>
        <div class="card-content">
            <div class="content">
                <form action="{{ route('localities.update', $locality->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="field">
                        <label class="label">Titre</label>
                        <div class="control">
                          <input class="input @error('name') is-danger @enderror" type="text" name="name" value="{{ old('name', $locality->name) }}" placeholder="Titre du locality">
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