"use strict";

var CreateRequest = function () {
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
                    'name': $('#name').val(),
                    'date_start': $('#date_start').val(),
                    'date_end': $('#date_end').val(),
                    'head': $('#head').val(),
                    'type': $('#type').val(),
                    'reason': $('#reason').val(),
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

var BootstrapDatepicker = {
    init: function() {
        $("#datepicker_leave").datepicker({
            todayHighlight: !0,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        })

        $('#date_start').blur(function() {
            var start_date_val = Math.round(Date.parse($("#date_start").val()) / 1000)
            var date = new Date()

            if (start_date_val != NaN) {
                if (start_date_val < (date.getTime() / 1000) + 259200) {
                    if($('#datepicker_leave').hasClass('has-warning') === false) {
                        $('#datepicker_leave').addClass('has-warning').append('<div id="type_leave-warning" class="form-text text-warning"><b>WARNING:</b> Leave of Absences submitted without three days notice will not be approved unless specifically approved by Head of Staff Management.</div>');
                    }
                }
                else {
                    if($('#datepicker_leave').hasClass('has-warning') === true) {
                        $('#datepicker_leave').removeClass('has-warning');
                        $('#type_leave-warning').remove();
                    }
                }
            }
        })
    }
};

var BootstrapSelect = {
    init: function() {
        $(".m_selectpicker").selectpicker();
    }
};

$(document).ready(function() {
    CreateRequest.init();
    BootstrapDatepicker.init();
    BootstrapSelect.init();
});
