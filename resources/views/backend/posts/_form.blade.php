
<div class="form-group flex-right">
        <textarea class="form-control" name="contents" rows="6" id="editor">
            {{ old('contents', $post->contents ?? null) }}
        </textarea>
</div>

<div class="row">
    <fieldset class="form-group col-4">
        <legend>Сhoosing a color theme</legend>
        <label for="blue" class="paper-radio">
            <input type="radio" name="template" id="blue" value="blue" @isset($post) {{ ($post->template==='blue')? "checked" : "" }} @endisset >
            <span>Blue</span>
        </label>
        <label for="red" class="paper-radio">
            <input type="radio" name="template" id="red" value="red" @isset($post) {{ ($post->template==='red')? "checked" : "" }} @endisset >
            <span>Red</span>
        </label>
        <label for="purple" class="paper-radio">
            <input type="radio" name="template" id="purple" value="purple" @isset($post) {{ ($post->template==='purple')? "checked" : "" }} @endisset >
            <span>Purple</span>
        </label>
    </fieldset>

    <fieldset class="form-group col-4">
        <label class="paper-switch-2">

            <input id="published" name="is_published" type="checkbox" value="1"
                   @isset($post)
                   @if($post->is_published)
                   checked
                   @endif
                   @else
                   checked
                    @endisset
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

@section('styles')
    <link href="{{ asset('css/selectize.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/selectize.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

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