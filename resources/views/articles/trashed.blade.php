@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Deleted Articles') }}
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
                            <th scope="col">Author</th>
                            <th scope="col">Created</th>
                            <th scope="col">Deleted</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $start = ($articles->currentPage() - 1) * $articles->perPage();
                        @endphp
                        @forelse ($articles as $article)
                            <tr>
                                <th scope="row">{{ ++$start }}</th>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->user->name }}</td>
                                <td>{{ $article->created_at }}</td>
                                <td>{{ $article->deleted_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Items">
                                        <form method="post" action="{{ route('articles.restore', [$article->id]) }}">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-primary btn-sm">Restore</button>
                                        </form>
                                        <form method="post" action="{{ route('articles.erase', [$article->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete &quot;{{ $article->title }}&quot;?');">Delete</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th scope="row" colspan="6">No Record Found</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                        <nav aria-label="Page navigation">
                            {{ $articles->links() }}
                        </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
