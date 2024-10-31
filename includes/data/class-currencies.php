<?php
/**
 * Proxy for currencies db queries.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/includes/data
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership_Data_Currencies {

	/**
	 * Returns list of all currencies
	 *
	 * @return array Currencies array
	 *
	 * @since    0.1.0
	 */
	public static function get_all() {
		global $wpdb;
		
		$currencies_sql = ' SELECT * FROM ' . Real_Membership_Db_Proxy::get_currencies_table();
		$currencies = $wpdb->get_results( $currencies_sql, OBJECT_K );
		
		return $currencies;		
	}

	/**
	 * Returns the default currency
	 *
	 * @return object Default currency object
	 *
	 * @since    0.1.0
	 */
	public static function get_default() {
		global $wpdb;
	
		$currencies_sql  = " SELECT * FROM " . Real_Membership_Db_Proxy::get_currencies_table();
		$currencies_sql .= " WHERE is_default = 1";
		
		$default_currency = $wpdb->get_row( $currencies_sql );
		return $default_currency;		
	}
	
	/**
	 * Sets the default currency
	 *
	 * @param string $iso The iso code for the specific currency
	 * @return void
	 *
	 * @since    0.1.0
	 */
	public static function set_default($iso) {
		global $wpdb;
		$table 	= Real_Membership_Db_Proxy::get_currencies_table();

		// Reset default currency
		$wpdb->query(" UPDATE $table SET is_default = 0");

		// Set new default currency
		$data 	= array('is_default' => 1);
		$where 	= array('iso' => $iso);
		$wpdb->update( $table, $data, $where );
	}
}