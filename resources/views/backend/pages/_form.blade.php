
<div class="form-group flex-right">
        <textarea class="form-control" name="content" rows="6" id="editor">
            {{ old('content', $page->content ?? null) }}
        </textarea>
</div>

<div class="row">
    <fieldset class="form-group col-4">
        <legend>Сhoosing a color theme</legend>
        <label for="blue" class="paper-radio">
            <input type="radio" name="template" id="blue" value="blue" @isset($page) {{ ($page->template==='blue')? "checked" : "" }} @endisset >
            <span>Blue</span>
        </label>
        <label for="red" class="paper-radio">
            <input type="radio" name="template" id="red" value="red" @isset($page) {{ ($page->template==='red')? "checked" : "" }} @endisset >
            <span>Red</span>
        </label>
        <label for="purple" class="paper-radio">
            <input type="radio" name="template" id="purple" value="purple" @isset($page) {{ ($page->template==='purple')? "checked" : "" }} @endisset >
            <span>Purple</span>
        </label>
    </fieldset>

    <div class="form-group">
        <label for="slug">Slug</label>
        @error('slug')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug ?? null) }}">
    </div>

</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3">{{ old('description', $page->description ?? null) }}</textarea>
</div>

<div class="form-group">
    <label for="css">Css</label>
    <textarea id="css" name="css" rows="3">{{ old('css', $page->css ?? null) }}</textarea>
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