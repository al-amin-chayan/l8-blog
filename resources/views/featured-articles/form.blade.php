@csrf
<div class="form-group">
    <label for="article_id">Article</label>
    <select name="article_id" class="custom-select form-control{{ $errors->has('article_id') ? ' is-invalid' : ''}}">
        @foreach($articles as $article_id => $article)
            <option value="{{ $article_id }}"{{ old('article_id', $featuredArticle->$article_id ?? 0) == $article_id ? ' selected' : '' }}>{{ $article }}</option>
        @endforeach
    </select>
    {!! $errors->first('tag_id', '<div class="invalid-feedback">:message</div>') !!}
</div>

@include('components.inputs.text', ['name' => 'title', 'model' => $featuredArticle ?? null])

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : ''}}" id="description" rows="5" name="description">{{ old('description', $featuredArticle->description ?? '') }}</textarea>
    {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
</div>
<button type="submit" class="btn btn-primary">{{ $action }}</button>
