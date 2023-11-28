<?php

// Following are so media library can be used for featured image
function wp_gear_manager_admin_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('jquery');
}

function wp_gear_manager_admin_styles() {
    wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');



/* Create forum_post custom taxonomy */

function add_cpc_forum_custom_taxonomies() {

	register_taxonomy('cpc_forum', 'cpc_forum_post', array(

        'hierarchical'               => true,
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the ClassicPress Admin UI
		'labels' => array(
			'name' 				=> __( 'Forums', CPC2_TEXT_DOMAIN ),
			'singular_name' 	=> __( 'Forum', CPC2_TEXT_DOMAIN ),
			'search_items' 		=> __( 'Search Forums', CPC2_TEXT_DOMAIN ),
			'all_items' 		=> __( 'All Forums', CPC2_TEXT_DOMAIN ),
			'parent_item' 		=> __( 'Parent Forum', CPC2_TEXT_DOMAIN ),
			'parent_item_colon' => __( 'Parent Forum:', CPC2_TEXT_DOMAIN ),
			'edit_item' 		=> __( 'Edit Forum', CPC2_TEXT_DOMAIN ),
			'update_item' 		=> __( 'Update Forum', CPC2_TEXT_DOMAIN ),
			'add_new_item' 		=> __( 'Add New Forum', CPC2_TEXT_DOMAIN ),
			'new_item_name' 	=> __( 'New Forum Name', CPC2_TEXT_DOMAIN ),
			'menu_name'			=> __( 'Forums', CPC2_TEXT_DOMAIN ),
		),
        // Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'cpc-forums', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));

}
add_action( 'init', 'add_cpc_forum_custom_taxonomies', 0 );


add_action("cpc_forum_add_form_fields", 'cpc_taxonomy_metadata_add', 10, 1);
function cpc_taxonomy_metadata_add( $tag ) {
	// Only allow users with capability to publish content
	if ( current_user_can( 'publish_posts' ) ): ?>
	<div class="form-field">
		<label for="cpc_forum_public"><?php _e('Visibility', CPC2_TEXT_DOMAIN); ?></label>
		<input name="cpc_forum_public" id="cpc_forum_public" type="checkbox" style="width:10px" />
		<span class="description"><?php _e('Can this forum be viewed without logging in?', CPC2_TEXT_DOMAIN); ?></span>
	</div>

	<div class="form-field">
		<label for="cpc_forum_order"><?php _e('Order', CPC2_TEXT_DOMAIN); ?></label>
		<input type="text" name="cpc_forum_order" id="cpc_forum_order" style="width:50px" />
		<span class="description"><?php _e('Order in which the forum is shown, in a list of forums.', CPC2_TEXT_DOMAIN); ?></span>
	</div> 


	<div class="form-field">
		<label for="cpc_forum_cat_page"><?php _e('ClassicPress page', CPC2_TEXT_DOMAIN); ?></label>
		<select name="cpc_forum_cat_page" name="cpc_forum_cat_page">
		 <?php 
		  echo '<option value="0">'.__('Select page...', CPC2_TEXT_DOMAIN).'</option>';
		  $pages = get_pages(); 
		  foreach ( $pages as $page ) {
		  	$option = '<option value="' . $page->ID . '">';
			$option .= $page->post_title;
			$option .= '</option>';
			echo $option;
		  }
		 ?>						
		</select>
		<div class="description"><?php echo sprintf(__('ClassicPress page that has this forum\'s shortcodes on.<br />See <a href="%s">Getting Started</a> information.', CPC2_TEXT_DOMAIN), 'admin.php?page=cpc_com'); ?></div>
		<div class="description"><br /><strong><?php _e('Make sure your forum slug matches your forum page slug.', CPC2_TEXT_DOMAIN); ?></strong><br />
		<strong><?php _e('Your forum page should not have a parent page.', CPC2_TEXT_DOMAIN); ?></strong></div>    
    </div> 
    <p><a href="admin.php?page=cpccom_forum_setup"><?php _e('Go to Forum Administration', CPC2_TEXT_DOMAIN); ?></a></p><br />

<?php endif;
}

add_action("cpc_forum_edit_form_fields", 'cpc_taxonomy_metadata_edit', 10, 1);
function cpc_taxonomy_metadata_edit( $tag ) {
	// Only allow users with capability to publish content
	if ( current_user_can( 'publish_posts' ) ): ?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_public"><?php _e('Visibility', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<input name="cpc_forum_public" id="cpc_forum_public" type="checkbox" <?php if ( cpc_get_term_meta($tag->term_id, 'cpc_forum_public', true) ) echo 'CHECKED'; ?> style="width:10px" />
			<span class="description"><?php _e('Can this forum be viewed without logging in?', CPC2_TEXT_DOMAIN); ?></span>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_closed"><?php _e('Auto-close period', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<?php
			$cpc_forum_auto_close = cpc_get_term_meta($tag->term_id, 'cpc_forum_auto_close', true) ? cpc_get_term_meta($tag->term_id, 'cpc_forum_auto_close', true) : '';
			if (!$cpc_forum_auto_close)
				$cpc_forum_auto_close = get_option( 'cpc_forum_auto_close' ) ? get_option( 'cpc_forum_auto_close' ) : '';
			?>
			<input type="text" name="cpc_forum_auto_close" id="cpc_forum_auto_close" style="width:50px" value="<?php echo $cpc_forum_auto_close; ?>" />
			<span class="description"><?php echo sprintf(__('Number of days after no activity that a forum post will close automatically (if left blank, default is used from <a href="%s">Setup->Forum</a>).', CPC2_TEXT_DOMAIN), admin_url( 'admin.php?page=cpc_com_setup' )); ?></span>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_closed"><?php _e('Lock forum', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<input name="cpc_forum_closed" id="cpc_forum_closed" type="checkbox" <?php if ( cpc_get_term_meta($tag->term_id, 'cpc_forum_closed', true) ) echo 'CHECKED'; ?> style="width:10px" />
			<span class="description"><?php _e('Lock this forum, stopping new posts and replies', CPC2_TEXT_DOMAIN); ?></span>
		</td>
	</tr>

    <?php if (function_exists('cpc_forum_subs_extension_insert_rewrite_rules')): ?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_auto"><?php _e('Auto subscribe', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<input name="cpc_forum_auto" id="cpc_forum_auto" type="checkbox" <?php if ( cpc_get_term_meta($tag->term_id, 'cpc_forum_auto', true) ) echo 'CHECKED'; ?> style="width:10px" />
			<span class="description"><?php _e('Automatically subscribe new users to this forum (users can then choose to opt-out)', CPC2_TEXT_DOMAIN); ?></span>
		</td>
	</tr>
    <?php endif; ?>

    <?php if (function_exists('cpc_forum_subs_extension_insert_rewrite_rules')): ?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_email_all"><?php _e('Email all members', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<input name="cpc_forum_email_all" id="cpc_forum_email_all" type="checkbox" <?php if ( cpc_get_term_meta($tag->term_id, 'cpc_forum_email_all', true) ) echo 'CHECKED'; ?> style="width:10px" />
			<span class="description"><?php _e('Always send email alert to all site members when new topics are added (no opt-out)', CPC2_TEXT_DOMAIN); ?></span>
		</td>
	</tr>
    <?php endif; ?>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_author"><?php _e('Show own posts', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<input name="cpc_forum_author" id="cpc_forum_author" type="checkbox" <?php if ( cpc_get_term_meta($tag->term_id, 'cpc_forum_author', true) ) echo 'CHECKED'; ?> style="width:10px" />
			<span class="description"><?php _e('Only show posts by current user (administrators always see all)', CPC2_TEXT_DOMAIN); ?></span>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_order"><?php _e('Order', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<input type="text" name="cpc_forum_order" id="cpc_forum_order" style="width:50px" value="<?php echo cpc_get_term_meta($tag->term_id, 'cpc_forum_order', true); ?>" />
			<span class="description"><?php _e('Order in which the forum is shown, in a list of forums.', CPC2_TEXT_DOMAIN); ?></span>
		</td>
	</tr> 

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_cat_page"><?php _e('ShareThis', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<p><span class="description">
                <?php echo sprintf(__('On <a href="%s" target="_blank">ShareThis</a>, choose "website code" (not Wordpress) and copy the two sets of code supplied below (applies to all forums). Use [cpc-forum-sharethis slug="xxx"] to display.', CPC2_TEXT_DOMAIN), "http://www.sharethis.com"); ?>
            </span></p>
            <?php
            $buttons = get_option('cpc_forum_sharethis_buttons') ? get_option('cpc_forum_sharethis_buttons') : '';
            $js = get_option('cpc_forum_sharethis_js') ? get_option('cpc_forum_sharethis_js') : '';
            ?>
            <p><strong><?php _e('1. Span tags (code for displaying your buttons)', CPC2_TEXT_DOMAIN); ?></strong></p>
            <textarea style="height:100px;" name="cpc_forum_sharethis_buttons"><?php echo $buttons; ?></textarea>
            <p><strong><?php _e('2. Script tags', CPC2_TEXT_DOMAIN); ?></strong></p>
            <textarea style="height:100px;" name="cpc_forum_sharethis_js"><?php echo $js; ?></textarea>
		</td>
	</tr> 

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_cat_page"><?php _e('ClassicPress page', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
			<?php 
		  	$forum_page = cpc_get_term_meta($tag->term_id, 'cpc_forum_cat_page', true);

            echo '<select name="cpc_forum_cat_page">';

			  	if (!$forum_page) echo '<option value="0">'.__('Select page...', CPC2_TEXT_DOMAIN).'</option>';
			  	$pages = get_pages(); 
			  	foreach ( $pages as $page ):
			  		$option = '<option value="' . $page->ID . '"';
			  			if ($page->ID == $forum_page) $option .= ' SELECTED';
			  			$option .= '>';
						$option .= $page->post_title.' ('.$page->ID.')';
					$option .= '</option>';
					echo $option;
				endforeach;

			echo '</select>';
			 ?>						
			<br />
			<span class="description"><?php _e('ClassicPress page that has this forum\'s shortcodes on.', CPC2_TEXT_DOMAIN); ?>
			<?php if ($forum_page) { ?> [<a href="post.php?post=<?php echo $forum_page; ?>&action=edit"><?php _e('Edit', CPC2_TEXT_DOMAIN); ?></a>]<?php } ?></span><br />
			<div class="description"><br /><strong><?php _e('Make sure your forum slug matches your forum page slug.', CPC2_TEXT_DOMAIN); ?></strong><br />
			<strong><?php _e('Your forum page should not have a parent page.', CPC2_TEXT_DOMAIN); ?></strong></div>
		</td>
	</tr> 

	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cpc_forum_featured_image"><?php _e('Featured Image', CPC2_TEXT_DOMAIN); ?></label>
		</th>
		<td>
            <input id="cpc_forum_featured_upload_image" type="text" style="width: 50%" name="cpc_forum_featured_image" value="<?php echo cpc_get_term_meta($tag->term_id, 'cpc_forum_featured_image', true); ?>" /> 
            <button id="cpc_forum_featured_upload_image_button" class="button-secondary"><?php _e('Select from Media Library', CPC2_TEXT_DOMAIN); ?></button><br />
            <span class="description"><?php _e('URL of an image that, if set, is used with the [cpc-forums] shortcode.', CPC2_TEXT_DOMAIN); ?>
		</td>
	</tr> 


	<?php 

	// Any further options?
	do_action('cpc_forum_taxonomy_metadata_edit_hook', $tag);

	endif;
}


add_action("created_cpc_forum", 'cpc_save_taxonomy_metadata', 10, 1);
add_action("edited_cpc_forum", 'cpc_save_taxonomy_metadata', 10, 1);
function cpc_save_taxonomy_metadata( $term_id ) {
    
	if (isset($_POST['cpc_forum_featured_image']))
		cpc_update_term_meta( $term_id, 'cpc_forum_featured_image', $_POST['cpc_forum_featured_image'] );

    if ( isset($_POST['cpc_forum_public']) ):
		cpc_update_term_meta( $term_id, 'cpc_forum_public', true );
	else:
		cpc_update_term_meta( $term_id, 'cpc_forum_public', false );
	endif;

	if (isset($_POST['cpc_forum_cat_page']))
		cpc_update_term_meta( $term_id, 'cpc_forum_cat_page', $_POST['cpc_forum_cat_page'] );

	if (isset($_POST['cpc_forum_auto_close'])):
		cpc_update_term_meta( $term_id, 'cpc_forum_auto_close', $_POST['cpc_forum_auto_close'] );
	else:
		cpc_update_term_meta( $term_id, 'cpc_forum_auto_close', 0 );
	endif;

	if (isset($_POST['cpc_forum_closed'])):
		cpc_update_term_meta( $term_id, 'cpc_forum_closed', $_POST['cpc_forum_closed'] );
	else:
		cpc_update_term_meta( $term_id, 'cpc_forum_closed', 0 );
	endif;

    if (function_exists('cpc_forum_subs_extension_insert_rewrite_rules')):        
        if (isset($_POST['cpc_forum_auto'])):
            cpc_update_term_meta( $term_id, 'cpc_forum_auto', $_POST['cpc_forum_auto'] );
        else:
            cpc_update_term_meta( $term_id, 'cpc_forum_auto', 0 );
        endif;
    endif;

	if (isset($_POST['cpc_forum_order'])):
		cpc_update_term_meta( $term_id, 'cpc_forum_order', $_POST['cpc_forum_order'] );
	else:
		cpc_update_term_meta( $term_id, 'cpc_forum_order', 0 );
	endif;

	if (isset($_POST['cpc_forum_author'])):
		cpc_update_term_meta( $term_id, 'cpc_forum_author', $_POST['cpc_forum_author'] );
	else:
		cpc_update_term_meta( $term_id, 'cpc_forum_author', 0 );
	endif;

	if (isset($_POST['cpc_forum_email_all'])):
		cpc_update_term_meta( $term_id, 'cpc_forum_email_all', $_POST['cpc_forum_email_all'] );
	else:
		cpc_update_term_meta( $term_id, 'cpc_forum_email_all', 0 );
	endif;

    $buttons = isset($_POST['cpc_forum_sharethis_buttons']) ? stripslashes($_POST['cpc_forum_sharethis_buttons']) : false;
    $js = isset($_POST['cpc_forum_sharethis_js']) ? stripslashes($_POST['cpc_forum_sharethis_js']) : false;
    update_option( 'cpc_forum_sharethis_buttons', $buttons );
    update_option( 'cpc_forum_sharethis_js', $js );
        
	// Any further options to save?
	do_action('cpc_forum_taxonomy_metadata_edit_roles_save_hook', $term_id, $_POST);

	// Ready for re-writing
	global $wp_rewrite;
   	$wp_rewrite->flush_rules();

}

/* Add notice to forum setup */
function cpc_save_taxonomy_metadata_notice(){
    $screen = get_current_screen();
    
    if( $screen->id !='edit-cpc_forum' )
        return;

    if( strpos(cpc_curPageURL(), 'edit-tags.php?taxonomy=cpc_forum') !== false ) {
    	echo '<script>window.location="'.admin_url('admin.php?page=cpccom_forum_setup').'";</script>';
    }

	echo '<style>#message { display: none; }</style>';

	echo '<div class="cpc_success" style="margin-top:24px;">&larr; ';
		echo sprintf('<a href="%s">', admin_url( 'admin.php?page=cpccom_forum_setup' )).__('Back to Manage All Forums', CPC2_TEXT_DOMAIN).'</a>';
	echo '</div>';
    
    echo '<p style="font-weight:bold">'.__('Please remember that your forum slug must always match the slug of the page your forum is operating on, and that forum page should not have a parent page. For example, if your forum slug is general-forum it must be on a page with a slug of general-forum. The forum name can be anything you want.', CPC2_TEXT_DOMAIN).'</p>';
    

}
add_action('admin_notices','cpc_save_taxonomy_metadata_notice');

/* Add filter to posts screen */

if (!class_exists('cpc_Tax_CTP_Filter')){
  /**
    * Tax CTP Filter Class 
    * Simple class to add custom taxonomy dropdown to a custom post type admin edit list
    * @author Ohad Raz <admin@bainternet.info>
    * @version 0.1
    */
    class cpc_Tax_CTP_Filter
    {
        /**
         * __construct 
         * @author Ohad Raz <admin@bainternet.info>
         * @since 0.1
         * @param array $cpt [description]
         */
        function __construct($cpt = array()){
            $this->cpt = $cpt;
            // Adding a Taxonomy Filter to Admin List for a Custom Post Type
            add_action( 'restrict_manage_posts', array($this,'my_restrict_manage_posts' ));
        }
  
        /**
         * my_restrict_manage_posts  add the slelect dropdown per taxonomy
         * @author Ohad Raz <admin@bainternet.info>
         * @since 0.1
         * @return void
         */
        public function my_restrict_manage_posts() {
            // only display these taxonomy filters on desired custom post_type listings
            global $typenow;
            $types = array_keys($this->cpt);
            if (in_array($typenow, $types)) {
                // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
                $filters = $this->cpt[$typenow];
                foreach ($filters as $tax_slug) {
                    // retrieve the taxonomy object
                    $tax_obj = get_taxonomy($tax_slug);
                    $tax_name = $tax_obj->labels->name;
  
                    // output html for taxonomy dropdown filter
                    echo "<select name='".strtolower($tax_slug)."' id='".strtolower($tax_slug)."' class='postform'>";
                    echo "<option value=''>Show All $tax_name</option>";
                    $this->generate_taxonomy_options($tax_slug,0,0,(isset($_GET[strtolower($tax_slug)])? $_GET[strtolower($tax_slug)] : null));
                    echo "</select>";
                }
            }
        }
         
        /**
         * generate_taxonomy_options generate dropdown
         * @author Ohad Raz <admin@bainternet.info>
         * @since 0.1
         * @param  string  $tax_slug 
         * @param  string  $parent   
         * @param  integer $level    
         * @param  string  $selected 
         * @return void            
         */
        public function generate_taxonomy_options($tax_slug, $parent = '', $level = 0,$selected = null) {
            $args = array('show_empty' => 1);
            if(!is_null($parent)) {
                $args = array('parent' => $parent);
            }
            $terms = get_terms($tax_slug,$args);
            $tab='';
            for($i=0;$i<$level;$i++){
                $tab.='--';
            }
  
            foreach ($terms as $term) {
                // output each select option line, check against the last $_GET to show the current option selected
                echo '<option value='. $term->slug, $selected == $term->slug ? ' selected="selected"' : '','>' .$tab. $term->name .' (' . $term->count .')</option>';
                $this->generate_taxonomy_options($tax_slug, $term->term_id, $level+1,$selected);
            }
  
        }
    }//end class
}//end if
new cpc_Tax_CTP_Filter(array('cpc_forum_post' => array('cpc_forum')));



?>