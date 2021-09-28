@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : ''}}" id="name" name="name" value="{{ old('name', $tag->name ?? '') }}">
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>
<button type="submit" class="btn btn-primary">{{ $action }}</button>
