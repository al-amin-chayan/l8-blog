<div class="form-group">
    <label for="{{ $name }}">{{ \Illuminate\Support\Str::ucfirst($name) }}</label>
    <input type="{{ $type ?? 'text' }}" class="form-control{{ $errors->has($name) ? ' is-invalid' : ''}}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $model?->{$name} ?? '') }}">
    {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
</div>
