"use strict";

/**
 * Define the output of this file. The output of CSS and JS file will be auto detected.
 *
 * @output js/scripts.bundle
 */

// Keentheme"s plugins
window.KTUtil = require("./global/components/base/util");
window.KTApp = require("./global/components/base/app");
window.KTAvatar = require("./global/components/base/avatar");
window.KTDialog = require("./global/components/base/dialog");
window.KTHeader = require("./global/components/base/header");
window.KTMenu = require("./global/components/base/menu");
window.KTOffcanvas = require("./global/components/base/offcanvas");
window.KTPortlet = require("./global/components/base/portlet");
window.KTScrolltop = require("./global/components/base/scrolltop");
window.KTToggle = require("./global/components/base/toggle");
window.KTWizard = require("./global/components/base/wizard");
require("./global/components/base/datatable/core.datatable");
require("./global/components/base/datatable/datatable.checkbox");
require("./global/components/base/datatable/datatable.rtl");
require("./global/components/base/datatable/detail");

// Layout scripts
window.KTLayout = require("./global/layout/layout");
window.KTChat = require("./global/layout/chat");
require("./global/layout/demo-panel");
require("./global/layout/offcanvas-panel");
require("./global/layout/quick-panel");
require("./global/layout/quick-search");

window.AjaxResponse = function (data) {
    swal.fire({
        "title": "",
        "text": data.message,
        "type": data.status,
        "confirmButtonClass": "btn btn-secondary"
    });
    if (data.redirect) {
        setTimeout(function() {
            window.location.href = data.redirect;
        }, 1000);
    } else {
        if (data.reset) {
            $('button[disabled]').closest('form')[0].reset();
        }
        KTApp.unprogress($('button.kt-spinner'));
    }
};


window.AjaxResponseDefault = function(data) {
    var text = "";
    if (data.responseJSON.status && data.responseJSON.status == "error") {
        text = (data.responseJSON.message ? data.responseJSON.message : "An error occurred on the server");
    }
    else {
        $('.is-invalid')
            .removeClass('is-invalid')
            .next('span.invalid-feedback').remove();

        if (data.responseJSON.errors) {
            for(var index in data.responseJSON.errors) {
                for (var msg in data.responseJSON.errors[index]) {
                    var element = $('#' + index);
                    if (element) {

                        element.addClass('is-invalid');
                        element.after('<span class="invalid-feedback">' + data.responseJSON.errors[index][msg] + '</span>');
                    }
                    else {
                        text += data.responseJSON.errors[index][msg] + '<br>';
                    }
                }
            }
        }
        else {
            text = "An error occurred on the server";
        }
    }
    if (text) {
        swal.fire({
            html: true,
            "title": "",
            "html": text,
            "type": "error",
            "confirmButtonClass": "btn btn-secondary"
        });
    }
    KTApp.unprogress($('button.kt-spinner'));
};

window.progressBtn = function(element) {
    element.prepend('<span class="spinner-border spinner-border-sm mr-1"></span> ');
    element.attr('disabled', 'disabled');
};

window.unprogressBtn = function(element) {
    element.find('span.spinner-border').remove();
    element.removeAttr('disabled');
};

