<div class="row flex-edges">

<div class="form-group col-5">
    <label for="name">Template name *</label>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input type="text" class="input-block" name="name" id="name" value="{{ old('name', $template->name ?? null) }}" required>
</div>
    <div class="form-group col-5">
        <label for="file_name">File name *</label>
        @error('file_name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" class="input-block" name="file_name" id="file_name"
               value="{{ old('file_name', $template->file_name ?? null) }}" required>
    </div>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description" class="input-block"
              rows="3">{{ old('description', $template->description ?? null) }}</textarea>
</div>

<div class="form-group flex-right">
    <label for="file">File blade.php *</label>
    @error('file')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <textarea class="form-control input-block border border-3 border-primary" name="file" id="file" data-editor="php_laravel_blade"
              rows="16">{{ old('file', $template->file ?? null) }}</textarea>
</div>
<div id="editor"></div>

<div class="form-group">
    <label for="css">Css</label>
    <textarea id="css" name="css" class="input-block border border-4 border-primary" data-editor="css"
              rows="10">{{ old('css', $template->css ?? null) }}</textarea>
</div>

<div class="form-group">
    <label for="js">Js</label>
    <textarea id="js" name="js" class="input-block border border-6 border-primary" data-editor="javascript" rows="10">{{ old('js', $template->js ?? null) }}</textarea>
</div>

@section('styles')

@endsection

@section('scripts')
    {{--    <script src="{{ asset('ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>--}}
    <script src="{{ asset('ace/emmet.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.min.js" type="text/javascript"
            charset="utf-8"></script>
    <script src="{{ asset('ace/ext-emmet.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('ace/config.js') }}" type="text/javascript" charset="utf-8"></script>

@endsection