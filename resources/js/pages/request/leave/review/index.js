"use strict";

var UpdateRequest = function () {
    var initApprove = function() {
        var request_name = "update-approve";

        var form = $('[data-form-type="' + request_name + '"]');
        var btn = $('[data-type-button="' + request_name + '"]');

        btn.on('click', function(e) {
            e.preventDefault();
            KTApp.progress(btn);

            $.ajax({
                url: form.data('form-url'),
                method: form.data('form-method'),
                data: {
                    'method': 'approve',
                },
                success: AjaxResponse,
                error: AjaxResponseDefault,
            });
        });
    };

    var initDecline = function() {
        var request_name = "update-decline";

        var form = $('[data-form-type="' + request_name + '"]');
        var btn = $('[data-type-button="' + request_name + '"]');

        btn.on('click', function(e) {
            e.preventDefault();
            KTApp.progress(btn);

            $.ajax({
                url: form.data('form-url'),
                method: form.data('form-method'),
                data: {
                    'method': 'decline',
                },
                success: AjaxResponse,
                error: AjaxResponseDefault,
            });
        });
    };

    return {
        init: function() {
            initApprove(); // ajax
            initDecline(); // ajax
        }
    };
}();

function replaceUrlParam(url, paramName, paramValue){
    var pattern = new RegExp('(\\?|\\&)('+paramName+'=).*?(&|$)');
    var newUrl = url;

    if (url.search(pattern) >= 0) {
        newUrl = url.replace(pattern,'$1$2' + paramValue + '$3');
    }
    else {
        newUrl = newUrl + (newUrl.indexOf('?') > 0 ? '&' : '?') + paramName + '=' + paramValue;
    }
    return (newUrl);
}

$("#search").submit(function (event) {
    var actual_url = window.location.href;
    var url_redirect = $(this).find("#search_text").data("url-redirect");
    var url_params = $(this).find("#search_text").val();

    event.preventDefault();
    location.href = replaceUrlParam(actual_url, url_redirect, url_params);
});

$("#status").change(function () {
    var actual_url = window.location.href;
    var url_redirect = $(this).data("url-redirect");
    var url_params = $(this).val();

    location.href = replaceUrlParam(actual_url, url_redirect, url_params);
});

$("#type").change(function () {
    var actual_url = window.location.href;
    var url_redirect = $(this).data("url-redirect");
    var url_params = $(this).val();

    location.href = replaceUrlParam(actual_url, url_redirect, url_params);
});


$(document).ready(function() {
    UpdateRequest.init();
});
