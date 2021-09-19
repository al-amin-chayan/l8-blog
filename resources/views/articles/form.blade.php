@csrf
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" id="title" name="title" value="{{ old('title', $article->title ?? '') }}">
    {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    <label for="details">Details</label>
    <textarea class="form-control{{ $errors->has('details') ? ' is-invalid' : ''}}" id="details" rows="20" name="details">{{ old('details', $article->details ?? '') }}</textarea>
    {!! $errors->first('details', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    <label for="image">Article Image</label>
    <input type="file" class="form-control-file" id="image" name="image">
</div>
<div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="is_published" value="1" name="is_published" {{ old('is_published', $article->is_published ?? '') == '1' ? 'checked' : '' }}>
    <label class="form-check-label" for="is_published">Publish this Article</label>
</div>
<button type="submit" class="btn btn-primary">{{ $action }}</button>
