<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="input-block" name="name" id="name" value="{{ old('name', $template->name ?? null) }}">
</div>


<div class="form-group flex-right">
    <label for="file">File blade.php</label>
    <textarea class="form-control input-block" name="file" id="file" data-editor="php_laravel_blade"
              rows="10">{{ old('file', $template->file ?? null) }}</textarea>
</div>
<div id="editor"></div>


<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description"
              rows="3">{{ old('description', $template->description ?? null) }}</textarea>
</div>

<div class="form-group">
    <label for="file_name">File name</label>
    <input type="text" class="input-block" name="file_name" id="file_name"
           value="{{ old('file_name', $template->file_name ?? null) }}">
</div>

<div class="form-group">
    <label for="css">Css</label>
    <textarea id="css" name="css" class="input-block" data-editor="css"
              rows="10">{{ old('css', $template->css ?? null) }}</textarea>
</div>

<div class="form-group">
    <label for="js">Js</label>
    <textarea id="js" name="js" class="input-block" rows="3">{{ old('js', $template->js ?? null) }}</textarea>
</div>

@section('styles')

@endsection

@section('scripts')
    {{--    <script src="{{ asset('ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.min.js" type="text/javascript"
            charset="utf-8"></script>
    <script src="{{ asset('ace/emmet.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('ace/ext-emmet.js') }}" type="text/javascript" charset="utf-8"></script>



    <script>
        $(function () {
            $('textarea[data-editor]').each(function () {
                var textarea = $(this);

                var mode = textarea.data('editor');

                var editDiv = $('<div>', {
                    position: 'absolute',
                    width: textarea.width(),
                    height: textarea.height(),
                    'class': textarea.attr('class')
                }).insertBefore(textarea);

                textarea.css('display', 'none');

                var editor = ace.edit(editDiv[0]);
                editor.renderer.setShowGutter(true);
                editor.getSession().setValue(textarea.val());

                ace.config.set("basePath", "/ace");
                editor.getSession().setMode("ace/mode/" + mode);

                editor.setTheme("ace/theme/monokai");

                var Emmet = require("ace/ext/emmet");
                editor.setOptions({
                    enableEmmet: true,
                    fontSize: '16px',
                    useSoftTabs: true,
                    highlightSelectedWord: true,
                    highlightGutterLine: true,
                    onResize: function () {
                        this.editor.resize(true);
                    },
                });

                // editor.setOption("enableEmmet", true);

                // copy back to textarea on form submit...
                textarea.closest('form').submit(function () {
                    textarea.val(editor.getSession().getValue());
                })

            });
        });
    </script>
@endsection