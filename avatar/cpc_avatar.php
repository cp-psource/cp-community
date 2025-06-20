<?php 
/* Credit to Enej Bajgoric / Gagan Sandhu / CTLT DEV, http://wordpress.org/extend/plugins/user-avatar/ */

add_action('init', 'user_avatar_core_set_avatar_constants', 8 );
add_action('show_user_profile', 'user_avatar_form');
add_action('edit_user_profile', 'user_avatar_form');
add_action('wp_ajax_user_avatar_add_photo', 'user_avatar_add_photo');
add_action('user_avatar_iframe_head','user_avatar_init');

// Shortcodes
require_once('cpc_avatar_shortcodes.php');

if (is_admin())  add_action('admin_print_styles-user-edit.php', 'user_avatar_admin_print_styles');
if (is_admin())  add_action('admin_print_styles-profile.php', 'user_avatar_admin_print_styles');

function user_avatar_admin_enqueue_modal_assets() {
    wp_enqueue_style(
		'psource-modal',
		plugins_url('../assets/psource-ui/modal/psource-modal.css', __FILE__)
	);
	wp_enqueue_script(
		'psource-modal',
		plugins_url('../assets/psource-ui/modal/psource-modal.js', __FILE__),
		array(),
		false,
		true
	);
}
add_action('admin_enqueue_scripts', 'user_avatar_admin_enqueue_modal_assets');

function user_avatar_admin_print_styles() {
	wp_enqueue_style('user-avatar', plugins_url('user-avatar.css', __FILE__), 'css');
}

/**
 * user_avatar_init function.
 * Description: Initializing user avatar style.
 * @access public
 * @return void
 */
function user_avatar_init(){
	
	wp_enqueue_style( 'global' );
	wp_enqueue_style( 'wp-admin' );
	wp_enqueue_style( 'colors' );
	wp_enqueue_style( 'ie' );
	wp_enqueue_style('user-avatar', plugins_url('user-avatar.css', __FILE__), 'css');
	wp_enqueue_style('imgareaselect');
	wp_enqueue_script('imgareaselect');
	do_action('admin_print_styles');
	do_action('admin_print_scripts');
	do_action('admin_head');

}
/**
 * user_avatar_core_set_avatar_constants function.
 * Description: Establishing restraints on sizes of files and dimensions of images.
 * Sets the default constants 
 * @access public
 * @return void
 */
function user_avatar_core_set_avatar_constants() {
	
	if ( !defined( 'USER_AVATAR_THUMB_WIDTH' ) )
		define( 'USER_AVATAR_THUMB_WIDTH', 50 );

	if ( !defined( 'USER_AVATAR_THUMB_HEIGHT' ) )
		define( 'USER_AVATAR_THUMB_HEIGHT', 50 );

	if ( !defined( 'USER_AVATAR_FULL_WIDTH' ) )
		define( 'USER_AVATAR_FULL_WIDTH', 150 );

	if ( !defined( 'USER_AVATAR_FULL_HEIGHT' ) )
		define( 'USER_AVATAR_FULL_HEIGHT', 150 );

	if ( !defined( 'USER_AVATAR_ORIGINAL_MAX_FILESIZE' ) ) {
		if ( !get_site_option( 'fileupload_maxk', 1500 ) )
			define( 'USER_AVATAR_ORIGINAL_MAX_FILESIZE', 5120000 ); /* 5mb */
		else
			define( 'USER_AVATAR_ORIGINAL_MAX_FILESIZE', get_site_option( 'fileupload_maxk', 1500 ) * 1024 );
	}

	if ( !defined( 'USER_AVATAR_DEFAULT' ) )
		define( 'USER_AVATAR_DEFAULT', plugins_url('/cp-community/avatar/images/mystery-man.jpg') );

	if ( !defined( 'USER_AVATAR_DEFAULT_THUMB' ) )
		define( 'USER_AVATAR_DEFAULT_THUMB', plugins_url('/cp-community/avatar/images/mystery-man-50.jpg') );
		
}

