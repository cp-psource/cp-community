<?php
// Add menu items for forum
add_action( 'admin_menu', 'cpc_add_forums_menu' );
function cpc_add_forums_menu() {
    add_submenu_page(get_option('cpc_core_admin_icons') ? 'cpc_com' : '', __('Forum Setup', CPC2_TEXT_DOMAIN), __('Forum Setup', CPC2_TEXT_DOMAIN), 'manage_options', 'edit-tags.php?taxonomy=cpc_forum&post_type=cpc_forum_post');
    add_submenu_page(get_option('cpc_core_admin_icons') ? 'cpc_com' : '', __('All Forums', CPC2_TEXT_DOMAIN), __('All Forums', CPC2_TEXT_DOMAIN), 'manage_options', 'cpccom_forum_setup', 'cpccom_forum_setup');
}

// Quick Start
add_action('cpc_admin_quick_start_hook', 'cpc_admin_quick_start_forum');
function cpc_admin_quick_start_forum() {

	echo '<div style="margin-right:10px; float:left">';
	echo '<input type="submit" id="cpc_admin_forum_add" class="button-secondary" value="'.__('Add Forum', CPC2_TEXT_DOMAIN).'" />';
	echo '</div>';

	echo '<div id="cpc_admin_forum_add_details" style="clear:both;display:none">';
		echo '<form action="" method="POST">';
		echo '<input type="hidden" name="cpccom_quick_start" value="forum" />';
		echo '<br /><strong>'.__('Enter name of new forum', CPC2_TEXT_DOMAIN).'</strong><br />';
		echo '<input type="input" style="margin-top:4px;" id="cpc_admin_forum_add_name" name="cpc_admin_forum_add_name" /><br />';
		echo '<br /><strong>'.__('Enter description of new forum', CPC2_TEXT_DOMAIN).'</strong><br />';
		echo '<input type="input" style="margin-top:4px;width:300px;" id="cpc_admin_forum_add_description" name="cpc_admin_forum_add_description" /><br /><br />';
		echo '<input type="submit" id="cpc_admin_forum_add_button" class="button-primary" value="'.__('Publish', CPC2_TEXT_DOMAIN).'" />';
		echo '</form>';
	echo '</div>';


}


add_action('cpc_admin_quick_start_form_save_hook', 'cpc_admin_quick_start_forum_save', 10, 1);
function cpc_admin_quick_start_forum_save($the_post) {

	if (isset($the_post['cpccom_quick_start']) && $the_post['cpccom_quick_start'] == 'forum'):

		$name = $the_post['cpc_admin_forum_add_name'];
		$description = $the_post['cpc_admin_forum_add_description'];
		$slug = sanitize_title_with_dashes($name);

		$new_term = wp_insert_term(
		  $name, 
		  'cpc_forum', 
		  array(
		    'description'=> $description,
		    'slug' => $slug,
		  )
		);	

		if (is_wp_error($new_term)):
			
			echo '<div class="cpc_error">'.__('You have already added this Forum.', CPC2_TEXT_DOMAIN).'</div>';

		else:

			$post_content = '['.CPC_PREFIX.'-forum-post slug="'.$slug.'"]['.CPC_PREFIX.'-forum-backto slug="'.$slug.'"]['.CPC_PREFIX.'-forum slug="'.$slug.'"]';
 			$post_content .= '['.CPC_PREFIX.'-forum-reply slug="'.$slug.'"]['.CPC_PREFIX.'-forum-backto slug="'.$slug.'"]';

			// Forum Page
			$post = array(
			  'post_content'   => $post_content,
			  'post_name'      => $slug,
			  'post_title'     => $name,
			  'post_status'    => 'publish',
			  'post_type'      => 'page',
			  'ping_status'    => 'closed',
			  'comment_status' => 'closed',
			);  

			$new_id = wp_insert_post( $post );	

			cpc_update_term_meta( $new_term['term_id'], 'cpc_forum_public', true );
			cpc_update_term_meta( $new_term['term_id'], 'cpc_forum_cat_page', $new_id );
			cpc_update_term_meta( $new_term['term_id'], 'cpc_forum_order', 1 );

			echo '<div class="cpc_success">';
				echo sprintf(__('Forum Page (%s) added. [<a href="%s">view</a>]', CPC2_TEXT_DOMAIN), urldecode(get_permalink($new_id)), urldecode(get_permalink($new_id))).'<br /><br />';
				echo sprintf(__('If you are using the <a href="%s">Forum Roles Security</a> extension, choose who can see the forum via <a href="%s">CP Community->Manage All Forums</a>.', CPC2_TEXT_DOMAIN), "http://www.cpcymposiumpro.info/forum-security/", "admin.php?page=cpccom_forum_setup").'<br />';
				echo sprintf(__('You might want to add it to your <a href="%s">ClassicPress menu</a>.', CPC2_TEXT_DOMAIN), "nav-menus.php");
			echo '</div>';

		endif;

	endif;

}

