<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="input-block" name="name" id="name" value="{{ old('name', $template->name ?? null) }}">
</div>

<div class="form-group flex-right">
        <textarea class="form-control" name="file" rows="6" id="editor">{{ old('file', $template->file ?? null) }}</textarea>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3">{{ old('description', $template->description ?? null) }}</textarea>
</div>

<div class="form-group">
    <label for="css">Css</label>
    <textarea id="css" name="css" class="input-block" rows="3">{{ old('css', $template->css ?? null) }}</textarea>
</div>

<div class="form-group">
    <label for="js">Js</label>
    <textarea id="js" name="js" class="input-block" rows="3">{{ old('js', $template->js ?? null) }}</textarea>
</div>

@section('styles')

@endsection

@section('scripts')

@endsection