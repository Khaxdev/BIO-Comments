<?php
/**
 * Plugin Name: BIO PCC
 * Description: Plugin control comments
 * Plugin URI: https://github.com/Khaxdev/BIO-Comments
 * Author: Khaxdev
 * Version: 1.0.0
 * Author URI: https://github.com/Khaxdev/
 *
 * Text Domain: BIO Comments
 *
 * @package BIO Comments
 *
 * FOR CONTROL YOUR COMMENTS AND CREATE A GOOD IMAGE FOR IU
 * GNU General Public License for more details.
 */

add_action('admin_menu', 'test_plugin_setup_menu');
 
function test_plugin_setup_menu(){
    add_menu_page( 'BIO Comments ', 'BIO Comments Edit', 'manage_options', 'bio-comments', 'bio_comments_menu' );
}
 
function bio_comments_menu(){
    echo "<h1>Hello World!</h1>";
}


register_activation_hook( __FILE__, 'bio_kxd_create_db' );
function bio_kxd_create_db() {

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'bio_comments';

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		views smallint(5) NOT NULL,
		clicks smallint(5) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

/**
 * ENQUEUE STYLES 
**/

function bio_kxd_style() {
    $plugin_url = plugin_dir_url( __FILE__ );

wp_enqueue_style( 'style',  $plugin_url . "/assets/css/style.css");
}

add_action( 'wp_enqueue_scripts', 'bio_kxd_style' );
/**
 * ADD SHORT CODE FOR FORM
**/

add_shortcode( "bio_form", "bio_display_init_form" );
function bio_display_init_form(){

    $USER_NAME = $_POST['name'];
    echo $USER_NAME;
    $USER_PASSWORD = $_POST['password'];
    echo $USER_PASSWORD;
    $USER_EMAIL = $_POST['email'];
    echo $USER_EMAIL;

    $form='
    <div class="bio-container">  
        <form id="bio-contact" action="" method="post">
        <h3>Colorlib bio-Contact Form</h3>
        <h4>bio-Contact us for custom quote</h4>
        <fieldset>
            <input name="name" placeholder="Your name" type="text" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
            <input name="password" placeholder="Your password" type="password" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
            <input name="email" placeholder="Your Email Address" type="email" tabindex="2" required>
        </fieldset>
        <fieldset>
            <button name="submit" type="submit" id="bio-contact-submit" data-submit="...Sending">Submit</button>
        </fieldset>
        <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a></p>
        </form>
    </div>
    ';

    return $form;
}