    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Update Article#' . $article->id) }}
                    </div>
                    <div class="card-body">
                            @if(Storage::exists($article?->image?->url))
                                <picture>
                                    <img src="{{ Storage::url($article->image->url) }}" class="img-fluid img-thumbnail" alt="{{ $article->title }}">
                                </picture>
                            @endif
                                @include('components.inputs.text', ['name' => 'title', 'model' => $article ?? null])

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
                    </div>
                </div>
            </div>
        </div>
    </div>
