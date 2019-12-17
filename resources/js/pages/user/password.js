"use strict";

var UpdatePassword = function () {
    var initSubmit = function() {
        var request_name = "update-password";

        var form = $('[data-form-type="' + request_name + '"]');
        var btn = $('[data-type-button="' + request_name + '"]');

        btn.on('click', function(e) {
            e.preventDefault();
            KTApp.progress(btn);

            $.ajax({
                url: form.data('form-url'),
                method: form.data('form-method'),
                data: {
                    'actual_password': $('#actual_password').val(),
                    'new_password': $('#new_password').val(),
                    'new_confirmed_password': $('#new_confirmed_password').val(),
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
    UpdatePassword.init();
});
