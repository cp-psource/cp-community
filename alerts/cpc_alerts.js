jQuery(function($) {

    if ($("#cpc_alerts_activity").length) {
        $("#cpc_alerts_activity").select2({
            minimumInputLength: 0,
            minimumResultsForSearch: -1,
            dropdownCssClass: 'cpc_alerts_activity',
        });
    };

    $(document).on('select2:open', ".select2, .select2-multiple", function(e) {
        $('.select2-search input').prop('focus', false);
    });

    $('#cpc_alerts_activity').on("change", function(e) {

        var alert_id = $(this).val();
        var selected = $(this).find('option:selected');
        var url = selected.data('url');

        if (url == 'make_all_read') {

            $(".cpc_alerts_unread").removeClass("cpc_alerts_unread");
            $("#cpc_alerts_activity option[value='count']").remove();
            $(this).parent().find(".select2-selection__rendered").html('');

            $.post(
                cpc_alerts.ajaxurl, {
                    action: 'cpc_alerts_make_all_read',
                    alert_id: alert_id,
                    url: url
                },
                function(response) {}
            );

        } else {

            if (url == 'delete_all_text') {

                $(".cpc_alert_item").remove();
                $("#cpc_alerts_activity option[value='count']").remove();
                $(this).parent().find(".select2-selection__rendered").html('');

                $.post(
                    cpc_alerts.ajaxurl, {
                        action: 'cpc_alerts_delete_all',
                    },
                    function(response) {}
                );

            } else {

                $("body").addClass("cpc_wait_loading");

                $.post(
                    cpc_alerts.ajaxurl, {
                        action: 'cpc_alerts_activity_redirect',
                        alert_id: alert_id,
                        url: url,
                        delete_alert: $(this).attr('rel')
                    },
                    function(response) {
                        window.location.assign(response);
                    }
                );

            }
        }

    });

    // ***** Users for custom post *****
    if ($("#cpc_alert_recipient").length) {

        if ($("#cpc_alert_recipient").val() == '') {
            $("#cpc_alert_recipient").select2({
                minimumInputLength: 1,
                ajax: {
                    url: cpc_alerts.ajaxurl,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            action: 'cpc_get_users',
                            term: params.term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.value,
                                text: item.label
                            });
                        });
                        return {
                            results: results
                        };
                    },
                    cache: true
                }
            });
        }

    }

    // Clear all sent alerts
    $(".cpc_alerts_list_item_link").on('click', function(event) {
        var url = $(this).data('url');
        var alert_id = $(this).data('id');

        $.post(
            cpc_alerts.ajaxurl, {
                action: 'cpc_alerts_activity_redirect',
                alert_id: alert_id,
                url: url
            },
            function(response) {
                window.location.assign(response);
            }
        );

    });

    // Mark all as read (for list)
    $("#cpc_make_all_read").on('click', function(event) {

        $(this).parent().remove();
        $('#cpc_alerts_flag_unread').remove();
        $(".cpc_alerts_unread").removeClass("cpc_alerts_unread");

        $.post(
            cpc_alerts.ajaxurl, {
                action: 'cpc_alerts_make_all_read',
            },
            function(response) {}
        );

    });

    // Delete alert from list
    $(document).on('click', ".cpc_alerts_list_item_delete", function(event) {

        $(this).parent().slideUp('fast');

        $.post(
            cpc_alerts.ajaxurl, {
                action: 'cpc_alerts_list_item_delete',
                alert_id: $(this).attr('rel'),
            },
            function(response) {}
        );

    });

    // Show delete icon on hover
    $(document).on('mouseenter', ".cpc_alerts_list_item", function(event) {

        $(this).children('.cpc_alerts_list_item_delete').show();

    });

    // Hide delete icon when mouse leaves
    $(document).on('mouseleave', ".cpc_alerts_list_item", function(event) {

        $(this).children('.cpc_alerts_list_item_delete').hide();

    });

    // Delete all
    $("#cpc_alerts_delete_all").on('click', function(event) {

        $(".cpc_alerts_list_item").slideUp('fast');
        $(this).hide();
        $("#cpc_mark_all_as_read_div").hide();

        $.post(
            cpc_alerts.ajaxurl, {
                action: 'cpc_alerts_delete_all',
            },
            function(response) {}
        );

    });

});


