"use strict";

// Class definition
var DatatableDetail = function () {

    var initDetail = function() {
        toastr.options = {
            "newestOnTop": true,
            "progressBar": true,
            "preventDuplicates": true,
            "positionClass": "toast-bottom-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "5000"
        };

        $(".content").click(function () {
            var get_id = $(this).attr('id');
            var detail = $("tr#" + get_id + ".detail");

            if (detail.length)
                detail.toggleClass("detail-hidden");
            else {
                toastr.info("There is no detailed description for the row you clicked on.", "No Detail");
            }

        });
    };

    return {
        init: function() {
            initDetail();
        }
    };
}();

$(document).ready(function() {
    DatatableDetail.init();
});
