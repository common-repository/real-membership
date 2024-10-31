<?php
/**
 * The Real Membership bootstrap file
 *
 * This file is used by WordPress to show the plugin info in the admin area.
 * This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://exigio.com
 * @since             0.1.0
 * @package           Real_Membership
 *
 * @wordpress-plugin
 * Plugin Name:       Real Membership
 * Plugin URI:        https://wordpress.org/plugins/real-membership/
 * Description:       Lite approach to WP members management.
 * Version:           0.1.0
 * Author:            Damyan Mirchev - Exigio Ltd.
 * Author URI:        http://exigio.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       real-membership
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if(!defined( 'WPINC' )) {
	die;
}

/**
 * Load defines & versions
 */
require_once('defined.php');
require_once('versions.php');

/**
 * Load external files
 */
 
/**
 * GUMP: For data validation & filtering - MIT License
 * @link https://github.com/Wixel/GUMP
 */
require "gump/gump.class.php"; 
require "gump/gump.extended.class.php";


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
function activate_real_membership() {
	require_once REAL_MEMBERSHIP_ROOT . 'includes/class-activator.php';
	
	$error_message = '';
	// Check if WP version is recent enough
	if(version_compare(get_bloginfo('version'), REAL_MEMBERSHIP_MINIMUM_WP_VERSION, '<') ) {
		// @todo Make the message translateable
		$error_message .= 'Error: Minimum WordPress version for Real Membership is ' . REAL_MEMBERSHIP_MINIMUM_WP_VERSION . '<br>';
	}   

	// Check if PHP version is recent enough
	if(version_compare(phpversion(), REAL_MEMBERSHIP_MINIMUM_PHP_VERSION, '<') ) {
		// @todo Make the message translateable
		$error_message .= 'Error: Minimum PHP version for Real Membership is ' . REAL_MEMBERSHIP_MINIMUM_PHP_VERSION . '<br>';
	}

	// If error message
	if($error_message != '') {
		error_log( $error_message );      
		$args = var_export( func_get_args(), true );
		error_log( $args );
		wp_die( $error_message );
	}
	
	Real_Membership_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 */
function deactivate_real_membership() {
	require_once REAL_MEMBERSHIP_ROOT . 'includes/class-deactivator.php';
	Real_Membership_Deactivator::deactivate();
}

/**
 * The code that runs during plugin deinstallation.
 * This action is documented in includes/class-uninstaller.php
 */
function uninstall_real_membership() {
	require_once REAL_MEMBERSHIP_ROOT . 'includes/class-uninstaller.php';
	Real_Membership_Uninstaller::uninstall();
}

register_activation_hook( 	__FILE__, 'activate_real_membership' 	);
register_deactivation_hook( __FILE__, 'deactivate_real_membership' 	);
register_uninstall_hook( 	__FILE__, 'uninstall_real_membership' 	);

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require REAL_MEMBERSHIP_ROOT . 'includes/class-real-membership.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function start_real_membership() {

	try {
		$real = new Real_Membership();
		$real->run();
	} catch(Exception $e) {
		echo 'Exception: ' . $e->getMessage();
	}
	
}

start_real_membership();
