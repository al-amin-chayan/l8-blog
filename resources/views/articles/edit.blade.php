@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Update Article#' . $article->id) }}
                    @include('components.buttons.back')
                </div>

                <div class="card-body">
                    @include('components.alerts.error')
                    <form enctype="multipart/form-data" method="post" action="{{ route('articles.update', [$article->id]) }}">
                        @method('PATCH')
                        @if(Storage::exists($article->image))
                            <picture>
                                <img src="{{ Storage::url($article->image) }}" class="img-fluid img-thumbnail" alt="{{ $article->title }}">
                            </picture>
                        @endif
                        @include('articles.form', ['action' => 'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