/**
 * user_avatar_core_avatar_upload_path function.
 * Description: Establishing upload path/area where images that are uploaded will be stored.
 * @access public
 * @return void
 */
function user_avatar_core_avatar_upload_path($uid = false)
{
	if (!$uid):
		global $current_user;
		$uid = (isset($_GET['user_id'])) ? $_GET['user_id'] : $current_user->ID;
	endif;
	if( !file_exists(WP_CONTENT_DIR."/cpc-pro-content/members/".$uid."/avatar/") )
		mkdir(WP_CONTENT_DIR."/cpc-pro-content/members/".$uid."/avatar/", 0777 ,true);
	return WP_CONTENT_DIR."/cpc-pro-content/members/".$uid."/avatar/";
}

/**
 * user_avatar_core_avatar_url function.
 * Description: Establishing the path of the core content avatar area.
 * @access public
 * @return void
 */
function user_avatar_core_avatar_url($uid = false)
{	
	if (!$uid):
		global $current_user;
		$uid = (isset($_GET['user_id'])) ? $_GET['user_id'] : $current_user->ID;
	endif;
	return WP_CONTENT_URL."/cpc-pro-content/members/".$uid."/avatar/";
}

/**
 * user_avatar_add_photo function.
 * The content inside the iframe 
 * Description: Creating panels for the different steps users take to upload a file and checking their uploads.
 * @access public
 * @return void
 */
function user_avatar_add_photo() {
    global $current_user;

    if(($_GET['uid'] == $current_user->ID || current_user_can('edit_users')) && is_numeric($_GET['uid'])) {
        $uid = $_GET['uid'];

        // Prüfe, ob das Modal (iframe) geladen wird
        if (isset($_GET['modal']) && $_GET['modal'] == 1) {
            // NUR das Formular ausgeben, KEIN komplettes HTML-Dokument!
            switch($_GET['step']) {
                case 1: user_avatar_add_photo_step1($uid); break;
                case 2: user_avatar_add_photo_step2($uid); break;
                case 3: user_avatar_add_photo_step3($uid); break;
            }
        } else {
            // Standard: komplettes HTML-Dokument (z.B. für Direktaufruf)
            ?><!DOCTYPE html>
            <html xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
            <head>
            <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
            <title><?php bloginfo('name') ?> &rsaquo; <?php _e('Uploads'); ?> &#8212; <?php _e('WordPress'); ?></title>
            <?php do_action('user_avatar_iframe_head'); ?>
            </head>
            <body>
            <?php
            switch($_GET['step']) {
                case 1: user_avatar_add_photo_step1($uid); break;
                case 2: user_avatar_add_photo_step2($uid); break;
                case 3: user_avatar_add_photo_step3($uid); break;
            }
            ?>
            </body>
            </html>
            <?php
        }
        die();
    } else {
        wp_die(__("Du darfst das nicht.", CPC2_TEXT_DOMAIN));
    }
}

/**
 * user_avatar_add_photo_step1 function.
 * The First Step in the process 
 * Description: Displays the users photo and they can choose to upload another if they please.
 * @access public
 * @param mixed $uid
 * @return void
 */
function user_avatar_add_photo_step1($uid)
{
    $values = cpc_get_shortcode_options('cpc_avatar');
    $upload_prompt = cpc_get_shortcode_value($values, 'cpc_avatar-upload_prompt', __('Wähle ein Bild von Deinem Computer:', CPC2_TEXT_DOMAIN));
    $upload_button = cpc_get_shortcode_value($values, 'cpc_avatar-upload_button', __('Hochladen', CPC2_TEXT_DOMAIN));
	?>
	<p id="step1-image" >
	<?php
	echo user_avatar_get_avatar( $uid , 150);
	?>
	</p>
	<div id="user-avatar-step1">
	<form enctype="multipart/form-data" id="uploadForm" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>?action=user_avatar_add_photo&step=2&uid=<?php echo $uid; ?>" >
		<div style="font-size:1.2em"><?php echo $upload_prompt; ?></div><br /><input title="Wähle ein Bild" type="file" id="upload" name="uploadedfile" />

		<?php wp_nonce_field('user-avatar') ?>
		<p class="submit"><input type="submit" class="cpc_button btn btn-primary" value="<?php echo $upload_button; ?>" /></p>
	</form>
	</div>
	
	<?php
}

