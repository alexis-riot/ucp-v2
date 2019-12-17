"use strict";

// Class definition
var EditPermission = function () {

    var initSubmit = function() {
        var request_name = "update";

        var form = $('[data-form-type="' + request_name + '"]');
        var btn = $('[data-type-button="' + request_name + '"]');

        btn.on('click', function(e) {
            e.preventDefault();
            KTApp.progress(btn);

            $.ajax({
                url: form.data('form-url'),
                method: form.data('form-method'),
                data: {
                    'name': $('#name').val(),
                    'group': $('#group').val(),
                    'description': $('#description').val(),
                    'slug': $('#slug').val(),
                },
                success: AjaxResponse,
                error: AjaxResponseDefault,
            });
        });
    };

    return {
        init: function() {
            initSubmit(); // ajax
        }
    };
}();

$(document).ready(function() {
    EditPermission.init();
});
