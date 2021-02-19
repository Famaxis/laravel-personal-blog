
<div class="form-group flex-right">
        <textarea class="form-control" name="contents" rows="6" id="editor">
            {{ old('contents', $post->contents ?? null) }}
        </textarea>
</div>

<div class="row">
    <fieldset class="form-group col-4">
        <legend>Сhoosing a color theme</legend>
        <label for="blue" class="paper-radio">
            <input type="radio" name="template" id="blue" value="blue"
                    {{ ((old('template') === 'blue') || ($post->template === 'blue')) ? 'checked' : '' }}
            >
            <span>Blue</span>
        </label>
        <label for="red" class="paper-radio">
            <input type="radio" name="template" id="red" value="red"
                    {{ ((old('template') === 'red') || ($post->template === 'red')) ? 'checked' : '' }}
            >
            <span>Red</span>
        </label>
        <label for="purple" class="paper-radio">
            <input type="radio" name="template" id="purple" value="purple"
                    {{ ((old('template') === 'purple') || ($post->template === 'purple')) ? 'checked' : '' }}
            >
            <span>Purple</span>
        </label>
    </fieldset>

    <fieldset class="form-group col-4">
        <label class="paper-switch-2">

            <input id="published" name="is_published" type="checkbox" value="1"
                    {{ ((old('is_published') == '1') || ($post->is_published == '1')) || (!$post->id) ? 'checked' : '' }}
            />
            <span class="paper-switch-slider round"></span>
        </label>
        <label for="published" class="paper-switch-2-label">
            Is published?
        </label>
    </fieldset>
    <div class="form-group">
        <label for="slug">Slug</label>
        @error('slug')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug ?? null) }}">
    </div>

</div>

<div class="form-group">
    <label for="description">Description</label>

    <textarea id="description" name="description" rows="3">{{ old('description', $post->description ?? null) }}</textarea>
</div>

<div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" name="tags" id="tags"
           value="@php
               if(old('tags')) {
                    echo old('tags');
                } elseif (isset($post)){
                    echo implode(',', $post->tagged->pluck('tag_name')->toArray() );
                }
           @endphp">
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
    <link href="{{ asset('css/selectize.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/selectize.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    {{--    <script src="{{ asset('ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>--}}
    <script src="{{ asset('ace/emmet.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.min.js" type="text/javascript"
            charset="utf-8"></script>
    <script src="{{ asset('ace/ext-emmet.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('ace/config.js') }}" type="text/javascript" charset="utf-8"></script>

    <script>
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{route('upload_image', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#tags').selectize({
                delimiter: ',',
                persist: false,
                valueField: 'tag',
                labelField: 'tag',
                searchField: 'tag',
                inputClass: 'selectize-input',
                wrapperClass: 'selectize-control border',
                options: tags,
                create: function (input) {
                    return {
                        tag: input,
                    }
                },
            });
        });

        $(document).on('click', 'div.selectize-input div.item', function (e) {
            var select = $('#tags').selectize();
            var selectSizeControl = select[0].selectize;
            // 1. Get the value
            var selectedValue = $(this).attr("data-value");
            // 2. Remove the option
            select[0].selectize.removeItem(selectedValue);
            select[0].selectize.refreshItems();
            select[0].selectize.refreshOptions();
        });

        var tags = [@foreach ($tags as $tag){tag: "{{$tag}}"},@endforeach];

    </script>

@endsection