/**
 * user_avatar_add_photo_step2 function.
 * The Second Step in the process 
 * Description: Takes the uploaded photo and saves it to database.
 * @access public
 * @access public
 * @param mixed $uid
 * @return void
 */
function user_avatar_add_photo_step2($uid) {
	
		if (!(($_FILES["uploadedfile"]["type"] == "image/gif") || ($_FILES["uploadedfile"]["type"] == "image/jpeg") || ($_FILES["uploadedfile"]["type"] == "image/png") || ($_FILES["uploadedfile"]["type"] == "image/pjpeg") || ($_FILES["uploadedfile"]["type"] == "image/x-png"))){
			echo "<div class='error'><p>".__("Bitte lade eine Bilddatei hoch (.jpeg, .gif, .png).", CPC2_TEXT_DOMAIN)."</p></div>";
			user_avatar_add_photo_step1($uid);
			die();
		}

        // check file size
        $file_size = $_FILES["uploadedfile"]["size"];
        $file_size = $file_size / 1024; // KB
        if ($file_size > 5120): // 5 MB Limit
            echo "<div class='error'><p>".sprintf(__("Bitte lade eine Bilddatei mit weniger als 5 MB hoch (Deine war %dKB).", CPC2_TEXT_DOMAIN), $file_size)."</p></div>";
            die();
        else:
            $overrides = array('test_form' => false);
            $file = wp_handle_upload($_FILES['uploadedfile'], $overrides);

            if ( isset($file['error']) ){
                die( $file['error'] );
            }

            $url = $file['url'];
            $type = $file['type'];
            $file = $file['file'];
            $filename = basename($file);

            set_transient( 'avatar_file_'.$uid, $file, 60 * 60 * 5 );
            // Construct the object array
            $object = array(
            'post_title' => $filename,
            'post_content' => $url,
            'post_mime_type' => $type,
            'guid' => $url);

            // Save the data
            list($width, $height, $type, $attr) = getimagesize( $file );

            if ( $width > 420 ) {
                $oitar = $width / 420;
                $image = wp_crop_image($file, 0, 0, $width, $height, 420, $height / $oitar, false, str_replace(basename($file), 'midsize-'.basename($file), $file));


                $url = str_replace(basename($url), basename($image), $url);
                $width = $width / $oitar;
                $height = $height / $oitar;
            } else {
                $oitar = 1;
            }
            ?>
            <form id="iframe-crop-form" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>?action=user_avatar_add_photo&step=3&uid=<?php echo esc_attr($uid); ?>">

            <div id="testWrap">
            <img src="<?php echo $url; ?>" id="upload" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" />
            </div>
            <div id="user-avatar-preview">
            <h4>Preview</h4>
            <div id="preview" style="width: <?php echo USER_AVATAR_FULL_WIDTH; ?>px; height: <?php echo USER_AVATAR_FULL_HEIGHT; ?>px; overflow: hidden;">
            <img src="<?php echo esc_url_raw($url); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo $height; ?>">
            </div>
            <p class="submit" >
            <input type="hidden" name="x1" id="x1" value="0" />
            <input type="hidden" name="y1" id="y1" value="0" />
            <input type="hidden" name="x2" id="x2" />
            <input type="hidden" name="y2" id="y2" />
            <input type="hidden" name="width" id="width" value="<?php echo esc_attr($width) ?>" />
            <input type="hidden" name="height" id="height" value="<?php echo esc_attr($height) ?>" />

            <input type="hidden" name="oitar" id="oitar" value="<?php echo esc_attr($oitar); ?>" />
            <?php wp_nonce_field('user-avatar'); ?>
            </p>
            <input type="submit" class="cpc_button btn btn-primary" style="margin-left:0;" id="user-avatar-crop-button" value="<?php esc_attr_e('Bild zuschneiden', CPC2_TEXT_DOMAIN); ?>" />
            </div>
            </form>
			
			<?php
			// imgAreaSelect und jQuery im Modal/iframe einbinden:
			echo '<link rel="stylesheet" href="' . includes_url('js/imgareaselect/imgareaselect.css') . '" type="text/css" />';
			echo '<script src="' . includes_url('js/jquery/jquery.js') . '"></script>';
			echo '<script src="' . includes_url('js/imgareaselect/jquery.imgareaselect.js') . '"></script>';
			?>
            <script type="text/javascript">


        jQuery(document).ready(function() {
            var xinit = <?php echo USER_AVATAR_FULL_WIDTH; ?>;
            var yinit = <?php echo USER_AVATAR_FULL_HEIGHT; ?>;
            var ratio = xinit / yinit;
            var ximg = jQuery('img#upload').width();
            var yimg = jQuery('img#upload').height();

            if ( yimg < yinit || ximg < xinit ) {
                if ( ximg / yimg > ratio ) {
                    yinit = yimg;
                    xinit = yinit * ratio;
                } else {
                    xinit = ximg;
                    yinit = xinit / ratio;
                }
            }

            jQuery('img#upload').imgAreaSelect({
                handles: true,
                keys: true,
                aspectRatio: xinit + ':' + yinit,
                show: true,
                x1: 0,
                y1: 0,
                x2: xinit,
                y2: yinit,
                //maxHeight: <?php echo USER_AVATAR_FULL_HEIGHT; ?>,
                //maxWidth: <?php echo USER_AVATAR_FULL_WIDTH; ?>,
                onInit: function () {
                    jQuery('#width').val(xinit);
                    jQuery('#height').val(yinit);
                },
                onSelectChange: function(img, c) {
                    jQuery('#x1').val(c.x1);
                    jQuery('#y1').val(c.y1);
                    jQuery('#width').val(c.width);
                    jQuery('#height').val(c.height);

                    if (!c.width || !c.height)
                        return;

                    var scaleX = <?php echo USER_AVATAR_FULL_WIDTH; ?> / c.width;
                    var scaleY = <?php echo USER_AVATAR_FULL_HEIGHT; ?> / c.height;

                    jQuery('#preview img').css({
                        width: Math.round(scaleX * <?php echo $width; ?>),
                        height: Math.round(scaleY * <?php echo $height; ?>),
                        marginLeft: -Math.round(scaleX * c.x1),
                        marginTop: -Math.round(scaleY * c.y1)
                    });

                }
            });
        });
    </script>
            <?php

    endif;
}
/**
 * user_avatar_add_photo_step3 function.
 * The Third Step in the Process
 * Description: Deletes previous uploaded picture and creates a new cropped image in its place. Updated user meta.
 * @access public
 * @param mixed $uid
 * @return void
 */
