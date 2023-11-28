<?php

// Default settings header
add_action('cpc_admin_getting_started_hook', 'cpc_admin_getting_started_options_header', 0.5);
function cpc_admin_getting_started_options_header() {
    // Default settings hook
    do_action( 'cpc_admin_getting_started_options_hook' );
    
}

// Add Default settings information
add_action('cpc_admin_getting_started_shortcodes_hook', 'cpc_admin_getting_started_options', 1);
function cpc_admin_getting_started_options() {
    
    echo '<div class="wrap">';
            
        echo '<style>';
            echo '.wrap { margin-top: 30px !important; margin-right: 10px !important; margin-left: 5px !important; }';
        echo '</style>';
        echo '<div id="cpc_release_notes">';
            echo '<div id="cpc_welcome_bar" style="margin-top: 20px;">';
                echo '<img id="cpc_welcome_logo" style="width:56px; height:56px; float:left;" src="'.plugins_url('../cp-community/css/images/cpc_logo.png', __FILE__).'" title="'.__('help', CPC2_TEXT_DOMAIN).'" />';
                echo '<div style="font-size:2em; line-height:1em; font-weight:100; color:#fff;">'.__('Willkommen bei CP-Community', CPC2_TEXT_DOMAIN).'</div>';
                echo '<p style="color:#fff;"><em>'.__('Das ultimative Plugin für soziale Netzwerke für ClassicPress', CPC2_TEXT_DOMAIN).'</em></p>';
            echo '</div>';

            $css = 'cpc_admin_getting_started_menu_item_remove_icon ';    
          	echo '<div style="margin-top:25px" class="'.$css.'cpc_admin_getting_started_menu_item_no_click" >'.__('CP-Community-Shortcodes und Standardeinstellungen', CPC2_TEXT_DOMAIN).'</div>';    
        	$display = 'block';
          	echo '<div class="cpc_admin_getting_started_content" id="cpc_admin_getting_started_options" style="display:'.$display.'">';
            
                echo '<div id="cpc_admin_getting_started_options_outline">';
            
                    // reset options?
                    if (isset($_GET['cpc_reset_options'])) {

                        global $wpdb;
                        $sql = "DELETE FROM ".$wpdb->prefix."options WHERE option_name like 'cpc_shortcode_options%'";
                        $wpdb->query($sql);
                        delete_option('cpccom_global_styles'); // global styles flag
                        echo '<div class="cpc_success" style="margin-top:20px">';
                            echo sprintf(__('Die Shortcode-Optionen der CP-Community wurden alle zurückgesetzt! <a href="%s">Weiter...</a>', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpc_com_shortcodes' ));
                        echo '</div>';

                    } else {
            
                        echo '<div id="cpc_admin_getting_started_options_help" style="margin-bottom:20px;'.(true || !isset($_POST['cpc_expand_shortcode']) ? '' : 'display:none;').'">';
                        echo __('Dieser Abschnitt bietet eine schnelle und einfache Möglichkeit, alle Shortcodes der CP-Community anzuzeigen und anzupassen, die jeweils zu jeder ClassicPress-Seite, jedem Beitrag oder jedem Text-Widget hinzugefügt werden können.', CPC2_TEXT_DOMAIN).'<br />';
                        echo sprintf(__('Wenn Du nicht sicher bist, welcher Shortcode auf einer ClassicPress-Seite verwendet wird, <a href="%s">bearbeite die Seite</a> und schaue im Seiteninhaltseditor nach.', CPC2_TEXT_DOMAIN), admin_url( 'edit.php?post_type=page' )).'</p>';
                        echo '<p style="margin-top:-8px">'.sprintf(__('Wähle in der linken Spalte einen allgemeinen Bereich und dann einen angezeigten Shortcode aus. Du kannst dann die Standardwerte sehen und festlegen und weitere Hilfe für diesen Shortcode erhalten. Um einen Wert zurückzusetzen, entferne den Wert und speichere ihn, oder <a onclick="return confirm(\''.__('Bist Du Dir sicher, dass dies nicht rückgängig gemacht werden kann?', CPC2_TEXT_DOMAIN).'\')" href="% s">Alle Shortcode-Optionen zurücksetzen</a>.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpc_com_shortcodes&cpc_reset_options=1' )).' ';
                        echo __('Du kannst jedem Shortcode auch Optionen hinzufügen, wenn Du eine Seite/einen Beitrag/ein Widget bearbeitest, indem Du Shortcode-Optionen verwendest.', CPC2_TEXT_DOMAIN).'</p>';
                        echo '<div style="width:100%;text-align:center;"><div style="margin-left:auto;margin-right:auto;width:25%;padding:6px;background-color:#cfcfcf">'.sprintf('%s','<a href="javascript:void(0);" id="cpc_show_shortcodes_show">Beispiele zeigen</a><a href="javascript:void(0);" id="cpc_show_shortcodes_hide" style="display:none">Beispiele ausblenden</a>').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo sprintf('%s','<a href="javascript:void(0);" id="cpc_show_shortcodes_desc_show">Hilfeinformationen anzeigen</a><a href="javascript:void(0);" id="cpc_show_shortcodes_desc_hide" style="display:none">Hilfeinformationen ausblenden</a>').'</div></div>';
                        echo '</div>';

                        echo '<div id="cpc_admin_getting_started_options_please_wait">';
                            echo __('Bitte warten, Werte werden geladen...', CPC2_TEXT_DOMAIN);
                        echo '</div>';

                        echo '<div id="cpc_admin_getting_started_options_left_and_middle" style="display: none;">';
                            echo '<div id="cpc_admin_getting_started_options_left">';
                                /* TABS (1st column) */
                                $cpc_expand_tab = isset($_POST['cpc_expand_tab']) ? $_POST['cpc_expand_tab'] : 'activity';
                                $tabs = array();
                                array_push($tabs, array('tab' => 'cpc_option_activity',     'option' => 'activity',     'title' => __('Aktivität', CPC2_TEXT_DOMAIN)));
                                array_push($tabs, array('tab' => 'cpc_option_alerts',       'option' => 'alerts',       'title' => __('Benachrichtigungen', CPC2_TEXT_DOMAIN)));
                                array_push($tabs, array('tab' => 'cpc_option_avatar',       'option' => 'avatar',       'title' => __('Avatar', CPC2_TEXT_DOMAIN)));
                                array_push($tabs, array('tab' => 'cpc_option_forums',       'option' => 'forums',       'title' => __('Forum', CPC2_TEXT_DOMAIN)));
                                array_push($tabs, array('tab' => 'cpc_option_friends',      'option' => 'friends',      'title' => __('Freunde', CPC2_TEXT_DOMAIN)));
                                array_push($tabs, array('tab' => 'cpc_option_conditional',  'option' => 'conditional',  'title' => __('Bedingt', CPC2_TEXT_DOMAIN)));
                                array_push($tabs, array('tab' => 'cpc_option_profile',      'option' => 'profile',      'title' => __('Profil', CPC2_TEXT_DOMAIN)));

                                // any more tabs?
                                $tabs = apply_filters( 'cpc_options_show_tab_filter', $tabs );

                                $sort = array();
                                foreach($tabs as $k=>$v) {
                                    $sort['title'][$k] = $v['title'];
                                }
                                array_multisort($sort['title'], SORT_ASC, $tabs);    

                                foreach ($tabs as $tab):
                                    echo cpc_show_tab($cpc_expand_tab, $tab['tab'], $tab['option'], $tab['title']);
                                endforeach;

                                echo '<div id="cpc_options_save_button" style="text-align:left"><input type="submit" id="cpc_shortcode_options_save_submit" name="Submit" class="button-primary" value="'.__('Shortcode-Optionen speichern', CPC2_TEXT_DOMAIN).'" /></div>';
                                echo '<span style="float:left" class="spinner"></span>';

                            echo '</div>';

                            echo '<div id="cpc_admin_getting_started_options_middle">';
                                /* SHORTCODES (2nd column) */
                                $cpc_expand_shortcode = isset($_POST['cpc_expand_shortcode']) ? $_POST['cpc_expand_shortcode'] : 'cpc_activity_page_tab';
                                // Activity Tab
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'activity', 'cpc_activity_tab', CPC_PREFIX.'-activity');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'activity', 'cpc_activity_page_tab', CPC_PREFIX.'-activity-page');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'activity', 'cpc_activity_post_tab', CPC_PREFIX.'-activity-post');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'activity', 'cpc_alerts_activity_tab', CPC_PREFIX.'-alerts-activity');
                                
                                // Alerts Tab
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'alerts', 'cpc_alerts_activity_tab', CPC_PREFIX.'-alerts-activity');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'alerts', 'cpc_alerts_friends_tab', CPC_PREFIX.'-alerts-friends');
                                
                                // Avatar Tab
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'avatar', 'cpc_avatar_tab', CPC_PREFIX.'-avatar');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'avatar', 'cpc_avatar_change_tab', CPC_PREFIX.'-avatar-change');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'avatar', 'cpc_avatar_change_link_tab', CPC_PREFIX.'-avatar-change-link');
                                
                                // Forums
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forum_tab', CPC_PREFIX.'-forum');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forum_backto_tab', CPC_PREFIX.'-forum-backto');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forum_comment_tab', CPC_PREFIX.'-forum-reply');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forum_page_tab', CPC_PREFIX.'-forum-page');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forum_post_tab', CPC_PREFIX.'-forum-post');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forums_tab', CPC_PREFIX.'-forums');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forum_sharethis_insert_tab', CPC_PREFIX.'-forum-sharethis');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forum_show_posts_tab', CPC_PREFIX.'-forum-show-posts');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forum_children_tab', CPC_PREFIX.'-forum-children');
                        
                                // Conditional Tab
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'conditional', 'cpc_user_id_tab', CPC_PREFIX.'-user-id');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'conditional', 'cpc_is_logged_in_tab', CPC_PREFIX.'-is-logged-in');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'conditional', 'cpc_not_logged_in_tab', CPC_PREFIX.'-not-logged-in');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'conditional', 'cpc_is_forum_posts_list_tab', CPC_PREFIX.'-is-forum-posts-list');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'conditional', 'cpc_is_forum_single_post_tab', CPC_PREFIX.'-is-forum-single-post');

                                // Friendships
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'friends', 'cpc_friends_tab', CPC_PREFIX.'-friends');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'friends', 'cpc_friends_add_button_tab', CPC_PREFIX.'-friends-add-button');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'friends', 'cpc_friends_status_tab', CPC_PREFIX.'-friends-status');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'friends', 'cpc_friends_pending_tab', CPC_PREFIX.'-friends-pending');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'friends', 'cpc_alerts_friends_tab', CPC_PREFIX.'-alerts-friends');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'friends', 'cpc_friends_count_tab', CPC_PREFIX.'-friends-count');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'friends', 'cpc_favourite_friend_tab', CPC_PREFIX.'-favourite-friend');
                        
                                // Profile Tab
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_activity_page_tab', CPC_PREFIX.'-activity-page');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_display_name_tab', CPC_PREFIX.'-display-name');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_usermeta_button_tab', CPC_PREFIX.'-usermeta-button');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_usermeta_change_tab', CPC_PREFIX.'-usermeta-change');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_usermeta_change_link_tab', CPC_PREFIX.'-usermeta-change-link');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_usermeta_tab', CPC_PREFIX.'-usermeta');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_close_account_tab', CPC_PREFIX.'-close-account');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_join_site_tab', CPC_PREFIX.'-join-site');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_last_logged_in_tab', CPC_PREFIX.'-last-logged-in');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'profile', 'cpc_last_active_tab', CPC_PREFIX.'-last-active');
                                echo cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, 'conditional', 'cpc_no_user_check', CPC_PREFIX.'-no-user-check');

                                // Group Tab

                                // any more shortcodes?
                                do_action('cpc_options_shortcode_hook', $cpc_expand_tab, $cpc_expand_shortcode);    

                            echo '</div>';
                        echo '</div>';    

                        echo '<div id="cpc_admin_getting_started_options_right" style="display: none;">';

                            /* ----------------------- CONDITIONAL TAB ----------------------- */    

                            // [cpc-user-id]
                            $values = get_option('cpc_shortcode_options_'.'cpc_conditional') ? get_option('cpc_shortcode_options_'.'cpc_conditional') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_user_id_tab');
                                echo '<strong>'.__('Zweck:', CPC2_TEXT_DOMAIN).'</strong> '.__("Gibt die Benutzer-ID des aktuellen Benutzers aus, oder, wenn auf einer Profilseite, diese Benutzer-ID.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('Wie benutzt man:', CPC2_TEXT_DOMAIN).'</strong> '.__('Füge [cpc-user-id] zu einer ClassicPress-Seite, einem Beitrag oder einem Text-Widget hinzu.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-user-id/');
                                echo '<p><strong>'.__('Optionen', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Keine Optionen', CPC2_TEXT_DOMAIN).'</td></tr>';

                                echo '</table>';
                            echo '</div>';    

                            // [cpc-is-logged-in]
                            $values = get_option('cpc_shortcode_options_'.'cpc_conditional') ? get_option('cpc_shortcode_options_'.'cpc_conditional') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_is_logged_in_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Only displays content when the browser (user) <strong>is</strong> logged in.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-is-logged-in]CONTENT[/cpc-is-logged-in] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-is-logged-in/');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';

                                    do_action('cpc_show_styling_options_hook', 'cpc_is_logged_in', $values);        

                                echo '</table>';
                            echo '</div>';    

                            // [cpc-not-logged-in]
                            $values = get_option('cpc_shortcode_options_'.'cpc_conditional') ? get_option('cpc_shortcode_options_'.'cpc_conditional') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_not_logged_in_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Only displays content when the browser (user) is <strong>not</strong> logged in.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-not-logged-in]CONTENT[/cpc-not-logged-in] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-not-logged-in/');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';

                                    do_action('cpc_show_styling_options_hook', 'cpc_not_logged_in', $values);        

                                echo '</table>';
                            echo '</div>';    

                            // [cpc-is-forum-posts-list]
                            $values = get_option('cpc_shortcode_options_'.'cpc_conditional') ? get_option('cpc_shortcode_options_'.'cpc_conditional') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_is_forum_posts_list_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Only displays content viewing a list of forum posts.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-is-forum-posts-list]CONTENT[/cpc-is-forum-posts-list] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-is-forum-posts-list');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';

                                    do_action('cpc_show_styling_options_hook', 'cpc_is_forum_posts_list', $values);        

                                echo '</table>';
                            echo '</div>';    

                            // [cpc-is-forum-single-post]
                            $values = get_option('cpc_shortcode_options_'.'cpc_conditional') ? get_option('cpc_shortcode_options_'.'cpc_conditional') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_is_forum_single_post_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Only displays content when viewing a single forum post with replies/comments.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc_is_forum_single_post]CONTENT[/cpc_is_forum_single_post] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-is-forum-single-post');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';

                                    do_action('cpc_show_styling_options_hook', 'cpc_is_forum_single_post', $values);        

                                echo '</table>';
                            echo '</div>';    

                                                
                            /* ----------------------- ACTIVITY TAB ----------------------- */    

                            // [cpc-activity]
                            $values = get_option('cpc_shortcode_options_'.'cpc_activity') ? get_option('cpc_shortcode_options_'.'cpc_activity') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_activity_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays activity feed of the user.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-activity] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-activity/');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Include user's own activity", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $include_self = cpc_get_shortcode_default($values, 'cpc_activity-include_self', true);
                                        echo '<input type="checkbox" name="cpc_activity-include_self"'.($include_self ? ' CHECKED' : '').'></td><td>(include_self="'.($include_self ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Whether or not to include the user’s activity in the activity stream.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Include user's friends activity", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $include_friends = cpc_get_shortcode_default($values, 'cpc_activity-include_friends', true);
                                        echo '<input type="checkbox" name="cpc_activity-include_friends"'.($include_friends ? ' CHECKED' : '').'></td><td>(include_friends="'.($include_friends ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Whether or not to include activity from the user’s friends or not. Increases load on server if you do.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("How long since friend has been active for activity to be included", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $active_friends = cpc_get_shortcode_default($values, 'cpc_activity-active_friends', 30);
                                        echo '<input type="text" name="cpc_activity-active_friends" value="'.$active_friends.'" /> '.__('days', CPC2_TEXT_DOMAIN).'</td><td>(active_friends="'.$active_friends.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Exclude inactive friends since ‘x’ number of days.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Number of activity items shown at a time', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $page_size = cpc_get_shortcode_default($values, 'cpc_activity-page_size', 10);
                                        echo '<input type="text" name="cpc_activity-page_size" value="'.$page_size.'" /></td><td>(page_size="'.$page_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('How many to show before loading more, keep lower to improve performance.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Maximum activity posts retrieved for user', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $get_max = cpc_get_shortcode_default($values, 'cpc_activity-get_max', 50);
                                        echo '<input type="text" name="cpc_activity-get_max" value="'.$get_max.'" /></td><td>(get_max="'.$get_max.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Avoid adding to the load on your server by keeping this number smaller.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Maximum activity posts retrieved from friends', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $get_max_friends = cpc_get_shortcode_default($values, 'cpc_activity-get_max_friends', 50);
                                        echo '<input type="text" name="cpc_activity-get_max_friends" value="'.$get_max.'" /></td><td>(get_max_friends="'.$get_max_friends.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Avoid adding to the load on your server by keeping this number smaller.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Avatar size', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $avatar_size = cpc_get_shortcode_default($values, 'cpc_activity-avatar_size', 64);
                                        echo '<input type="text" name="cpc_activity-avatar_size" value="'.$avatar_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(avatar_size="'.$avatar_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('The size of the user’s avatar shown beside the activity post.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Word limit for posts', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $more = cpc_get_shortcode_default($values, 'cpc_activity-more', 50);
                                        echo '<input type="text" name="cpc_activity-more" value="'.$more.'" /> '.__('words', CPC2_TEXT_DOMAIN).'</td><td>(more="'.$more.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('The maximum number of words allowed in a single post.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Text to show reset of truncated posts', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $more_label = cpc_get_shortcode_default($values, 'cpc_activity-more_label', __('more', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-more_label" value="'.$more_label.'" /></td><td>(more_label="'.$more_label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('When long posts are truncated, what word should be shown to click on to show the rest of the post.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Hide activity until fully loaded", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $hide_until_loaded = cpc_get_shortcode_default($values, 'cpc_activity-hide_until_loaded', false);
                                        echo '<input type="checkbox" name="cpc_activity-hide_until_loaded"'.($hide_until_loaded ? ' CHECKED' : '').'></td><td>(hide_until_loaded="'.($hide_until_loaded ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Set this to wait until all activity has loaded before showing it, can make the page load appearance more managed.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Comment avatar size', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comment_avatar_size = cpc_get_shortcode_default($values, 'cpc_activity-comment_avatar_size', 40);
                                        echo '<input type="text" name="cpc_activity-comment_avatar_size" value="'.$comment_avatar_size.'" /></td><td>(comment_avatar_size="'.$comment_avatar_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Avatar size for comment.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Number of comments shown', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comment_size = cpc_get_shortcode_default($values, 'cpc_activity-comment_size', 5);
                                        echo '<input type="text" name="cpc_activity-comment_size" value="'.$comment_size.'" /></td><td>(comment_size="'.$comment_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Number of comments shown, previous ones are hidden.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Text for multiple previous comments', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comment_size_text_plural = cpc_get_shortcode_default($values, 'cpc_activity-comment_size_text_plural', __('Show previous %d comments...', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-comment_size_text_plural" value="'.$comment_size_text_plural.'" /></td><td>(comment_size_text_plural="'.$comment_size_text_plural.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Text that is shown if there are 2+ previous comments.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Text for one previous comment', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comment_size_text_singular = cpc_get_shortcode_default($values, 'cpc_activity-comment_size_text_singular', __('Show previous comment...', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-comment_size_text_singular" value="'.$comment_size_text_singular.'" /></td><td>(comment_size_text_singular="'.$comment_size_text_singular.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Text that is shown if there is 1 previous comment.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Label for Comment button', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_activity-label', __('Comment', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Erm… label for the comment button!', CPC2_TEXT_DOMAIN).' :)';
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Optional CSS class for button', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $class = cpc_get_shortcode_default($values, 'cpc_activity-class', '');
                                        echo '<input type="text" name="cpc_activity-class" value="'.$class.'" /></td><td>(class="'.$class.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Add a CSS class to the button.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("User names link to profile page", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $link = cpc_get_shortcode_default($values, 'cpc_activity-link', true);
                                        echo '<input type="checkbox" name="cpc_activity-link"'.($link ? ' CHECKED' : '').'></td><td>(link="'.$link.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Whether or not user names link to their profile page.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Activity is private message', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $private_msg = cpc_get_shortcode_default($values, 'cpc_activity-private_msg', __('Activity is private', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-private_msg" value="'.$private_msg.'" /></td><td>(private_msg="'.$private_msg.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Message shown if activity cannot be seen due to privacy settings.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Post no longer exists message', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $not_found = cpc_get_shortcode_default($values, 'cpc_activity-not_found', __('Sorry, this activity post is not longer available.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-not_found" value="'.$not_found.'" /></td><td>(not_found="'.$not_found.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Message shown if the message no longer exists, probably deleted.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Delete option label', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $delete_label = cpc_get_shortcode_default($values, 'cpc_activity-delete_label', __('Delete', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-delete_label" value="'.$delete_label.'" /></td><td>(delete_label="'.$delete_label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Word(s) for the delete option.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Stick option label', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $sticky_label = cpc_get_shortcode_default($values, 'cpc_activity-sticky_label', __('Stick', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-sticky_label" value="'.$sticky_label.'" /></td><td>(sticky_label="'.$sticky_label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Word(s) for the stick option.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Unstick option label', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $unsticky_label = cpc_get_shortcode_default($values, 'cpc_activity-unsticky_label', __('Unstick', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-unsticky_label" value="'.$unsticky_label.'" /></td><td>(unsticky_label="'.$unsticky_label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Word(s) for the unstick option.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Hide option label', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $hide_label = cpc_get_shortcode_default($values, 'cpc_activity-hide_label', __('Hide', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-hide_label" value="'.$hide_label.'" /></td><td>(hide_label="'.$hide_label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Word(s) for the hide option.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Include Report option", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $report = cpc_get_shortcode_default($values, 'cpc_activity-report', true);
                                        echo '<input type="checkbox" name="cpc_activity-report"'.($report ? ' CHECKED' : '').'></td><td>(report="'.($report ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Whether or not the report option is shown.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Report option label', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $report_label = cpc_get_shortcode_default($values, 'cpc_activity-report_label', __('Report', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-report_label" value="'.$report_label.'" /></td><td>(report_label="'.$report_label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('The label for the report option if shown.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Report email recipient', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $report_email = cpc_get_shortcode_default($values, 'cpc_activity-report_email', get_bloginfo('admin_email'));
                                        echo '<input type="text" name="cpc_activity-report_email" value="'.$report_email.'" /></td><td>(report_email="'.$report_email.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('An email address where reports are sent.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';

                                    echo '<tr><td>'.__("Honour friends sticky posts", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $stick_others = cpc_get_shortcode_default($values, 'cpc_activity-stick_others', false);
                                        echo '<input type="checkbox" name="cpc_activity-stick_others"'.($stick_others ? ' CHECKED' : '').'></td><td>(stick_others="'.($stick_others ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('If a friend’s post is sticky, should it also be sticky on the user’s profile activity.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Allow comments", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $allow_replies = cpc_get_shortcode_default($values, 'cpc_activity-allow_replies', true);
                                        echo '<input type="checkbox" name="cpc_activity-allow_replies"'.($allow_replies ? ' CHECKED' : '').'></td><td>(allow_replies="'.($allow_replies ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Should comments be allowed.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Date format', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $date_format = cpc_get_shortcode_default($values, 'cpc_activity-date_format', __('%s ago', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-date_format" value="'.$date_format.'" /></td><td>(date_format="'.$date_format.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Format of the date, %s is used to replace how long ago the post was made.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Logged out message', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $logged_out_msg = cpc_get_shortcode_default($values, 'cpc_activity-logged_out_msg', __('You must be logged in to view the profile page.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity-logged_out_msg" value="'.$logged_out_msg.'" /></td><td>(logged_out_msg="'.$logged_out_msg.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Message shown if you need to be logged in to see the activity.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Optional URL to login", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $login_url = cpc_get_shortcode_default($values, 'cpc_activity-login_url', '');
                                        echo '<input type="text" name="cpc_activity-login_url" value="'.$login_url.'" /></td><td>(login_url="'.$login_url.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('An optional link to login, combined with the above.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_activity', $values);        

                                echo '</table>';
                            echo '</div>';    

                            // [cpc-activity-page]
                            $values = get_option('cpc_shortcode_options_'.'cpc_activity_page') ? get_option('cpc_shortcode_options_'.'cpc_activity_page') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_activity_page_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__('Displays a default profile page with common elements all set up.', CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-activity-page] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-activity-page');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong></p>';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Size of the user's avatar", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $user_avatar_size = cpc_get_shortcode_default($values, 'cpc_activity_page-user_avatar_size', 150);
                                        echo '<input type="text" name="cpc_activity_page-user_avatar_size" value="'.$user_avatar_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(user_avatar_size="'.$user_avatar_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("How big the user's avatar is", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Style of Google Map', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $map_style = cpc_get_shortcode_default($values, 'cpc_activity_page-map_style', 'dynamic');
                                        echo '<select name="cpc_activity_page-map_style">';
                                            echo '<option value="static"'.($map_style == 'static' ? ' SELECTED' : '').'>'.__('Static', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="dynamic"'.($map_style == 'dynamic' ? ' SELECTED' : '').'>'.__('Dynamic', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(map_style="'.$map_style.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Static is an image, dynamic can be moved around and zoomed in and out.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Size of Google Map', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $map_size = cpc_get_shortcode_default($values, 'cpc_activity_page-map_size', '150,150');
                                        echo '<input type="text" name="cpc_activity_page-map_size" value="'.$map_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(map_size="'.$map_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('How big in pixels.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Zoom level of Google Map', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $map_zoom = cpc_get_shortcode_default($values, 'cpc_activity_page-map_zoom', 4);
                                        echo '<input type="text" name="cpc_activity_page-map_zoom" value="'.$map_zoom.'" /></td><td>(map_zoom="'.$map_zoom.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Based on the scale used by Google, the initial zoom level.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Label for Stadt/Gemeinde', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $town_label = cpc_get_shortcode_default($values, 'cpc_activity_page-town_label', __('Stadt/Gemeinde', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity_page-town_label" value="'.$town_label.'" /></td><td>(town_label="'.$town_label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Normally a city, but can be any level of detail.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Label for Country', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $country_label = cpc_get_shortcode_default($values, 'cpc_activity_page-country_label', __('Country', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity_page-country_label" value="'.$country_label.'" /></td><td>(country_label="'.$country_label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Related to town, normally country, but can be a different level of detail.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Friend Requests Label', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $requests_label = cpc_get_shortcode_default($values, 'cpc_activity_page-requests_label', __('Friend Requests', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity_page-requests_label" value="'.$requests_label.'" /></td><td>(requests_label="'.$requests_label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Label for friend requests.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_activity_page', $values);        

                                echo '</table>';
                            echo '</div>';

                            // [cpc-activity-post]
                            $values = get_option('cpc_shortcode_options_'.'cpc_activity_post') ? get_option('cpc_shortcode_options_'.'cpc_activity_post') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_activity_post_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a text area for adding an activity post.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-activity-post] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-activity-post/');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Optional CSS class for button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $class = cpc_get_shortcode_default($values, 'cpc_activity_post-class', '');
                                        echo '<input type="text" name="cpc_activity_post-class" value="'.$class.'" /></td><td>(class="'.$class.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("A class to be added to the button for styling.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Label for button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_activity_post-label', __('Add Post', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity_post-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("The label on the button.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Message that only friends can post", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $private_msg = cpc_get_shortcode_default($values, 'cpc_activity_post-private_msg', __('You do not have permission to post here', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity_post-private_msg" value="'.$private_msg.'" /></td><td>(private_msg="'.$private_msg.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Message shown if not allowed to post to activity.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Message that account is closed", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $account_closed_msg = cpc_get_shortcode_default($values, 'cpc_activity_post-account_closed_msg', __('Account closed.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_activity_post-account_closed_msg" value="'.$account_closed_msg.'" /></td><td>(account_closed_msg="'.$account_closed_msg.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Account is closed message.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon in new activity post textarea", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $background_icon = cpc_get_shortcode_default($values, 'cpc_activity_post-background_icon', false);
                                        echo '<input type="checkbox" name="cpc_activity_post-background_icon"'.($background_icon ? ' CHECKED' : '').'></td><td>(background_icon="'.($background_icon ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Should a little icon be shown inside the post textarea?", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_activity_post', $values);

                                echo '</table>';
                            echo '</div>';
                        
                            // [cpc-display-name]
                            $values = get_option('cpc_shortcode_options_'.'cpc_display_name') ? get_option('cpc_shortcode_options_'.'cpc_display_name') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_display_name_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a users display name.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-display-name] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-display-name/');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';

                                    echo '<tr><td>'.__('User', CPC2_TEXT_DOMAIN).'</td><td>';
                                    $user_id = cpc_get_shortcode_default($values, 'cpc_display_name-user_id', '');
                                    echo '<select name="cpc_display_name-user_id">';
                                        echo '<option value=""'.($user_id == '' ? ' SELECTED' : '').'>'.__('Reflects page context', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '<option value="user"'.($user_id == 'user' ? ' SELECTED' : '').'>'.__('Current user', CPC2_TEXT_DOMAIN).'</option>';
                                    echo '</select> '.__('or set to a user ID in shortcode', CPC2_TEXT_DOMAIN).'</td><td>(user_id="'.$user_id.'")</td></tr>';    
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Which user to display. Can also set to a user ID via the shortcode itself.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';    

                                    echo '<tr><td>'.__("Name links to profile page", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $link = cpc_get_shortcode_default($values, 'cpc_display_name-link', false);
                                        echo '<input type="checkbox" name="cpc_display_name-link"'.($link ? ' CHECKED' : '').'></td><td>(link="'.($link ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Should the name link to the profile page?', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';    

                                    echo '<tr><td>'.__('Show first name/last name instead of display name', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $firstlast = cpc_get_shortcode_default($values, 'cpc_display_name-firstlast', false);
                                        echo '<input type="checkbox" name="cpc_display_name-firstlast"'.($firstlast ? ' CHECKED' : '').'></td><td>(firstlast="'.($firstlast ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __('Show first name and last name, useful if sorting by last name. Consider if people are actually filling these in though on your site.', CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';    
                        
                                    do_action('cpc_show_styling_options_hook', 'cpc_display_name', $values);

                                echo '</table>';
                            echo '</div>';                        

                            // [cpc-last-logged-in]
                            $values = get_option('cpc_shortcode_options_'.'cpc_last_logged_in') ? get_option('cpc_shortcode_options_'.'cpc_last_logged_in') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_last_logged_in_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays when a user last logged in.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-last-logged-in] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-last-logged-in/');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';

                                    echo '<tr><td>'.__('User', CPC2_TEXT_DOMAIN).'</td><td>';
                                    $user_id = cpc_get_shortcode_default($values, 'cpc_last_logged_in-user_id', '');
                                    echo '<select name="cpc_last_logged_in-user_id">';
                                        echo '<option value=""'.($user_id == '' ? ' SELECTED' : '').'>'.__('Reflects page context', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '<option value="user"'.($user_id == 'user' ? ' SELECTED' : '').'>'.__('Current user', CPC2_TEXT_DOMAIN).'</option>';
                                    echo '</select> '.__('or set to a user ID in shortcode', CPC2_TEXT_DOMAIN).'</td><td>(user_id="'.$user_id.'")</td></tr>';    
                        
                                    echo '<tr><td>'.__("Format for date", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $date_format = cpc_get_shortcode_default($values, 'cpc_last_logged_in-date_format', __('%s ago', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_last_logged_in-date_format" value="'.$date_format.'" /></td><td>(date_format="'.$date_format.'")</td></tr>';                        
                                    echo '<tr><td>'.__("No last login text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $not_logged_in_msg = cpc_get_shortcode_default($values, 'cpc_last_logged_in-not_logged_in_msg', __('Not logged in recently.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_last_logged_in-not_logged_in_msg" value="'.$not_logged_in_msg.'" /></td><td>(not_logged_in_msg="'.$not_logged_in_msg.'")</td></tr>';                        
                        
                                    do_action('cpc_show_styling_options_hook', 'cpc_last_logged_in', $values);

                                echo '</table>';
                            echo '</div>';
                        
                            // [cpc-last-active]
                            $values = get_option('cpc_shortcode_options_'.'cpc_last_active') ? get_option('cpc_shortcode_options_'.'cpc_last_active') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_last_active_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays when a user was last active.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-last-active] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-last-active/');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';

                                    echo '<tr><td>'.__('User', CPC2_TEXT_DOMAIN).'</td><td>';
                                    $user_id = cpc_get_shortcode_default($values, 'cpc_last_active-user_id', '');
                                    echo '<select name="cpc_last_active-user_id">';
                                        echo '<option value=""'.($user_id == '' ? ' SELECTED' : '').'>'.__('Reflects page context', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '<option value="user"'.($user_id == 'user' ? ' SELECTED' : '').'>'.__('Current user', CPC2_TEXT_DOMAIN).'</option>';
                                    echo '</select> '.__('or set to a user ID in shortcode', CPC2_TEXT_DOMAIN).'</td><td>(user_id="'.$user_id.'")</td></tr>';    

                                    echo '<tr><td>'.__("Format for date", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $date_format = cpc_get_shortcode_default($values, 'cpc_last_active-date_format', __('%s ago', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_last_active-date_format" value="'.$date_format.'" /></td><td>(date_format="'.$date_format.'")</td></tr>';                        
                                    echo '<tr><td>'.__("No last login text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $not_logged_in_msg = cpc_get_shortcode_default($values, 'cpc_last_active-not_logged_in_msg', __('Not logged in recently.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_last_active-not_logged_in_msg" value="'.$not_logged_in_msg.'" /></td><td>(not_logged_in_msg="'.$not_logged_in_msg.'")</td></tr>';                        
                        
                                    do_action('cpc_show_styling_options_hook', 'cpc_last_active', $values);

                                echo '</table>';
                            echo '</div>';                            

                            /* ----------------------- ALERTS TAB ----------------------- */

                            // [cpc-alerts-activity]
                            $values = get_option('cpc_shortcode_options_'.'cpc_alerts_activity') ? get_option('cpc_shortcode_options_'.'cpc_alerts_activity') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_alerts_activity_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a drop-down list of alerts for the user.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-alerts-activity] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-alerts-activity');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Style of List', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $style = cpc_get_shortcode_default($values, 'cpc_alerts_activity-style', 'dropdown');
                                        echo '<select name="cpc_alerts_activity-style">';
                                            echo '<option value="dropdown"'.($style == 'dropdown' ? ' SELECTED' : '').'>'.__('Dropdown list', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="list"'.($style == 'list' ? ' SELECTED' : '').'>'.__('List', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="flag"'.($style == 'flag' ? ' SELECTED' : '').'>'.__('Icon', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(style="'.$style.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("How the alerts are presented.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon size", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_size = cpc_get_shortcode_default($values, 'cpc_alerts_activity-flag_size', 24);
                                        echo '<input type="text" name="cpc_alerts_activity-flag_size" value="'.$flag_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_size="'.$flag_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Size of the icon (if Icon chosen).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon unread number size", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_unread_size = cpc_get_shortcode_default($values, 'cpc_alerts_activity-flag_unread_size', 10);
                                        echo '<input type="text" name="cpc_alerts_activity-flag_unread_size" value="'.$flag_unread_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_unread_size="'.$flag_unread_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Size of the unread number (if Icon chosen).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon unread number top margin", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_unread_top = cpc_get_shortcode_default($values, 'cpc_alerts_activity-flag_unread_top', 6);
                                        echo '<input type="text" name="cpc_alerts_activity-flag_unread_top" value="'.$flag_unread_top.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_unread_top="'.$flag_unread_top.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Allows you to adjust the top margin of the unread number (if Icon chosen).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon unread number left margin", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_unread_left = cpc_get_shortcode_default($values, 'cpc_alerts_activity-flag_unread_left', 8);
                                        echo '<input type="text" name="cpc_alerts_activity-flag_unread_left" value="'.$flag_unread_left.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_unread_left="'.$flag_unread_left.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Allows you to adjust the left margin of the unread number (if Icon chosen).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon unread number radius", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_unread_radius = cpc_get_shortcode_default($values, 'cpc_alerts_activity-flag_unread_radius', 8);
                                        echo '<input type="text" name="cpc_alerts_activity-flag_unread_radius" value="'.$flag_unread_radius.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_unread_radius="'.$flag_unread_radius.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Radius of the corners for unread messages, set to 0 for a square.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon URL", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_url = cpc_get_shortcode_default($values, 'cpc_alerts_activity-flag_url', '');
                                        echo '<input type="text" name="cpc_alerts_activity-flag_url" value="'.$flag_url.'" /></td><td>(flag_url="'.$flag_url.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("URL that the user is take to when the icon is clicked.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon image alernative URL", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_src = cpc_get_shortcode_default($values, 'cpc_alerts_activity-flag_src', '');
                                        echo '<input type="text" name="cpc_alerts_activity-flag_src" value="'.$flag_src.'" /></td><td>(flag_src="'.$flag_src.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("URL of an image to use as the icon instead of the default one..", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Recent alerts text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $recent_alerts_text = cpc_get_shortcode_default($values, 'cpc_alerts_activity-recent_alerts_text', __('Recent alerts...', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_alerts_activity-recent_alerts_text" value="'.$recent_alerts_text.'" /></td><td>(recent_alerts_text="'.$recent_alerts_text.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text to denote recent alerts.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("No alerts text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $no_activity_text = cpc_get_shortcode_default($values, 'cpc_alerts_activity-no_activity_text', __('No activity alerts', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_alerts_activity-no_activity_text" value="'.$no_activity_text.'" /></td><td>(no_activity_text="'.$no_activity_text.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text for no activity alerts.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Text for new alerts, seperated by commas", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $select_activity_text = cpc_get_shortcode_default($values, 'cpc_alerts_activity-select_activity_text', __('You have 1 new alert,You have %d new alerts,You have no new alerts', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_alerts_activity-select_activity_text" value="'.$select_activity_text.'" /></td><td>(select_activity_text="'.$select_activity_text.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("The three version of text to use, seperated by a comma, for 1, 2+ and no new alerts.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Mark all as read text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $make_all_read_text = cpc_get_shortcode_default($values, 'cpc_alerts_activity-make_all_read_text', __('Mark all as read', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_alerts_activity-make_all_read_text" value="'.$make_all_read_text.'" /></td><td>(make_all_read_text="'.$make_all_read_text.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text to mark all alerts as read.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Delete all text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $delete_all_text = cpc_get_shortcode_default($values, 'cpc_alerts_activity-delete_all_text', __('Delete all', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_alerts_activity-delete_all_text" value="'.$delete_all_text.'" /></td><td>(delete_all_text="'.$delete_all_text.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text to delete all alerts.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Date format", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $date_format = cpc_get_shortcode_default($values, 'cpc_alerts_activity-date_format', __('%s ago', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_alerts_activity-date_format" value="'.$date_format.'" /></td><td>(date_format)</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text for how long ago, the %s is replaced by how many days (etc).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Delete on click", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $delete_on_click = cpc_get_shortcode_default($values, 'cpc_alerts_activity-delete_on_click', false);
                                        echo '<input type="checkbox" name="cpc_alerts_activity-delete_on_click"'.($delete_on_click ? ' CHECKED' : '').'></td><td>(delete_on_click="'.($delete_on_click ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Tick this to delete the alert automatically when it is clicked on.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_alerts_activity', $values);        

                                echo '</table>';
                            echo '</div>';   

                            /* ----------------------- AVATAR TAB ----------------------- */

                            // [cpc-avatar]
                            $values = get_option('cpc_shortcode_options_'.'cpc_avatar') ? get_option('cpc_shortcode_options_'.'cpc_avatar') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_avatar_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a user's avatar.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-avatar] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-avatar');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Size of the avatar", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $size = cpc_get_shortcode_default($values, 'cpc_avatar-size', 256);
                                        echo '<input type="text" name="cpc_avatar-size" value="'.$size.'" /> '.__('pixels or a %', CPC2_TEXT_DOMAIN).'</td><td>(size="'.$size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Size of the avatar displayed, in pixels.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Show link to change avatar', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $change_link = cpc_get_shortcode_default($values, 'cpc_avatar-change_link', false);
                                        echo '<input type="checkbox" name="cpc_avatar-change_link"'.($change_link ? ' CHECKED' : '').'></td><td>(change_link="'.($change_link ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Style of avatar change', CPC2_TEXT_DOMAIN).'</td><td>';
                                    $avatar_style = cpc_get_shortcode_default($values, 'cpc_avatar-avatar_style', 'page');
                                    echo '<select name="cpc_avatar-avatar_style">';
                                        echo '<option value="page"'.($avatar_style == 'page' ? ' SELECTED' : '').'>'.__('Go to change avatar page', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '<option value="popup"'.($avatar_style == 'popup' ? ' SELECTED' : '').'>'.__('Use a popup', CPC2_TEXT_DOMAIN).'</option>';
                                    echo '</select></td><td>(avatar_style="'.$avatar_style.'")</td></tr>';    
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("If set to page, will be a link to a page with [cpc-avatar-change] on it. If popup, a box appears on the same screen.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Text for change link", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $change_avatar_text = cpc_get_shortcode_default($values, 'cpc_avatar-change_avatar_text', __('Change Picture', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar-change_avatar_text" value="'.$change_avatar_text.'" /></td><td>(change_avatar_text="'.$change_avatar_text.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text that is shown to prompt the user to change their avatar.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Title for change link/box", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $change_avatar_title = cpc_get_shortcode_default($values, 'cpc_avatar-change_avatar_title', __('Upload and Crop an Image to be Displayed', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar-change_avatar_title" value="'.$change_avatar_title.'" /></td><td>(change_avatar_title="'.$change_avatar_title.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Title for the change link, particularly relevant if using the popup style.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';                        
                                    echo '<tr><td>'.__("Prompt to select image from computer", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $upload_prompt = cpc_get_shortcode_default($values, 'cpc_avatar-upload_prompt', __('Choose an image from your computer:', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar-upload_prompt" value="'.$upload_prompt.'" /></td><td>(upload_prompt="'.$upload_prompt.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Prompt to select an image from computer if using popup style.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';                        
                                    echo '<tr><td>'.__("Upload button (for popup style only)", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $upload_button = cpc_get_shortcode_default($values, 'cpc_avatar-upload_button', __('Upload', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar-upload_button" value="'.$upload_button.'" /></td><td>(upload_button="'.$upload_button.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Label for upload button for popup style.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';                        
                                    echo '<tr><td>'.__("Width of popup (for popup style only)", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $popup_width = cpc_get_shortcode_default($values, 'cpc_avatar-popup_width', 750);
                                        echo '<input type="text" name="cpc_avatar-popup_width" value="'.$popup_width.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(popup_width="'.$popup_width.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Width of the popup if being used (in pixels).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';                        
                                    echo '<tr><td>'.__("Height of popup (for popup style only)", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $popup_height = cpc_get_shortcode_default($values, 'cpc_avatar-popup_height', 450);
                                        echo '<input type="text" name="cpc_avatar-popup_height" value="'.$popup_height.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(popup_height="'.$popup_height.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Height of the popup if being used (in pixels).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';                        
                                    echo '<tr><td>'.__("Avatar links to profile page (if not current user's avatar)", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $profile_link = cpc_get_shortcode_default($values, 'cpc_avatar-profile_link', false);
                                        echo '<input type="checkbox" name="cpc_avatar-profile_link"'.($profile_link ? ' CHECKED' : '').'></td><td>(profile_link="'.($profile_link ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Should the avatar image link to that user's profile page?", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('User', CPC2_TEXT_DOMAIN).'</td><td>';
                                    $user_id = cpc_get_shortcode_default($values, 'cpc_avatar-user_id', '');
                                    echo '<select name="cpc_avatar-user_id">';
                                        echo '<option value=""'.($user_id == '' ? ' SELECTED' : '').'>'.__('Reflects page context', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '<option value="user"'.($user_id == 'user' ? ' SELECTED' : '').'>'.__('Current user', CPC2_TEXT_DOMAIN).'</option>';
                                    echo '</select> '.__('or set to a user ID in shortcode', CPC2_TEXT_DOMAIN).'</td><td>(user_id="'.$user_id.'")</td></tr>';    
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Whether to reflect the page context (like on a profile page), or set to the current logged in user. Can also set to a specific ClassicPress user ID.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';

                        
                                    do_action('cpc_show_styling_options_hook', 'cpc_avatar', $values);        

                                echo '</table>';    
                            echo '</div>';    

                            // [cpc-avatar-change]
                            $values = get_option('cpc_shortcode_options_'.'cpc_avatar_change') ? get_option('cpc_shortcode_options_'.'cpc_avatar_change') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_avatar_change_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays the form to let users upload an avatar.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-avatar-change] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-avatar-change');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Prompt for step 1", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $step1 = cpc_get_shortcode_default($values, 'cpc_avatar_change-step1', __('Step 1: Click on this link to choose an image and afterwards click the button below.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-step1" value="'.$step1.'" /></td><td>(step1="'.$step1.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text to show for the first step in uploading a new avatar.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Prompt for step 2", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $step2 = cpc_get_shortcode_default($values, 'cpc_avatar_change-step2', __('Step 2: First select an area on your uploaded image, and then click the crop button.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-step2" value="'.$step2.'" /></td><td>(step2="'.$step2.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text for the second step.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Label for Upload button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_avatar_change-label', __('Upload', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Label for the button to upload an image.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Text for link to choose an image", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $choose = cpc_get_shortcode_default($values, 'cpc_avatar_change-choose', __('Click here to choose an image... (maximum %dKB)', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-choose" value="'.$choose.'" /></td><td>(choose="'.$choose.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text for the link to choose an image (make this clear what to do!).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Try again message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $try_again_msg = cpc_get_shortcode_default($values, 'cpc_avatar_change-try_again_msg', __('Try again...', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-try_again_msg" value="'.$try_again_msg.'" /></td><td>(try_again_msg="'.$try_again_msg.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text try again.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Allowed file types", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $file_types_msg = cpc_get_shortcode_default($values, 'cpc_avatar_change-file_types_msg', __("Please upload an image file (.jpeg, .gif, .png).", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-file_types_msg" value="'.$file_types_msg.'" /></td><td>(file_types_msg="'.$file_types_msg.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("The text shown explaining which file types are allowed to be uploaded.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Not allowed to change avatar message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $not_permitted = cpc_get_shortcode_default($values, 'cpc_avatar_change-not_permitted', __("You are not allowed to change this avatar.", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-not_permitted" value="'.$not_permitted.'" /></td><td>(not_permitted="'.$not_permitted.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text shown if not allowed to change the avatar.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("File too big message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $file_too_big_msg = cpc_get_shortcode_default($values, 'cpc_avatar_change-file_too_big_msg', __("Please upload an image file no larger than %dKB, yours was %dKB.", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-file_too_big_msg" value="'.$file_too_big_msg.'" /></td><td>(file_too_big_msg="'.$file_too_big_msg.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Message if the uploaded file is too big.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Maximum file upload size (KB)", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $max_file_size = cpc_get_shortcode_default($values, 'cpc_avatar_change-max_file_size', 500);
                                        echo '<input type="text" name="cpc_avatar_change-max_file_size" value="'.$max_file_size.'" /></td><td>(max_file_size="'.$max_file_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Maximum permitted file size to upload <strong>in KiloBytes</strong>.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Allow users to crop avatars', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $crop = cpc_get_shortcode_default($values, 'cpc_avatar_change-crop', true);
                                        echo '<input type="checkbox" name="cpc_avatar_change-crop"'.($crop ? ' CHECKED' : '').'></td><td>(crop="'.($crop ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Whether user's are allowed to crop uploaded images (select an area to use).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__('Activate special effects', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $effects = cpc_get_shortcode_default($values, 'cpc_avatar_change-effects', false);
                                        echo '<input type="checkbox" name="cpc_avatar_change-effects"'.($effects ? ' CHECKED' : '').'></td><td>(effects="'.($effects ? '1' : '0').'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Can user's apply special effects to uploaded images.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Label for Flip", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flip = cpc_get_shortcode_default($values, 'cpc_avatar_change-flip', __("Flip", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-flip" value="'.$flip.'" /></td><td>(flip="'.$flip.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Vertical flip", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Label for Rotate", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $rotate = cpc_get_shortcode_default($values, 'cpc_avatar_change-rotate', __("Rotate", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-rotate" value="'.$rotate.'" /></td><td>(rotate="'.$rotate.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Rotate 90 degrees to the right (can be done multiple times).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Label for Invert", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $invert = cpc_get_shortcode_default($values, 'cpc_avatar_change-invert', __("Invert", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-invert" value="'.$invert.'" /></td><td>(invert="'.$invert.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Invert the colour pallete.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Label for Sketch", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $sketch = cpc_get_shortcode_default($values, 'cpc_avatar_change-sketch', __("Sketch", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-sketch" value="'.$sketch.'" /></td><td>(sketch="'.$sketch.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Make the image look like a sketch.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Label for Pixelate", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pixelate = cpc_get_shortcode_default($values, 'cpc_avatar_change-pixelate', __("Pixelate", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-pixelate" value="'.$pixelate.'" /></td><td>(pixelate="'.$pixelate.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Enlarge pixels in the image to make it look more blocky...", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Label for Sepia", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $sepia = cpc_get_shortcode_default($values, 'cpc_avatar_change-sepia', __("Sepia", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-sepia" value="'.$sepia.'" /></td><td>(sepia="'.$sepia.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Use subtle shades of cream and brown.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Label for Emboss", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $emboss = cpc_get_shortcode_default($values, 'cpc_avatar_change-emboss', __("Emboss", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-emboss" value="'.$emboss.'" /></td><td>(emboss="'.$emboss.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Give a 3D look to the image.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Must be logged in message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $logged_out_msg = cpc_get_shortcode_default($values, 'cpc_avatar_change-logged_out_msg', __("You must be logged in to view this page.", CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change-logged_out_msg" value="'.$logged_out_msg.'" /></td><td>(logged_out_msg="'.$logged_out_msg.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text shown in not logged in.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Optional URL to login", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $login_url = cpc_get_shortcode_default($values, 'cpc_avatar_change-login_url', '');
                                        echo '<input type="text" name="cpc_avatar_change-login_url" value="'.$login_url.'" /></td><td>(login_url="'.$login_url.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("An optional URL of a login page to take the visitor to that login page (and return afterwards).", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_avatar_change', $values);        

                                echo '</table>';    
                            echo '</div>';  

                            // [cpc-avatar-change-link]
                            $values = get_option('cpc_shortcode_options_'.'cpc_avatar_change_link') ? get_option('cpc_shortcode_options_'.'cpc_avatar_change_link') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_avatar_change_link_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a link to let a user change their avatar.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-avatar-change-link] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-avatar-change-link');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Style of avatar change', CPC2_TEXT_DOMAIN).'</td><td>';
                                    $change_style = cpc_get_shortcode_default($values, 'cpc_avatar_change_link-change_style', 'page');
                                    echo '<select name="cpc_avatar_change_link-change_style">';
                                        echo '<option value="page"'.($change_style == 'page' ? ' SELECTED' : '').'>'.__('Go to change avatar page', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '<option value="popup"'.($change_style == 'popup' ? ' SELECTED' : '').'>'.__('Use a popup', CPC2_TEXT_DOMAIN).'</option>';
                                    echo '</select></td><td>(change_style="'.$change_style.'")</td></tr>';    
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("If set to page, will be a link to a page with [cpc-avatar-change] on it. If popup, a box appears on the same screen.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Text shown for the link", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $text = cpc_get_shortcode_default($values, 'cpc_avatar_change_link-text', __('Change Picture', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change_link-text" value="'.$text.'" /></td><td>($text="'.$text.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Text to show for the user to change their avatar.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Title for change link/box", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $change_avatar_title = cpc_get_shortcode_default($values, 'cpc_avatar_change_link-change_avatar_title', __('Upload and Crop an Image to be Displayed', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_avatar_change_link-change_avatar_title" value="'.$change_avatar_title.'" /></td><td>(change_avatar_title="'.$change_avatar_title.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Title for the change link, particularly relevant if using the popup style.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';                        
                        
                                    do_action('cpc_show_styling_options_hook', 'cpc_avatar_change_link', $values);            

                                echo '</table>';    
                            echo '</div>';   

                            /* ----------------------- FORUMS TAB ----------------------- */

                            // [cpc-forum]
                            $values = get_option('cpc_shortcode_options_'.'cpc_forum') ? get_option('cpc_shortcode_options_'.'cpc_forum') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forum_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays topics (and replies if style is set to 'classic') of a forum.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.sprintf(__('Add [cpc-forum slug="xxx"] to a ClassicPress Page where "xxx" is the <a href="%s">slug of your forum</a>.', CPC2_TEXT_DOMAIN), admin_url( 'edit-tags.php?taxonomy=cpc_forum&post_type=cpc_forum_post' ));
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-forum');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Style', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $style = cpc_get_shortcode_default($values, 'cpc_forum-style', 'table');
                                        echo '<select name="cpc_forum-style">';
                                            echo '<option value="table"'.($style == 'table' ? ' SELECTED' : '').'>'.__('Table', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="classic"'.($style == 'classic' ? ' SELECTED' : '').'>'.__('Classic', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(style="'.$style.'")</td></tr>';    
                                    echo '<tr><td>'.__('Base date', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $base_date = cpc_get_shortcode_default($values, 'cpc_forum_page-base_date', 'post_date_gmt');
                                        echo '<select name="cpc_forum_page-base_date">';
                                            echo '<option value="post_date_gmt"'.($base_date == 'post_date_gmt' ? ' SELECTED' : '').'>'.__('GMT', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="post_date"'.($base_date == 'post_date' ? ' SELECTED' : '').'>'.__('Local', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(base_date="'.$base_date.'")</td></tr>';
                                    echo '<tr><td>'.__('Comment base date', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comment_base_date = cpc_get_shortcode_default($values, 'cpc_forum_page-comment_base_date', 'comment_date_gmt');
                                        echo '<select name="cpc_forum_page-comment_base_date">';
                                            echo '<option value="comment_date_gmt"'.($base_date == 'comment_date_gmt' ? ' SELECTED' : '').'>'.__('GMT', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="comment_date"'.($base_date == 'comment_date' ? ' SELECTED' : '').'>'.__('Local', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(comment_base_date="'.$base_date.'")</td></tr>';
                                    echo '<tr><td colspan=3 class="cpc_section">'.__('For table style...', CPC2_TEXT_DOMAIN).'</td></tr>';
                                    echo '<tr><td>'.__('Show table header', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_header = cpc_get_shortcode_default($values, 'cpc_forum-show_header', true);
                                        echo '<input type="checkbox" name="cpc_forum-show_header"'.($show_header ? ' CHECKED' : '').'></td><td>(show_header="'.($show_header ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show closed topics', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_closed = cpc_get_shortcode_default($values, 'cpc_forum-show_closed', true);
                                        echo '<input type="checkbox" name="cpc_forum-show_closed"'.($show_closed ? ' CHECKED' : '').'></td><td>(show_closed="'.($show_closed ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show topic count', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_count = cpc_get_shortcode_default($values, 'cpc_forum-show_count', true);
                                        echo '<input type="checkbox" name="cpc_forum-show_count"'.($show_count ? ' CHECKED' : '').'></td><td>(show_count="'.($show_count ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show freshness', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_freshness = cpc_get_shortcode_default($values, 'cpc_forum-show_freshness', true);
                                        echo '<input type="checkbox" name="cpc_forum-show_freshness"'.($show_freshness ? ' CHECKED' : '').'></td><td>(show_freshness="'.($show_freshness ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show last activity', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_last_activity = cpc_get_shortcode_default($values, 'cpc_forum-show_last_activity', true);
                                        echo '<input type="checkbox" name="cpc_forum-show_last_activity"'.($show_last_activity ? ' CHECKED' : '').'></td><td>(show_last_activity="'.($show_last_activity ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show comment count', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_comments_count = cpc_get_shortcode_default($values, 'cpc_forum-show_comments_count', true);
                                        echo '<input type="checkbox" name="cpc_forum-show_comments_count"'.($show_comments_count ? ' CHECKED' : '').'></td><td>(show_comments_count="'.($show_comments_count ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show post author', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_originator = cpc_get_shortcode_default($values, 'cpc_forum-show_originator', true);
                                        echo '<input type="checkbox" name="cpc_forum-show_originator"'.($show_originator ? ' CHECKED' : '').'></td><td>(show_originator="'.($show_originator ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Text for post author", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $originator = cpc_get_shortcode_default($values, 'cpc_forum-originator', __(' by %s', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-originator" value="'.$originator.'" /></td><td>(originator="'.$originator.'")</td></tr>';
                                    echo '<tr><td>'.__("Header title", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_title = cpc_get_shortcode_default($values, 'cpc_forum-header_title', __('Topic', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-header_title" value="'.$header_title.'" /></td><td>(header_title="'.$header_title.'")</td></tr>';
                                    echo '<tr><td>'.__("Replies title", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_count = cpc_get_shortcode_default($values, 'cpc_forum-header_count', __('Replies', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-header_count" value="'.$header_count.'" /></td><td>(header_count="'.$header_count.'")</td></tr>';
                                    echo '<tr><td>'.__("Last activity title", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_last_activity = cpc_get_shortcode_default($values, 'cpc_forum-header_last_activity', __('Last activity', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-header_last_activity" value="'.$header_last_activity.'" /></td><td>(header_last_activity="'.$header_last_activity.'")</td></tr>';
                                    echo '<tr><td>'.__("Freshness title", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_freshness = cpc_get_shortcode_default($values, 'cpc_forum-header_freshness', __('When', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-header_freshness" value="'.$header_freshness.'" /></td><td>(header_freshness="'.$header_freshness.'")</td></tr>';                        

                                    echo '<tr><td colspan=3 class="cpc_section">'.__('For classic style...', CPC2_TEXT_DOMAIN).'</td></tr>';
                                    echo '<tr><td>'.__("Text for topic started", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $started = cpc_get_shortcode_default($values, 'cpc_forum-started', __('Started by %s %s', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-started" value="'.$started.'" /></td><td>(started="'.$started.'")</td></tr>';
                                    echo '<tr><td>'.__("Text for last reply", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $replied = cpc_get_shortcode_default($values, 'cpc_forum-replied', __('Last replied to by %s %s', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-replied" value="'.$replied.'" /></td><td>(replied="'.$replied.'")</td></tr>';
                                    echo '<tr><td>'.__("Text for last comment", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $commented = cpc_get_shortcode_default($values, 'cpc_forum-commented', __('Last commented on by %s %s', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-commented" value="'.$commented.'" /></td><td>(commented="'.$commented.'")</td></tr>';
                                    echo '<tr><td>'.__("Avatar size for topics", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $size_posts = cpc_get_shortcode_default($values, 'cpc_forum-size_posts', 96);
                                        echo '<input type="text" name="cpc_forum-size_posts" value="'.$size_posts.'" /></td><td>(size_posts="'.$size_posts.'")</td></tr>';
                                    echo '<tr><td>'.__("Avatar size for replies", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $size_replies = cpc_get_shortcode_default($values, 'cpc_forum-size_replies', 48);
                                        echo '<input type="text" name="cpc_forum-size_replies" value="'.$size_replies.'" /></td><td>(size_replies="'.$size_replies.'")</td></tr>';
                                    echo '<tr><td>'.__("Maximum size of topic preview", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $post_preview = cpc_get_shortcode_default($values, 'cpc_forum-post_preview', 250);
                                        echo '<input type="text" name="cpc_forum-post_preview" value="'.$post_preview.'" /> '.__('characters', CPC2_TEXT_DOMAIN).'</td><td>(post_preview="'.$post_preview.'")</td></tr>';
                                    echo '<tr><td>'.__("Maximum size of reply preview", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reply_preview = cpc_get_shortcode_default($values, 'cpc_forum-reply_preview', 120);
                                        echo '<input type="text" name="cpc_forum-reply_preview" value="'.$reply_preview.'" /> '.__('characters', CPC2_TEXT_DOMAIN).'</td><td>(reply_preview="'.$reply_preview.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for view count", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $view_count_label = cpc_get_shortcode_default($values, 'cpc_forum-view_count_label', __('VIEW', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-view_count_label" value="'.$view_count_label.'" /> '.__('singular', CPC2_TEXT_DOMAIN).'</td><td>(view_count_label="'.$view_count_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for view count", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $views_count_label = cpc_get_shortcode_default($values, 'cpc_forum-views_count_label', __('VIEWS', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-views_count_label" value="'.$views_count_label.'" /> '.__('plural', CPC2_TEXT_DOMAIN).'</td><td>(views_count_label="'.$views_count_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for reply count", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reply_count_label = cpc_get_shortcode_default($values, 'cpc_forum-reply_count_label', __('REPLY', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-reply_count_label" value="'.$reply_count_label.'" /> '.__('singular', CPC2_TEXT_DOMAIN).'</td><td>(reply_count_label="'.$reply_count_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for view count", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $replies_count_label = cpc_get_shortcode_default($values, 'cpc_forum-replies_count_label', __('REPLIES', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-replies_count_label" value="'.$replies_count_label.'" /> '.__('plural', CPC2_TEXT_DOMAIN).'</td><td>(replies_count_label="'.$replies_count_label.'")</td></tr>';
                        
                                    echo '<tr><td colspan=3 class="cpc_section">'.__('For both styles...', CPC2_TEXT_DOMAIN).'</td></tr>';

                                    echo '<tr><td>'.__('Clicking on topic', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $topic_action = cpc_get_shortcode_default($values, 'cpc_forum-topic_action', '');
                                        echo '<select name="cpc_forum-topic_action">';
                                            echo '<option value=""'.($topic_action == '' ? ' SELECTED' : '').'>'.__('Always go to start of replies', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="last"'.($topic_action == 'last' ? ' SELECTED' : '').'>'.__('Always go to end of replies', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(topic_action="'.$topic_action.'")</td></tr>';    
                        
                                    echo '<tr><td>'.__('Highlight "new" content', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $new_item = cpc_get_shortcode_default($values, 'cpc_forum-new_item', true);
                                        echo '<input type="checkbox" class="cpc_shortcode_tip_available" name="cpc_forum-new_item"'.($new_item ? ' CHECKED' : '').'></td><td>(new_item="'.($new_item ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('How long content stays "new" for', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $new_seconds = cpc_get_shortcode_default($values, 'cpc_forum-new_seconds', 259200);
                                        echo '<input type="text" name="cpc_forum-new_seconds" class="cpc_shortcode_tip_available" value="'.$new_seconds.'" /> seconds</td><td>(new_seconds="'.$new_seconds.'")</td></tr>';
                                    echo '<tr id="cpc_shortcode_tip" style="display:none"';
                                        echo '><td colspan="3" class="cpc_admin_shortcode_tip">'.sprintf(__('See <a href="%s" target="_blank">CP Community Codex</a> for styling tips.', CPC2_TEXT_DOMAIN), 'https://cp-community.n3rds.work/cpc-forum/').'</td></tr>';

                                    echo '<tr><td>'.__('Mark read items as no longer new', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $new_item_read = cpc_get_shortcode_default($values, 'cpc_forum-new_item_read', true);
                                        echo '<input type="checkbox" name="cpc_forum-new_item_read"'.($new_item_read ? ' CHECKED' : '').'></td><td>(new_item_read="'.($new_item_read ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Word for new content", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $new_item_label = cpc_get_shortcode_default($values, 'cpc_forum-new_item_label', __('NEW!', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-new_item_label" value="'.$new_item_label.'" /></td><td>(new_item_label="'.$new_item_label.'")</td></tr>';

                                    echo '<tr><td>'.__('Enable pagination', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_posts = cpc_get_shortcode_default($values, 'cpc_forum-pagination_posts', true);
                                        echo '<input type="checkbox" name="cpc_forum-pagination_posts"'.($pagination_posts ? ' CHECKED' : '').'></td><td>(pagination_posts="'.($pagination_posts ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Pagination above posts', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_top_posts = cpc_get_shortcode_default($values, 'cpc_forum-pagination_top_posts', true);
                                        echo '<input type="checkbox" name="cpc_forum-pagination_top_posts"'.($pagination_top_posts ? ' CHECKED' : '').'></td><td>(pagination_top_posts="'.($pagination_top_posts ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Pagination below posts', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_bottom_posts = cpc_get_shortcode_default($values, 'cpc_forum-pagination_bottom_posts', true);
                                        echo '<input type="checkbox" name="cpc_forum-pagination_bottom_posts"'.($pagination_bottom_posts ? ' CHECKED' : '').'></td><td>(pagination_bottom_posts="'.($pagination_bottom_posts ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Pagination page size", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $page_size_posts = cpc_get_shortcode_default($values, 'cpc_forum-page_size_posts', 10);
                                        echo '<input type="text" name="cpc_forum-page_size_posts" value="'.$page_size_posts.'" /></td><td>(page_size_posts="'.$page_size_posts.'")</td></tr>';
                                    echo '<tr><td>'.__("Pagination first label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_first_posts = cpc_get_shortcode_default($values, 'cpc_forum-pagination_first_posts', __('First', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-pagination_first_posts" value="'.$pagination_first_posts.'" /></td><td>(pagination_first_posts="'.$pagination_first_posts.'")</td></tr>';                        
                                    echo '<tr><td>'.__("Pagination previous label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_previous_posts = cpc_get_shortcode_default($values, 'cpc_forum-pagination_previous_posts', __('Previous', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-pagination_previous_posts" value="'.$pagination_previous_posts.'" /></td><td>(pagination_previous_posts="'.$pagination_previous_posts.'")</td></tr>';
                                    echo '<tr><td>'.__("Pagination next label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_next_posts = cpc_get_shortcode_default($values, 'cpc_forum-pagination_next_posts', __('Next', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-pagination_next_posts" value="'.$pagination_next_posts.'" /></td><td>(pagination_next_posts="'.$pagination_next_posts.'")</td></tr>';
                                    echo '<tr><td>'.__("Pagination current page text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $page_x_of_y_posts = cpc_get_shortcode_default($values, 'cpc_forum-page_x_of_y_posts', __('On page %d of %d', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-page_x_of_y_posts" value="'.$page_x_of_y_posts.'" /></td><td>(page_x_of_y_posts="'.$page_x_of_y_posts.'")</td></tr>';
                                    echo '<tr><td>'.__("Maximum number of pages", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $max_pages_posts = cpc_get_shortcode_default($values, 'cpc_forum-max_pages_posts', 10);
                                        echo '<input type="text" name="cpc_forum-max_pages_posts" value="'.$max_pages_posts.'" /></td><td>(max_pages_posts="'.$max_pages_posts.'")</td></tr>';
                                    echo '<tr><td>'.__("Maximum number of posts (if no pagination)", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $max_posts_no_pagination_posts = cpc_get_shortcode_default($values, 'cpc_forum-max_posts_no_pagination_posts', 100);
                                        echo '<input type="text" name="cpc_forum-max_posts_no_pagination_posts" value="'.$max_posts_no_pagination_posts.'" /></td><td>(max_posts_no_pagination_posts="'.$max_posts_no_pagination_posts.'")</td></tr>';
                        
                                    echo '<tr><td>'.__('Show reply icon', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reply_icon = cpc_get_shortcode_default($values, 'cpc_forum-reply_icon', true);
                                        echo '<input type="checkbox" name="cpc_forum-reply_icon" '.($reply_icon ? ' CHECKED' : '').'></td><td>(reply_icon="'.($reply_icon ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Maximum title length", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $title_length = cpc_get_shortcode_default($values, 'cpc_forum-title_length', 150);
                                        echo '<input type="text" name="cpc_forum-title_length" value="'.$title_length.'" /> '.__('characters', CPC2_TEXT_DOMAIN).'</td><td>(title_length="'.$title_length.'")</td></tr>';
                                    echo '<tr><td>'.__('Reply status', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $status = cpc_get_shortcode_default($values, 'cpc_forum-status', '');
                                        echo '<select name="cpc_forum-status">';
                                            echo '<option value=""'.($status == '' ? ' SELECTED' : '').'>'.__('Open and closed', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="open"'.($status == 'open' ? ' SELECTED' : '').'>'.__('Open', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="closed"'.($status == 'closed' ? ' SELECTED' : '').'>'.__('Closed', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(status="'.$status.'")</td></tr>';    
                                    echo '<tr><td>'.__('Default state of closed switch', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $closed_switch = cpc_get_shortcode_default($values, 'cpc_forum-closed_switch', '');
                                        echo '<select name="cpc_forum-closed_switch">';
                                            echo '<option value=""'.($status == '' ? ' SELECTED' : '').'>'.__('Do not show', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="on"'.($status == 'on' ? ' SELECTED' : '').'>'.__('On', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="off"'.($status == 'off' ? ' SELECTED' : '').'>'.__('Off', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(closed_switch="'.$closed_switch.'")</td></tr>';    
                                    echo '<tr><td>'.__("Closed switch prompt", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $closed_switch_msg = cpc_get_shortcode_default($values, 'cpc_forum-closed_switch_msg', __('Include closed posts', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-closed_switch_msg" value="'.$closed_switch_msg.'" /></td><td>(closed_switch_msg="'.$closed_switch_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Must be logged in message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $private_msg = cpc_get_shortcode_default($values, 'cpc_forum-private_msg', __('You must be logged in to view this forum.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-private_msg" value="'.$private_msg.'" /></td><td>(private_msg="'.$private_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Optional URL to login", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $login_url = cpc_get_shortcode_default($values, 'cpc_forum-login_url', '');
                                        echo '<input type="text" name="cpc_forum-login_url" value="'.$login_url.'" /></td><td>(login_url)</td></tr>';
                                    echo '<tr><td>'.__("Don't have permission message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $secure_msg = cpc_get_shortcode_default($values, 'cpc_forum-secure_msg', __('You do not have permission to view this forum.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-secure_msg" value="'.$secure_msg.'" /> '.__('for forum', CPC2_TEXT_DOMAIN).'</td><td>(secure_msg="'.$secure_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Don't have permission message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $secure_post_msg = cpc_get_shortcode_default($values, 'cpc_forum-secure_post_msg', __('You do not have permission to view this post.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-secure_post_msg" value="'.$secure_post_msg.'" /> '.__('for topic', CPC2_TEXT_DOMAIN).'</td><td>(secure_post_msg="'.$secure_post_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Empty forum message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $empty_msg = cpc_get_shortcode_default($values, 'cpc_forum-empty_msg', __('No forum posts.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-empty_msg" value="'.$empty_msg.'" /></td><td>(empty_msg="'.$empty_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Topic deleted message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $post_deleted = cpc_get_shortcode_default($values, 'cpc_forum-post_deleted', __('Post deleted.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-post_deleted" value="'.$post_deleted.'" /></td><td>(post_deleted="'.$post_deleted.'")</td></tr>';
                                    echo '<tr><td>'.__("Word for pending topic", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pending = cpc_get_shortcode_default($values, 'cpc_forum-pending', '('.__('pending', CPC2_TEXT_DOMAIN).')');
                                        echo '<input type="text" name="cpc_forum-pending" value="'.$pending.'" /></td><td>(pending="'.$pending.'")</td></tr>';
                                    echo '<tr><td>'.__("Word for pending reply", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comment_pending = cpc_get_shortcode_default($values, 'cpc_forum-comment_pending', '('.__('pending', CPC2_TEXT_DOMAIN).')');
                                        echo '<input type="text" name="cpc_forum-comment_pending" value="'.$comment_pending.'" /></td><td>(comment_pending="'.$comment_pending.'")</td></tr>';
                                    echo '<tr><td>'.__("Closed prefix", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $closed_prefix = cpc_get_shortcode_default($values, 'cpc_forum-closed_prefix', __('closed', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-closed_prefix" value="'.$closed_prefix.'" /></td><td>(closed_prefix="'.$closed_prefix.'")</td></tr>';
                                    echo '<tr><td>'.__("Topic moved message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $moved_to = cpc_get_shortcode_default($values, 'cpc_forum-moved_to', __('%s successfully moved to %s', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-moved_to" value="'.$moved_to.'" /></td><td>(moved_to)</td></tr>';
                                    echo '<tr><td>'.__("Date format", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $date_format = cpc_get_shortcode_default($values, 'cpc_forum-date_format', __('%s ago', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-date_format" value="'.$date_format.'" /></td><td>(date_format="'.$date_format.'")</td></tr>';
                        
                                    echo '<tr><td>'.__('Enable timeout', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $enable_timeout = cpc_get_shortcode_default($values, 'cpc_forum-enable_timeout', true);
                                        echo '<input type="checkbox" name="cpc_forum-enable_timeout"'.($enable_timeout ? ' CHECKED' : '').'></td><td>(enable_timeout="'.($enable_timeout ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Timeout before can't edit", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $timeout = cpc_get_shortcode_default($values, 'cpc_forum-timeout', 120);
                                        echo '<input type="text" name="cpc_forum-timeout" value="'.$timeout.'" /> '.__('seconds', CPC2_TEXT_DOMAIN).'</td><td>(timeout="'.$timeout.'")</td></tr>';
                                    echo '<tr><td>'.__("Number of topics to show", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $count = cpc_get_shortcode_default($values, 'cpc_forum-count', 0);
                                        echo '<input type="text" name="cpc_forum-count" value="'.$count.'" /> '.__('0 = all', CPC2_TEXT_DOMAIN).'</td><td>(count="'.$count.'")</td></tr>';

                                    echo '<tr><td colspan=3 class="cpc_section">'.__('For single topic view...', CPC2_TEXT_DOMAIN).'</td></tr>';    

                                    echo '<tr><td>'.__("No replies text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reply_comment_none = cpc_get_shortcode_default($values, 'cpc_forum-reply_comment_none', __('No replies', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-reply_comment_none" value="'.$reply_comment_none.'" /></td><td>(reply_comment_none="'.$reply_comment_none.'")</td></tr>';
                                    echo '<tr><td>'.__("One reply text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reply_comment_one = cpc_get_shortcode_default($values, 'cpc_forum-reply_comment_one', __('1 reply', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-reply_comment_one" value="'.$reply_comment_one.'" /></td><td>(reply_comment_one="'.$reply_comment_one.'")</td></tr>';
                                    echo '<tr><td>'.__("Multiple replies text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reply_comment_multiple = cpc_get_shortcode_default($values, 'cpc_forum-reply_comment_multiple', __('%d replies', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-reply_comment_multiple" value="'.$reply_comment_multiple.'" /></td><td>(reply_comment_multiple="'.$reply_comment_multiple.'")</td></tr>';
                                    echo '<tr><td>'.__("1 comment text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reply_comment_one_comment = cpc_get_shortcode_default($values, 'cpc_forum-reply_comment_one_comment', __('and 1 comment', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-reply_comment_one_comment" value="'.$reply_comment_one_comment.'" /></td><td>(reply_comment_one_comment="'.$reply_comment_one_comment.'")</td></tr>';
                                    echo '<tr><td>'.__("Multiple comments text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reply_comment_multiple_comments = cpc_get_shortcode_default($values, 'cpc_forum-reply_comment_multiple_comments', __('and %d comments', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-reply_comment_multiple_comments" value="'.$reply_comment_multiple_comments.'" /></td><td>(reply_comment_multiple_comments="'.$reply_comment_multiple_comments.'")</td></tr>';
                        
                                    echo '<tr><td>'.__("Additional forum admins", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_admins = cpc_get_shortcode_default($values, 'cpc_forum-forum_admins', '');
                                        echo '<input type="text" name="cpc_forum-forum_admins" value="'.$forum_admins.'" /> '.__('user logins, seperated by commas', CPC2_TEXT_DOMAIN).'</td><td>(forum_admins="'.$forum_admins.'")</td></tr>';
                                    echo '<tr><td>'.__("Topic author avatar", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $size = cpc_get_shortcode_default($values, 'cpc_forum-size', 96);
                                        echo '<input type="text" name="cpc_forum-size" value="'.$size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(size="'.$size.'")</td></tr>';
                                    echo '<tr><td>'.__("Reply author avatar", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comments_avatar_size = cpc_get_shortcode_default($values, 'cpc_forum-comments_avatar_size', 96);
                                        echo '<input type="text" name="cpc_forum-comments_avatar_size" value="'.$comments_avatar_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(comments_avatar_size="'.$comments_avatar_size.'")</td></tr>';

                                    echo '<tr><td>'.__('Enable pagination', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination = cpc_get_shortcode_default($values, 'cpc_forum-pagination', true);
                                        echo '<input type="checkbox" name="cpc_forum-pagination"'.($pagination ? ' CHECKED' : '').'></td><td>(pagination="'.($pagination ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Pagination above topic', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_above = cpc_get_shortcode_default($values, 'cpc_forum-pagination_above', false);
                                        echo '<input type="checkbox" name="cpc_forum-pagination_above"'.($pagination_above ? ' CHECKED' : '').'></td><td>(pagination_above="'.($pagination_above ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Pagination above replies', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_top = cpc_get_shortcode_default($values, 'cpc_forum-pagination_top', true);
                                        echo '<input type="checkbox" name="cpc_forum-pagination_top"'.($pagination_top ? ' CHECKED' : '').'></td><td>(pagination_top="'.($pagination_top ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Pagination below replies', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_bottom = cpc_get_shortcode_default($values, 'cpc_forum-pagination_bottom', true);
                                        echo '<input type="checkbox" name="cpc_forum-pagination_bottom"'.($pagination_bottom ? ' CHECKED' : '').'></td><td>(pagination_bottom="'.($pagination_bottom ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Pagination page size", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $page_size = cpc_get_shortcode_default($values, 'cpc_forum-page_size', 10);
                                        echo '<input type="text" name="cpc_forum-page_size" value="'.$page_size.'" /></td><td>(page_size="'.$page_size.'")</td></tr>';
                                    echo '<tr><td>'.__("Pagination first label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_first = cpc_get_shortcode_default($values, 'cpc_forum-pagination_first', __('First', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-pagination_first" value="'.$pagination_first.'" /></td><td>(pagination_first="'.$pagination_first.'")</td></tr>';
                                    echo '<tr><td>'.__("Pagination previous label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_previous = cpc_get_shortcode_default($values, 'cpc_forum-pagination_previous', __('Previous', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-pagination_previous" value="'.$pagination_previous.'" /></td><td>(pagination_previous="'.$pagination_previous.'")</td></tr>';
                                    echo '<tr><td>'.__("Pagination next label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $pagination_next = cpc_get_shortcode_default($values, 'cpc_forum-pagination_next', __('Next', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-pagination_next" value="'.$pagination_next.'" /></td><td>(pagination_next="'.$pagination_next.'")</td></tr>';
                                    echo '<tr><td>'.__("Pagination current page text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $page_x_of_y = cpc_get_shortcode_default($values, 'cpc_forum-page_x_of_y', __('On page %d of %d', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-page_x_of_y" value="'.$page_x_of_y.'" /></td><td>(page_x_of_y="'.$page_x_of_y.'")</td></tr>';
                        
                                    echo '<tr><td>'.__('Replies order', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $replies_order = cpc_get_shortcode_default($values, 'cpc_forum-replies_order', 'ASC');
                                        echo '<select name="cpc_forum-replies_order">';
                                            echo '<option value="ASC"'.($replies_order == 'ASC' ? ' SELECTED' : '').'>'.__('Oldest first', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="DESC"'.($replies_order == 'DESC' ? ' SELECTED' : '').'>'.__('Newest first', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(replies_order="'.$replies_order.'")</td></tr>';    

                                    echo '<tr><td>'.__("Include Report option", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $report = cpc_get_shortcode_default($values, 'cpc_forum-report', true);
                                        echo '<input type="checkbox" name="cpc_forum-report"'.($report ? ' CHECKED' : '').'></td><td>(report="'.($report ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Report option label', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $report_label = cpc_get_shortcode_default($values, 'cpc_forum-report_label', __('Report', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-report_label" value="'.$report_label.'" /></td><td>(report_label="'.$report_label.'")</td></tr>';
                                    echo '<tr><td>'.__('Report email recipient', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $report_email = cpc_get_shortcode_default($values, 'cpc_forum-report_email', get_bloginfo('admin_email'));
                                        echo '<input type="text" name="cpc_forum-report_email" value="'.$report_email.'" /></td><td>(report_email="'.$report_email.'")</td></tr>';
                        
                                    echo '<tr><td>'.__('Hide initial post on page 2+', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $hide_initial = cpc_get_shortcode_default($values, 'cpc_forum-hide_initial', false);
                                        echo '<input type="checkbox" name="cpc_forum-hide_initial"'.($hide_initial ? ' CHECKED' : '').'></td><td>(hide_initial="'.($hide_initial ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Enable comments', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_comments = cpc_get_shortcode_default($values, 'cpc_forum-show_comments', true);
                                        echo '<input type="checkbox" name="cpc_forum-show_comments"'.($show_comments ? ' CHECKED' : '').'></td><td>(show_comments="'.($show_comments ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show comment as default', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_comment_form = cpc_get_shortcode_default($values, 'cpc_forum-show_comment_form', true);
                                        echo '<input type="checkbox" name="cpc_forum-show_comment_form"'.($show_comment_form ? ' CHECKED' : '').'></td><td>(show_comment_form="'.($show_comment_form ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Allow new comments', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $allow_comments = cpc_get_shortcode_default($values, 'cpc_forum-allow_comments', true);
                                        echo '<input type="checkbox" name="cpc_forum-allow_comments"'.($allow_comments ? ' CHECKED' : '').'></td><td>(allow_comments="'.($allow_comments ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Label for comment button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comment_add_label = cpc_get_shortcode_default($values, 'cpc_forum-comment_add_label', __('Add comment', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-comment_add_label" value="'.$comment_add_label.'" /></td><td>(comment_add_label="'.$comment_add_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for Update button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $update_label = cpc_get_shortcode_default($values, 'cpc_forum-update_label', __('Update', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-update_label" value="'.$update_label.'" /></td><td>(update_label="'.$update_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for cancel button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $cancel_label = cpc_get_shortcode_default($values, 'cpc_forum-cancel_label', __('Cancel', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-cancel_label" value="'.$cancel_label.'" /></td><td>(cancel_label="'.$cancel_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for moderate message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $moderate_msg = cpc_get_shortcode_default($values, 'cpc_forum-moderate_msg', __('Your post will appear once it has been moderated.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-moderate_msg" value="'.$moderate_msg.'" /></td><td>(moderate_msg="'.$moderate_msg.'")</td></tr>';
                                    echo '<tr><td>'.__('Optional CSS class for comment button', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comment_class = cpc_get_shortcode_default($values, 'cpc_forum-comment_class', '');
                                        echo '<input type="text" name="cpc_forum-comment_class" value="'.$comment_class.'" /></td><td>(comment_class="'.$comment_class.'")</td></tr>';
                                    echo '<tr><td>'.__('Text shown for private comments', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $private_reply_msg = cpc_get_shortcode_default($values, 'cpc_forum-private_reply_msg', __('PRIVATE REPLY', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum-private_reply_msg" value="'.$private_reply_msg.'" /></td><td>(private_reply_msg="'.$private_reply_msg.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_forum', $values);            

                                    echo '</table>';    
                            echo '</div>';    

                            // [cpc-forum-backto]
                            $values = get_option('cpc_shortcode_options_'.'cpc_forum_backto') ? get_option('cpc_shortcode_options_'.'cpc_forum_backto') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forum_backto_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a link back to the forum topics. Only shown when viewing a single topic.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.sprintf(__('Add [cpc-forum-backto slug="xxx"] to the ClassicPress Page of your forum (click on the <strong>Page</strong> link <a href="%s">here</a>) where "xxx" is the <a href="%s">slug of your forum</a>.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpccom_forum_setup' ), admin_url( 'edit-tags.php?taxonomy=cpc_forum&post_type=cpc_forum_post' ));
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-forum-backto');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Text for the link", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_forum_backto-label', __('Back to %s...', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_backto-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_forum_backto', $values);            

                                echo '</table>';    
                            echo '</div>';    

                            // [cpc-forum-reply]
                            $values = get_option('cpc_shortcode_options_'.'cpc_forum_comment') ? get_option('cpc_shortcode_options_'.'cpc_forum_comment') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forum_comment_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a text area to add a reply to a forum topic. Only shown when viewing a single topic.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.sprintf(__('Add [cpc-forum-reply slug="xxx"] to the ClassicPress Page of your forum (click on the <strong>Page</strong> link <a href="%s">here</a>) where "xxx" is the <a href="%s">slug of your forum</a>.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpccom_forum_setup' ), admin_url( 'edit-tags.php?taxonomy=cpc_forum&post_type=cpc_forum_post' ));
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-forum-reply');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Label for add reply button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_forum_comment-label', __('Add Reply', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_comment-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr><td>'.__("Optional CSS class for button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $class = cpc_get_shortcode_default($values, 'cpc_forum_comment-class', '');
                                        echo '<input type="text" name="cpc_forum_comment-class" value="'.$class.'" /></td><td>(class="'.$class.'")</td></tr>';
                                    echo '<tr><td>'.__("Text above reply text area", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $content_label = cpc_get_shortcode_default($values, 'cpc_forum_comment-content_label', '');
                                        echo '<input type="text" name="cpc_forum_comment-content_label" value="'.$content_label.'" /></td><td>(content_label="'.$content_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Don't have permission to view topic message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $private_msg = cpc_get_shortcode_default($values, 'cpc_forum_comment-private_msg', '');
                                        echo '<input type="text" name="cpc_forum_comment-private_msg" value="'.$private_msg.'" /></td><td>(private_msg="'.$private_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Don't have permission to reply message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $no_permission_msg = cpc_get_shortcode_default($values, 'cpc_forum_comment-no_permission_msg', __('You do not have permission to reply on this forum.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_comment-no_permission_msg" value="'.$no_permission_msg.'" /></td><td>(no_permission_msg="'.$no_permission_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Forum is locked message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $locked_msg = cpc_get_shortcode_default($values, 'cpc_forum_comment-locked_msg', __('This forum is locked. New posts and replies are not allowed.', CPC2_TEXT_DOMAIN).' ');
                                        echo '<input type="text" name="cpc_forum_comment-locked_msg" value="'.$locked_msg.'" /></td><td>(locked_msg="'.$locked_msg.'")</td></tr>';
                                    echo '<tr><td>'.__('Enable reply moderation', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $moderate = cpc_get_shortcode_default($values, 'cpc_forum_comment-moderate', false);
                                        echo '<input type="checkbox" name="cpc_forum_comment-moderate"'.($moderate ? ' CHECKED' : '').'></td><td>(moderate="'.($moderate ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Moderation message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $moderate_msg = cpc_get_shortcode_default($values, 'cpc_forum_comment-moderate_msg', __('Your comment will appear once it has been moderated.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_comment-moderate_msg" value="'.$moderate_msg.'" /></td><td>(moderate_msg="'.$moderate_msg.'")</td></tr>';
                                    echo '<tr><td>'.__('Show reply textarea by default', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show = cpc_get_shortcode_default($values, 'cpc_forum_comment-show', true);
                                        echo '<input type="checkbox" name="cpc_forum_comment-show"'.($show ? ' CHECKED' : '').'></td><td>(show="'.($show ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Allow users to close posts', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $allow_close = cpc_get_shortcode_default($values, 'cpc_forum_comment-allow_close', true);
                                        echo '<input type="checkbox" name="cpc_forum_comment-allow_close"'.($allow_close ? ' CHECKED' : '').'></td><td>(allow_close="'.($allow_close ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Label to close topic", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $close_msg = cpc_get_shortcode_default($values, 'cpc_forum_comment-close_msg', __('Tick to close this post', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_comment-close_msg" value="'.$close_msg.'" /></td><td>(close_msg="'.$close_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Message that topic is closed", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $comments_closed_msg = cpc_get_shortcode_default($values, 'cpc_forum_comment-comments_closed_msg', __('This post is closed.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_comment-comments_closed_msg" value="'.$comments_closed_msg.'" /></td><td>(comments_closed_msg="'.$comments_closed_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Label to re-open topic", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reopen_label = cpc_get_shortcode_default($values, 'cpc_forum_comment-reopen_label', __('Re-open this post', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_comment-reopen_label" value="'.$reopen_label.'" /></td><td>(reopen_label="'.$reopen_label.'")</td></tr>';
                                    echo '<tr><td>'.__('Only allow one reply per user', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $allow_one = cpc_get_shortcode_default($values, 'cpc_forum_comment-allow_one', false);
                                        echo '<input type="checkbox" name="cpc_forum_comment-allow_one"'.($allow_one ? ' CHECKED' : '').'></td><td>(allow_one="'.($allow_one ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Message that replied already", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $allow_one_msg = cpc_get_shortcode_default($values, 'cpc_forum_comment-allow_one_msg', __('You can only reply once on this forum.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_comment-allow_one_msg" value="'.$allow_one_msg.'" /></td><td>(allow_one_msg="'.$allow_one_msg.'")</td></tr>';
                                    echo '<tr><td>'.__('Private replies', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $allow_private = cpc_get_shortcode_default($values, 'cpc_forum_comment-allow_private', 'disabled');
                                        echo '<select name="cpc_forum_comment-allow_private">';
                                            echo '<option value=0'.($allow_private == 'disabled' ? ' SELECTED' : '').'>'.__('Disabled', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="optional"'.($allow_private == 'optional' ? ' SELECTED' : '').'>'.__('Option available to user', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="forced"'.($allow_private == 'forced' ? ' SELECTED' : '').'>'.__('All replies private', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(allow_private="'.$allow_private.'")</td></tr>';    
                                    echo '<tr><td>'.__("Private reply label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $private_reply_check_msg = cpc_get_shortcode_default($values, 'cpc_forum_comment-private_reply_check_msg', __('Only share reply with %s', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_comment-private_reply_check_msg" value="'.$private_reply_check_msg.'" /></td><td>(private_reply_check_msg="'.$private_reply_check_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Show in (which forum) label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_in_label = cpc_get_shortcode_default($values, 'cpc_forum_comment-show_in_label', __('Show in:', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_comment-show_in_label" value="'.$show_in_label.'" /></td><td>(show_in_label="'.$show_in_label.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_forum_comment', $values);            

                                echo '</table>';    
                            echo '</div>';    

                            // [cpc-forum-page]
                            $values = get_option('cpc_shortcode_options_'.'cpc_forum_page') ? get_option('cpc_shortcode_options_'.'cpc_forum_page') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forum_page_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a ready made page for a forum.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.sprintf(__('Add [cpc-forum-page slug="xxx"] to a ClassicPress Page where "xxx" is the <a href="%s">slug of your forum</a>.', CPC2_TEXT_DOMAIN), admin_url( 'edit-tags.php?taxonomy=cpc_forum&post_type=cpc_forum_post' ));
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-forum-page');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Style', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $style = cpc_get_shortcode_default($values, 'cpc_forum_page-style', 'table');
                                        echo '<select name="cpc_forum_page-style">';
                                            echo '<option value="table"'.($style == 'table' ? ' SELECTED' : '').'>'.__('Table', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="classic"'.($style == 'classic' ? ' SELECTED' : '').'>'.__('Classic', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(style="'.$style.'")</td></tr>';    
                                    echo '<tr><td>'.__('Show new topic form', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show = cpc_get_shortcode_default($values, 'cpc_forum_page-show', false);
                                        echo '<input type="checkbox" name="cpc_forum_page-show"'.($show ? ' CHECKED' : '').'></td><td>(show="'.($show ? '1' : '0').'")</td></tr>';    
                                    echo '<tr><td>'.__("Title header text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_title = cpc_get_shortcode_default($values, 'cpc_forum_page-header_title', __('Topic', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_page-header_title" value="'.$header_title.'" /></td><td>(header_title="'.$header_title.'")</td></tr>';
                                    echo '<tr><td>'.__("Replies header text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_count = cpc_get_shortcode_default($values, 'cpc_forum_page-header_count', __('Replies', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_page-header_count" value="'.$header_count.'" /></td><td>(header_count="'.$header_count.'")</td></tr>';
                                    echo '<tr><td>'.__("Last activity header text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_last_activity = cpc_get_shortcode_default($values, 'cpc_forum_page-header_last_activity', __('Last activity', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_page-header_last_activity" value="'.$header_last_activity.'" /></td><td>(header_last_activity="'.$header_last_activity.'")</td></tr>';
                                    echo '<tr><td>'.__('Base date', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $base_date = cpc_get_shortcode_default($values, 'cpc_forum_page-base_date', 'post_date_gmt');
                                        echo '<select name="cpc_forum_page-base_date">';
                                            echo '<option value="post_date_gmt"'.($base_date == 'post_date_gmt' ? ' SELECTED' : '').'>'.__('GMT', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="post_date"'.($base_date == 'post_date' ? ' SELECTED' : '').'>'.__('Local', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(base_date="'.$base_date.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_forum_page', $values);                

                                echo '</table>';    
                            echo '</div>';    

                            // [cpc-forum-post]
                            $values = get_option('cpc_shortcode_options_'.'cpc_forum_post') ? get_option('cpc_shortcode_options_'.'cpc_forum_post') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forum_post_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a textarea for adding a forum topic.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.sprintf(__('Add [cpc-forum-post slug="xxx"] to a ClassicPress Page where "xxx" is the <a href="%s">slug of your forum</a> or slug="choose" to allow users to select.', CPC2_TEXT_DOMAIN), admin_url( 'edit-tags.php?taxonomy=cpc_forum&post_type=cpc_forum_post' ));
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-forum-post');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Post title text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $title_label = cpc_get_shortcode_default($values, 'cpc_forum_post-title_label', __('Post title', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_post-title_label" value="'.$title_label.'" /></td><td>(title_label="'.$title_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Topic content text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $content_label = cpc_get_shortcode_default($values, 'cpc_forum_post-content_label', __('Post', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_post-content_label" value="'.$content_label.'" /></td><td>(content_label="'.$content_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Add topic button label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_forum_post-label', __('Add Topic', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_post-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr><td>'.__("Prompt to subscribe", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $subscribe_prompt = cpc_get_shortcode_default($values, 'cpc_forum_post-subscribe_prompt', __('Receive email when new comments are added', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_post-subscribe_prompt" value="'.$subscribe_prompt.'" /></td><td>(subscribe_prompt="'.$subscribe_prompt.'")</td></tr>';
                                    echo '<tr><td>'.__("Optional CSS class for button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $class = cpc_get_shortcode_default($values, 'cpc_forum_post-class', '');
                                        echo '<input type="text" name="cpc_forum_post-class" value="'.$class.'" /></td><td>(class="'.$class.'")</td></tr>';
                                    echo '<tr><td>'.__('Enable moderation', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $moderate = cpc_get_shortcode_default($values, 'cpc_forum_post-moderate', false);
                                        echo '<input type="checkbox" name="cpc_forum_post-moderate"'.($moderate ? ' CHECKED' : '').'></td><td>(moderate="'.($moderate ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Awaiting moderation message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $moderate_msg = cpc_get_shortcode_default($values, 'cpc_forum_post-moderate_msg', __('Your post will appear once it has been moderated.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_post-moderate_msg" value="'.$moderate_msg.'" /></td><td>(moderate_msg="'.$moderate_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Permission denied message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $private_msg = cpc_get_shortcode_default($values, 'cpc_forum_post-private_msg', '');
                                        echo '<input type="text" name="cpc_forum_post-private_msg" value="'.$private_msg.'" /></td><td>(private_msg="'.$private_msg.'")</td></tr>';
                                    echo '<tr><td>'.__('Set post title as multiline', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $multiline = cpc_get_shortcode_default($values, 'cpc_forum_post-multiline', 0);
                                        echo '<select name="cpc_forum_post-multiline">';
                                            echo '<option value="0"'.($multiline == '0' ? ' SELECTED' : '').'>'.__('Disabled', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="1"'.($multiline == '1' ? ' SELECTED' : '').'>'.__('1 line', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="2"'.($multiline == '2' ? ' SELECTED' : '').'>'.__('2 lines', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="3"'.($multiline == '3' ? ' SELECTED' : '').'>'.__('3 lines', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="4"'.($multiline == '4' ? ' SELECTED' : '').'>'.__('4 lines', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="5"'.($multiline == '5' ? ' SELECTED' : '').'>'.__('5 lines', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(multiline="'.$multiline.'")</td></tr>';
                                    echo '<tr><td>'.__('Show new topic form', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show = cpc_get_shortcode_default($values, 'cpc_forum_post-show', false);
                                        echo '<input type="checkbox" name="cpc_forum_post-show"'.($show ? ' CHECKED' : '').'></td><td>(show="'.($show ? '1' : '0').'")</td></tr>';        
                                    echo '<tr><td>'.__('Allow forum choice', CPC2_TEXT_DOMAIN).'</td><td>';
                                        echo '<input type="checkbox" class="cpc_shortcode_tip_available"></td><td></td></tr>';
                                    echo '<tr id="cpc_shortcode_tip" style="display:none"';
                                        echo '><td colspan="3" class="cpc_admin_shortcode_tip">'.__('Add slug="choose" to the shortcode on your page. This value is not set here (just for information).', CPC2_TEXT_DOMAIN).'</td></tr>';
                                    echo '<tr><td>'.__("Forum choice label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $post_to_label = cpc_get_shortcode_default($values, 'cpc_forum_post-post_to_label', __('Post to', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_post-post_to_label" value="'.$post_to_label.'" /></td><td>(post_to_label="'.$post_to_label.'")</td></tr>';                                    

                                    do_action('cpc_show_styling_options_hook', 'cpc_forum_post', $values);                

                                echo '</table>';  
                            echo '</div>';   

                            // [cpc-forums]
                            $values = get_option('cpc_shortcode_options_'.'cpc_forums') ? get_option('cpc_shortcode_options_'.'cpc_forums') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forums_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a top level of all forums.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-forums] to a ClassicPress Page, Post or Text Widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-forums');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Show as dropdown', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_as_dropdown = cpc_get_shortcode_default($values, 'cpc_forums-show_as_dropdown', false);
                                        echo '<input type="checkbox" name="cpc_forums-show_as_dropdown"'.($show_as_dropdown ? ' CHECKED' : '').'></td><td>(show_as_dropdown="'.($show_as_dropdown ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Quick jump text for dropdown", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_as_dropdown_text = cpc_get_shortcode_default($values, 'cpc_forums-show_as_dropdown_text', __('Quick jump to forum...', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forums-show_as_dropdown_text" value="'.$show_as_dropdown_text.'" /></td><td>(show_as_dropdown_text="'.$show_as_dropdown_text.'")</td></tr>';
                                    echo '<tr><td>'.__("Forum title header text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_title = cpc_get_shortcode_default($values, 'cpc_forums-forum_title', __('Forum', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forums-forum_title" value="'.$forum_title.'" /></td><td>(forum_title="'.$forum_title.'")</td></tr>';
                                    echo '<tr><td>'.__("Topic count header text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_count = cpc_get_shortcode_default($values, 'cpc_forums-forum_count', __('Count', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forums-forum_count" value="'.$forum_count.'" /></td><td>(forum_count="'.$forum_count.'")</td></tr>';
                                    echo '<tr><td>'.__("Last Poster header text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_last_activity = cpc_get_shortcode_default($values, 'cpc_forums-forum_last_activity', __('Last Poster', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forums-forum_last_activity" value="'.$forum_last_activity.'" /></td><td>(forum_last_activity="'.$forum_last_activity.'")</td></tr>';
                                    echo '<tr><td>'.__("Freshness header text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_freshness = cpc_get_shortcode_default($values, 'cpc_forums-forum_freshness', __('Freshness', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forums-forum_freshness" value="'.$forum_freshness.'" /></td><td>(forum_freshness="'.$forum_freshness.'")</td></tr>';
                                    echo '<tr><td>'.__('Base poster & freshness on latest reply?', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_count_include_replies = cpc_get_shortcode_default($values, 'cpc_forums-forum_count_include_replies', true);
                                        echo '<input type="checkbox" name="cpc_forums-forum_count_include_replies"'.($forum_count_include_replies ? ' CHECKED' : '').'></td><td>(forum_count_include_replies="'.($forum_count_include_replies ? '1' : '0').'")</td></tr>';

                                    echo '<tr><td>'.__('Show children forums', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_children = cpc_get_shortcode_default($values, 'cpc_forums-show_children', false);
                                        echo '<input type="checkbox" name="cpc_forums-show_children"'.($show_children ? ' CHECKED' : '').'></td><td>(show_children="'.($show_children ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show header', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_header = cpc_get_shortcode_default($values, 'cpc_forums-show_header', false);
                                        echo '<input type="checkbox" name="cpc_forums-show_header"'.($show_header ? ' CHECKED' : '').'></td><td>(show_header="'.($show_header ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show topic count header text', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_count = cpc_get_shortcode_default($values, 'cpc_forums-show_count', true);
                                        echo '<input type="checkbox" name="cpc_forums-show_count"'.($show_count ? ' CHECKED' : '').'></td><td>(show_count="'.($show_count ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show last poster header text', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_last_activity = cpc_get_shortcode_default($values, 'cpc_forums-show_last_activity', true);
                                        echo '<input type="checkbox" name="cpc_forums-show_last_activity"'.($show_last_activity ? ' CHECKED' : '').'></td><td>(show_last_activity="'.($show_last_activity ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show freshness header text', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_freshness = cpc_get_shortcode_default($values, 'cpc_forums-show_freshness', true);
                                        echo '<input type="checkbox" name="cpc_forums-show_freshness"'.($show_freshness ? ' CHECKED' : '').'></td><td>(show_freshness="'.($show_freshness ? '1' : '0').'")</td></tr>';

                                    echo '<tr><td>'.__('Top level as links', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $level_0_links = cpc_get_shortcode_default($values, 'cpc_forums-level_0_links', true);
                                        echo '<input type="checkbox" name="cpc_forums-level_0_links"'.($level_0_links ? ' CHECKED' : '').'></td><td>(level_0_links="'.($level_0_links ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Privacy filter', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $include = cpc_get_shortcode_default($values, 'cpc_forums-include', 'all');
                                        echo '<select name="cpc_forums-include">';
                                            echo '<option value="all"'.($include == 'all' ? ' SELECTED' : '').'>'.__('All', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="private"'.($include == 'private' ? ' SELECTED' : '').'>'.__('Private only', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="public"'.($include == 'public' ? ' SELECTED' : '').'>'.__('Public only', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(include="'.$include.'")</td></tr>';
                                    echo '<tr><td>'.__('Base date', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $base_date = cpc_get_shortcode_default($values, 'cpc_forums-base_date', 'post_date_gmt');
                                        echo '<select name="cpc_forums-base_date">';
                                            echo '<option value="post_date_gmt"'.($base_date == 'post_date_gmt' ? ' SELECTED' : '').'>'.__('GMT', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="post_date"'.($base_date == 'post_date' ? ' SELECTED' : '').'>'.__('Local', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(base_date="'.$base_date.'")</td></tr>';

                                    echo '<tr><td colspan=3 class="cpc_section">'.__('Most recent activity shown below each forum', CPC2_TEXT_DOMAIN).'</td></tr>';    
                                    
                                    echo '<tr><td>'.__("Number of topics to show (or 'none')", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_posts = cpc_get_shortcode_default($values, 'cpc_forums-show_posts', 3);
                                        echo '<input type="text" name="cpc_forums-show_posts" value="'.$show_posts.'" /></td><td>(show_posts="'.$show_posts.'")</td></tr>';
                                    echo '<tr><td>'.__('Show topics header', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_posts_header = cpc_get_shortcode_default($values, 'cpc_forums-show_posts_header', true);
                                        echo '<input type="checkbox" name="cpc_forums-show_posts_header"'.($show_posts_header ? ' CHECKED' : '').'></td><td>(show_posts_header="'.($show_posts_header ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show count totals above topics', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_summary = cpc_get_shortcode_default($values, 'cpc_forums-show_summary', false);
                                        echo '<input type="checkbox" name="cpc_forums-show_summary"'.($show_summary ? ' CHECKED' : '').'></td><td>(show_summary="'.($show_summary ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Header title", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_title = cpc_get_shortcode_default($values, 'cpc_forums-header_title', __('Topic', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forums-header_title" value="'.$header_title.'" /></td><td>(header_title="'.$header_title.'")</td></tr>';
                                    echo '<tr><td>'.__("Replies title", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_count = cpc_get_shortcode_default($values, 'cpc_forums-header_count', __('Replies', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forums-header_count" value="'.$header_count.'" /></td><td>(header_count="'.$header_count.'")</td></tr>';
                                    echo '<tr><td>'.__("Last activity title", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $header_last_activity = cpc_get_shortcode_default($values, 'cpc_forums-header_last_activity', __('Last activity', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forums-header_last_activity" value="'.$header_last_activity.'" /></td><td>(header_last_activity="'.$header_last_activity.'")</td></tr>';
                                    echo '<tr><td>'.__("Limit on title length", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $title_length = cpc_get_shortcode_default($values, 'cpc_forums-title_length', 50);
                                        echo '<input type="text" name="cpc_forums-title_length" value="'.$title_length.'" /> '.__('characters', CPC2_TEXT_DOMAIN).'</td><td>(title_length="'.$title_length.'")</td></tr>';
                                    echo '<tr><td>'.__('Include closed topics', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_closed = cpc_get_shortcode_default($values, 'cpc_forums-show_closed', true);
                                        echo '<input type="checkbox" name="cpc_forums-show_closed"'.($show_closed ? ' CHECKED' : '').'></td><td>(show_closed="'.($show_closed ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Do not indent', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $no_indent = cpc_get_shortcode_default($values, 'cpc_forums-no_indent', true);
                                        echo '<input type="checkbox" name="cpc_forums-no_indent"'.($no_indent ? ' CHECKED' : '').'></td><td>(no_indent="'.($no_indent ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.sprintf(__("Forum image width (add via <a href='%s'>Forum Edit</a>)", CPC2_TEXT_DOMAIN), admin_url( 'edit-tags.php?taxonomy=cpc_forum&post_type=cpc_forum_post' )).'</td><td>';
                                        $featured_image_width = cpc_get_shortcode_default($values, 'cpc_forums-featured_image_width', 0);
                                        echo '<input type="text" name="cpc_forums-featured_image_width" value="'.$featured_image_width.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(featured_image_width="'.$featured_image_width.'")</td></tr>';    

                                    do_action('cpc_show_styling_options_hook', 'cpc_forums', $values);                

                                echo '</table>';  
                            echo '</div>';   

                            // [cpc-forum-show-posts]
                            $values = get_option('cpc_shortcode_options_'.'cpc_forum_show_posts') ? get_option('cpc_shortcode_options_'.'cpc_forum_show_posts') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forum_show_posts_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Flexible way to show forum posts.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.sprintf(__('Add [cpc-forum-show-posts slug="xxx"] to the ClassicPress Page of your forum (click on the <strong>Page</strong> link <a href="%s">here</a>) where "xxx" is the <a href="%s">slug of your forum</a>.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpccom_forum_setup' ), admin_url( 'edit-tags.php?taxonomy=cpc_forum&post_type=cpc_forum_post' ));    
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-forum-show-posts');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Order value', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $order = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-order', 'date');
                                        echo '<select name="cpc_forum_post-order">';
                                            echo '<option value="author"'.($order == 'author' ? ' SELECTED' : '').'>'.__('Author', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="content"'.($order == 'content' ? ' SELECTED' : '').'>'.__('Content', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="date"'.($order == 'date' ? ' SELECTED' : '').'>'.__('Date', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="title"'.($order == 'title' ? ' SELECTED' : '').'>'.__('Title', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(order="'.$order.'")</td></tr>';
                                    echo '<tr><td>'.__('Order', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $orderby = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-orderby', 'DESC');
                                        echo '<select name="cpc_forum_post-orderby">';
                                            echo '<option value="ASC"'.($orderby == 'ASC' ? ' SELECTED' : '').'>'.__('Ascending', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="DESC"'.($orderby == 'DESC' ? ' SELECTED' : '').'>'.__('Descending', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(orderby="'.$orderby.'")</td></tr>';
                                    echo '<tr><td>'.__('Status', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $status = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-status', '');
                                        echo '<select name="cpc_forum_post-status">';
                                            echo '<option value=""'.($status == '' ? ' SELECTED' : '').'>'.__('All', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="open"'.($status == 'open' ? ' SELECTED' : '').'>'.__('Open', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="closed"'.($status == 'closed' ? ' SELECTED' : '').'>'.__('Closed', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(status="'.$status.'")</td></tr>';
                                    echo '<tr><td>'.__('Include topics', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $include_posts = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-include_posts', true);
                                        echo '<input type="checkbox" name="cpc_forum_show_posts-include_posts"'.($include_posts ? ' CHECKED' : '').'></td><td>(include_posts="'.($include_posts ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Include replies', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $include_replies = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-include_replies', true);
                                        echo '<input type="checkbox" name="cpc_forum_show_posts-include_replies"'.($include_replies ? ' CHECKED' : '').'></td><td>(include_replies="'.($include_replies ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Include comments', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $include_comments = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-include_comments', false);
                                        echo '<input type="checkbox" name="cpc_forum_show_posts-include_comments"'.($include_comments ? ' CHECKED' : '').'></td><td>(include_comments="'.($include_comments ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Closed prefix", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $closed_prefix = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-closed_prefix', __('closed', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_show_posts-closed_prefix" value="'.$closed_prefix.'" /></td><td>(closed_prefix="'.$closed_prefix.'")</td></tr>';    
                                    echo '<tr><td>'.__('Show author', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_author = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-show_author', true);
                                        echo '<input type="checkbox" name="cpc_forum_show_posts-show_author"'.($show_author ? ' CHECKED' : '').'></td><td>(show_author="'.($show_author ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Format of author text (for above)", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $author_format = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-author_format', __('By %s', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_show_posts-author_format" value="'.$author_format.'" /></td><td>(author_format="'.$author_format.'")</td></tr>';    
                                    echo '<tr><td>'.__('Link author to profile page', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $author_link = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-author_link', true);
                                        echo '<input type="checkbox" name="cpc_forum_show_posts-author_link"'.($author_link ? ' CHECKED' : '').'></td><td>(author_link="'.($author_link ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show date', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_date = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-show_date', true);
                                        echo '<input type="checkbox" name="cpc_forum_show_posts-show_date"'.($show_date ? ' CHECKED' : '').'></td><td>(show_date="'.($show_date ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Format of date text (for above)", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $date_format = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-date_format', __('%s ago', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_show_posts-date_format" value="'.$date_format.'" /></td><td>(date_format="'.$date_format.'")</td></tr>';    
                                    echo '<tr><td>'.__('Show snippet', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_snippet = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-show_snippet', true);
                                        echo '<input type="checkbox" name="cpc_forum_show_posts-show_snippet"'.($show_snippet ? ' CHECKED' : '').'></td><td>(show_snippet="'.($show_snippet ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Text for link to forum post", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $more_link = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-more_link', __('read', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_show_posts-more_link" value="'.$more_link.'" /></td><td>(more_link="'.$more_link.'")</td></tr>';    
                                    echo '<tr><td>'.__("Text shown if no posts", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $no_posts = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-no_posts', __('No posts', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_show_posts-no_posts" value="'.$no_posts.'" /></td><td>(no_posts="'.$no_posts.'")</td></tr>';    
                                    echo '<tr><td>'.__("Maximum length of title", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $title_length = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-title_length', 50);
                                        echo '<input type="text" name="cpc_forum_show_posts-title_length" value="'.$title_length.'" /></td><td>(title_length="'.$title_length.'")</td></tr>';    
                                    echo '<tr><td>'.__("Maximum length of snippet", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $snippet_length = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-snippet_length', 30);
                                        echo '<input type="text" name="cpc_forum_show_posts-snippet_length" value="'.$snippet_length.'" /></td><td>(snippet_length="'.$snippet_length.'")</td></tr>';    
                                    echo '<tr><td>'.__("Number of posts displayed", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $max = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-max', 10);
                                        echo '<input type="text" name="cpc_forum_show_posts-max" value="'.$max.'" /></td><td>(max="'.$max.'")</td></tr>';    
                                    echo '<tr><td>'.__('Base date', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $base_date = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-base_date', 'post_date_gmt');
                                        echo '<select name="cpc_forum_show_posts-base_date">';
                                            echo '<option value="post_date_gmt"'.($base_date == 'post_date_gmt' ? ' SELECTED' : '').'>'.__('GMT', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="post_date"'.($base_date == 'post_date' ? ' SELECTED' : '').'>'.__('Local', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(base_date="'.$base_date.'")</td></tr>';

                                    echo '<tr><td colspan=3 class="cpc_section">'.__('Summary sentence and author avatar', CPC2_TEXT_DOMAIN).'</td></tr>';        
                                    echo '<tr><td>'.__('Show summary sentence and avatar', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $summary = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-summary', false);
                                        echo '<input type="checkbox" name="cpc_forum_show_posts-summary"'.($summary ? ' CHECKED' : '').'></td><td>(summary="'.($summary ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Format", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $summary_format = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-summary_format', __('%s %s %s %s ago %s', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_show_posts-summary_format" value="'.$summary_format.'" /></td><td>(summary_format="'.$summary_format.'")</td></tr>';    
                                    echo '<tr><td>'.__("Size of avatar", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $summary_avatar_size = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-summary_avatar_size', 32);
                                        echo '<input type="text" name="cpc_forum_show_posts-summary_avatar_size" value="'.$summary_avatar_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(summary_avatar_size="'.$summary_avatar_size.'")</td></tr>';    
                                    echo '<tr><td>'.__("Text for started", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $summary_started = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-summary_started', __('started', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_show_posts-summary_started" value="'.$summary_started.'" /></td><td>(summary_started="'.$summary_started.'")</td></tr>';    
                                    echo '<tr><td>'.__("Text for replied to", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $summary_replied = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-summary_replied', __('replied to', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_show_posts-summary_replied" value="'.$summary_replied.'" /></td><td>(summary_replied="'.$summary_replied.'")</td></tr>';    
                                    echo '<tr><td>'.__("Text for commented on", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $summary_commented = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-summary_commented', __('commented on', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_show_posts-summary_commented" value="'.$summary_commented.'" /></td><td>(summary_commented="'.$summary_commented.'")</td></tr>';    
                                    echo '<tr><td>'.__("Maximum length for title", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $summary_title_length = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-summary_title_length', 150);
                                        echo '<input type="text" name="cpc_forum_show_posts-summary_title_length" value="'.$summary_title_length.'" /> '.__('characters', CPC2_TEXT_DOMAIN).'</td><td>(summary_title_length="'.$summary_title_length.'")</td></tr>';    
                                    echo '<tr><td>'.__("Maximum length for content snippet", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $summary_snippet_length = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-summary_snippet_length', 50);
                                        echo '<input type="text" name="cpc_forum_show_posts-summary_snippet_length" value="'.$summary_snippet_length.'" /> '.__('characters', CPC2_TEXT_DOMAIN).'</td><td>(summary_snippet_length="'.$summary_snippet_length.'")</td></tr>';    
                                    echo '<tr><td>'.__('Show unread if applicable', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $summary_show_unread = cpc_get_shortcode_default($values, 'cpc_forum_show_posts-summary_show_unread', true);
                                        echo '<input type="checkbox" name="cpc_forum_show_posts-summary_show_unread"'.($summary_show_unread ? ' CHECKED' : '').'></td><td>(summary_show_unread="'.($summary_show_unread ? '1' : '0').'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_forum_show_posts', $values);                

                                echo '</table>';  
                            echo '</div>';      
                        
                            // [cpc-forum-children]
                            $values = get_option('cpc_shortcode_options_'.'cpc_forum_children') ? get_option('cpc_shortcode_options_'.'cpc_forum_children') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forum_children_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays child forums as setup in Edit Forum.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.sprintf(__('Add [cpc-forum-children slug="xxx"] to the ClassicPress Page of your forum (click on the <strong>Page</strong> link <a href="%s">here</a>) where "xxx" is the <a href="%s">slug of the parent forum</a>.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpccom_forum_setup' ), admin_url( 'edit-tags.php?taxonomy=cpc_forum&post_type=cpc_forum_post' ));    
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-forum-children');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Show Header', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_header = cpc_get_shortcode_default($values, 'cpc_forum_children-show_header', true);
                                        echo '<input type="checkbox" name="cpc_forum_children-show_header"'.($show_header ? ' CHECKED' : '').'></td><td>(show_header="'.($show_header ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show Summary', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_summary = cpc_get_shortcode_default($values, 'cpc_forum_children-show_summary', true);
                                        echo '<input type="checkbox" name="cpc_forum_children-show_summary"'.($show_summary ? ' CHECKED' : '').'></td><td>(show_summary="'.($show_summary ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show Posts/Replies Count', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_count = cpc_get_shortcode_default($values, 'cpc_forum_children-show_count', true);
                                        echo '<input type="checkbox" name="cpc_forum_children-show_count"'.($show_count ? ' CHECKED' : '').'></td><td>(show_count="'.($show_count ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show Last Activity', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_last_activity = cpc_get_shortcode_default($values, 'cpc_forum_children-show_last_activity', true);
                                        echo '<input type="checkbox" name="cpc_forum_children-show_last_activity"'.($show_last_activity ? ' CHECKED' : '').'></td><td>(show_last_activity="'.($show_last_activity ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show Freshness', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_freshness = cpc_get_shortcode_default($values, 'cpc_forum_children-show_freshness', true);
                                        echo '<input type="checkbox" name="cpc_forum_children-show_freshness"'.($show_freshness ? ' CHECKED' : '').'></td><td>(show_freshness="'.($show_freshness ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Forum name label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_title = cpc_get_shortcode_default($values, 'cpc_forum_children-forum_title', __('Child Forum', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_children-forum_title" value="'.$forum_title.'" /></td><td>(forum_title="'.$forum_title.'")</td></tr>';                            
                                    echo '<tr><td>'.__("Posts/Replies Count label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_count = cpc_get_shortcode_default($values, 'cpc_forum_children-forum_count', __('Activity', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_children-forum_count" value="'.$forum_count.'" /></td><td>(forum_count="'.$forum_count.'")</td></tr>';                            
                                    echo '<tr><td>'.__("Last Poster label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_last_activity = cpc_get_shortcode_default($values, 'cpc_forum_children-forum_last_activity', __('Last Poster', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_children-forum_last_activity" value="'.$forum_last_activity.'" /></td><td>(forum_last_activity="'.$forum_last_activity.'")</td></tr>';                            
                                    echo '<tr><td>'.__("Freshness label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $forum_freshness = cpc_get_shortcode_default($values, 'cpc_forum_children-forum_freshness', __('Freshness', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_children-forum_freshness" value="'.$forum_freshness.'" /></td><td>(forum_freshness="'.$forum_freshness.'")</td></tr>';                            
                                    echo '<tr><td>'.__('Link forum titles to forum', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $link = cpc_get_shortcode_default($values, 'cpc_forum_children-link', true);
                                        echo '<input type="checkbox" name="cpc_forum_children-link"'.($link ? ' CHECKED' : '').'></td><td>(link="'.($link ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Base date', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $base_date = cpc_get_shortcode_default($values, 'cpc_forum_children-base_date', 'post_date_gmt');
                                        echo '<select name="cpc_forum_children-base_date">';
                                            echo '<option value="post_date_gmt"'.($base_date == 'post_date_gmt' ? ' SELECTED' : '').'>'.__('GMT', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="post_date"'.($base_date == 'post_date' ? ' SELECTED' : '').'>'.__('Local', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(base_date="'.$base_date.'")</td></tr>';

                                    echo '<tr><td colspan="3" style="font-weight:bold;background-color:#dfdfdf">'.__('Posts in child forum', CPC2_TEXT_DOMAIN).'</td></tr>';
                                    echo '<tr><td colspan="3" style="font-style:italic">'.__('If activated, it is recommended to switch off the first 5 options above, and to style the "cpc_forum_children_description" class for the forum names.', CPC2_TEXT_DOMAIN).'</td></tr>';
                                    echo '<tr><td>'.__('Show child forum posts', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_child_posts = cpc_get_shortcode_default($values, 'cpc_forum_children-show_child_posts', false);
                                        echo '<input type="checkbox" name="cpc_forum_children-show_child_posts"'.($show_child_posts ? ' CHECKED' : '').'></td><td>(show_child_posts="'.($show_child_posts ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Replies Count label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $child_posts_count = cpc_get_shortcode_default($values, 'cpc_forum_children-child_posts_count', __('Replies', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_children-child_posts_count" value="'.$child_posts_count.'" /></td><td>(child_posts_count="'.$child_posts_count.'")</td></tr>';                            
                                    echo '<tr><td>'.__("Last Poster label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $child_posts_last_activity = cpc_get_shortcode_default($values, 'cpc_forum_children-child_posts_last_activity', __('Last Poster', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_children-child_posts_last_activity" value="'.$child_posts_last_activity.'" /></td><td>(child_posts_last_activity="'.$child_posts_last_activity.'")</td></tr>';
                                    echo '<tr><td>'.__("Freshness label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $child_posts_freshness = cpc_get_shortcode_default($values, 'cpc_forum_children-child_posts_freshness', __('Freshness', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_forum_children-child_posts_freshness" value="'.$child_posts_freshness.'" /></td><td>(child_posts_freshness="'.$child_posts_freshness.'")</td></tr>';
                                    echo '<tr><td>'.__("Max number of posts", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $child_posts_max = cpc_get_shortcode_default($values, 'cpc_forum_children-child_posts_max', 3);
                                        echo '<input type="text" name="cpc_forum_children-child_posts_max" value="'.$child_posts_max.'" /></td><td>(child_posts_max="'.$child_posts_max.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_forum_children', $values);                

                                echo '</table>';  
                            echo '</div>';                              

                            // [cpc-forum-sharethis]
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forum_sharethis_insert_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.sprintf(__("Inserts ShareThis code added to <em>any</em> forum <a href='%s'>here</a>.", CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpccom_forum_setup' )).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.sprintf(__('Add [cpc-forum-sharethis slug="xxx"] to a ClassicPress Page where "xxx" is the <a href="%s">slug of your forum</a>.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpccom_forum_setup' ));
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-forum-sharethis');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('No options', CPC2_TEXT_DOMAIN).'</td></tr>';

                                echo '</table>';  
                            echo '</div>';          

                            /* ----------------------- FRIENDS TAB ----------------------- */    

                            // [cpc-friends]
                            $values = get_option('cpc_shortcode_options_'.'cpc_friends') ? get_option('cpc_shortcode_options_'.'cpc_friends') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_friends_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a user's friends.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-friends] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-friends');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Number of friends to show', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $count = cpc_get_shortcode_default($values, 'cpc_friends-count', 10);
                                        echo '<input type="text" name="cpc_friends-count" value="'.$count.'" /></td><td>(count="'.$count.'")</td></tr>';
                                    echo '<tr><td>'.__('Avatar size', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $size = cpc_get_shortcode_default($values, 'cpc_friends-size', 64);
                                        echo '<input type="text" name="cpc_friends-size" value="'.$size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(size="'.$size.'")</td></tr>';
                                    echo '<tr><td>'.__('Link display names to profile page', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $link = cpc_get_shortcode_default($values, 'cpc_friends-link', true);
                                        echo '<input type="checkbox" name="cpc_friends-link"'.($link ? ' CHECKED' : '').'></td><td>(link="'.($link ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show when last active', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_last_active = cpc_get_shortcode_default($values, 'cpc_friends-show_last_active', true);
                                        echo '<input type="checkbox" name="cpc_friends-show_last_active"'.($show_last_active ? ' CHECKED' : '').'></td><td>(show_last_active="'.($show_last_active ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Text for when last active', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $last_active_text = cpc_get_shortcode_default($values, 'cpc_friends-last_active_text', __('Last seen:', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends-last_active_text" value="'.$last_active_text.'" /></td><td>(last_active_text="'.$last_active_text.'")</td></tr>';
                                    echo '<tr><td>'.__('Format for when last active', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $last_active_format = cpc_get_shortcode_default($values, 'cpc_friends-last_active_format', __('%s ago', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends-last_active_format" value="'.$last_active_format.'" /></td><td>(last_active_format="'.$last_active_format.'")</td></tr>';
                                    echo '<tr><td>'.__('Text for private', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $private = cpc_get_shortcode_default($values, 'cpc_friends-private', __('Private information', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends-private" value="'.$private.'" /></td><td>(private="'.$private.'")</td></tr>';
                                    echo '<tr><td>'.__('Text for no friends', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $none = cpc_get_shortcode_default($values, 'cpc_friends-none', __('No friends', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends-none" value="'.$none.'" /></td><td>(none="'.$none.'")</td></tr>';
                                    echo '<tr><td>'.__('Layout', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $layout = cpc_get_shortcode_default($values, 'cpc_friends-layout', 'list');
                                        echo '<select name="cpc_friends-layout">';
                                            echo '<option value="list"'.($layout == 'list' ? ' SELECTED' : '').'>'.__('List', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="fluid"'.($layout == 'fluid' ? ' SELECTED' : '').'>'.__('Fluid', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(layout="'.$layout.'")</td></tr>';
                                    echo '<tr><td>'.__('Logged out text', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $logged_out_msg = cpc_get_shortcode_default($values, 'cpc_friends-logged_out_msg', __('You must be logged in to view this page.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends-logged_out_msg" value="'.$logged_out_msg.'" /></td><td>(logged_out_msg="'.$logged_out_msg.'")</td></tr>';
                                    echo '<tr><td>'.__('Remove all friends option', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $remove_all_friends = cpc_get_shortcode_default($values, 'cpc_friends-remove_all_friends', true);
                                        echo '<input type="checkbox" name="cpc_friends-remove_all_friends"'.($remove_all_friends ? ' CHECKED' : '').'></td><td>(remove_all_friends="'.($remove_all_friends ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Remove all friends text', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $remove_all_friends_msg = cpc_get_shortcode_default($values, 'cpc_friends-remove_all_friends_msg', __('Remove all friends', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends-remove_all_friends_msg" value="'.$remove_all_friends_msg.'" /></td><td>(remove_all_friends_msg="'.$remove_all_friends_msg.'")</td></tr>';
                                    echo '<tr><td>'.__('Remove all friends confirmation', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $remove_all_friends_sure_msg = cpc_get_shortcode_default($values, 'cpc_friends-remove_all_friends_sure_msg', __('Are you sure? This cannot be undone!', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends-remove_all_friends_sure_msg" value="'.$remove_all_friends_sure_msg.'" /></td><td>(remove_all_friends_sure_msg="'.$remove_all_friends_sure_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Optional URL to login", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $login_url = cpc_get_shortcode_default($values, 'cpc_friends-login_url', '');
                                        echo '<input type="text" name="cpc_friends-login_url" value="'.$login_url.'" /></td><td>(login_url="'.$login_url.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_friends', $values);                    

                                echo '</table>';
                            echo '</div>';        

                            // [cpc-friends-status]
                            $values = get_option('cpc_shortcode_options_'.'cpc_friends_status') ? get_option('cpc_shortcode_options_'.'cpc_friends_status') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_friends_status_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays the friendship status of a user with the current user.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-friends-status] to the ClassicPress Page being used as the profile page.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-friends-status');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("You are friends text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $friends_yes = cpc_get_shortcode_default($values, 'cpc_friends_status-friends_yes', __('You are friends', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends_status-friends_yes" value="'.$friends_yes.'" /></td><td>(friends_yes="'.$friends_yes.'")</td></tr>';
                                    echo '<tr><td>'.__("Friend request pending text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $friends_pending = cpc_get_shortcode_default($values, 'cpc_friends_status-friends_pending', __('You have requested to be friends', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends_status-friends_pending" value="'.$friends_pending.'" /></td><td>(friends_pending="'.$friends_pending.'")</td></tr>';
                                    echo '<tr><td>'.__("You have a friend request text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $friend_request = cpc_get_shortcode_default($values, 'cpc_friends_status-friend_request', __('You have a friends request', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends_status-friend_request" value="'.$friend_request.'" /></td><td>(friend_request="'.$friend_request.'")</td></tr>';
                                    echo '<tr><td>'.__("You are not friends text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $friends_no = cpc_get_shortcode_default($values, 'cpc_friends_status-friends_no', __('You are not friends', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends_status-friends_no" value="'.$friends_no.'" /></td><td>(friends_no="'.$friends_no.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_friends_status', $values);                    

                                echo '</table>';
                            echo '</div>';        

                            // [cpc-friends-pending]
                            $values = get_option('cpc_shortcode_options_'.'cpc_friends_pending') ? get_option('cpc_shortcode_options_'.'cpc_friends_pending') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_friends_pending_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays pending friendship requests for the current user.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-friends-pending] to the ClassicPress Page being used as the profile page.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-friends-pending');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Maximum number of requests to show", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $count = cpc_get_shortcode_default($values, 'cpc_friends_pending-count', 10);
                                        echo '<input type="text" name="cpc_friends_pending-count" value="'.$count.'" /></td><td>(count="'.$count.'")</td></tr>';
                                    echo '<tr><td>'.__("Avatar size", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $size = cpc_get_shortcode_default($values, 'cpc_friends_pending-size', 64);
                                        echo '<input type="text" name="cpc_friends_pending-size" value="'.$size.'" /></td><td>(size="'.$size.'")</td></tr>';
                                    echo '<tr><td>'.__('Link avatar to profile page', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $link = cpc_get_shortcode_default($values, 'cpc_friends_pending-link', true);
                                        echo '<input type="checkbox" name="cpc_friends_pending-link"'.($link ? ' CHECKED' : '').'></td><td>(link="'.($link ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Optional CSS class for button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $class = cpc_get_shortcode_default($values, 'cpc_friends_pending-class', '');
                                        echo '<input type="text" name="cpc_friends_pending-class" value="'.$class.'" /></td><td>(class="'.$class.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for accept button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $accept_request_label = cpc_get_shortcode_default($values, 'cpc_friends_pending-accept_request_label', __('Accept', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends_pending-accept_request_label" value="'.$accept_request_label.'" /></td><td>(accept_request_label="'.$accept_request_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for reject button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $reject_request_label = cpc_get_shortcode_default($values, 'cpc_friends_pending-reject_request_label', __('Reject', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends_pending-reject_request_label" value="'.$reject_request_label.'" /></td><td>(reject_request_label="'.$reject_request_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Text for no friendship requests", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $none = cpc_get_shortcode_default($values, 'cpc_friends_pending-none', '');
                                        echo '<input type="text" name="cpc_friends_pending-none" value="'.$none.'" /></td><td>(none="'.$none.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_friends_pending', $values);                    

                                echo '</table>';
                            echo '</div>';       

                            // [cpc-friends-add-button]
                            $values = get_option('cpc_shortcode_options_'.'cpc_friends_add_button') ? get_option('cpc_shortcode_options_'.'cpc_friends_add_button') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_friends_add_button_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a button to make a request to another user as a friend.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-friends-add-button] to the ClassicPress Page being used as the profile page.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-friends-add-button');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Label for the button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_friends_add_button-label', __('Make friends', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends_add_button-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr><td>'.__("Cancel friendship label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $cancel_label = cpc_get_shortcode_default($values, 'cpc_friends_add_button-cancel_label', __('Cancel friendship', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends_add_button-cancel_label" value="'.$cancel_label.'" /></td><td>(cancel_label="'.$cancel_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Cancel friendship request label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $cancel_request_label = cpc_get_shortcode_default($values, 'cpc_friends_add_button-cancel_request_label', __('Cancel friendship request', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_friends_add_button-cancel_request_label" value="'.$cancel_request_label.'" /></td><td>(cancel_request_label="'.$cancel_request_label.'")</td></tr>';
                                    echo '<tr><td>'.__("Optional CSS class for button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $class = cpc_get_shortcode_default($values, 'cpc_friends_add_button-class', '');
                                        echo '<input type="text" name="cpc_friends_add_button-class" value="'.$class.'" /></td><td>(class="'.$class.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_friends_add_button', $values);                    

                                echo '</table>';
                            echo '</div>';       

                            // [cpc-friends-count]
                            $values = get_option('cpc_shortcode_options_'.'cpc_friends_count') ? get_option('cpc_shortcode_options_'.'cpc_friends_count') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_friends_count_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays the number of friends (accepted or pending) a user has.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-friends-count] to the ClassicPress Page being used as the profile page.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-friends-count');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('User', CPC2_TEXT_DOMAIN).'</td><td>';
                                    $user_id = cpc_get_shortcode_default($values, 'cpc_friends_count-user_id', '');
                                    echo '<select name="cpc_friends_count-user_id">';
                                        echo '<option value=""'.($user_id == '' ? ' SELECTED' : '').'>'.__('Reflects page context', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '<option value="user"'.($user_id == 'user' ? ' SELECTED' : '').'>'.__('Current user', CPC2_TEXT_DOMAIN).'</option>';
                                    echo '</select> '.__('or set to a user ID in shortcode', CPC2_TEXT_DOMAIN).'</td><td>(user_id="'.$user_id.'")</td></tr>';    
                                    echo '<tr><td>'.__('Status', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $layout = cpc_get_shortcode_default($values, 'cpc_friends_count-status', 'accepted');
                                        echo '<select name="cpc_friends_count-status">';
                                            echo '<option value="accepted"'.($layout == 'accepted' ? ' SELECTED' : '').'>'.__('Accepted', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="pending"'.($layout == 'pending' ? ' SELECTED' : '').'>'.__('Pending', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(status="'.$layout.'")</td></tr>';
                        
                                    echo '<tr><td>'.__("Link (optional)", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $url = cpc_get_shortcode_default($values, 'cpc_friends_count-url', '');
                                        echo '<input type="text" name="cpc_friends_count-url" value="'.$url.'" /></td><td>(url="'.$url.'")</td></tr>';                        

                                    do_action('cpc_show_styling_options_hook', 'cpc_friends_count', $values);                    

                                echo '</table>';
                            echo '</div>';                                   

                            // [cpc-alerts-friends]
                            $values = get_option('cpc_shortcode_options_'.'cpc_alerts_friends') ? get_option('cpc_shortcode_options_'.'cpc_alerts_friends') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_alerts_friends_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays an icon for pending friendship requests.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-alerts-friends] to a ClassicPress Page, Post of Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-alerts-friends');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Icon size", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_size = cpc_get_shortcode_default($values, 'cpc_alerts_friends-flag_size', 24);
                                        echo '<input type="text" name="cpc_alerts_friends-flag_size" value="'.$flag_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_size="'.$flag_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Size of the icon in pixels.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon pending number size", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_pending_size = cpc_get_shortcode_default($values, 'cpc_alerts_friends-flag_pending_size', 10);
                                        echo '<input type="text" name="cpc_alerts_friends-flag_pending_size" value="'.$flag_pending_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_pending_size="'.$flag_pending_size.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Size of the number of pending requests", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon pending number top margin", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_pending_top = cpc_get_shortcode_default($values, 'cpc_alerts_friends-flag_pending_top', 6);
                                        echo '<input type="text" name="cpc_alerts_friends-flag_pending_top" value="'.$flag_pending_top.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_pending_top="'.$flag_pending_top.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Allows you to move the number vertically.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon pending number left margin", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_pending_left = cpc_get_shortcode_default($values, 'cpc_alerts_friends-flag_pending_left', 8);
                                        echo '<input type="text" name="cpc_alerts_friends-flag_pending_left" value="'.$flag_pending_left.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_pending_left="'.$flag_pending_left.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Allows you to move the number horizontally.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon pending number radius", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_pending_radius = cpc_get_shortcode_default($values, 'cpc_alerts_friends-flag_pending_radius', 8);
                                        echo '<input type="text" name="cpc_alerts_friends-flag_pending_radius" value="'.$flag_pending_radius.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(flag_pending_radius="'.$flag_pending_radius.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Radius of the corners for the box behind the number, set to 0 for a square.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon URL", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_url = cpc_get_shortcode_default($values, 'cpc_alerts_friends-flag_url', '');
                                        echo '<input type="text" name="cpc_alerts_friends-flag_url" value="'.$flag_url.'" /></td><td>(flag_url="'.$flag_url.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Where the user is taken (URL) when the icon is clicked on, nearly always where the [cpc-friends] shortcode is placed.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                                    echo '<tr><td>'.__("Icon image alernative URL", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $flag_src = cpc_get_shortcode_default($values, 'cpc_alerts_friends-flag_src', '');
                                        echo '<input type="text" name="cpc_alerts_friends-flag_src" value="'.$flag_src.'" /></td><td>(flag_src="'.$flag_src.'")</td></tr>';    
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("URL of an image to use for the icon instead of the default image.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_alerts_friends', $values);                    

                                echo '</table>';
                            echo '</div>';  
                        
                            // [cpc-favourite-friend]
                            $values = get_option('cpc_shortcode_options_'.'cpc_favourite_friend') ? get_option('cpc_shortcode_options_'.'cpc_favourite_friend') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_favourite_friend_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays button/link to add/remove user as a favourite. Also options for the Friends page (which shows favourite profiles at the top).", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-favourite-friend] to the ClassicPress Page being used as the profile page.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-favourite-friend');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Style', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $style = cpc_get_shortcode_default($values, 'cpc_favourite_friend-style', 'button');
                                        echo '<select name="cpc_favourite_friend-style">';
                                            echo '<option value="button"'.($style == 'button' ? ' SELECTED' : '').'>'.__('Button', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="link"'.($style == 'link' ? ' SELECTED' : '').'>'.__('Link', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(style="'.$style.'")</td></tr>';
                        
                                    echo '<tr><td>'.__("Add label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $favourite_no = cpc_get_shortcode_default($values, 'cpc_favourite_friend-favourite_no', __('Add as Favourite', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_favourite_friend-favourite_no" value="'.$favourite_no.'" /></td><td>(favourite_no="'.$favourite_no.'")</td></tr>';
                                    echo '<tr><td>'.__("Remove label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $favourite_yes = cpc_get_shortcode_default($values, 'cpc_favourite_friend-favourite_yes', __('Remove as Favourite', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_favourite_friend-favourite_yes" value="'.$favourite_yes.'" /></td><td>(favourite_yes="'.$favourite_yes.'")</td></tr>';

                                    echo '<tr><td>'.__("Added message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $favourite_no_msg = cpc_get_shortcode_default($values, 'cpc_favourite_friend-favourite_no_msg', __('Added as a favourite.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_favourite_friend-favourite_no_msg" value="'.$favourite_no_msg.'" /></td><td>(favourite_no_msg="'.$favourite_no_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Removed message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $favourite_yes_msg = cpc_get_shortcode_default($values, 'cpc_favourite_friend-favourite_yes_msg', __('Removed as a favourite.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_favourite_friend-favourite_yes_msg" value="'.$favourite_yes_msg.'" /></td><td>(favourite_yes_msg="'.$favourite_yes_msg.'")</td></tr>';

                                    echo '<tr><td>'.__("Friends page rollover text", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $friends_tooltip = cpc_get_shortcode_default($values, 'cpc_favourite_friend-friends_tooltip', __('Add/remove as a favourite', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_favourite_friend-friends_tooltip" value="'.$friends_tooltip.'" /></td><td>(friends_tooltip="'.$friends_tooltip.'")</td></tr>';
                        
                                    do_action('cpc_show_styling_options_hook', 'cpc_favourite_friend', $values);

                                echo '</table>';
                            echo '</div>';                                   

                        

                            /* ----------------------- PROFILE TAB ----------------------- */    

                            // [cpc-usermeta]
                            $values = get_option('cpc_shortcode_options_'.'cpc_usermeta') ? get_option('cpc_shortcode_options_'.'cpc_usermeta') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_usermeta_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a profile value (meta) of a user, including standard ClassicPress meta values such as display_name.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-usermeta] to a ClassicPress Page, Post of Text widget. Can be added more than once.', CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('Tip:', CPC2_TEXT_DOMAIN).'</strong> '.__('Choose options below (and save) to see how you can add [cpc-usermeta meta="<em>value</em>"] to build up your profile page.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-usermeta');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_usermeta-label', '');
                                        echo '<input type="text" name="cpc_usermeta-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr><td>'.__('Meta value', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $meta = cpc_get_shortcode_default($values, 'cpc_usermeta-meta', 'cpccom_home');
                                        echo '<select name="cpc_usermeta-meta">';
                                            echo '<option value="description"'.($meta == 'description' ? ' SELECTED' : '').'>'.__('Description', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="cpccom_last_active"'.($meta == 'cpccom_last_active' ? ' SELECTED' : '').'>'.__('Last active', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="display_name"'.($meta == 'display_name' ? ' SELECTED' : '').'>'.__('Display name', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="first_name"'.($meta == 'first_name' ? ' SELECTED' : '').'>'.__('First name', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="last_name"'.($meta == 'last_name' ? ' SELECTED' : '').'>'.__('Last name', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="user_login"'.($meta == 'user_login' ? ' SELECTED' : '').'>'.__('Username', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="user_email"'.($meta == 'user_email' ? ' SELECTED' : '').'>'.__('User email', CPC2_TEXT_DOMAIN).'</option>';    
                                            echo '<option value="user_nicename"'.($meta == 'user_nicename' ? ' SELECTED' : '').'>'.__('User nice name', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="user_registered"'.($meta == 'user_registered' ? ' SELECTED' : '').'>'.__('User registration date', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="user_url"'.($meta == 'user_url' ? ' SELECTED' : '').'>'.__('User URL', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="user_status"'.($meta == 'user_status' ? ' SELECTED' : '').'>'.__('User status', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="cpccom_home"'.($meta == 'cpccom_home' ? ' SELECTED' : '').'>'.__('Stadt/Gemeinde', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="cpccom_country"'.($meta == 'cpccom_country' ? ' SELECTED' : '').'>'.__('Country', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="cpccom_map"'.($meta == 'cpccom_map' ? ' SELECTED' : '').'>'.__('Map', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(meta="'.$meta.'")</td></tr>';

                                    echo '<tr><td colspan=3 class="cpc_section">'.__('If Map selected above...', CPC2_TEXT_DOMAIN).'</td></tr>';            
                                    echo '<tr><td>'.__("Size", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $size = cpc_get_shortcode_default($values, 'cpc_usermeta-label', '250,250');
                                        echo '<input type="text" name="cpc_usermeta-size" value="'.$size.'" /> ',__('pixels', CPC2_TEXT_DOMAIN).'</td><td>(size="'.$size.'")</td></tr>';
                                    echo '<tr><td>'.__('Map style', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $map_style = cpc_get_shortcode_default($values, 'cpc_usermeta-map_style', 'dynamic');
                                        echo '<select name="cpc_usermeta-map_style">';
                                            echo '<option value="dynamic"'.($layout == 'dynamic' ? ' SELECTED' : '').'>'.__('Dynamic', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="static"'.($layout == 'static' ? ' SELECTED' : '').'>'.__('Static', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(map_style="'.$map_style.'")</td></tr>';
                                    echo '<tr><td>'.__('Zoom level', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $zoom = cpc_get_shortcode_default($values, 'cpc_usermeta-zoom', 5);
                                        echo '<select name="cpc_usermeta-zoom">';
                                            echo '<option value="1"'.($zoom == '1' ? ' SELECTED' : '').'>1</option>';
                                            echo '<option value="2"'.($zoom == '2' ? ' SELECTED' : '').'>2</option>';
                                            echo '<option value="3"'.($zoom == '3' ? ' SELECTED' : '').'>3</option>';
                                            echo '<option value="4"'.($zoom == '4' ? ' SELECTED' : '').'>4</option>';
                                            echo '<option value="5"'.($zoom == '5' ? ' SELECTED' : '').'>5</option>';
                                            echo '<option value="6"'.($zoom == '6' ? ' SELECTED' : '').'>6</option>';
                                            echo '<option value="7"'.($zoom == '7' ? ' SELECTED' : '').'>7</option>';
                                            echo '<option value="8"'.($zoom == '8' ? ' SELECTED' : '').'>8</option>';
                                            echo '<option value="9"'.($zoom == '9' ? ' SELECTED' : '').'>9</option>';
                                            echo '<option value="10"'.($zoom == '10' ? ' SELECTED' : '').'>10</option>';
                                            echo '<option value="11"'.($zoom == '11' ? ' SELECTED' : '').'>11</option>';
                                            echo '<option value="12"'.($zoom == '12' ? ' SELECTED' : '').'>12</option>';
                                            echo '<option value="13"'.($zoom == '13' ? ' SELECTED' : '').'>13</option>';
                                            echo '<option value="14"'.($zoom == '14' ? ' SELECTED' : '').'>14</option>';
                                            echo '<option value="15"'.($zoom == '15' ? ' SELECTED' : '').'>15</option>';
                                        echo '</select></td><td>(zoom="'.$zoom.'")</td></tr>';

                                    echo '<tr><td colspan=3 class="cpc_section">'.__('If User email selected above...', CPC2_TEXT_DOMAIN).'</td></tr>';                
                                    echo '<tr><td>'.__('Email as hyperlink', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $link = cpc_get_shortcode_default($values, 'cpc_usermeta-link', true);
                                        echo '<input type="checkbox" name="cpc_usermeta-link"'.($link ? ' CHECKED' : '').'></td><td>(link="'.($link ? '1' : '0').'")</td></tr>';

                                    // any more options for this shortcode
                                    do_action('cpc_shortcode_options_hook', 'cpc_usermeta', $values);                    

                                    do_action('cpc_show_styling_options_hook', 'cpc_usermeta', $values);                    

                                echo '</table>';
                            echo '</div>';   

                            // [cpc-usermeta-button]
                            $values = get_option('cpc_shortcode_options_'.'cpc_usermeta_button') ? get_option('cpc_shortcode_options_'.'cpc_usermeta_button') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_usermeta_button_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a button to link to a URL, passing the user's ID as a parameter.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-usermeta-button] to a ClassicPress Page.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-usermeta-button');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("URL for button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $url = cpc_get_shortcode_default($values, 'cpc_usermeta_button-url', '');
                                        echo '<input type="text" name="cpc_usermeta_button-url" value="'.$url.'" /></td><td>(url="'.$url.'")</td></tr>';
                                    echo '<tr><td>'.__("Label for button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $value = cpc_get_shortcode_default($values, 'cpc_usermeta_button-value', __('Go', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_button-value" value="'.$value.'" /></td><td>(value="'.$value.'")</td></tr>';
                                    echo '<tr><td>'.__("Optional CSS class for button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $class = cpc_get_shortcode_default($values, 'cpc_usermeta_button-class', '');
                                        echo '<input type="text" name="cpc_usermeta_button-class" value="'.$class.'" /></td><td>(class="'.$class.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_usermeta_button', $values);                    

                                echo '</table>';
                            echo '</div>';         

                            // [cpc-usermeta-change]
                            $values = get_option('cpc_shortcode_options_'.'cpc_usermeta_change') ? get_option('cpc_shortcode_options_'.'cpc_usermeta_change') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_usermeta_change_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays profile fields for the user, which they can edit. This is their Edit Profile page.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-usermeta-change] to a ClassicPress Page.', CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('Tip:', CPC2_TEXT_DOMAIN).'</strong> '.__('Use "Edit Profile" setup below to add Tabs to your edit profile page.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-usermeta-change');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__("Label for update button", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_usermeta_change-label', __('Update', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr><td>'.__('Show Stadt/Gemeinde', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_town = cpc_get_shortcode_default($values, 'cpc_usermeta_change-show_town', true);
                                        echo '<input type="checkbox" name="cpc_usermeta_change-show_town"'.($show_town ? ' CHECKED' : '').'></td><td>(show_town="'.($show_town ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Stadt/Gemeinde label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $town = cpc_get_shortcode_default($values, 'cpc_usermeta_change-town', __('Stadt/Gemeinde', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-town" value="'.$town.'" /></td><td>(town="'.$town.'")</td></tr>';
                                    echo '<tr><td>'.__("Stadt/Gemeinde default value", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $town_default = cpc_get_shortcode_default($values, 'cpc_usermeta_change-town_default', '');
                                        echo '<input type="text" name="cpc_usermeta_change-town_default" value="'.$town_default.'" /></td><td>(town="'.$town.'")</td></tr>';
                                    echo '<tr><td>'.__('Stadt/Gemeinde mandatory', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $town_mandatory = cpc_get_shortcode_default($values, 'cpc_usermeta_change-town_mandatory', false);
                                        echo '<input type="checkbox" name="cpc_usermeta_change-town_mandatory"'.($town_mandatory ? ' CHECKED' : '').'></td><td>(town_mandatory="'.($town_mandatory ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__('Show Country', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_country = cpc_get_shortcode_default($values, 'cpc_usermeta_change-show_country', true);
                                        echo '<input type="checkbox" name="cpc_usermeta_change-show_country"'.($show_country ? ' CHECKED' : '').'></td><td>(show_country="'.($show_country ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Country label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $country = cpc_get_shortcode_default($values, 'cpc_usermeta_change-country', __('Country', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-country" value="'.$country.'" /></td><td>(country="'.$country.'")</td></tr>';
                                    echo '<tr><td>'.__("Country default value", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $country_default = cpc_get_shortcode_default($values, 'cpc_usermeta_change-country_default', '');
                                        echo '<input type="text" name="cpc_usermeta_change-country_default" value="'.$country_default.'" /></td><td>(town="'.$town.'")</td></tr>';
                                    echo '<tr><td>'.__('Country mandatory', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $country_mandatory = cpc_get_shortcode_default($values, 'cpc_usermeta_change-country_mandatory', false);
                                        echo '<input type="checkbox" name="cpc_usermeta_change-country_mandatory"'.($country_mandatory ? ' CHECKED' : '').'></td><td>(country_mandatory="'.($country_mandatory ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("Display name label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $displayname = cpc_get_shortcode_default($values, 'cpc_usermeta_change-displayname', __('Display Name', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-displayname" value="'.$displayname.'" /></td><td>(displayname="'.$displayname.'")</td></tr>';
                                    echo '<tr><td>'.__('Show First/family names', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $show_name = cpc_get_shortcode_default($values, 'cpc_usermeta_change-show_name', true);
                                        echo '<input type="checkbox" name="cpc_usermeta_change-show_name"'.($show_name ? ' CHECKED' : '').'></td><td>(show_name="'.($show_name ? '1' : '0').'")</td></tr>';
                                    echo '<tr><td>'.__("First/family name label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $name = cpc_get_shortcode_default($values, 'cpc_usermeta_change-name', __('Your first name and family name', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-name" value="'.$name.'" /></td><td>(name="'.$name.'")</td></tr>';
                                    echo '<tr><td>'.__("Password label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $password = cpc_get_shortcode_default($values, 'cpc_usermeta_change-password', __('Change your password', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-password" value="'.$password.'" /></td><td>(password="'.$password.'")</td></tr>';
                                    echo '<tr><td>'.__("Re-type your password label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $password2 = cpc_get_shortcode_default($values, 'cpc_usermeta_change-password2', __('Re-type your password', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-password2" value="'.$password2.'" /></td><td>(password2="'.$password2.'")</td></tr>';
                                    echo '<tr><td>'.__("Password change, log in again message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $password_msg = cpc_get_shortcode_default($values, 'cpc_usermeta_change-password_msg', __('Password changed, please log in again.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-password_msg" value="'.$password_msg.'" /></td><td>(password_msg="'.$password_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Email label", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $email = cpc_get_shortcode_default($values, 'cpc_usermeta_change-email', __('Email address', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-email" value="'.$email.'" /></td><td>(email="'.$email.'")</td></tr>';
                                    echo '<tr><td>'.__("Logged out message", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $logged_out_msg = cpc_get_shortcode_default($values, 'cpc_usermeta_change-logged_out_msg', __('You must be logged in to view this page.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-logged_out_msg" value="'.$logged_out_msg.'" /></td><td>(logged_out_msg="'.$logged_out_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Mandatory suffix", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $mandatory = cpc_get_shortcode_default($values, 'cpc_usermeta_change-mandatory', '&lt;span style=\'color:red;\'&gt; *&lt;/span&gt;');
                                        echo '<input type="text" name="cpc_usermeta_change-mandatory" value="'.$mandatory.'" /></td><td>(mandatory="'.$mandatory.'")</td></tr>';
                                    echo '<tr><td>'.__("Required fields alert", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $required_msg = cpc_get_shortcode_default($values, 'cpc_usermeta_change-required_msg', __('Please check for required fields', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-required_msg" value="'.$required_msg.'" /></td><td>(required_msg="'.$required_msg.'")</td></tr>';
                                    echo '<tr><td>'.__("Activity notifications prompt", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $activity_subs_subscribe = cpc_get_shortcode_default($values, 'cpc_usermeta_change-activity_subs_subscribe', __('Receive email notifications for activity', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change-activity_subs_subscribe" value="'.$activity_subs_subscribe.'" /></td><td>(activity_subs_subscribe="'.$activity_subs_subscribe.'")</td></tr>';
                                    echo '<tr><td>'.__("Optional URL to login", CPC2_TEXT_DOMAIN).'</td><td>';
                                        $login_url = cpc_get_shortcode_default($values, 'cpc_usermeta_change-login_url', '');
                                        echo '<input type="text" name="cpc_usermeta_change-login_url" value="'.$login_url.'" /></td><td>(login_url="'.$login_url.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_usermeta_change', $values);                    

                                echo '</table>';
                            echo '</div>';       

                            // [cpc-usermeta-change-link]    
                            $values = get_option('cpc_shortcode_options_'.'cpc_usermeta_change_link') ? get_option('cpc_shortcode_options_'.'cpc_usermeta_change_link') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_usermeta_change_link_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a link to the Edit Profile page.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-usermeta-change-link] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-usermeta-change-link');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Text for the link', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $text = cpc_get_shortcode_default($values, 'cpc_usermeta_change_link-text', __('Edit Profile', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_usermeta_change_link-text" value="'.$text.'" /></td><td>(text="'.$text.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_usermeta_change_link', $values);                    

                                echo '</table>';
                            echo '</div>'; 

                            // [cpc-close-account]
                            $values = get_option('cpc_shortcode_options_'.'cpc_close_account') ? get_option('cpc_shortcode_options_'.'cpc_close_account') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_close_account_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays button for users to close their account.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-close-account] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-close-account');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Optional CSS class for button', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $class = cpc_get_shortcode_default($values, 'cpc_close_account-class', '');
                                        echo '<input type="text" name="cpc_close_account-class" value="'.$class.'" /></td><td>(class="'.$class.'")</td></tr>';
                                    echo '<tr><td>'.__('Label for button', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_close_account-label', __('Close account', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_close_account-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr><td>'.__('Are you sure text', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $are_you_sure_text = cpc_get_shortcode_default($values, 'cpc_close_account-are_you_sure_text', __('Are you sure? You cannot re-open a closed account.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_close_account-are_you_sure_text" value="'.$are_you_sure_text.'" /></td><td>(are_you_sure_text="'.$are_you_sure_text.'")</td></tr>';
                                    echo '<tr><td>'.__('Account has been closed text', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $logout_text = cpc_get_shortcode_default($values, 'cpc_close_account-logout_text', __('Your account has been closed.', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_close_account-logout_text" value="'.$logout_text.'" /></td><td>(logout_text="'.$logout_text.'")</td></tr>';
                                    echo '<tr><td>'.__('URL after account is closed', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $url = cpc_get_shortcode_default($values, 'cpc_close_account-url', '/');
                                        echo '<input type="text" name="cpc_close_account-url" value="'.$url.'" /></td><td>(url="'.$url.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_close_account', $values);                    

                                echo '</table>';
                            echo '</div>';             

                            // [cpc-join-site] 
                            $values = get_option('cpc_shortcode_options_'.'cpc_join_site') ? get_option('cpc_shortcode_options_'.'cpc_join_site') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_join_site_tab');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Displays a link or button to join a site (multisite only).", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-join-site] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-join-site');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('Optional CSS class for button', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $class = cpc_get_shortcode_default($values, 'cpc_join_site-class', '');
                                        echo '<input type="text" name="cpc_join_site-class" value="'.$class.'" /></td><td>(class="'.$class.'")</td></tr>';
                                    echo '<tr><td>'.__('Label for link/button', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $label = cpc_get_shortcode_default($values, 'cpc_join_site-label', __('Join this site', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_join_site-label" value="'.$label.'" /></td><td>(label="'.$label.'")</td></tr>';
                                    echo '<tr><td>'.__('Style', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $style = cpc_get_shortcode_default($values, 'cpc_join_site-style', 'button');
                                        echo '<select name="cpc_join_site-style">';
                                            echo '<option value="button"'.($style == 'button' ? ' SELECTED' : '').'>'.__('Button', CPC2_TEXT_DOMAIN).'</option>';
                                            echo '<option value="text"'.($style == 'text' ? ' SELECTED' : '').'>'.__('Text', CPC2_TEXT_DOMAIN).'</option>';
                                        echo '</select></td><td>(style="'.$style.'")</td></tr>';

                                    do_action('cpc_show_styling_options_hook', 'cpc_join_site', $values);                    

                                echo '</table>';
                            echo '</div>';    

                            // [cpc-no-user-check]
                            $values = get_option('cpc_shortcode_options_'.'cpc_no_user_check') ? get_option('cpc_shortcode_options_'.'cpc_no_user_check') : array();   
                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_no_user_check');
                                echo '<strong>'.__('Purpose:', CPC2_TEXT_DOMAIN).'</strong> '.__("Checks for a valid user and displays an option message.", CPC2_TEXT_DOMAIN).'<br />';
                                echo '<strong>'.__('How to use:', CPC2_TEXT_DOMAIN).'</strong> '.__('Add [cpc-no-user-check] to a ClassicPress Page, Post or Text widget.', CPC2_TEXT_DOMAIN);
                                echo cpc_codex_link('https://cp-community.n3rds.work/cpc-no-user-check');
                                echo '<p><strong>'.__('Options', CPC2_TEXT_DOMAIN).'</strong><br />';
                                echo '<table cellpadding="0" cellspacing="0"  class="cpc_shortcode_value_row">';
                                    echo '<tr><td>'.__('User not found message', CPC2_TEXT_DOMAIN).'</td><td>';
                                        $not_found_msg = cpc_get_shortcode_default($values, 'cpc_no_user_check-not_found_msg', __('User does not exist!', CPC2_TEXT_DOMAIN));
                                        echo '<input type="text" name="cpc_no_user_check-not_found_msg" value="'.$not_found_msg.'" /></td><td>(not_found_msg="'.$not_found_msg.'")</td></tr>';
                                    echo '<tr class="cpc_desc"><td colspan="3">';
                                        echo __("Message to show if the user is not found.", CPC2_TEXT_DOMAIN);
                                        echo '</td></tr>';
                        
                                    do_action('cpc_show_styling_options_hook', 'cpc_no_user_check', $values);                    

                                echo '</table>';
                            echo '</div>'; 


                            /* OTHERS */

                            do_action('cpc_options_shortcode_options_hook', $cpc_expand_shortcode);        


                        echo '</div>';

                        
                    }
            
                echo '</div>';

            echo '</div>';

        echo '</div>';

}


function cpc_show_tab($cpc_expand_tab, $tab, $option, $text) {
    return '<div class="'.($cpc_expand_tab == $option ? 'cpc_admin_getting_started_active' : '').' cpc_admin_getting_started_option" id="'.$option.'" data-shortcode="'.$option.'">'.$text.'</div>';
}

function cpc_show_shortcode($cpc_expand_tab, $cpc_expand_shortcode, $tab, $function, $shortcode) {
    return '<div rel="'.$function.'" class="'.($cpc_expand_shortcode == $function ? 'cpc_admin_getting_started_active' : '').' cpc_'.$tab.' cpc_admin_getting_started_option_shortcode" data-tab="'.$function.'" style="display:'.($cpc_expand_tab == $tab ? 'block' : 'none').'">['.$shortcode.']</div>';
}

function cpc_show_options($cpc_expand_shortcode, $function) {
    return '<div id="'.$function.'" class="cpc_admin_getting_started_option_value" style="display:'.($cpc_expand_shortcode == $function ? 'block' : 'none').'">';
}

function cpc_get_shortcode_default($values, $name, $default) {

    // Remove function if passed in format function-option
    if (strpos($name, '-')):
        $arr = explode('-',$name);
        $name = $arr[1];
    endif;

    // Now calculate value stored
    if ($default === false || $default === true) {
        $v = isset($values[$name]) && ($values[$name] == 'on' || $values[$name] == 'off' ) ? $values[$name] : false;
        if ($v) {
            $v = $v == 'on' ? true : false; 
        } else {
            $v = $default;
        }
    } else {
        $v = isset($values[$name]) && ($values[$name]) ? $values[$name] : $default;
    }
    return $v;
}

function cpc_save_option($values, $the_post, $name, $checkbox=false) {
    if (!$checkbox) {
        $v = isset($the_post[$name]) ? $the_post[$name] : false;
    } else {
        $v = isset($the_post[$name]) ? 'on' : 'off';        
    }
    $values[$name] = $v ? htmlentities (htmlspecialcharacters_decode(stripslashes($v), ENT_QUOTES)) : '';
    return $values;
}

// Show styling options in setup
if (is_admin()) add_action('cpc_show_styling_options_hook', 'cpc_show_styling_options', 10, 2);		
function cpc_show_styling_options($function, $values) {

    echo '<tr><td colspan=3 class="cpc_section">'.__('Style (not available via shortcode options)...', CPC2_TEXT_DOMAIN);    
    
    if (isset($_GET['global_styles'])):
        if ($_GET['global_styles'] == 'on'):
            update_option('cpccom_global_styles', 'on');
        else:
            delete_option('cpccom_global_styles');
        endif;
    endif;

    $global_styles = ($var = get_option('cpccom_global_styles')) ? $var : 'off';
    if ($global_styles == 'on'):
        echo '<br />'.__('Add styles="0" to a shortcode to avoid using the following styles.', CPC2_TEXT_DOMAIN);
        echo '<br /><a href="'.admin_url( 'admin.php?page=cpc_com_shortcodes' ).'&global_styles=off">'.__('Switch styles off globally (this affects the entire output of the shortcode)', CPC2_TEXT_DOMAIN).'</a> ('.__('performance increase and easier to manually apply CSS', CPC2_TEXT_DOMAIN).')</td></tr>';    
    else:
        echo '<br /><a href="'.admin_url( 'admin.php?page=cpc_com_shortcodes' ).'&global_styles=on">'.__('Switch styles on globally</a> (this affects the entire output of the shortcodes, not the same as <a href="'.admin_url( 'admin.php?page=cpc_com_styles' ).'">Styles</a> which lets you style parts of the shortcode)', CPC2_TEXT_DOMAIN).'.</td></tr>';    
    endif;

    if ($global_styles != 'off'):

        echo '<tr><td>'.__('Top margin', CPC2_TEXT_DOMAIN).'</td><td>';
            $margin_top = cpc_get_shortcode_default($values, $function.'-margin_top', 0);
            echo '<input type="text" name="'.$function.'-margin_top" value="'.$margin_top.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__('Right margin', CPC2_TEXT_DOMAIN).'</td><td>';
            $margin_right = cpc_get_shortcode_default($values, $function.'-margin_right', 0);
            echo '<input type="text" name="'.$function.'-margin_right" value="'.$margin_right.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__('Bottom margin', CPC2_TEXT_DOMAIN).'</td><td>';
            $margin_bottom = cpc_get_shortcode_default($values, $function.'-margin_bottom', 0);
            echo '<input type="text" name="'.$function.'-margin_bottom" value="'.$margin_bottom.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__('Left margin', CPC2_TEXT_DOMAIN).'</td><td>';
            $margin_left = cpc_get_shortcode_default($values, $function.'-margin_left', 0);
            echo '<input type="text" name="'.$function.'-margin_left" value="'.$margin_left.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__('Top padding', CPC2_TEXT_DOMAIN).'</td><td>';
            $padding_top = cpc_get_shortcode_default($values, $function.'-padding_top', 0);
            echo '<input type="text" name="'.$function.'-padding_top" value="'.$padding_top.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__('Right padding', CPC2_TEXT_DOMAIN).'</td><td>';
            $padding_right = cpc_get_shortcode_default($values, $function.'-padding_right', 0);
            echo '<input type="text" name="'.$function.'-padding_right" value="'.$padding_right.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__('Bottom padding', CPC2_TEXT_DOMAIN).'</td><td>';
            $padding_bottom = cpc_get_shortcode_default($values, $function.'-padding_bottom', 0);
            echo '<input type="text" name="'.$function.'-padding_bottom" value="'.$padding_bottom.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__('Left padding', CPC2_TEXT_DOMAIN).'</td><td>';
            $padding_left = cpc_get_shortcode_default($values, $function.'-padding_left', 0);
            echo '<input type="text" name="'.$function.'-padding_left" value="'.$padding_left.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__("Clear previous float", CPC2_TEXT_DOMAIN).'</td><td>';
            $clear = cpc_get_shortcode_default($values, $function.'-clear', true);
            echo '<input type="checkbox" name="'.$function.'-clear"'.($clear ? ' CHECKED' : '').'> <em>clear: '.($clear ? 'both' : 'none').'</em></td><td></td></tr>';
        echo '<tr><td>'.__('Background color', CPC2_TEXT_DOMAIN).'</td><td>';
            $background_color = cpc_get_shortcode_default($values, $function.'-background_color', 'transparent');
            echo '<input type="text" name="'.$function.'-background_color" class="cpc-color-picker" data-default-color="transparent" value="'.$background_color.'" /></td><td></td></tr>';
        echo '<tr><td>'.__('Border size', CPC2_TEXT_DOMAIN).'</td><td>';
            $border_size = cpc_get_shortcode_default($values, $function.'-border_size', 0);
            echo '<input type="text" name="'.$function.'-border_size" value="'.$border_size.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__('Border color', CPC2_TEXT_DOMAIN).'</td><td>';
            $border_color = cpc_get_shortcode_default($values, $function.'-border_color', '#000');
            echo '<input type="text" name="'.$function.'-border_color" class="cpc-color-picker" data-default-color="#000" value="'.$border_color.'" /></td><td></td></tr>';
        echo '<tr><td>'.__('Border radius', CPC2_TEXT_DOMAIN).'</td><td>';
            $border_radius = cpc_get_shortcode_default($values, $function.'-border_radius', 0);
            echo '<input type="text" name="'.$function.'-border_radius" value="'.$border_radius.'" /> '.__('pixels', CPC2_TEXT_DOMAIN).'</td><td></td></tr>';
        echo '<tr><td>'.__('Border style', CPC2_TEXT_DOMAIN).'</td><td>';
            $border_style = cpc_get_shortcode_default($values, $function.'-border_style', 'solid');
            echo '<select name="'.$function.'-border_style">';
                echo '<option value="solid"'.($border_style == 'solid' ? ' SELECTED' : '').'>'.__('Solid', CPC2_TEXT_DOMAIN).'</option>';
                echo '<option value="dotted"'.($border_style == 'dotted' ? ' SELECTED' : '').'>'.__('Dotted', CPC2_TEXT_DOMAIN).'</option>';
                echo '<option value="dashed"'.($border_style == 'dashed' ? ' SELECTED' : '').'>'.__('Dashed', CPC2_TEXT_DOMAIN).'</option>';
            echo '</select></td><td></td></tr>';
        echo '<tr><td>'.__('Width', CPC2_TEXT_DOMAIN).'</td><td>';
            $style_width = cpc_get_shortcode_default($values, $function.'-style_width', '100%');
            echo '<input type="text" name="'.$function.'-style_width" value="'.$style_width.'" /> ('.__('include px or %', CPC2_TEXT_DOMAIN).')</td><td></td></tr>';
        echo '<tr><td>'.__('Height', CPC2_TEXT_DOMAIN).'</td><td>';
            $style_height = cpc_get_shortcode_default($values, $function.'-style_height', '');
            echo '<input type="text" name="'.$function.'-style_height" value="'.$style_height.'" /> ('.__('include px', CPC2_TEXT_DOMAIN).')</td><td></td></tr>';
    
    endif;
}
if (is_admin()) add_filter( 'cpc_show_styling_options_save_filter', 'cpc_show_styling_options_save', 10, 3 );
function cpc_show_styling_options_save($function, $the_post, $values) {
    
    $values = cpc_save_option($values, $the_post, $function.'-margin_top');      
    $values = cpc_save_option($values, $the_post, $function.'-margin_bottom');
    $values = cpc_save_option($values, $the_post, $function.'-margin_left');
    $values = cpc_save_option($values, $the_post, $function.'-margin_right');
    $values = cpc_save_option($values, $the_post, $function.'-padding_top');      
    $values = cpc_save_option($values, $the_post, $function.'-padding_bottom');
    $values = cpc_save_option($values, $the_post, $function.'-padding_left');
    $values = cpc_save_option($values, $the_post, $function.'-padding_right');
    $values = cpc_save_option($values, $the_post, $function.'-clear', true);
    $values = cpc_save_option($values, $the_post, $function.'-border_size');
    $values = cpc_save_option($values, $the_post, $function.'-border_color');
    $values = cpc_save_option($values, $the_post, $function.'-border_radius');
    $values = cpc_save_option($values, $the_post, $function.'-border_style');
    $values = cpc_save_option($values, $the_post, $function.'-background_color');
    $values = cpc_save_option($values, $the_post, $function.'-style_width');
    $values = cpc_save_option($values, $the_post, $function.'-style_height');

    return $values;
    
}

// System Options header
add_action('cpc_admin_getting_started_hook', 'cpc_admin_getting_started_core_header', 0.5);
function cpc_admin_getting_started_core_header() {
    echo '<h2>'.sprintf(__('Optionen (nicht über <a href="%s">Shortcode</a> festgelegt)', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpc_com_shortcodes' )).'</h2>';
}

// Add to Getting Started information
add_action('cpc_admin_getting_started_hook', 'cpc_admin_getting_started_core', 1);
function cpc_admin_getting_started_core() {

    echo '<a name="core"></a>';
    $css = isset($_POST['cpc_expand']) && $_POST['cpc_expand'] == 'cpc_admin_getting_started_core' ? 'cpc_admin_getting_started_menu_item_remove_icon ' : '';    
  	echo '<div class="'.$css.'cpc_admin_getting_started_menu_item" id="cpc_admin_getting_started_core_div" rel="cpc_admin_getting_started_core">'.__('System-Optionen', CPC2_TEXT_DOMAIN).'</div>';

	$display = (isset($_POST['cpc_expand']) && $_POST['cpc_expand'] == 'cpc_admin_getting_started_core') || (isset($_GET['cpc_expand']) && $_GET['cpc_expand'] == 'cpc_admin_getting_started_core') ? 'block' : 'none';
  	echo '<div class="cpc_admin_getting_started_content" id="cpc_admin_getting_started_core" style="display:'.$display.'">';

	?>
	<table class="form-table">

    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_core_options_tips"><?php _e('Admin-Tipps', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<input type="checkbox" style="width:10px" name="cpc_core_options_tips" />
            <span class="description"><?php echo __('Schalte alle Admin-Tipps ein.', CPC2_TEXT_DOMAIN); ?></span>
            <?php if (isset($_POST['cpc_core_options_tips'])):
                echo '<div style="margin-top:15px" class="cpc_success">'.__('Admin-Tipps werden aktiviert', CPC2_TEXT_DOMAIN).'</div>';
            endif; ?>
		</td>
	</tr> 
        
    <tr class="form-field">
        <th scope="row" valign="top"><label for="icon_colors"><?php echo __('Symbolfarben', CPC2_TEXT_DOMAIN); ?></label></th>
        <td>
            <select name="icon_colors">
             <?php 
                $icon_colors = get_option('cpccom_icon_colors');
                echo '<option value="dark"';
                    if ($icon_colors != "_light") echo ' SELECTED';
                    echo'>'.__('Dunkel', CPC2_TEXT_DOMAIN).'</option>';
                echo '<option value="light"';
                    if ($icon_colors == "_light") echo ' SELECTED';
                    echo '>'.__('Hell', CPC2_TEXT_DOMAIN).'</option>';
             ?>						
            </select>
            <span class="description"><?php echo __('Zu verwendendes Symbolfarbschema.', CPC2_TEXT_DOMAIN); ?></span>
        </td> 
    </tr> 

    <tr class="form-field">
        <th scope="row" valign="top"><label for="flag_colors"><?php echo __('Flaggenfarben', CPC2_TEXT_DOMAIN); ?></label></th>
        <td>
            <select name="flag_colors">
             <?php 
                $flag_colors = get_option('cpccom_flag_colors');
                echo '<option value="dark"';
                    if ($flag_colors != "_light") echo ' SELECTED';
                    echo'>'.__('Dunkel', CPC2_TEXT_DOMAIN).'</option>';
                echo '<option value="light"';
                    if ($flag_colors == "_light") echo ' SELECTED';
                    echo '>'.__('Hell', CPC2_TEXT_DOMAIN).'</option>';
             ?>						
            </select>
            <span class="description"><?php echo __('Zu verwendendes Farbschema des Flaggensymbols.', CPC2_TEXT_DOMAIN); ?></span>
        </td> 
    </tr> 
        
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cpc_external_links"><?php echo __('Externe Links', CPC2_TEXT_DOMAIN); ?></label></th>
        <td>
            <input name="cpc_external_links" style="width: 100px" value="<?php echo get_option('cpc_external_links'); ?>" />
            <br /><span class="description"><?php echo __('Um externe Links in einem neuen Browser-Tab zu erzwingen, gib ein Suffix ein, das an relevante Links angehängt wird, z.B. &quot;&amp;raquo;&quot; für &raquo;. Gib &quot;&amp;newtab;&quot; zum erzwingen ein, aber danach nichts mehr anzuzeigen.', CPC2_TEXT_DOMAIN); ?></span>
        </td> 
    </tr> 

    <tr class="form-field">
        <th scope="row" valign="top"><label for="cpc_api"><?php echo __('API-Sicherheitscode', CPC2_TEXT_DOMAIN); ?></label></th>
        <td>
            <input name="cpc_api" style="width: 100px" value="<?php echo get_option('cpc_api'); ?>" />
            <span class="description"><?php echo __('Code, der bei Verwendung von API-Funktionen übergeben werden soll.', CPC2_TEXT_DOMAIN); ?></span>
        </td> 
    </tr> 

    <tr class="form-field">
        <th scope="row" valign="top"><label for="cpc_api_functions"><?php echo __('API-zulässige Funktionen', CPC2_TEXT_DOMAIN); ?></label></th>
        <td>
            <input name="cpc_api_functions" style="width: 100px" value="<?php echo get_option('cpc_api_functions'); ?>" />
            <span class="description"><?php echo __('Durch Kommas getrennte Liste der zulässigen API-Funktionen.', CPC2_TEXT_DOMAIN); ?></span>
        </td> 
    </tr> 

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_filter_feed_comments"><?php _e('Feeds', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<input type="checkbox" style="width:10px" name="cpc_filter_feed_comments" <?php if (get_option('cpc_filter_feed_comments')) echo 'CHECKED '; ?>/><span class="description"><?php _e('Füge Kommentare in Feeds ein, z.B. den RSS-Feed (Kommentare vor dem 16.02.03 werden standardmäßig einbezogen).', CPC2_TEXT_DOMAIN); ?><br /><br /> 
            <input type="checkbox" style="width:10px" name="cpc_filter_feed_comments_update" /><?php _e('Aktiviere diese Option, um alte Beiträge zu aktualisieren, damit sie aus Feeds ausgeschlossen werden können. Gilt für Kommentare, die vor dem 16.02.03 abgegeben wurden (muss nur einmal ausgeführt werden, kann einige Zeit dauern)', CPC2_TEXT_DOMAIN); ?></span>
        </td>
	</tr> 
        
	<?php
		do_action( 'cpc_admin_getting_started_core_hook' );
	?>
	
	</table>
	<?php

	echo '</div>';

}

add_action('cpc_admin_setup_form_get_hook', 'cpc_admin_getting_started_core_save', 20, 2);
add_action('cpc_admin_setup_form_save_hook', 'cpc_admin_getting_started_core_save', 20, 2);
function cpc_admin_getting_started_core_save($the_post) {
    
	$current_core = get_option('cpc_default_core');	
    if (strpos($current_core, 'XRELOADX')):
        // extensions changed, will need to do a reload
        $current_core = str_replace('XRELOADX', '', $current_core);
        update_option('cpc_default_core', $current_core);
        // ... carry on
    endif;
	$cpc_default_core = '';
	if (isset($the_post['core-profile'])) 	   $cpc_default_core .= 'core-profile,';
	if (isset($the_post['core-activity'])) 	   $cpc_default_core .= 'core-activity,';
	if (isset($the_post['core-avatar']))       $cpc_default_core .= 'core-avatar,';
	if (isset($the_post['core-friendships']))  $cpc_default_core .= 'core-friendships,';
	if (isset($the_post['core-alerts'])) 	   $cpc_default_core .= 'core-alerts,';
	if (isset($the_post['core-forums'])) 	   $cpc_default_core .= 'core-forums,';
	update_option('cpc_default_core', $cpc_default_core);  

	if (isset($the_post['cpc_core_options_tips'])):
		delete_option('cpc_admin_tips');
	endif;
        
	if (isset($the_post['cpc_external_links'])):
		update_option('cpc_external_links', $the_post['cpc_external_links']);
	else:
		delete_option('cpc_external_links');
	endif;

    if (isset($the_post['cpc_api'])):
        update_option('cpc_api', $the_post['cpc_api']);
    else:
        delete_option('cpc_api');
    endif;

    if (isset($the_post['cpc_api_functions'])):
        update_option('cpc_api_functions', $the_post['cpc_api_functions']);
    else:
        delete_option('cpc_api_functions');
    endif;

	if (isset($the_post['icon_colors']) && $the_post['icon_colors'] == 'light'):
		update_option('cpccom_icon_colors', '_light');
	else:
		delete_option('cpccom_icon_colors');
	endif;

    if (isset($the_post['flag_colors']) && $the_post['flag_colors'] == 'light'):
		update_option('cpccom_flag_colors', '_light');
	else:
		delete_option('cpccom_flag_colors');
	endif;

	if (isset($the_post['cpc_filter_feed_comments'])):
		update_option('cpc_filter_feed_comments', true);
	else:
		delete_option('cpc_filter_feed_comments');
	endif;    

    if (isset($the_post['cpc_filter_feed_comments_update'])):
        // ... update comment_type prior to version 16.02.03
        
        // Increase PHP script timeout
        set_time_limit(86400); // 24 hours    
        global $wpdb;

        $sql = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_type = 'cpc_activity'";
        $the_posts = $wpdb->get_col($sql);
        if ($the_posts):
            foreach ($the_posts as $id):
                $sql = "UPDATE ".$wpdb->prefix."comments SET comment_type = 'cpc_activity_comment' WHERE comment_post_ID = %d";
                $wpdb->query($wpdb->prepare($sql, $id));
            endforeach;
        endif;

        $sql = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_type = 'cpc_forum_post'";
        $the_posts = $wpdb->get_col($sql);
        if ($the_posts):
            foreach ($the_posts as $id):
                $sql = "UPDATE ".$wpdb->prefix."comments SET comment_type = 'cpc_forum_comment' WHERE comment_post_ID = %d";
                $wpdb->query($wpdb->prepare($sql, $id));
            endforeach;
        endif;

        $sql = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_type = 'cpc_event'";
        $the_posts = $wpdb->get_col($sql);
        if ($the_posts):
            foreach ($the_posts as $id):
                $sql = "UPDATE ".$wpdb->prefix."comments SET comment_type = 'cpc_event_comment' WHERE comment_post_ID = %d";
                $wpdb->query($wpdb->prepare($sql, $id));
            endforeach;
        endif;

        $sql = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_type = 'cpc_gallery'";
        $the_posts = $wpdb->get_col($sql);
        if ($the_posts):
            foreach ($the_posts as $id):
                $sql = "UPDATE ".$wpdb->prefix."comments SET comment_type = 'cpc_gallery_comment' WHERE comment_post_ID = %d";
                $wpdb->query($wpdb->prepare($sql, $id));
            endforeach;
        endif;

        $sql = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_type = 'cpc_mail'";
        $the_posts = $wpdb->get_col($sql);
        if ($the_posts):
            foreach ($the_posts as $id):
                $sql = "UPDATE ".$wpdb->prefix."comments SET comment_type = 'cpc_mail_comment' WHERE comment_post_ID = %d";
                $wpdb->query($wpdb->prepare($sql, $id));
            endforeach;
        endif;

    endif;    
    
	do_action( 'cpc_admin_getting_started_core_save_hook', $the_post );

	if ($current_core !== $cpc_default_core):
		echo '<script>alert("Funktionen geändert, Seite neu laden...");location.reload();</script>';
	endif;      

}

// Add to Getting Started information
if (!function_exists('cpc_admin_getting_started_extensions')):

    add_action('cpc_admin_getting_started_hook', 'cpc_admin_getting_started_extensions', 0.2);
    function cpc_admin_getting_started_extensions() {

        $css = ( (!isset($_POST['cpc_expand'])) || (isset($_POST['cpc_expand']) && $_POST['cpc_expand'] == 'cpc_admin_getting_started_extensions') ) ? 'cpc_admin_getting_started_menu_item_remove_icon ' : '';         
        echo '<div class="'.$css.'cpc_admin_getting_started_menu_item" rel="cpc_admin_getting_started_extensions" id="cpc_admin_getting_started_extensions_div">'.__('Funktionen', CPC2_TEXT_DOMAIN).'</div>';

        $display = (!isset($_POST['cpc_expand']) && !isset($_GET['cpc_expand'])) || (isset($_POST['cpc_expand']) && $_POST['cpc_expand'] == 'cpc_admin_getting_started_extensions') || (isset($_GET['cpc_expand']) && $_GET['cpc_expand'] == 'cpc_admin_getting_started_extensions') ? 'block' : 'none';
        echo '<div class="cpc_admin_getting_started_content" id="cpc_admin_getting_started_extensions" style="display:'.$display.'">';

        ?>
        <table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="cpc_forum_order"><?php _e('Funktionen aktivieren', CPC2_TEXT_DOMAIN); ?></label><br />
                <?php echo __('Hier kannst Du Core-Funktionen aktivieren/deaktivieren', CPC2_TEXT_DOMAIN);?>
            </th>
            <td>
                <?php

                $values = get_option('cpc_default_core');
                $values = $values ? explode(',', $values) : array();        
                echo '<p style="font-size:2.0em;">'.__('Core Plugin', CPC2_TEXT_DOMAIN).'</p>';
                echo cpc_show_core($values, 'core-profile', __('Profil', CPC2_TEXT_DOMAIN), 'https://cp-community.n3rds.work/profile-page/', '');
                echo cpc_show_core($values, 'core-activity', __('Aktivität', CPC2_TEXT_DOMAIN), 'https://cp-community.n3rds.work/profile-page/', '');
                echo cpc_show_core($values, 'core-avatar', __('Avatar', CPC2_TEXT_DOMAIN), 'https://cp-community.n3rds.work/profile-page/', '');
                echo cpc_show_core($values, 'core-friendships', __('Freundschaften', CPC2_TEXT_DOMAIN), 'https://cp-community.n3rds.work/profile-page/', '');
                echo cpc_show_core($values, 'core-alerts', __('Benachrichtigungen', CPC2_TEXT_DOMAIN), 'https://cp-community.n3rds.work/email-alerts/', '');
                echo cpc_show_core($values, 'core-forums', __('Foren', CPC2_TEXT_DOMAIN), 'https://cp-community.n3rds.work/forum-page/', '');
                ?>
            </td>
        </tr> 
        </table>
        <?php

        echo '</div>';

    }
endif;

function cpc_show_core($values, $field, $label, $help, $video) {

    $html = '<input type="checkbox" class="cpc_extension_checkbox" style="width:10px;" name="'.$field.'"';
    if (in_array($field, $values)) $html .= ' CHECKED';
    $html .= '>'.$label;

    if ($help) $html .= sprintf('<a href="%s" target="_blank"><img style="width:16px;height:16px" src="'.plugins_url('../cp-community/css/images/help.png', __FILE__).'" title="'.__('help', CPC2_TEXT_DOMAIN).'" /></a>', $help);
    if ($video) $html .= sprintf('<a href="%s" target="_blank"><img style="width:16px;height:16px" src="'.plugins_url('../cp-community/css/images/video.png', __FILE__).'" title="'.__('video', CPC2_TEXT_DOMAIN).'" /></a>', $video);
    $html .= '<br />';
    return $html;
}

function cpc_codex_link($url) {
    return '<div class="cpc_codex_link"><a target="_blank" href="'.$url.'">'.__('Click here for help, information and examples with this shortcode (opens new window)...').'</a></div>';
}

/* STYLES */

// Add Default settings information
add_action('cpc_admin_getting_started_styles_hook', 'cpc_admin_getting_started_styles', 1);
function cpc_admin_getting_started_styles() {
    
    echo '<div class="wrap">';
            
        echo '<style>';
            echo '.wrap { margin-top: 30px !important; margin-right: 10px !important; margin-left: 5px !important; }';
        echo '</style>';
        echo '<div id="cpc_release_notes">';
            echo '<div id="cpc_welcome_bar" style="margin-top: 20px;">';
                echo '<img id="cpc_welcome_logo" style="width:56px; height:56px; float:left;" src="'.plugins_url('../cp-community/css/images/cpc_logo.png', __FILE__).'" title="'.__('help', CPC2_TEXT_DOMAIN).'" />';
                echo '<div style="font-size:2em; line-height:1em; font-weight:100; color:#fff;">'.__('Willkommen bei CP-Community', CPC2_TEXT_DOMAIN).'</div>';
                echo '<p style="color:#fff;"><em>'.__('Das ultimative Plugin für soziale Netzwerke für ClassicPress', CPC2_TEXT_DOMAIN).'</em></p>';
            echo '</div>';

            $css = 'cpc_admin_getting_started_menu_item_remove_icon ';    
          	echo '<div style="margin-top:25px" class="'.$css.'cpc_admin_getting_started_menu_item_no_click" >'.__('CP-Community-Stile', CPC2_TEXT_DOMAIN).'</div>';    
        	$display = 'block';
          	echo '<div class="cpc_admin_getting_started_content" id="cpc_admin_getting_started_options" style="display:'.$display.'">';
            
                echo '<div id="cpc_admin_getting_started_options_outline">';
            
                    // reset options?
                    if (isset($_GET['cpc_reset_options'])) {

                        global $wpdb;
                        $sql = "DELETE FROM ".$wpdb->prefix."options WHERE option_name like 'cpc_styles_%'";
                        $wpdb->query($sql);
                        echo '<div class="cpc_success" style="margin-top:20px">';
                            echo sprintf(__('CP Community styles all reset! <a href="%s">Continue...</a>', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpc_com_styles' ));
                        echo '</div>';

                    } else {
            
                        echo '<h1>BETA</h1>';
                        echo '<p>This is a new feature and is being trialled, please let us know what you think or any problems you may have so we can fix them! When stable we will expand the options available. Thank you!</p>';
                        echo '<div id="cpc_admin_getting_started_options_help" style="margin-bottom:20px;'.(true || !isset($_POST['cpc_expand_shortcode']) ? '' : 'display:none;').'">';
                        echo sprintf(__('This section provides a quick and easy way to style all CP Community screen elements, saving you from using CSS. You can <a onclick="return confirm(\''.__('Are you sure, this cannot be undone?', CPC2_TEXT_DOMAIN).'\')" href="%s">reset all style changes</a>.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpc_com_styles&cpc_reset_options=1')).'<br />';
                        echo '<p>'.sprintf(__('If you hover over an element, the CSS class used is shown, and you can then use <a href="%s">Custom CSS</a> to add more advanced attributes.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpc_com_custom_css')).'</p>';
                        
                        $use_styles = get_option('cpccom_use_styles');
                        if (!$use_styles):
                        
                            echo '<br />'.__('Using styles this way adds a small load to your pages, so you need to enable it first.', CPC2_TEXT_DOMAIN).'<br />';                        
                            echo '<br /><input type="submit" id="cpc_styles_enable_submit" name="Submit" class="button-primary" value="'.__('Enable Styles', CPC2_TEXT_DOMAIN).'" />';
                            echo '</div>';
                        
                        else:
                        
                            echo '</div>';                        

                            echo '<div id="cpc_admin_getting_started_options_please_wait">';
                                echo __('Please wait, loading values....', CPC2_TEXT_DOMAIN);
                            echo '</div>';

                            echo '<div id="cpc_admin_getting_started_options_left_and_middle" style="display: none;">';
                                echo '<div id="cpc_admin_getting_started_options_left">';
                                    /* TABS (1st column) */
                                    $cpc_expand_tab = isset($_POST['cpc_expand_tab']) ? $_POST['cpc_expand_tab'] : 'elements';
                                    $tabs = array();
                                    array_push($tabs, array('tab' => 'cpc_option_elements',     'option' => 'elements',     'title' => __('Interface', CPC2_TEXT_DOMAIN)));
                                    array_push($tabs, array('tab' => 'cpc_option_forums',       'option' => 'forums',       'title' => __('Forums', CPC2_TEXT_DOMAIN)));

                                    // any more tabs?
                                    $tabs = apply_filters( 'cpc_styles_show_tab_filter', $tabs );

                                    $sort = array();
                                    foreach($tabs as $k=>$v) {
                                        $sort['title'][$k] = $v['title'];
                                    }
                                    array_multisort($sort['title'], SORT_ASC, $tabs);    

                                    foreach ($tabs as $tab):
                                        echo cpc_show_tab($cpc_expand_tab, $tab['tab'], $tab['option'], $tab['title']);
                                    endforeach;

                                    echo '<div id="cpc_styles_save_button" style="text-align:left"><input type="submit" id="cpc_styles_save_submit" name="Submit" class="button-primary" value="'.__('Save Styles', CPC2_TEXT_DOMAIN).'" /></div>';

                                    echo '<span style="display:none;float:left;margin-bottom:19px;" class="spinner"></span>';
                                    echo '<div style="clear:both"><hr />'.__('If not being used, you should disable this feature (you can re-enable again).', CPC2_TEXT_DOMAIN).'</div>';

                                    echo '<div id="cpc_styles_save_button" style="text-align:left"><input type="submit" id="cpc_styles_disable_submit" name="Submit" class="button-secondary" value="'.__('Disable Styles', CPC2_TEXT_DOMAIN).'" /></div>';

                                echo '</div>';

                                echo '<div id="cpc_admin_getting_started_options_middle">';
                                    /* SHORTCODES (2nd column) */
                                    $cpc_expand_shortcode = isset($_POST['cpc_expand_shortcode']) ? $_POST['cpc_expand_shortcode'] : 'cpc_elements_tab';
                                    // Elements
                                    echo cpc_show_style($cpc_expand_tab, $cpc_expand_shortcode, 'elements', 'cpc_elements_tab', __('Elements', CPC2_TEXT_DOMAIN));
                                    // Forums
                                    echo cpc_show_style($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forum_tab', CPC_PREFIX.'-forum');
                                    echo cpc_show_style($cpc_expand_tab, $cpc_expand_shortcode, 'forums', 'cpc_forums_tab', CPC_PREFIX.'-forums');

                                    // any more shortcodes?
                                    do_action('cpc_styles_shortcode_hook', $cpc_expand_tab, $cpc_expand_shortcode);    

                                echo '</div>';
                            echo '</div>';    
                        
                        endif;

                        echo '<div id="cpc_admin_getting_started_options_right" style="display: none;">';

                            /* ----------------------- ELEMENTS TAB ----------------------- */

                            $function = 'cpc_elements';
                            $values = get_option('cpc_styles_'.$function) ? get_option('cpc_styles_'.$function) : array(); 

                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_elements_tab');
                                echo '<table class="widefat fixed" cellspacing="0">';
                                echo cpc_styles_header();

                                    echo cpc_styles_show_values(__('Buttons', CPC2_TEXT_DOMAIN),                'cpc_button',                   '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Buttons (mouse over)', CPC2_TEXT_DOMAIN),   'cpc_button:hover',             '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Buttons (click)', CPC2_TEXT_DOMAIN),        'cpc_button:active',            '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Links', CPC2_TEXT_DOMAIN),                  'a',                            '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Links (mouse over)', CPC2_TEXT_DOMAIN),     'a:hover',                      '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Links (click)', CPC2_TEXT_DOMAIN),          'a:active',                     '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Heading 1', CPC2_TEXT_DOMAIN),              'h1',                           '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Heading 2', CPC2_TEXT_DOMAIN),              'h2',                           '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Heading 3', CPC2_TEXT_DOMAIN),              'h3',                           '', '', '', 'off', 'off', $function, $values);

                                echo '</table>';    
                            echo '</div>';    

                            /* OTHERS */

                            do_action('cpc_styles_shortcode_options_hook', $cpc_expand_shortcode);        

                        
                            /* ----------------------- FORUMS TAB ----------------------- */

                            // [cpc-forum]
                            $function = 'cpc_forum';
                            $values = get_option('cpc_styles_'.$function) ? get_option('cpc_styles_'.$function) : array(); 

                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forum_tab');
                                echo '<table class="widefat fixed" cellspacing="0">';
                                    echo cpc_styles_header();

                                    echo cpc_styles_show_values(__('Topic Header', CPC2_TEXT_DOMAIN),       'cpc_forum_title_header',                   '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Replies Header', CPC2_TEXT_DOMAIN),     'cpc_forum_count_header',                   '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Last Poster Header', CPC2_TEXT_DOMAIN), 'cpc_forum_last_poster_header',             '', '', '', 'off', 'off', $function, $values);
                                    echo cpc_styles_show_values(__('Freshness Header', CPC2_TEXT_DOMAIN),   'cpc_forum_categories_freshness_header',    '', '', '', 'off', 'off', $function, $values);

                                echo '</table>';    
                            echo '</div>';    

                            // [cpc-forums]
                            $function = 'cpc_forums';
                            $values = get_option('cpc_styles_'.$function) ? get_option('cpc_styles_'.$function) : array(); 

                            echo cpc_show_options($cpc_expand_shortcode, 'cpc_forums_tab');
                                echo '<table class="widefat fixed" cellspacing="0">';
                                    echo cpc_styles_header();

                                    echo cpc_styles_show_values(__('Forum Title', CPC2_TEXT_DOMAIN),                'cpc_forums_forum_title',                   '', '', '', 'off', 'off', $function, $values, '');
                                    echo cpc_styles_show_values(__('Forum Title (mouse over)', CPC2_TEXT_DOMAIN),   'cpc_forums_forum_title:hover',                   '', '', '', 'off', 'off', $function, $values, '');
                                    echo cpc_styles_show_values(__('Forum Title (click)', CPC2_TEXT_DOMAIN),        'cpc_forums_forum_title:active',                   '', '', '', 'off', 'off', $function, $values, sprintf(__('If Forum Title is styled, it would be best to <a href="%s">turn off "Top level as links"</a> via the [cpc-forums] shortcode.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpc_com_shortcodes' )));

                                echo '</table>';    
                            echo '</div>';    

                            /* OTHERS */

                            do_action('cpc_styles_shortcode_options_hook', $cpc_expand_shortcode);        

                        echo '</div>';

                        
                    }
            
                echo '</div>';

            echo '</div>';

        echo '</div>';

}

function cpc_styles_header() {
    $html = '<thead><tr>';
        $html .= '<td>'.__('Element', CPC2_TEXT_DOMAIN).'</td>';
        $html .= '<td>'.__('Fore Color', CPC2_TEXT_DOMAIN).'</td>';
        $html .= '<td>'.__('Back Color', CPC2_TEXT_DOMAIN).'</td>';
        $html .= '<td style="width:50px;">'.__('Bold', CPC2_TEXT_DOMAIN).'</td>';
        $html .= '<td style="width:50px;">'.__('Italic', CPC2_TEXT_DOMAIN).'</td>';
        $html .= '<td>'.__('Font size', CPC2_TEXT_DOMAIN).'</td>';
    $html .= '</tr></thead>';
    return $html;    
}
function cpc_styles_show_values($element, $class, $forecolor, $backcolor, $font_size, $bold, $italic, $function, $values, $notes = '') {

    echo '<tr>';
    echo '<td><a href="javascript:void(0);" title=".'.$class.'" alt=".'.$class.'">'.$element.'</a></td>';

    $default = $forecolor;
    $attr = 'forecolor';
    $value = cpc_get_shortcode_default($values, $function.'-'.$class.'_'.$attr, $default);
    echo '<td><input type="text" name="'.$function.'-'.$class.'_'.$attr.'" class="cpc-color-picker" data-default-color="'.$default.'" value="'.$value.'" /></td>';

    $default = $backcolor;
    $attr = 'backcolor';
    $value = cpc_get_shortcode_default($values, $function.'-'.$class.'_'.$attr, $default);
    echo '<td><input type="text" name="'.$function.'-'.$class.'_'.$attr.'" class="cpc-color-picker" data-default-color="'.$default.'" value="'.$value.'" /></td>';

    $default = $bold;
    $attr = 'bold';
    $value = cpc_get_shortcode_default($values, $function.'-'.$class.'_'.$attr, $default);
    echo '<td><input type="checkbox" name="'.$function.'-'.$class.'_'.$attr.'"'.($value == 'on' ? ' CHECKED' : '').'></td>';

    $default = $italic;
    $attr = 'italic';
    $value = cpc_get_shortcode_default($values, $function.'-'.$class.'_'.$attr, $default);
    echo '<td><input type="checkbox" name="'.$function.'-'.$class.'_'.$attr.'"'.($value == 'on' ? ' CHECKED' : '').'></td>';

    $default = $font_size;
    $attr = 'fontsize';
    $value = cpc_get_shortcode_default($values, $function.'-'.$class.'_'.$attr, $default);
    echo '<td><select class="cpc_fontsize_select" name="'.$function.'-'.$class.'_'.$attr.'">';
        echo '<option value=""'.($value == '' ? ' SELECTED' : '').'>'.__('Inherit', CPC2_TEXT_DOMAIN).'</option>';
        echo '<option value="1em"'.($value == '1em' ? ' SELECTED' : '').'>1em</option>';
        echo '<option value="1.2em"'.($value == '1.2em' ? ' SELECTED' : '').'>1.2em</option>';
        echo '<option value="1.4em"'.($value == '1.4em' ? ' SELECTED' : '').'>1.4em</option>';
        echo '<option value="1.6em"'.($value == '1.6em' ? ' SELECTED' : '').'>1.6em</option>';
        echo '<option value="1.8em"'.($value == '1.8em' ? ' SELECTED' : '').'>1.8em</option>';
        echo '<option value="2.0em"'.($value == '2.0em' ? ' SELECTED' : '').'>2.0em</option>';
        echo '<option value="2.2em"'.($value == '2.2em' ? ' SELECTED' : '').'>2.2em</option>';
        echo '<option value="2.4em"'.($value == '2.4em' ? ' SELECTED' : '').'>2.4em</option>';
    echo '</select></td>';

    echo '</tr>';

    if ($notes):
        echo '<tr style="background-color:#efefef">';
            echo '<td colspan=6>'.$notes.'</td>';
        echo '</tr>';
    endif;
}

function cpc_show_style($cpc_expand_tab, $cpc_expand_shortcode, $tab, $function, $shortcode) {
    if ($function != 'cpc_elements_tab'):
        return '<div rel="'.$function.'" class="'.($cpc_expand_shortcode == $function ? 'cpc_admin_getting_started_active' : '').' cpc_'.$tab.' cpc_admin_getting_started_option_shortcode" data-tab="'.$function.'" style="display:'.($cpc_expand_tab == $tab ? 'block' : 'none').'">['.$shortcode.']</div>';
    else:
        return '<div rel="'.$function.'" class="'.($cpc_expand_shortcode == $function ? 'cpc_admin_getting_started_active' : '').' cpc_'.$tab.' cpc_admin_getting_started_option_shortcode" data-tab="'.$function.'" style="display:'.($cpc_expand_tab == $tab ? 'block' : 'none').'">'.$shortcode.'</div>';
    endif;
}

?>
