<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="input-block" name="name" id="name" value="{{ old('name', $template->name ?? null) }}">
</div>

<div class="form-group flex-right">
        <textarea class="form-control" name="contents" rows="6" id="editor">
            {{ old('contents', $template->contents ?? null) }}
        </textarea>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3">{{ old('description', $template->description ?? null) }}</textarea>
</div>

<div class="form-group">
    <label for="css">Css</label>
    <textarea id="css" name="css" class="input-block" rows="3">{{ old('css', $template->css ?? null) }}</textarea>
</div>

@section('styles')

@endsection

@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{route('upload_image', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection