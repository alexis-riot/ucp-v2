"use strict";

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
    BootstrapDatepicker.init();
    BootstrapSelect.init();
});
