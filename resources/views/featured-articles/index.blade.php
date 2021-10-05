@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Featured Articles') }}
                    @include('components.buttons.create', ['item' => 'featured_article'])
                </div>

                <div class="card-body">
                    @include('components.alerts.success')
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $start = ($featured_articles->currentPage() - 1) * $featured_articles->perPage();
                        @endphp
                        @forelse ($featured_articles as $featured_article)
                            <tr>
                                <th scope="row">{{ ++$start }}</th>
                                <td>{{ $featured_article->title }}</td>
                                <td>{{ $featured_article->created_at }}</td>
                                <td>{{ $featured_article->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Items">
                                        @include('components.buttons.edit', ['item' => 'featured_article'])
                                        @include('components.buttons.delete', ['item' => 'featured_article', 'title' => $featured_article->title])
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th scope="row" colspan="5">No Record Found</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                        <nav aria-label="Page navigation">
                            {{ $featured_articles->links() }}
                        </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
