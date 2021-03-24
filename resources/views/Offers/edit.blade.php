<div class="field">
    <label class="label">Catégories</label>
    <div class="select is-multiple">
        <select name="cats[]" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, old('cats') ?: $film->categories->pluck('id')->all()) ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>