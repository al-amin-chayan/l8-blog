@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Update Tag#' . $tag->name) }}
                    <a class="btn-sm float-right btn-primary" href="{{ url()->previous() }}" role="button">&laquo; Back</a>
                </div>

                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
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
