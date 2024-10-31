<?php
/**
 * The Plans screen of the plugin.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/admin
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */

class Real_Membership_Admin_Settings {
	/**
	 * Render page
	 *
	 * @since    0.1.0
	 */
	public static function render($action = '') {
		if( $action == 'save' ) {
			if( filter_has_var(INPUT_POST, 'default_currency') ) {
				Real_Membership_Data_Currencies::set_default( sanitize_key($_REQUEST['default_currency']) );

				$notice = Real_Membership_Notices::get_notice('success', __('Settings saved.', 'real-membership'));
			} else {
				$notice = Real_Membership_Notices::get_notice('error', __('Settings saved.', 'real-membership'));
			}
		}
		$currencies = Real_Membership_Data_Currencies::get_all();

		require_once( REAL_MEMBERSHIP_ADMIN_PAGES_PATH . 'settings.php' );
	}
}