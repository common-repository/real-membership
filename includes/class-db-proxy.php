<?php
/**
 * Proxy for various db functions.
 *
 * The number of tables is still manageable.
 * Soon the magic method will take them all.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/includes
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership_Db_Proxy {
	private static $db;
	
	/**
	 * Inits the static db proxy class
	 *
	 * @since    0.1.0
	 */
	public static function init() {
		global $wpdb;
		self::$db = $wpdb;
	}

	/**
	 * Gets table name with WP & RM prefixes
	 *
	 * @since    0.1.0
	 */
	public static function get_plans_table() {
		return self::$db->prefix . REAL_MEMBERSHIP_DB_PREFIX . 'plans';
	}

	/**
	 * Gets table name with WP & RM prefixes
	 *
	 * @since    0.1.0
	 */
	public static function get_user_memberships_table() {
		return self::$db->prefix . REAL_MEMBERSHIP_DB_PREFIX . 'user_memberships';
	}

	/**
	 * Gets table name with WP & RM prefixes
	 *
	 * @since    0.1.0
	 */
	public static function get_snapshot_table() {
		return self::$db->prefix . REAL_MEMBERSHIP_DB_PREFIX . 'snapshot';
	}

	/**
	 * Gets table name with WP & RM prefixes
	 *
	 * @since    0.1.0
	 */
	public static function get_currencies_table() {
		return self::$db->prefix . REAL_MEMBERSHIP_DB_PREFIX . 'currencies';
	}
}
