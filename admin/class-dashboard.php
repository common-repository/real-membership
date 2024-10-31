<?php
/**
 * The dashboard of the plugin.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/admin
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */

class Real_Membership_Admin_Dashboard {
	/**
	 * Render page
	 *
	 * @since    0.1.0
	 */
	public static function render() {
		require_once( REAL_MEMBERSHIP_ADMIN_PAGES_PATH . 'dashboard.php' );
	}
}