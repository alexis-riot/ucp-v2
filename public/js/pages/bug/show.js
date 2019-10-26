"use strict";

// Class definition
var ShowPage = function () {
    var initSummernote = function() {
        $('.summernote').summernote({
            height: 250,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    };

    var updateSettings = function() {
        var request_name = "update";

        var form = $('[data-form-type="' + request_name + '"]');
        var btn = $('[data-type-button="' + request_name + '"]');

        btn.on('click', function(e) {
            e.preventDefault();
            KTApp.progress(btn);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: form.data('form-url'),
                method: form.data('form-method'),
                data: {
                    'action': request_name,
                    'settings_subject': $('#settings_subject').val(),
                    'settings_type': $('#settings_type').val(),
                    'settings_status': $('#settings_status').val(),
                    'settings_developer': $('#settings_developer').val(),
                    'settings_tester': $('#settings_tester').val(),
                },
                success: AjaxResponse,
                error: AjaxResponseDefault,
            });
        });
    };

    var addComment = function() {
        var request_name = "add_comment";

        var form = $('[data-form-type="' + request_name + '"]');
        var btn = $('[data-type-button="' + request_name + '"]');

        btn.on('click', function(e) {
            console.log("test");
            e.preventDefault();
            KTApp.progress(btn);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: form.data('form-url'),
                method: form.data('form-method'),
                data: {
                    'action': request_name,
                    'comment': form.find('.summernote').summernote('code'),
                },
                success: AjaxResponse,
                error: AjaxResponseDefault,
            });
        });
    };

    return {
        init: function() {
            initSummernote();
            updateSettings(); // ajax
            addComment(); // ajax
        }
    };
}();

$(document).ready(function() {
    ShowPage.init();
});
