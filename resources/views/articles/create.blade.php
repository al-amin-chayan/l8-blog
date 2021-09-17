@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create Article') }}
                    <a class="btn-sm float-right btn-primary" href="{{ route('articles.index') }}" role="button">&laquo; Back</a>
                </div>

                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form enctype="multipart/form-data" method="post" action="{{ route('articles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" id="title" name="title" value="{{ old('title') }}">
                            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea class="form-control{{ $errors->has('details') ? ' is-invalid' : ''}}" id="details" rows="20" name="details">{{ old('details') }}</textarea>
                            {!! $errors->first('details', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="image">Article Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_published" value="1" name="is_published">
                            <label class="form-check-label" for="is_published">Publish this Article</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
