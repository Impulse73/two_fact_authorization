(function(_, $) {
    $(_.doc).ready(function() {
        $(_.doc).on('click', '#send_new_code_link', function(event) {
            fn_get_changed_attempt();
            return false;
        });
    });

    function fn_get_changed_attempt() {
        var attempt_id = $('#attempt_id').val();
        $.ceAjax('request', fn_url("two_fact_auth.change_attempt"), {
            data: {
                attempt: attempt_id,
                result_ids: 'attempt_div',
            },
        });
    }
}(Tygh, Tygh.$));