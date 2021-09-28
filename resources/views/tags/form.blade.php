@csrf
@include('components.inputs.text', ['name' => 'name', 'model' => $tag ?? null])
<button type="submit" class="btn btn-primary">{{ $action }}</button>
