@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create Article') }}
                    @include('components.buttons.back')
                </div>

                <div class="card-body">
                    @include('components.alerts.error')
                    <form enctype="multipart/form-data" method="post" action="{{ route('articles.store') }}">
                        @include('articles.form', ['action' => 'Create'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
