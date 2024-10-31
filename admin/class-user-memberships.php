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

class Real_Membership_Admin_User_Memberships {
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
		
		// Get list of memberships
		$memberships = Real_Membership_Data_User_Memberships::get_all();

		// Load main screen
		require_once( REAL_MEMBERSHIP_ADMIN_PAGES_PATH . 'user-memberships.php' );
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
		$users = get_users();
		$user = wp_get_current_user();
		
		// Generate users dropdown
		$users_dropdown = new Real_Membership_Select_List_Users(isset($_REQUEST['users']) ? intval($_REQUEST['users']) : null);
		$users_dropdown_html = $users_dropdown->get_select_html();
		
		// Generate plans dropdown
		$plans_dropdown = new Real_Membership_Select_List_Plans(isset($_REQUEST['base_plans']) ? intval($_REQUEST['base_plans']) : null);
		$plans_dropdown_html = $plans_dropdown->get_select_html();

		if($subaction == 'save') {
			// Validation
			$gump 	= new GUMP_Extended();
			$_POST 	= $gump->sanitize($_POST);
			
			$gump->validation_rules(array(
				'users'			=> 'required|numeric',
				// 'is_active'		=> 'required|on or 1', // @todo Checkbox is hard to validate

				'start_date'		=> 'required|date', // ???
				'base_plans'		=> 'required|numeric',

				'duration'		=> 'required|numeric',
				'duration_type'	=> 'required|alpha',
			));
			$gump->filter_rules(array(
				'private_notes'		=> 'trim|sanitize_string',
			));		
			$validated_data = $gump->run($_POST);

			if(is_array($validated_data)) {
				// Add membership to db
				$result = Real_Membership_Data_User_Memberships::insert($validated_data);
				// $result = false;

				if($result === false) {
					$notice = Real_Membership_Notices::get_notice('error', _('Cannot insert membership in database.'));
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
		require_once( REAL_MEMBERSHIP_ADMIN_PAGES_PATH . 'add-edit-user-membership.php' );
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
		$users = get_users();
		$user = wp_get_current_user();	
		
		// Missing id ... nothing to edit
		if(!isset($_REQUEST['id'])) {
			self::show();
			return;
		}
		
		// Get plan data from db
		$membership_id = (int)$_REQUEST['id'];
		$membership_data = Real_Membership_Data_User_Memberships::get($membership_id);
		
		// No plan for this id
		if(!is_array($membership_data)) {
			self::show();
			die();
		}
		
		// Generate users dropdown
		$users_dropdown = new Real_Membership_Select_List_Users($membership_data['user_id']);
		$users_dropdown_html = $users_dropdown->get_select_html();
		
		// Generate plans dropdown
		$plans_dropdown = new Real_Membership_Select_List_Plans($membership_data['plan_id']);
		$plans_dropdown_html = $plans_dropdown->get_select_html();

		if($subaction == 'save') {
			// Validation
			$gump 	= new GUMP_Extended();
			$_POST 	= $gump->sanitize($_POST);
			
			$gump->validation_rules(array(
				'users'			=> 'required|numeric',
				// 'is_active'		=> 'required|on or 1', // @todo Checkbox is hard to validate

				'start_date'		=> 'required|date', // ???
				'base_plans'		=> 'required|numeric',

				'duration'		=> 'required|numeric',
				'duration_type'	=> 'required|alpha',
			));
			$gump->filter_rules(array(
				'private_notes'		=> 'trim|sanitize_string',
			));		
			$validated_data = $gump->run($_POST);

			if(is_array($validated_data)) {
				// Add membership to db
				$result = Real_Membership_Data_User_Memberships::update($membership_id, $validated_data);

				if($result === false) {
					$notice = Real_Membership_Notices::get_notice('error', _('Cannot insert membership in database.'));
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
		require_once( REAL_MEMBERSHIP_ADMIN_PAGES_PATH . 'add-edit-user-membership.php' );

	}

	/**
	 * Delete
	 *
	 * @since    0.1.0
	 *
	 * @param int $membership_id
	 *
	 */
	private static function delete($membership_id) {
		$membership_id = intval($membership_id);
		Real_Membership_Data_User_Memberships::delete( $membership_id );

		// Call recursively
		self::render();
	}
}