<a class="btn btn-primary btn-sm" href="{{ route(\Illuminate\Support\Str::plural(Str::replace('_', '-', $item)) . '.edit', [${$item}->id]) }}" role="button">Edit</a>