function user_avatar_add_photo_step3($uid)
{
	set_time_limit(3600); // increase script timeout to 60 minutes (3600 seconds)
    
    $values = cpc_get_shortcode_options('cpc_avatar');
    $upload = cpc_get_shortcode_value($values, 'cpc_avatar-uploaded', __('Avatar aktualisiert...', CPC2_TEXT_DOMAIN));

	if ( $_POST['oitar'] > 1 ) {
		$_POST['x1'] = $_POST['x1'] * $_POST['oitar'];
		$_POST['y1'] = $_POST['y1'] * $_POST['oitar'];
		$_POST['width'] = $_POST['width'] * $_POST['oitar'];
		$_POST['height'] = $_POST['height'] * $_POST['oitar'];
	}
	
	$original_file = get_transient( 'avatar_file_'.$uid );
					 delete_transient('avatar_file_'.$uid );
	if( !file_exists($original_file) ) {
		echo "<div class='error'><p>". __('Leider ist keine Datei verfügbar', CPC2_TEXT_DOMAIN)."</p></div>";
		return true;
	}

	$time_now = time();

	$cropped_full = user_avatar_core_avatar_upload_path($uid).$time_now."-cpcfull.jpg";
	$cropped_thumb = user_avatar_core_avatar_upload_path($uid).$time_now."-cpcthumb.jpg";

    // delete the previous files
    user_avatar_delete_files($uid);
    @mkdir(WP_CONTENT_DIR."/cpc-pro-content/members/".$uid."/avatar/", 0777 ,true);

    if (!class_exists('SimpleImage')) require_once('SimpleImage.php');

    // update the files 
    $img = $original_file;
        $image = new SimpleImage();
        $image->load($img);
        $image->crop($_POST['x1'], $_POST['y1'], $_POST['x1']+$_POST['width'], $_POST['y1']+$_POST['height']);
        $image->save($cropped_full);

    $img = $original_file;
        $image = new SimpleImage();
        $image->load($img);
        $image->crop($_POST['x1'], $_POST['y1'], $_POST['x1']+$_POST['width'], $_POST['y1']+$_POST['height']);
        $image->save($cropped_thumb);

	/* Remove the original */
	@unlink( $original_file );

	/* Update user's meta data for quick reference */
  	update_user_meta( $uid, 'cpc_com_avatar', "/cpc-pro-content/members/".$uid."/avatar/".$time_now."-cpcfull.jpg" );

	if ( is_wp_error( $cropped_full ) )
		wp_die( __( 'Bild konnte nicht verarbeitet werden. Bitte gehe zurück und versuche es erneut.' ), __( 'Bildverarbeitungsfehler' ) );		
	?>
	<script type="text/javascript">
        if (typeof user_avatar_refresh_image === 'function') {
            self.parent.user_avatar_refresh_image('<?php echo user_avatar_get_avatar($uid, 150); ?>');
            self.parent.add_remove_avatar_link();
        }
	</script>
	<div id="user-avatar-step3">
		<h3><?php echo $upload; ?></h3>
		<span style="float:left;">
		<?php
		echo user_avatar_get_avatar( $uid, 150);
		?>
		</span>
        <script type="text/javascript">
            window.top.location.reload();
        </script>        
        
	</div>
<?php	
}	
/**
 * user_avatar_delete_files function.
 * Description: Deletes the avatar files based on the user id.
 * @access public
 * @param mixed $uid
 * @return void
 */
