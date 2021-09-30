<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        @foreach($tags as $tag)
            <a class="p-2 text-muted" href="{{ route('tags.show', [$tag->id, $tag->slug]) }}">{{ $tag->name }}</a>
        @endforeach
    </nav>
</div>
