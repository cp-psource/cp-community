jQuery(document).ready(function() {

    // Join site (Multisite only)
	jQuery("#cpc_join_site").on('click', function (event) {
        jQuery.post(
            cpc_usermeta.ajaxurl,
            {
                action : 'cpc_add_to_site',
            },
            function(response) {
                window.location.href=(response);
            }   
        );       
    });

    // ... click required fields message when one is focussed on
    jQuery(".cpc_mandatory_field").on('click', function (event) {
        jQuery('#cpc_required_msg').slideUp('slow');
    });

    // Strength meter (on Edit Profile)
    if(jQuery("#cpc_password_strength_result").length > 0) {
        jQuery("#cpccom_password").bind("keyup", function(){
            var pass1 = jQuery("#cpccom_password").val();
            var pass2 = jQuery("#cpccom_password2").val();
            var strength = passwordStrength(pass1, 'admin', pass2);
            cpc_updateStrength(strength);
            if (pass1 == '' && pass2 == '') { jQuery("#cpc_password_strength_result").hide(); }
        });
        jQuery("#cpccom_password2").bind("keyup", function(){
            var pass1 = jQuery("#cpccom_password").val();
            var pass2 = jQuery("#cpccom_password2").val();
            var strength = passwordStrength(pass1, 'admin', pass2);
            cpc_updateStrength(strength);
            if (pass1 == '' && pass2 == '') { jQuery("#cpc_password_strength_result").hide(); }
        });
    };
    
    // submit Edit Profile
	jQuery(document).on('submit', '#cpc_usermeta_change', function(event) {
        // ... erste Änderung für obligatorische Felder
        var all_filled = true;
        // ... zuerst frühere Hervorhebungen löschen
        // ... und dann gegebenenfalls hinzufügen
    
        jQuery('.cpc_mandatory_field').each(function(i, obj) {
            if (jQuery(this).val().trim() == '') {
                if (jQuery('#s2id_' + jQuery(this).attr('id')).length > 0) {
                    jQuery('#s2id_' + jQuery(this).attr('id')).addClass('cpc_field_error');
                    all_filled = false;
                } else {
                    if (typeof jQuery(this).attr('id') != 'undefined') {
                        if (jQuery(this).attr('id').substr(0, 4) != 's2id') {
                            jQuery(this).addClass('cpc_field_error');
                            jQuery(this).val(''); // falls Leerzeichen eingegeben wurden, entfernen
                            all_filled = false;
                        }
                    }
                }
                // Tab hervorheben
                var tab_div = jQuery(this).closest('.cpc-tab');
                jQuery('#cpc-' + jQuery(tab_div).attr('id')).addClass('cpc_field_error');
            } else {
                if (jQuery('#s2id_' + jQuery(this).attr('id')).length > 0) {
                    jQuery('#s2id_' + jQuery(this).attr('id')).removeClass('cpc_field_error');
                } else {
                    jQuery(this).removeClass('cpc_field_error');
                }
                // Hervorhebung des Tabs entfernen
                var tab_div = jQuery(this).closest('.cpc-tab');
                jQuery('#cpc-' + jQuery(tab_div).attr('id')).removeClass('cpc_field_error');
            }
        });
    
        if (all_filled) {
            // ... überprüfe, ob Passwörter übereinstimmen (falls eingegeben)
            if (jQuery('#cpccom_password').length) {
                if (jQuery('#cpccom_password').val() != jQuery('#cpccom_password2').val()) {
                    jQuery('#cpccom_password').addClass('cpc_field_error');
                    jQuery('#cpccom_password2').addClass('cpc_field_error');
                    jQuery('#cpc_required_msg').slideDown('fast');
                    event.preventDefault();
                    // Tab hervorheben
                    var tab_div = jQuery('#cpccom_password').closest('.cpc-tab');
                    jQuery('#cpc-' + jQuery(tab_div).attr('id')).addClass('cpc_field_error');
                } else {
                    jQuery('#cpccom_password').removeClass('cpc_field_error');
                    jQuery('#cpccom_password2').removeClass('cpc_field_error');
                    // Hervorhebung des Tabs entfernen
                    var tab_div = jQuery('#cpccom_password').closest('.cpc-tab');
                    jQuery('#cpc-' + jQuery(tab_div).attr('id')).removeClass('cpc_field_error');
                }
            }
        } else {
            jQuery('#cpc_required_msg').slideDown('fast');
            event.preventDefault();
        }
    });    

	// cpc_user_button

	jQuery(".cpc_user_button").on('click', function (event) {

		var url = jQuery(this).attr('rel');		
		event.preventDefault();

		window.location = url;

	});
    
    // cpc_close_account
    
    jQuery('#cpc_close_account').on('click', function (event) {
       
        var answer = confirm(jQuery(this).data('sure'));
        if (answer) {
            jQuery.post(
                cpc_usermeta.ajaxurl,
                {
                    action : 'cpc_deactivate_account',
                    user_id: jQuery(this).data('user'),
                },
                function(response) {
                    var url = jQuery('#cpc_close_account').data('url');
                    if (url) {
                        window.location = url;
                    } else {
                        location.reload();
                    }
                }   
            );
        }
    });

    // Edit Profile Page Tabs
    jQuery('.cpc-tabs .cpc-tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
         
        // Show/Hide Tabs
        if (cpc_usermeta.animation == 'fade')
            jQuery('.cpc-tabs ' + currentAttrValue).fadeIn(800).siblings().hide();
        if (cpc_usermeta.animation == 'slide')
            jQuery('.cpc-tabs ' + currentAttrValue).slideDown(800).siblings().slideUp(800);
        if (cpc_usermeta.animation == 'none')
            jQuery('.cpc-tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });

    // Language list
    if (jQuery("#cpccom_lang").length) {
        jQuery("#cpccom_lang").select2({ minimumResultsForSearch: -1 });
    };


});

function cpc_updateStrength(strength){
    var status = new Array('cpc_score_1', 'cpc_score_2', 'cpc_score_3', 'cpc_score_4', 'cpc_score_5');
    var dom = jQuery("#cpc_password_strength_result");
    switch(strength){
    case 1:
      dom.removeClass().show().addClass(status[0]).text(cpc_usermeta.score1);
      break;
    case 2:
      dom.removeClass().show().addClass(status[1]).text(cpc_usermeta.score2);
      break;
    case 3:
      dom.removeClass().show().addClass(status[2]).text(cpc_usermeta.score3);
      break;
    case 4:
      dom.removeClass().show().addClass(status[3]).text(cpc_usermeta.score4);
      break;
    case 5:
      dom.removeClass().show().addClass(status[4]).text(cpc_usermeta.score5);
      break;
    default:
      dom.removeClass().show().addClass(status[0]).text(cpc_usermeta.score1);
      break;
    }
}