function user_avatar_delete_files($uid)
{
	$avatar_folder_dir = user_avatar_core_avatar_upload_path($uid);
	if ( !file_exists( $avatar_folder_dir ) )
		return false;

	if ( is_dir( $avatar_folder_dir ) && $av_dir = opendir( $avatar_folder_dir ) ) {
		while ( false !== ( $avatar_file = readdir($av_dir) ) ) {
				@unlink( $avatar_folder_dir . '/' . $avatar_file );
		}
		closedir($av_dir);
	}

	@rmdir( $avatar_folder_dir );
	delete_user_meta( $uid, 'cpc_com_avatar' );

}

/**
 * Based on the 
 * user_avatar_core_fetch_avatar_filter()
 *
 * Description: Attempts to filter get_avatar function and let Word/BuddyPress have a go at  
 * 				finding an avatar that may have been uploaded locally.
 *
 * @global array $authordata
 * @param string $avatar The result of get_avatar from before-filter
 * @param int|string|object $user A user ID, email address, or comment object
 * @param int $size Size of the avatar image (thumb/full)
 * @param string $default URL to a default image to use if no avatar is available
 * @param string $alt Alternate text to use in image tag. Defaults to blank
 * @return <type>
 */
function user_avatar_fetch_avatar_filter( $avatar, $user, $size, $default, $alt ) {
	global $pagenow;
	
	//If user is on discussion page, return $avatar 
    if($pagenow == "options-discussion.php")
    	return $avatar;
    	
	// If passed an object, assume $user->user_id
	if ( is_object( $user ) )
		$id = $user->user_id;

	// If passed a number, assume it was a $user_id
	else if ( is_numeric( $user ) )
		$id = $user;


	// If passed a string and that string returns a user, get the $id
	else if ( is_string( $user ) && ( $user_by_email = get_user_by( 'email', $user ) ) )
		$id = $user_by_email->ID;


	// If somehow $id hasn't been assigned, return the result of get_avatar
	if ( empty( $id ) )
		return !empty( $avatar ) ? $avatar : $default;
		
	// check to see if there is a file that was uploaded by the user
	if( user_avatar_avatar_exists($id) ):
	
		$user_avatar = user_avatar_fetch_avatar( array( 'item_id' => $id, 'width' => $size, 'height' => $size, 'alt' => $alt ) );
		if($user_avatar)
			return $user_avatar;
		else
			return !empty( $avatar ) ? $avatar : $default;
	else:
		return !empty( $avatar ) ? $avatar : $default;
	endif;
	// for good measure 
	return !empty( $avatar ) ? $avatar : $default;

}

