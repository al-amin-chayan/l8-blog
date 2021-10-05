@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Update Article#' . $featuredArticle->id) }}
                    @include('components.buttons.back')
                </div>

                <div class="card-body">
                    @include('components.alerts.error')
                    <form method="post" action="{{ route('featured-articles.update', [$featuredArticle->id]) }}">
                        @method('PATCH')
                        @include('featured-articles.form', ['action' => 'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
