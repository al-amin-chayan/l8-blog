@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Articles') }}
                    @include('components.buttons.create', ['item' => 'article'])
                </div>

                <div class="card-body">
                    @include('components.alerts.success')
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">views</th>
                            <th scope="col">Image</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
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
                                <td>{{ $article->views }}</td>
                                <td>
                                    <img src="{{ Storage::exists($article->image) ? Storage::url($article->image) : 'https://picsum.photos/id/237/100/100' }}" class="img-thumbnail" alt="{{ $article->title }}">
                                </td>
                                <td>{{ $article->created_at }}</td>
                                <td>{{ $article->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Items">
                                        @include('components.buttons.edit', ['item' => 'article'])
                                        @include('components.buttons.delete', ['item' => 'article', 'title' => $article->title])
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th scope="row" colspan="7">No Record Found</th>
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
