@extends('template')
@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Création d'un offer</p>
        </header>
        <div class="card-content">
            <div class="content">
                <form action="{{ route('offers.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Promo</label>
                        <div class="select is-multiple">
                            <select name="promo[]" multiple>
                                @foreach($promotions as $promotion)
                                    <option value="{{ $promotion->id }}" {{ in_array($promotion->id, old('promo') ?: []) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">loca</label>
                        <div class="select">
                            <select name="locality_id">
                                @foreach($localities as $locality)
                                    <option value="{{ $locality->id }}">{{ $locality->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Titre</label>
                        <div class="control">
                          <input class="input @error('name') is-danger @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Titre du offer">
                        </div>
                        @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">salaire</label>
                        <div class="control">
                          <input class="input" type="number" name="wage" value="{{ old('wage') }}" min="4" max="25">
                        </div>
                        @error('wage')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Description</label>
                        <div class="control">
                            <textarea class="textarea" name="comment" placeholder="Description du offer">{{ old('comment') }}</textarea>
                        </div>
                        @error('comment')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">debut</label>
                        <div class="control">
                            <input class="input" type="date" name="start" placeholder="Description du offer">{{ old('start') }}</input>
                        </div>
                        @error('start')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">fin</label>
                        <div class="control">
                            <input class="input" type="date" name="end" placeholder="Description du offer">{{ old('end') }}</input>
                        </div>
                        @error('end')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">place</label>
                        <div class="control">
                          <input class="input" type="number" name="seat" value="{{ old('seat') }}" min="1" max="10">
                        </div>
                        @error('seat')
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