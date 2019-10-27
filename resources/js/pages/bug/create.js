"use strict";

// Class definition
var KTWizard2 = function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_wizard_v2', {
            startStep: 1, // initial active step number
            clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        });

        wizard.on('beforePrev', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        });

        // Change event
        wizard.on('change', function(wizard) {
            updateReview();
            KTUtil.scrollTop();
        });
    };

    var updateReview = function() {
        var review_username = $('#username').val();
        var review_email =  $('#email').val();
        var review_type =  $('#type option:selected').text();
        var review_priority =  $('#priority option:selected').text();
        var review_subject =  $('#subject').val();
        var review_content = $('.summernote').summernote('code');
        var count_review_medias = getImages().length;

        $(document).find('#review_username').text(review_username);
        $(document).find('#review_email').text(review_email);
        $(document).find('#review_type').text(review_type);
        $(document).find('#review_priority').text(review_priority);
        $(document).find('#review_subject').text(review_subject);
        $(document).find('#review_content').html(review_content);
        $(document).find('#count_review_medias').html(count_review_medias);
    };

    var getImages = function() {
        return $('.images').map(function() {
            return (($(this).val().length > 0) ? $(this).val() : null);
        }).toArray();
    }

    var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                subject: {
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

    var initSummernote = function() {
        $('.summernote').summernote({
            height: 250,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    };

    var initSubmit = function() {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {
                KTApp.progress(btn);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/development/bug',
                    method: 'POST',
                    data: {
                        'bug_type': $('#type').val(),
                        'bug_priority': $('#priority').val(),
                        'subject': $('#subject').val(),
                        'content': $('.summernote').summernote('code'),
                        'images': getImages(),
                    },
                    success: AjaxResponse,
                    error: AjaxResponseDefault,
                });
            }
        });
    };

    return {
        // public functions
        init: function() {
            wizardEl = KTUtil.get('kt_wizard_v2');
            formEl = $('#kt_form');

            $('#kt_repeater_2').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    if(confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });

            initSummernote();
            initWizard();
            initValidation();
            initSubmit();
        }
    };
}();

$(document).ready(function() {
    KTWizard2.init();
});
