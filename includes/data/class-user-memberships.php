<?php
/**
 * Proxy for various membership queries.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/includes/data
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership_Data_User_Memberships {

	/**
	 * Returns array of all memberships
	 *
	 * @since    0.1.0
	 *
	 * @return array Array of all memberships. Each membership is a separate object.
	 */
	public static function get_all($columns = array('memberships.*', 'plans.name', 'users.*'), $where = '1') {
		global $wpdb;
		$dbPrefix = $wpdb->prefix;

		$user_memberships_table = Real_Membership_Db_Proxy::get_user_memberships_table();
		$plans_table = Real_Membership_Db_Proxy::get_plans_table();
		
		if(is_array($columns))
			$columns = implode(',', $columns);

		$user_memberships_sql = "	SELECT 	$columns
									FROM 	$user_memberships_table AS memberships
									
									INNER JOIN $plans_table AS plans
									ON memberships.plan_id = plans.id
									
									INNER JOIN {$wpdb->users} AS users
									ON memberships.user_id = users.ID
									
									WHERE $where";
		$user_memberships = $wpdb->get_results( $user_memberships_sql, OBJECT );
		
		// Compute expiration date
		$user_memberships = self::set_expiration_date($user_memberships);
		
		return $user_memberships;
	}

	/**
	 * Returns 1 membership as array
	 *
	 * @since    0.1.0
	 *
	 * @param int $membership_id The membership id
	 * @return array 1 membership as array
	 */
	public static function get($membership_id) {
		global $wpdb;
	
		$membership_sql  = " SELECT * FROM " . Real_Membership_Db_Proxy::get_user_memberships_table();
		$membership_sql .= " WHERE id = $membership_id";
		
		// @todo Convert ARRAY_A to OBJECT
		$membership = $wpdb->get_row( $membership_sql, ARRAY_A );
		return $membership;		
	}		

	/**
	 * Inserts the membership into the database
	 *
	 * @since    0.1.0
	 *
	 * @param array $data The membership data
	 * @return void
	 */
	public static function insert($data) {
		global $wpdb;
		$table 	= Real_Membership_Db_Proxy::get_user_memberships_table();
		
		// var_dump( $data );

		return $wpdb->insert(
			$table,
			array(
				'user_id'		=> $data['users'],
				'plan_id'		=> $data['base_plans'],
				'is_active' 	=> isset($data['is_active']) ? 1 : 0,
				
				'order_id'		=> 0,
				'start_date' 	=> $data['start_date'],
				
				'duration' 		=> $data['duration'],
				'duration_type'	=> $data['duration_type'],

				'private_notes' => $data['private_notes'],
			), 
			array(
				'%d', '%d', '%d',
				'%d', '%s',
				'%d', '%s',
				'%s',
			)
		);
	}

	/**
	 * Updates the membership into the database
	 *
	 * @since    0.1.0
	 *
	 * @param int $plan_id The membership id
	 * @param array $data The membership data
	 * @return void
	 */
	public static function update($membership_id, $data) {
		global $wpdb;
		$table 	= Real_Membership_Db_Proxy::get_user_memberships_table();
		
		return $wpdb->update(
			$table,
			array(
				'user_id'		=> $data['users'],
				'plan_id'		=> $data['base_plans'],
				'is_active' 	=> isset($data['is_active']) ? 1 : 0,
				
				'order_id'		=> 0,
				'start_date' 	=> $data['start_date'],
				
				'duration' 		=> $data['duration'],
				'duration_type'	=> $data['duration_type'],

				'private_notes' => $data['private_notes'],
			), 
			array(
				'id'			=> $membership_id
			),
			array(
				'%d', '%d', '%d',
				'%d', '%s',
				'%d', '%s',
				'%s',
			)
		);
	}

	/**
	 * Deletes the membership from the database
	 *
	 * @since    0.1.0
	 *
	 * @param int $membership_id
	 * @return void
	 *
	 */
	public static function delete($membership_id) {
		global $wpdb;
		$memberships_table = Real_Membership_Db_Proxy::get_user_memberships_table();

		$wpdb->query("DELETE FROM $memberships_table WHERE id = $membership_id");
	}

	/**
	 * Sets the expiration date of multiple memberships
	 *
	 * @since    0.1.0
	 *
	 * @param array $user_memberships Array of user memberships
	 * @return array Array of user memberships - with expiration date included
	 *
	 */
	private static function set_expiration_date($user_memberships) {
		// Compute expiration date
		foreach($user_memberships AS &$user_membership) {
			$expiration_date = new DateTime($user_membership->start_date);
			$expiration_date->modify("+{$user_membership->duration} {$user_membership->duration_type}");
			$user_membership->expires = $expiration_date;
		}
		
		return $user_memberships;		
	}
}