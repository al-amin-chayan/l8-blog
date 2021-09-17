@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Articles') }}
                    <a class="btn-sm float-right btn-primary" href="{{ route('articles.create') }}" role="button">Create New</a>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">views</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($articles as $article)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->views }}</td>
                                <td>{{ $article->created_at }}</td>
                                <td>{{ $article->updated_at->diffForHumans() }}</td>
                                <td>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th scope="row" colspan="6">No Record Found</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
