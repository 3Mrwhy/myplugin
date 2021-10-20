<?php 
/*
	@package myplugin
*/ 

/**
 * Plugin name: My plugin
 * Plugin uri: https://myplugin.com
 * Author: Developer
 * Author uri: https://author.com
 * Version: 1.0.0
 * Description: This is the just developing testing plugin
 * tags Plugin, wordpress plugin, get plugin
 * License: GPL 1.0.0
 * */ 

// proctect your plugin from direct accessing
defined('ABSPATH') or die("You can't access this file Silly human!");

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// include path
include PLUGIN_PATH."inc/metaboxes.php";
include PLUGIN_PATH."inc/custom-post-type.php";


// activation hook 
register_activation_hook( __FILE__, 'myplugin_register_activation_hook' );

function myplugin_register_activation_hook() {
	// add option to the table
	add_option( "myplugin_options_1", "" );
}

// deactivation hook
register_deactivation_hook( __FILE__, 'myplugin_register_deactivation_hook' );
function myplugin_register_deactivation_hook() {
	delete_option( "myplugin_options_1" );
}
// uninstall hook
// register_uninstall_hook()

// add_filter( 'the_title', 'myplugin_the_title' );
// function myplugin_the_title($title) {
	//return "<strong> {$title} </strong>";
// }
// 
// add css and js
add_action( 'wp_enqueue_scripts', 'myplugin_wp_enqeue_scripts' );
function myplugin_wp_enqeue_scripts() {
	// wp_enqueue_style
	wp_enqueue_style( 'myplugin-css-file', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
	
	// wp_enqueue_script
	wp_enqueue_script( 'myplugin-js-file', plugin_dir_url( __FILE__ ). 'assets/js/script.js', array(), false, true );
}


// add admin menu hook
add_action( 'admin_menu', 'myplugin_admin_menu' );
add_action( "admin_menu", "myplugin_process_form" );

function myplugin_process_form() {
	register_setting( "myplugin_option_group", "myplugin_option_name" );
	if(isset($_POST["action"]) && current_user_can("manage_options")) {
		update_option( 'myplugin_options_1', sanitize_text_field( $_POST[ "myplugin_options_1" ] ) );
	}
}

function myplugin_admin_menu() {
	// add_menu_page( page_title, menu_title, capability, menu_slug, function, icon_url, position )
	add_menu_page( 'My Plugin', 'My Plugin', "manage_options", "my-plugin-admin", 'myplugin_add_menu_page');

	// add_submenu_page( $parent_slug:string, $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $position:integer|null )
	add_submenu_page( "my-plugin-admin", "Genreal", "Genreal", "manage_options", "genreal", "myplugin_genreal_setting" );
	add_submenu_page( "my-plugin-admin", "Discussion", "Discussion", "manage_options", "discussion", "myplugin_discussion" );
	add_submenu_page( "my-plugin-admin", "Settings", "Settings", "manage_options", "Settings", "myplugin_settings" );
} 

function myplugin_add_menu_page() {
	?>
	<h1> My plugin options menu </h1>
	<?php settings_errors(); ?>
	<div class="wrap">
		<form action="options.php" method="post">
			<?php settings_fields( "myplugin_option_group" ); ?>
			<input type="text" name="myplugin_options_1" value="<?php echo esc_html(get_option('myplugin_options_1')); ?>">
			<?php submit_button( "Save changes" ); ?>
		</form>
	</div>
<?php }

function myplugin_genreal_setting() {
	echo "<h1> Genreal setting </h1>";
}

function myplugin_discussion() {
	echo "<h1> Discussion </h1>";
}

function myplugin_settings() {
	echo "<h1> Settings </h1>";
}
function myplugin_delete_page() {
	echo "This is the just delete page options";
}