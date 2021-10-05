@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create Featured Article') }}
                    @include('components.buttons.back')
                </div>

                <div class="card-body">
                    @include('components.alerts.error')
                    <form method="post" action="{{ route('featured-articles.store') }}">
                        @include('featured-articles.form', ['action' => 'Create'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
