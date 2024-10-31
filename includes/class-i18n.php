<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/includes
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership_i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'real-membership',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
