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
                        @include('articles.form', ['action' => 'Create'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