add_filter( 'get_avatar', 'user_avatar_fetch_avatar_filter', 10, 5 );

/**
 * user_avatar_core_fetch_avatar()
 *
 * Description: Fetches an avatar from a BuddyPress object. Supports user/group/blog as
 * 				default, but can be extended to include your own custom components too.
 *
 * @global object $current_blog
 * @param array $args Determine the output of this function
 * @return string Formatted HTML <img> element, or raw avatar URL based on $html arg
 */
function user_avatar_fetch_avatar( $args = '' ) {
	
	$defaults = array(
		'item_id'		=> false,
		'object'		=> "user",		// user/group/blog/custom type (if you use filters)
		'type'			=> 'thumb',		// thumb or full
		'avatar_dir'	=> false,		// Specify a custom avatar directory for your object
		'width'			=> false,		// Custom width (int)
		'height'		=> false,		// Custom height (int)
		'class'			=> '',			// Custom <img> class (string)
		'css_id'		=> false,		// Custom <img> ID (string)
		'alt'			=> '',	// Custom <img> alt (string)
		'email'			=> false,		// Pass the user email (for gravatar) to prevent querying the DB for it
		'no_grav'		=> false,		// If there is no avatar found, return false instead of a grav?
		'html'			=> true			// Wrap the return img URL in <img />
	);
	
	// Compare defaults to passed and extract
	$params = wp_parse_args( $args, $defaults );
	extract( $params, EXTR_SKIP );
    
	$avatar_folder_dir = user_avatar_core_avatar_upload_path($item_id);
	$avatar_folder_url = user_avatar_core_avatar_url($item_id);
	
	//if ($width > 100) $type = "full";
		
	$avatar_size = ( 'full' == $type ) ? '-cpcfull' : '-cpcthumb';

    $class .= " avatar ";
	$class .= " avatar-". $width ." ";
	$class .= " photo";
	
	if ( false === $alt)
		$safe_alt = '';
	else
		$safe_alt = esc_attr( $alt );
	
	
	// Add an identifying class to each item
	$class .= ' ' . $object . '-' . $item_id . '-avatar';

	// Set CSS ID if passed
	if ( !empty( $css_id ) )
		$css_id = " id=\"".esc_attr($css_id)."\"";
	
	// Set avatar width
	if ( $width )
		$html_width = "width:".esc_attr($width)."px !important;";
	else
		$html_width = ( 'thumb' == $type ) ? 'width:' . esc_attr(USER_AVATAR_THUMB_WIDTH) . 'px;' : 'width:' . esc_attr(USER_AVATAR_FULL_WIDTH) . 'px !important;';

	// Set avatar height
	if ( $height )
		$html_height = "height:".esc_attr($height)."px !important;";
	else
		$html_height = ( 'thumb' == $type ) ? 'height:"' . esc_attr(USER_AVATAR_THUMB_HEIGHT) . 'px;' : 'height:"' . esc_attr(USER_AVATAR_FULL_HEIGHT) . 'px !important;';
	

	if( $avatar_img = user_avatar_avatar_exists( $item_id, $avatar_size ) ):
    

		$avatar_url = content_url()."/cpc-pro-content/members/".$item_id."/avatar/".$avatar_img;
		if(function_exists('is_subdomain_install') && !is_subdomain_install())
			$avatar_url = content_url()."/cpc-pro-content/members/".$item_id."/avatar/".$avatar_img;

		// Return it wrapped in an <img> element
		if ( true === $html ) { // this helps validate stuff
			return '<img src="' . esc_url($avatar_url) . '" alt="' . esc_attr($alt) . '" class="' . esc_attr($class) . '"' . $css_id . ' style="'.$html_width . $html_height . '" />';
		// ...or only the URL
		} else {
			return  $avatar_url ;
		}
	else:
		return false;
	endif;
}
add_action("admin_init", "user_avatar_delete");
/**
 * user_avatar_delete function.
 * 
 * @access public
 * @return void
 */
