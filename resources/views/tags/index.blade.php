@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Tags') }}
                    @include('components.buttons.create', ['item' => 'tag'])
                </div>

                <div class="card-body">
                    @include('components.alerts.success')
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Articles</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $start = $tags->firstItem();
                        @endphp
                        @forelse ($tags as $tag)
                            <tr>
                                <th scope="row">{{ $start++ }}</th>
                                <td>{{ $tag->name }}</td>
                                <td class="text-center">{{ $tag->articles_count }}</td>
                                <td>{{ $tag->created_at }}</td>
                                <td>{{ $tag->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Items">
                                        @include('components.buttons.edit', ['item' => 'tag'])
                                        @include('components.buttons.delete', ['item' => 'tag', 'title' => $tag->name])
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
                            {{ $tags->links() }}
                        </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
