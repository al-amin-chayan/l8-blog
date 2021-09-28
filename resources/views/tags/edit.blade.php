@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Update Tag#' . $tag->name) }}
                    @include('components.buttons.back')
                </div>

                <div class="card-body">
                    @include('components.alerts.error')
                    <form method="post" action="{{ route('tags.update', [$tag->id]) }}">
                        @method('PATCH')
                        @include('tags.form', ['action' => 'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
