"use strict";

// Class definition
var CreateUsergroup = function () {
    var validator;
    var formEl;

    var checkLabel = function() {
        $("[name='label_permission']").click(function () {
            $(this)
                .closest(".kt-option")
                .toggleClass('selected');
        });
        $("[type='reset']").click(function () {
            $(document)
                .find(".kt-option")
                .removeClass('selected');
        });
    };

    var getPermissions = function() {
        return $("[name='label_permission']").map(function() {
            return (($(this).is(':checked')) ? $(this).val() : null);
        }).toArray();
    };

    var initSubmit = function() {
        var request_name = "create";

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
                        'name': $('#usergroup_name').val(),
                        'permissions': getPermissions(),
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
                usergroup_name: {
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
            formEl = $("[data-form-type='create']");

            checkLabel();
            initSubmit(); // ajax
            initValidation();
        }
    };
}();

$(document).ready(function() {
    CreateUsergroup.init();
});
