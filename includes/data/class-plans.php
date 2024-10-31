<?php
/**
 * Proxy for various plans queries.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/includes/data
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership_Data_Plans {

	/**
	 * Returns array of all plans
	 *
	 * @since    0.1.0
	 *
	 * @return array Array of all plans. Each plan is a separate object.
	 */
	public static function get_all($columns = '*', $where = '1') {
		global $wpdb;
		$plans_table = Real_Membership_Db_Proxy::get_plans_table();
		
		if(is_array($columns))
			$columns = implode(',', $columns);
		
		$plans_sql = "	SELECT 	$columns
						FROM 	$plans_table
						WHERE 	$where";
		$plans = $wpdb->get_results( $plans_sql, OBJECT_K );
		
		return $plans;		
	}

	/**
	 * Returns 1 plan as array
	 *
	 * @since    0.1.0
	 *
	 * @param int $plan_id The plan id
	 * @return array 1 plan as array
	 */
	public static function get($plan_id) {
		global $wpdb;
	
		$plan_sql  = " SELECT * FROM " . Real_Membership_Db_Proxy::get_plans_table();
		$plan_sql .= " WHERE id = $plan_id";
		
		// @todo Convert ARRAY_A to OBJECT
		$plan = $wpdb->get_row( $plan_sql, ARRAY_A );
		return $plan;
	}		
	
	/**
	 * Inserts the plan into the database
	 *
	 * @since    0.1.0
	 *
	 * @param array $data The plan data
	 * @return void
	 */
	public static function insert($data) {
		global $wpdb;
		
		// Set created by
		$user = wp_get_current_user();
		$data['created_by'] = $user->ID;

		// Set date created
		// false is blog's local time. true returns UTC/GMT.
		$data['date_created'] = current_time('mysql', REAL_MEMBERSHIP_CURRENT_TIME);

		return $wpdb->insert(
			Real_Membership_Db_Proxy::get_plans_table(), 
			array( 
				'name' 			=> $data['name'],
				'is_active' 	=> isset($data['is_active']) ? 1 : 0,
				'base_price' 	=> $data['base_price'],
				'color' 		=> str_replace('#', '', $data['plan_color']),

				'duration' 		=> $data['duration'],
				'duration_type' => $data['duration_type'],

				'created_by' 	=> $data['created_by'],
				'date_created'	=> $data['date_created'],

				'teaser' 		=> $data['teaser'],
				'description' 	=> $data['description'],
				'private_notes' => $data['private_notes'],
			), 
			array(
				'%s', '%d', '%f', '%s',
				'%d', '%s',
				'%d', '%s',
				'%s', '%s', '%s',
			)
		);
	}
	
	/**
	 * Updates the plan into the database
	 *
	 * @since    0.1.0
	 *
	 * @param int $plan_id The plan id
	 * @param array $data The plan data
	 * @return void
	 */
	public static function update($plan_id, $data) {
		global $wpdb;
		
		return $wpdb->update(
			Real_Membership_Db_Proxy::get_plans_table(), 
			array( 
				'name' 			=> $data['name'],
				'is_active' 	=> isset($data['is_active']) ? 1 : 0,
				'base_price' 	=> $data['base_price'],
				'color' 		=> str_replace('#', '', $data['plan_color']),

				'duration' 		=> $data['duration'],
				'duration_type' => $data['duration_type'],

				'teaser' 		=> $data['teaser'],
				'description' 	=> $data['description'],
				'private_notes' => $data['private_notes'],
			),
			array(
				'id'			=> $plan_id
			),
			array(
				'%s', '%d', '%f', '%s',
				'%d', '%s',
				'%s', '%s', '%s',
			)
		);
	}

	/**
	 * Deletes the plan from the database
	 *
	 * @since    0.1.0
	 *
	 * @param int $plan_id
	 *
	 */
	public static function delete($plan_id) {
		global $wpdb;
		$plans_table = Real_Membership_Db_Proxy::get_plans_table();

		$wpdb->query("DELETE FROM $plans_table WHERE id = $plan_id");
	}
}