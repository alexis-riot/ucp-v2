"use strict";

// Class definition
var CreatePermission = function () {
    var request_name = "create";

    var validator;
    var formEl;

    var initSubmit = function() {

        var form = $('[data-form-type="' + request_name + '"]');
        var btn = $('[data-type-button="' + request_name + '"]');

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {
                KTApp.progress(btn);

                $.ajax({
                    url: form.data('form-url'),
                    method: form.data('form-method'),
                    data: {
                        'name': $('#name').val(),
                        'group': $('#group').val(),
                        'description': $('#description').val(),
                    },
                    success: AjaxResponse,
                    error: AjaxResponseDefault,
                });
            }
        });
    };

    var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                name: {
                    required: true
                },
                group: {
                    required: true
                },
                description: {
                    required: true
                },
            },

            // Display error
            invalidHandler: function(event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": "There are some errors in your submission. Please correct them.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
            },
        });
    };

    return {
        init: function() {
            formEl = $("[data-form-type='" + request_name + "']");

            initSubmit(); // ajax
            initValidation();
        }
    };
}();

$(document).ready(function() {
    CreatePermission.init();
});
