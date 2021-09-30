@extends('layouts.web')
@section('title', $tag->name)
@section('content')
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                {{ $tag->name }} Related Posts
            </h3>
            @foreach($articles as $article)
            <div class="blog-post">
                <a href="{{ route('articles.show', [$article->id, $article->slug]) }}">
                    <h2 class="blog-post-title">{{ $article->title }}</h2>
                </a>
                <p class="blog-post-meta">{{ $article->created_at->format('F j, Y') }} by <a href="#">{{ $article->user->name }}</a></p>

                <p>{{ \Illuminate\Support\Str::limit($article->details, 200) }}</p>
            </div><!-- /.blog-post -->
            @endforeach

            <nav aria-label="blog-pagination">
                {{ $articles->links() }}
            </nav>

            @include('components.comments', ['commentable_id' => $tag->id, 'commentable_type' => $tag::class, 'comments' => $tag->comments])
        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
            <div class="p-3 mb-3 bg-light rounded">
                <h4 class="font-italic">About</h4>
                <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            </div>

            <div class="p-3">
                <h4 class="font-italic">Archives</h4>
                <ol class="list-unstyled mb-0">
                    <li><a href="#">March 2014</a></li>
                    <li><a href="#">February 2014</a></li>
                    <li><a href="#">January 2014</a></li>
                    <li><a href="#">December 2013</a></li>
                    <li><a href="#">November 2013</a></li>
                    <li><a href="#">October 2013</a></li>
                    <li><a href="#">September 2013</a></li>
                    <li><a href="#">August 2013</a></li>
                    <li><a href="#">July 2013</a></li>
                    <li><a href="#">June 2013</a></li>
                    <li><a href="#">May 2013</a></li>
                    <li><a href="#">April 2013</a></li>
                </ol>
            </div>

            <div class="p-3">
                <h4 class="font-italic">Elsewhere</h4>
                <ol class="list-unstyled">
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                </ol>
            </div>
        </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->
@endsection
