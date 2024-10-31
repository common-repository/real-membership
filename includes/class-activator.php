<?php
/**
 * Fired during plugin activation
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/includes
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership_Activator {

	/**
	 * The main activation method.
	 *
	 * @since    0.1.0
	 */
	public static function activate() {
		self::create_table(Real_Membership_Db_Proxy::get_plans_table(), 				REAL_MEMBERSHIP_CREATE_PLANS_SQL);
		self::create_table(Real_Membership_Db_Proxy::get_user_memberships_table(), 	REAL_MEMBERSHIP_CREATE_USER_MEMBERSHIPS_SQL);
		self::create_table(Real_Membership_Db_Proxy::get_snapshot_table(), 			REAL_MEMBERSHIP_CREATE_SNAPSHOT_SQL);

		// Currency related
		self::create_table(Real_Membership_Db_Proxy::get_currencies_table(), 			REAL_MEMBERSHIP_CREATE_CURRENCIES_SQL);
		self::insert_currency_data();
	}
	
    /**
     * 
	 * Creates a db table based on table name and path to sql file.
     * 
     * @param string $table_name
     * @param string $sql_file
     * 
     * @return bool
     */
	private static function create_table($table_name, $sql_file) {
		global $wpdb;

		// Load sql file
		$create_sql  = file_get_contents( REAL_MEMBERSHIP_SQL_PATH . $sql_file);
	
		// Add DB collation
		$create_sql .= REAL_MEMBERSHIP_WHITESPACE . $wpdb->get_charset_collate();
		
		// Set table name
		$create_sql = str_replace('%%TABLE_NAME%%', $table_name, $create_sql);
		// die( $create_sql );

		$is_created = (bool) $wpdb->query( $create_sql );
		return $is_created;
	}

    /**
     * 
     * Inserts currency list into a dedicated currency table.
     * 
     * @return bool
     */
	private static function insert_currency_data() {
		global $wpdb;
		$currencies_table = Real_Membership_Db_Proxy::get_currencies_table();

		// Table missing - nothing to insert
		if ( $wpdb->get_var("SHOW TABLES LIKE '$currencies_table'") != $currencies_table )
			return;

		// Table already has records
		$count = $wpdb->get_var("SELECT COUNT(iso) FROM $currencies_table");
		if($count > 0) return;
		// @todo Here we should throw an exception

		// Load sql file
		$insert_sql = file_get_contents( REAL_MEMBERSHIP_SQL_PATH . REAL_MEMBERSHIP_INSERT_CURRENCIES_SQL);

		// Set table name
		$insert_sql = REAL_MEMBERSHIP_WHITESPACE . str_replace('%%TABLE_NAME%%', $currencies_table, $insert_sql);

		$is_inserted = (bool) $wpdb->query( $insert_sql );
		return $is_inserted;
	}
}
