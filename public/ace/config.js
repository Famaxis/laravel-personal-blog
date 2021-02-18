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
        });

        // copy back to textarea on form submit...
        textarea.closest('form').submit(function () {
            textarea.val(editor.getSession().getValue());
        })

    });
});