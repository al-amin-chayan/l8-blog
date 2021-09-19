@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Update Article#' . $article->id) }}
                    <a class="btn-sm float-right btn-primary" href="{{ url()->previous() }}" role="button">&laquo; Back</a>
                </div>

                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
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