// Add to Getting Started information
add_action('cpc_admin_getting_started_hook', 'cpc_admin_getting_started_forum', 4);
function cpc_admin_getting_started_forum() {

    $css = isset($_POST['cpc_expand']) && $_POST['cpc_expand'] == 'cpc_admin_getting_started_forum' ? 'cpc_admin_getting_started_menu_item_remove_icon ' : '';    
  	echo '<div class="'.$css.'cpc_admin_getting_started_menu_item" rel="cpc_admin_getting_started_forum" id="cpc_admin_getting_started_forum_div">'.__('Forum', CPC2_TEXT_DOMAIN).'</div>';

  	$display = isset($_POST['cpc_expand']) && $_POST['cpc_expand'] == 'cpc_admin_getting_started_forum' ? 'block' : 'none';
  	echo '<div class="cpc_admin_getting_started_content" id="cpc_admin_getting_started_forum" style="display:'.$display.'">';

		?>
		<table class="form-table">
		<tr class="form-field">
			<td scope="row" valign="top">
				<label for="cpc_forum_auto_close"><?php _e('Auto-close period', CPC2_TEXT_DOMAIN); ?></label>
			</td>
			<td>
				<input type="text" style="width:50px" name="cpc_forum_auto_close" value="<?php echo get_option('cpc_forum_auto_close'); ?>" /> 
				<span class="description"><?php echo sprintf(__('Default number of days after no activity that a forum post will close automatically (blank for never). Can be overridden for individual forums via Edit on <a href="%s">Manage All Forums</a>.', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpccom_forum_setup' ) ); ?></span>
			</td>
        </tr>
		<tr class="form-field">
			<td scope="row" valign="top">
				<label for="cpc_forum_slug_length"><?php _e('Slug length', CPC2_TEXT_DOMAIN); ?></label>
			</td>
			<td>
                <?php $cpc_forum_slug_length = get_option('cpc_forum_slug_length') ? get_option('cpc_forum_slug_length') : 50; ?>
				<input type="text" style="width:50px" name="cpc_forum_slug_length" value="<?php echo $cpc_forum_slug_length; ?>" /> 
				<span class="description"><?php echo __('Maximum length for forum post titles in URLs.', CPC2_TEXT_DOMAIN) ; ?></span>
			</td>
        </tr>
        <tr class="form-field">
			<td scope="row" valign="top">
				<label for="cpc_forum_sticky_admin_only"><?php _e('Sticky posts', CPC2_TEXT_DOMAIN); ?></label>
			</td>            
            <td>
                <input type="checkbox" name="cpc_forum_sticky_admin_only" 
                <?php if (get_option('cpc_forum_sticky_admin_only')) echo ' CHECKED'; ?>
                />
                <span class="description">
                    <?php _e('Only display sticky option to site administrator.', CPC2_TEXT_DOMAIN); ?>
                </span>
            </td>            
		</tr> 
		<?php 
				do_action('cpc_admin_getting_started_forum_hook');
		?>
		</table>
        <?php

	echo '</div>';

}

add_action('cpc_admin_setup_form_get_hook', 'cpc_admin_forum_save', 10, 2);
add_action('cpc_admin_setup_form_save_hook', 'cpc_admin_forum_save', 10, 2);
function cpc_admin_forum_save($the_post) {
        
	if (isset($the_post['cpc_forum_auto_close']) && $the_post['cpc_forum_auto_close'] != ''):
		update_option('cpc_forum_auto_close', $the_post['cpc_forum_auto_close']);
	else:
		delete_option('cpc_forum_auto_close');
	endif;
    
	if (isset($the_post['cpc_forum_slug_length']) && $the_post['cpc_forum_slug_length'] != ''):
		update_option('cpc_forum_slug_length', $the_post['cpc_forum_slug_length']);
	else:
		update_option('cpc_forum_slug_length', 50);
	endif;
    
	if (isset($the_post['cpc_forum_sticky_admin_only'])):
		update_option('cpc_forum_sticky_admin_only', true);
	else:
		delete_option('cpc_forum_sticky_admin_only');
	endif;    

	do_action('cpc_admin_forum_save_hook', $the_post);


}

?>