"use strict";

// Class definition
var Delete = function () {
    var initDeleteUsergroup = function() {
        var request_name = "delete_usergroup";
        var btn = $('[data-type-button="' + request_name + '"]');

        btn.on('click', function(e) {
            var form = $(this).closest('[data-form-type="' + request_name + '"]');

            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this! Users linked to this group will lose their permissions.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {
                    e.preventDefault();
                    $.ajax({
                        url: form.data('form-url'),
                        method: form.data('form-method'),
                        success: AjaxResponse,
                        error: AjaxResponseDefault,
                    });
                }
            });
        });
    };

    var initDeletePermission = function() {
        var request_name = "delete_permission";
        var btn = $('[data-type-button="' + request_name + '"]');

        btn.on('click', function(e) {
            var form = $(this).closest('[data-form-type="' + request_name + '"]');

            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this! Usergroup linked to this permission will lose this permission.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                console.log(form);
                if (result.value) {
                    e.preventDefault();
                    $.ajax({
                        url: form.data('form-url'),
                        method: form.data('form-method'),
                        success: AjaxResponse,
                        error: AjaxResponseDefault,
                    });
                }
            });
        });
    };

    return {
        init: function() {
            initDeleteUsergroup();
            initDeletePermission();
        }
    };
}();

$(document).ready(function() {
    Delete.init();
});
