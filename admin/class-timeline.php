<?php
/**
 * The Plans screen of the plugin. In progress.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/admin
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership_Admin_Timeline {
	/**
	 * Render page
	 *
	 * @since    0.1.0
	 */
	public static function render($action = 'show') {
		self::show();
	}

	private static function show() {
		$users = get_users();
		// Load main screen
		require_once( REAL_MEMBERSHIP_ADMIN_PAGES_PATH . 'timeline.php' );
	}
}