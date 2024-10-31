<?php
/**
 * Utility for displaying notices.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/includes/utils/
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership_Notices {
	
	/**
	 * Generates WP style notices
	 *
	 * @param array $notice_type Can be one of the following - info, success, warning, error. Default is error
	 * @param string $notice The actual user message
	 * @param bool $is_dismissable If true the notice can be closed by the user
	 *
	 * @since    0.1.0
	 */
	public static function get_notice($notice_type, $notice, $is_dismissable = false) {
		if($notice == '') return '';
	
		if(!in_array($notice_type, array('info', 'success', 'warning', 'error')))
			$notice_type = 'error';
		
		return self::get_notice_html($notice_type, $notice, $is_dismissable);
	}
	
	/**
	 * Generates the actual html for the WP style notices.
	 *
	 * @param array $notice_type Can be one of the following values - info, success, warning, error
	 * @param string $notice The actual user message
	 * @param bool $is_dismissable If true the notice can be closed by the user
	 *
	 * @since    0.1.0
	 */
	private static function get_notice_html($notice_type, $notice, $is_dismissable = false) {
		$class_is_dismissable = $is_dismissable ? 'is-dismissible' : '';

		$template  = "<div class='notice notice-{$notice_type} {$class_is_dismissable}'>";
		$template .= "<p>" . $notice . "</p>";
		$template .= "</div>";

		return $template;		
	}
}
