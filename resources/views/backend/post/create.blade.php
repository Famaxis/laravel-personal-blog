@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Post</div>
                    <div class="card-body">

                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <form enctype="multipart/form-data" method="post" action="{{ route('post.store') }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="content" rows="6" id="editor" required></textarea>
                            </div>

                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary active">
                                    <input type="radio" name="template" id="option1" value="1" autocomplete="off"
                                           checked> Active
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="template" id="option2" value="2" autocomplete="off"> Radio
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="template" id="option3" value="3" autocomplete="off"> Radio
                                </label>
                            </div>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                       name="is_published" value="1" checked>
                                <label class="custom-control-label" for="customSwitch1">Is published?</label>
                            </div>

                            <input type="text" name="tags" id="tags">

                            <div class="form-group">
                                <input type="submit" class="paper-btn btn-secondary" value="Create post"/>
                            </div>
                        </form>


                        <script>
                            CKEDITOR.replace('editor', {
                                filebrowserUploadUrl: "{{route('post.store', ['_token' => csrf_token() ])}}",
                                filebrowserUploadMethod: 'form'
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')

@endsection

@section('scripts')

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
    </script>

    <script>
        var tags = [
                @foreach ($tags as $tag)
            {tag: "{{$tag}}" },
            @endforeach
        ];
    </script>

@endsection