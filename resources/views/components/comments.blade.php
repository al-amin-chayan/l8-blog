<hr>
@guest
    <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login to Submit Comments') }}</a>
@else
    @include('components.alerts.success')
    <form method="post" action="{{ route('comments.store') }}">
        @csrf
        <input type="hidden" name="commentable_id" value="{{ $commentable_id }}">
        <input type="hidden" name="commentable_type" value="{{ $commentable_type }}">
        <div class="form-group">
            <label for="body">Post your comments</label>
            <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : ''}}" name="body" id="body">{{ old('body') }}</textarea>
            {!! $errors->first('body', '<div class="invalid-feedback">:message</div>') !!}
            <small id="bodyHelp" class="form-text text-muted">Please share your feedback with us</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="clearfix"></div>
@endguest

<br><br>
@foreach($comments as $comment)
    <div class="blog-post">
        <p class="blog-post-meta"><a href="#">{{ $comment->user->name }}</a> at {{ $comment->created_at->format('F j, Y') }}</p>
        <p>{{ $comment->body }}</p>

    </div><!-- /.blog-post -->
@endforeach
