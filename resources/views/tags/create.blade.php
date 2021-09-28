@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create Tag') }}
                    @include('components.buttons.back')
                </div>

                <div class="card-body">
                    @include('components.alerts.error')
                    <form method="post" action="{{ route('tags.store') }}">
                        @include('tags.form', ['action' => 'Create'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
