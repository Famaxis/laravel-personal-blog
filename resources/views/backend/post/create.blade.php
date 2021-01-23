@extends('layouts.app')

@section('content')
    <div class="container">
                <div class="card">
                    <div class="card-header">Create Post</div>
                    <div class="card-body">

                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <form enctype="multipart/form-data" method="post" action="{{ route('post.store') }}">
                            @csrf
                            <div class="form-group flex-right">
                                <textarea class="form-control" name="content" rows="6" id="editor" required></textarea>
                            </div>

                            <div class="row">
                                <fieldset class="form-group col-4">
                                    <legend>Сhoosing a color theme</legend>
                                    <label for="template1" class="paper-radio">
                                        <input type="radio" name="template" id="template1" value="option 1"> <span>This is the first option</span>
                                    </label>
                                    <label for="template2" class="paper-radio">
                                        <input type="radio" name="template" id="template2" value="option 2"> <span>This is the second option</span>
                                    </label>
                                    <label for="template3" class="paper-radio">
                                        <input type="radio" name="template" id="template3" value="option 3"> <span>This is the third option</span>
                                    </label>
                                </fieldset>

                                <fieldset class="form-group col-4">
                                    <label class="paper-switch-2">
                                        <input id="published" name="is_published" type="checkbox" value="1" checked/>
                                        <span class="paper-switch-slider round"></span>
                                    </label>
                                    <label for="published" class="paper-switch-2-label">
                                        Is published?
                                    </label>
                                </fieldset>
                            </div>

                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" name="tags" id="tags">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="paper-btn btn-secondary" value="Create post"/>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
@endsection

@section('styles')

@endsection

@section('scripts')

    <script>
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{route('post.store', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

    <script>
        $( document ).ready(function() {
            $('#tags').selectize({
                delimiter: ',',
                persist: false,
                valueField: 'tag',
                labelField: 'tag',
                searchField: 'tag',
                options: tags,
                create: function(input) {
                    return {
                        tag: input,
                        text: input
                    }
                }
            });
        });

        $(document).on('click', 'div.selectize-input div.item', function(e) {
            var select = $('#tags').selectize();
            var selectSizeControl = select[0].selectize;
            // 1. Get the value
            var selectedValue = $(this).attr("data-value");
            // 2. Remove the option
            select[0].selectize.removeItem(selectedValue);

            select[0].selectize.refreshItems();
            select[0].selectize.refreshOptions();

        });
    </script>

    <script>
        var tags = [
                @foreach ($tags as $tag)
            {tag: "{{$tag}}" },
            @endforeach
        ];
    </script>

@endsection