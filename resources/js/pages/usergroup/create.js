"use strict";

// Class definition
var CreateUsergroup = function () {
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
        });
    };

    return {
        init: function() {
            checkLabel();
            initSubmit(); // ajax
        }
    };
}();

$(document).ready(function() {
    CreateUsergroup.init();
});
