@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Tags') }}
                    <a class="btn-sm float-right btn-primary" href="{{ route('tags.create') }}" role="button">Create New</a>
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
                                        <a class="btn btn-primary btn-sm" href="{{ route('tags.edit', [$tag->id]) }}" role="button">Edit</a>
                                        <form method="post" action="{{ route('tags.update', [$tag->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete &quot;{{ $tag->name }}&quot;?');">Delete</button>
                                        </form>
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
