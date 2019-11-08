$("#log_select").change(function () {
    var actual_url = window.location.href;
    var url_params = $(this).val();

    location.href = '/admin/logs/panel/' + url_params;
});
