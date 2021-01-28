@error('content')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group flex-right">
        <textarea class="form-control" name="content" rows="6" id="editor">
            @isset ($post){{$post->content}}@endisset
        </textarea>
</div>

<div class="row">
    <fieldset class="form-group col-4">
        <legend>Сhoosing a color theme</legend>
        <label for="template1" class="paper-radio">
            <input type="radio" name="template" id="template1" value="template 1">
            <span>Red</span>
        </label>
        <label for="template2" class="paper-radio">
            <input type="radio" name="template" id="template2" value="template 2">
            <span>Green</span>
        </label>
        <label for="template3" class="paper-radio">
            <input type="radio" name="template" id="template3" value="template 3">
            <span>Blue</span>
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
        <input type="text" name="slug" id="slug" value="@isset ($post){{$post->slug}}@endisset">
    </div>

</div>

<div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" name="tags" id="tags"
           value="@isset ($post, $tags)@foreach($post->tagged as $tagged){{$tagged->tag_name}},@endforeach @endisset">
</div>

@section('styles')
    <link href="{{ asset('css/selectize.css') }}" rel="stylesheet">
@endsection

@section('scripts')
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