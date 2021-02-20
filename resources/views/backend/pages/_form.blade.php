<div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="input-block" name="title" id="title" value="{{ old('title', $page->title ?? null) }}">
    <span class="annotation">Will be displayed as a page title in meta tags.</span>
</div>


<div class="form-group flex-right">
        <textarea class="form-control" name="contents" rows="6" id="editor">
            {{ old('contents', $page->contents ?? null) }}
        </textarea>
    <span class="annotation">Optional. Yes, page content is optional, you can leave all the form empty, if you wish. Nothing is required.</span>
</div>

<div class="row">
    <fieldset class="form-group col-3 margin-right-small">
        <legend>Pick a color theme:</legend>
        <label for="blue" class="paper-radio">
            <input type="radio" name="default_template" id="blue" value="blue"
                    {{ ((old('default_template') === 'blue') || ($page->default_template === 'blue')) ? 'checked' : '' }}
            >
            <span>Blue</span>
        </label>
        <label for="red" class="paper-radio">
            <input type="radio" name="default_template" id="red" value="red"
                    {{ ((old('default_template') === 'red') || ($page->default_template === 'red')) ? 'checked' : '' }}
            >
            <span>Red</span>
        </label>
        <label for="purple" class="paper-radio">
            <input type="radio" name="default_template" id="purple" value="purple"
                    {{ ((old('default_template') === 'purple') || ($page->default_template === 'purple')) ? 'checked' : '' }}
            >
            <span>Purple</span>
        </label>
        <span class="annotation">You can leave it empty for random pick.</span>
    </fieldset>

    <fieldset class="form-group col-3 margin-right">
        <label for="custom_template">Or pick a custom template:</label>
        <select id="custom_template" name="custom_template">
            <option label=" "></option>
            @foreach($templates as $template)
                <option value="{{ $template->id }}" {{ ((count($errors) && old('custom_template') == $template->id) || (!count($errors) && $page->custom_template == $template->id)) ? 'selected' : '' }}>{{ $template->name }}</option>
            @endforeach
        </select>
        <span class="annotation">If you prefer your own created template.</span>
    </fieldset>

    <div class="form-group col-4">
        <label for="slug">Slug:</label>
        @error('slug')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug ?? null) }}">
        <span class="annotation">It will be generated automatically. If you want to create slug, it should be unique for posts and pages both.</span>
    </div>

</div>

<div class="form-group">
    <label for="description">Description:</label>
    <textarea id="description" class="input-block" name="description" rows="3">{{ old('description', $page->description ?? null) }}</textarea>
    <span class="annotation">Description text will be displayed in meta tags.</span>
</div>

<div class="collapsible margin-bottom">
    <input id="collapsible1" type="checkbox" name="collapsible">
    <label for="collapsible1">Scripts & styles</label>
    <div class="collapsible-body">
        <div class="form-group">
            <label for="css">Css</label>
            <textarea id="css" name="css" class="input-block border border-4 border-primary" data-editor="css"
                      rows="10">{{ old('css', $page->css ?? null) }}</textarea>
        </div>

        <div class="form-group">
            <label for="js">Js</label>
            <textarea id="js" name="js" class="input-block border border-6 border-primary" data-editor="javascript" rows="10">{{ old('js', $page->js ?? null) }}</textarea>
        </div>
    </div>
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

    {{--    <script src="{{ asset('ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>--}}
    <script src="{{ asset('ace/emmet.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.min.js" type="text/javascript"
            charset="utf-8"></script>
    <script src="{{ asset('ace/ext-emmet.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('ace/config.js') }}" type="text/javascript" charset="utf-8"></script>
@endsection