function user_avatar_delete(){
		
		global $pagenow;
		
		$current_user = wp_get_current_user();
		
		// If user clicks the remove avatar button, in URL deleter_avatar=true
		if( isset($_GET['delete_avatar']) && wp_verify_nonce($_GET['_nononce'], 'user_avatar') && ( $_GET['u'] == $current_user->ID || current_user_can('edit_users')) )
		{
			$user_id = cpc_get_user_id();
			
			if(is_numeric($user_id))
				$user_id = "?user_id=".$user_id;
				
			user_avatar_delete_files($_GET['u']);
			wp_redirect(get_option('siteurl') . '/wp-admin/'.$pagenow.$user_id);
			
		}		
}
/**
 * user_avatar_form function.
 * Description: Creation and calling of appropriate functions on the overlay form. 
 * @access public
 * @param mixed $profile
 * @return void
 */
function user_avatar_form($profile)
{

	global $current_user;
	
	// Check if it is current user or super admin role
	if( $profile->ID == $current_user->ID || current_user_can('edit_user', $current_user->ID) || is_super_admin($current_user->ID) )
	{
		$avatar_folder_dir = user_avatar_core_avatar_upload_path($profile->ID);
	?>
	<h3><?php _e('Bild', CPC2_TEXT_DOMAIN); ?></h3>

	<div id="user-avatar-display" class="submitbox" >
	<p id="user-avatar-display-image"><?php echo user_avatar_get_avatar($profile->ID, 150); ?></p>
	<a id="user-avatar-link"
	class="button-secondary"
	data-psource-modal-open="user-avatar-modal"
	href="<?php echo admin_url('admin-ajax.php'); ?>?action=user_avatar_add_photo&step=1&uid=<?php echo $profile->ID; ?>&modal=1"
	title="<?php _e('Hochladen und Zuschneiden des anzuzeigenden Bildes', CPC2_TEXT_DOMAIN); ?>">
	<?php _e('Bild aktualisieren', CPC2_TEXT_DOMAIN); ?>
	</a>
	<dialog id="user-avatar-modal" class="psource-modal" style="width: 750px; max-width: 95vw;">
		<button class="psource-modal-close" aria-label="Schließen" style="float:right;">&times;</button>
		<iframe id="user-avatar-iframe" src="" width="720" height="450" style="border:0;width:100%;height:450px;"></iframe>
	</dialog>
	
	<?php 
		// Remove the User-Avatar button if there is no uploaded image
		
		if(isset($_GET['user_id'])):
			$remove_url = admin_url('user-edit.php')."?user_id=".$_GET['user_id']."&delete_avatar=true&_nononce=". wp_create_nonce('user_avatar')."&u=".$profile->ID;
		else:
			$remove_url = admin_url('profile.php')."?delete_avatar=true&_nononce=". wp_create_nonce('user_avatar')."&u=".$profile->ID;
		
		endif;
		if ( user_avatar_avatar_exists($profile->ID) ):?>

			<a id="user-avatar-remove" class="submitdelete deleteaction" href="<?php echo esc_url_raw($remove_url); ?>" title="<?php _e('Benutzer-Avatar-Bild entfernen', CPC2_TEXT_DOMAIN); ?>" ><?php _e('Entfernen', CPC2_TEXT_DOMAIN); ?></a>
			<?php
		endif;
	?>
	</div>
	<script type="text/javascript">
	function user_avatar_refresh_image(img){
	 jQuery('#user-avatar-display-image').html(img);
	}
	function add_remove_avatar_link(){
		if(!jQuery("#user-avatar-remove").is('a')){
			jQuery('#user-avatar-link').after(" <a href='<?php echo $remove_url; ?>' class='submitdelete'  id='user-avatar-remove' ><?php _e('Entfernen', CPC2_TEXT_DOMAIN); ?></a>")
		}
			
	
	}
	
	</script>
	<?php
	}
} 

