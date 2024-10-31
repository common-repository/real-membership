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

class Real_Membership_Admin_Plans {
	/**
	 * Render page
	 *
	 * @since    0.1.0
	 */
	public static function render($action = 'show', $subaction = '') {
		switch($action) {
			case 'show':
				self::show();
				break;

			case 'add':
				self::add($subaction);
				break;

			case 'edit':
				self::edit($subaction);
				break;

			case 'delete':
				self::delete(intval($_REQUEST['id']));
				break;

			default:
				self::show();
				break;
		}
	}

	/**
	 * Listing page
	 *
	 * @since    0.1.0
	 */
	private static function show() {
		$users = get_users();
		
		// Get list of plans
		$plans = Real_Membership_Data_Plans::get_all();
		
		// Get default currency
		$default_currency = Real_Membership_Data_Currencies::get_default();
		
		// Load main screen
		require_once( REAL_MEMBERSHIP_ADMIN_PAGES_PATH . 'plans.php' );
	}

	/**
	 * Add page
	 *
	 * @since    0.1.0
	 *
	 * @param string $subaction (optional) If passed triggers save operation
	 *
	 */
	private static function add($subaction) {
		$user = wp_get_current_user();

		if($subaction == 'save') {
			// Validation
			$gump 	= new GUMP_Extended();
			$_POST 	= $gump->sanitize($_POST);
			
			$gump->validation_rules(array(
				'name'		=> 'required|alpha_numeric|max_len,100|min_len,1',
				'base_price'	=> 'required|float',
				// 'plan_color'	=> 'required|color',

				'duration'		=> 'required|integer',
				'duration_type'	=> 'required|alpha',
			));
			$gump->filter_rules(array(
				'name'			=> 'trim|sanitize_string',
				'plan_color'	=> 'trim',
				
				'teaser'		=> 'trim|sanitize_string',
				'description'	=> 'trim|sanitize_string',
				'private_notes'	=> 'trim|sanitize_string',
			));
			$validated_data = $gump->run($_POST);

			if(is_array($validated_data)) {
				// Add plan to db
				$result = Real_Membership_Data_Plans::insert($validated_data);

				if($result === false) {
					$notice = Real_Membership_Notices::get_notice('error', _('Cannot insert plan in database.'));
				} else {

					// Insert successful .. redirect to show all plans
					self::show();
					return;

				}
			} else { // Error
				$notice = Real_Membership_Notices::get_notice('error', implode( '<br>', $gump->get_readable_errors() ));
			}
		}

		$addPage = true;
		require_once( REAL_MEMBERSHIP_ADMIN_PAGES_PATH . 'add-edit-plan.php' );
	}

	/**
	 * Edit page
	 *
	 * @since    0.1.0
	 *
	 * @param string $subaction (optional) If passed triggers save operation
	 *
	 */
	private static function edit($subaction) {
		$user = wp_get_current_user();

		// Missing id ... nothing to edit
		if(!isset($_REQUEST['id'])) {
			self::show();
			return;
		}

		// Get plan data from db
		$plan_id = (int)$_REQUEST['id'];
		$plan_data = Real_Membership_Data_Plans::get($plan_id);

		// No plan for this id
		if(!is_array($plan_data)) {
			self::show();
			die();
		}

		if($subaction == 'save') {
			// Validation
			$gump 	= new GUMP_Extended();
			$_POST 	= $gump->sanitize($_POST);

			$gump->validation_rules(array(
				'name'			=> 'required|alpha_numeric|max_len,100|min_len,1',
				'base_price'	=> 'required|float',
				// 'plan_color'	=> 'required|color',

				'duration'		=> 'required|integer',
				'duration_type'	=> 'required|alpha',
			));
			$gump->filter_rules(array(
				'name'			=> 'trim|sanitize_string',
				'plan_color'	=> 'trim',

				'teaser'		=> 'trim|sanitize_string',
				'description'	=> 'trim|sanitize_string',
				'private_notes'	=> 'trim|sanitize_string',
			));
			$validated_data = $gump->run($_POST);

			if(is_array($validated_data)) {
				// Add plan to db
				$result = Real_Membership_Data_Plans::update($plan_id, $validated_data);

				if($result === false) {
					$notice = Real_Membership_Notices::get_notice('error', _('Cannot update plan in database.'));
				} else {

					// Insert successful .. redirect to show all plans
					self::show();
					return;

				}
			} else { // Error
				$notice = Real_Membership_Notices::get_notice('error', implode( '<br>', $gump->get_readable_errors() ));
			}
		}

		$editPage = true;
		require_once( REAL_MEMBERSHIP_ADMIN_PAGES_PATH . 'add-edit-plan.php' );
	}

	/**
	 * Delete
	 *
	 * @since    0.1.0
	 *
	 * @param int $plan_id
	 *
	 */
	private static function delete($plan_id) {
		$plan_id = intval($plan_id);
		Real_Membership_Data_Plans::delete( $plan_id );

		// Call recursively
		self::render();
	}
}