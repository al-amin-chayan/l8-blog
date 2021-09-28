<form method="post" action="{{ route(\Illuminate\Support\Str::plural($item) . '.destroy', [${$item}->id]) }}">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete &quot;{{ $title }}&quot;?');">Delete</button>
</form>