/*-- HELPER FUNCTIONS --*/
/**
 * user_avatar_avatar_exists function.
 * 
 * @access public
 * @param mixed $id
 * @return void
 */
function user_avatar_avatar_exists($id, $type = "-cpcfull"){
	
	$avatar_folder_dir = user_avatar_core_avatar_upload_path($id);
	$return = false;
	
	if ( is_dir( $avatar_folder_dir ) && $av_dir = opendir( $avatar_folder_dir ) ) {

			// Stash files in an array once to check for one that matches
			$avatar_files = array();
			while ( false !== ( $avatar_file = readdir($av_dir) ) ) {
				// Only add files to the array (skip directories)
				if ( 2 < strlen( $avatar_file ) )
					$avatar_files[] = $avatar_file;
			}
			
			// Check for array
			if ( 0 < count( $avatar_files ) ) {
				// Check for current avatar
				if( is_array($avatar_files) ):
					foreach( $avatar_files as $key => $value ) {
						if(strpos($value, $type)):
							$return = $value;
						endif;
					}
				endif;
				
			}

		// Close the avatar directory
		closedir( $av_dir );

	}
	
	return $return;
}
/**
 * user_avatar_get_avatar function.
 * 
 * @access public
 * @param mixed $id
 * @param mixed $width
 * @return void
 */
function user_avatar_get_avatar($id,$width,$link=0,$type='full') {

    $ret = '';
    
	if ($id):

		if( user_avatar_avatar_exists($id) ):

			$user_avatar = user_avatar_fetch_avatar( array( 'item_id' => $id, 'width' => $width, 'height' => $width, 'type' => $type, 'alt' => '' ) );
			if($user_avatar):
				$ret = $user_avatar;
			else:
				$ret = '<img id="user-avatar-display-image" src="'.USER_AVATAR_DEFAULT.'" width="'.$width.' !important;" height="'.$width.' !important;" class="avatar" />';
			endif;
		else:
			// WordPress default avatar
			$ret = get_avatar($id, $width);
		endif;

		if ($link):
			if (function_exists('icl_link_to_element')):
				$icl_object_id = icl_object_id(get_option('cpccom_profile_page'), 'page', true);
				$url = get_permalink($icl_object_id);
				$html = '<a href="'.$url.cpc_query_mark($url).'user_id='.$id.'">';
			elseif (get_option('cpccom_profile_permalinks')):
				$url = get_page_link(get_option('cpccom_profile_page'));
				$html = '<a href="'.$url.cpc_query_mark($url).'user_id='.$id.'">';
			else:
				$url = get_page_link(get_option('cpccom_profile_page'));
				if ( cpc_using_permalinks() ):
					$user = get_user_by('id', $id);
					$html = '<a href="'.$url.urlencode($user->user_login).'">';
				else:
					$html = '<a href="'.$url.cpc_query_mark($url).'user_id='.$id.'">';
				endif;
			endif;
			$ret = $html . $ret . '</a>';
		endif;

	else:

		$ret = '<img src="'.plugins_url('/cp-community/avatar/images/mystery-man.jpg').'" width="'.$width.' !important;" height="'.$width.' !important;" class="avatar" />';

	endif;

    // Filter for any actions
    $ret = apply_filters( 'cpc_get_avatar_filter', $ret, $id );
    
    return $ret;
	
}

?>
