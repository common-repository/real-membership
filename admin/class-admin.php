<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/admin
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership_Admin {

	/**
	 * Constructor
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		add_action('admin_init', array(&$this, 'admin_init'));
		add_action('admin_menu', array(&$this, 'admin_menu'));
	}

    /**
     * Called when WP admin_init is called.
	 *
	 * @since 0.1.0
     */
	public function admin_init() {
		$this->enqueue_styles();
		$this->enqueue_scripts();
	}

    /**
     * Called when WP admin_menu is called.
	 *
	 * @since 0.1.0
     */
	public function admin_menu() {
		// add_action('admin_menu', array('PIIv2Admin', 'admin_menu'), 5); # Priority 5, so it's called before Jetpack's admin_menu.

		/*
		 * # Required:
		 * @param page_title 	The text to be displayed in the title tags of the page when the menu is selected.
		 * @param menu_title 	The text to be used for the menu.
		 * @param capability 	The capability required for this menu to be displayed to the user.
		 * @param menu_slug 	The slug name to refer to this menu by (should be unique for this menu).
		 *
		 * # Optional:
		 * @param function 		The function to be called to output the content for this page.
		 * @param icon_url 		The URL to the icon to be used for this menu. 
		 * @param position 		The position in the menu order this one should appear.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_menu_page/
		*/
		add_menu_page('Real Membership', 'Real Membership', 'manage_options', 'real_membership_dashboard', array($this, 'load_page'), 'dashicons-groups');

		$submenu_pages = array(
			array(
				'real_membership_dashboard',
				'',
				'Plans',
				'manage_options',
				'real_membership_plans',
				array($this, 'load_page'),
				null,
			),
			array(
				'real_membership_dashboard',
				'',
				'User Memberships',
				'manage_options',
				'real_membership_user_memberships',
				array($this, 'load_page'),
				null,
			),
			// @todo Activate timeline
			// array(
				// 'real_membership_dashboard',
				// '',
				// 'Timeline',
				// 'manage_options',
				// 'real_membership_timeline',
				// array($this, 'load_page'),
				// null,
			// ),
			array(
				'real_membership_dashboard',
				'',
				'Settings',
				'manage_options',
				'real_membership_settings',
				array($this, 'load_page'),
				null,
			),
		);

		if( count($submenu_pages) )
			foreach($submenu_pages as $submenu_page) {
				// Add submenu page
				/*
				 *
				 * # Required:
				 * @param parent_slug 	The slug name for the parent menu (or the file name of a standard WordPress admin page).
				 * @param page_title	The text to be displayed in the title tags of the page when the menu is selected.
				 * @param menu_title	The text to be used for the menu.
				 * @param capability	The capability required for this menu to be displayed to the user.
				 * @param menu_slug		The slug name to refer to this menu by (should be unique for this menu).
				 *
				 * # Optional:
				 * @param function		The function to be called to output the content for this page.
				 *
				 * @link https://developer.wordpress.org/reference/functions/add_submenu_page/
				*/
				$admin_page = add_submenu_page($submenu_page[0], $submenu_page[2], $submenu_page[2], $submenu_page[3], $submenu_page[4], $submenu_page[5]);
			}
	}

	/**
     * Called when a page request from admin_menu is made.
	 *
	 * @since 0.1.0
     */
	public function load_page() {
		$action 	= isset($_REQUEST['action']) 	? sanitize_key($_REQUEST['action']) : '';
		$subaction 	= isset($_REQUEST['subaction']) ? sanitize_key($_REQUEST['subaction']) : '';
	
		switch( sanitize_key($_GET['page']) ) {
			case 'real_membership_dashboard':
				Real_Membership_Admin_Dashboard::render();
				break;
			case 'real_membership_plans':
				Real_Membership_Admin_Plans::render($action, $subaction);
				break;
			case 'real_membership_user_memberships':
				Real_Membership_Admin_User_Memberships::render($action, $subaction);
				break;
			// case 'real_membership_timeline':
				// Real_Membership_Admin_Timeline::render($action);
				// break;
			case 'real_membership_settings':
				Real_Membership_Admin_Settings::render($action);
				break;

			default:
				Real_Membership_Admin_Dashboard::render();
				break;
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style('jquery-ui-css', plugin_dir_url( __FILE__ ) . 'jqueryui/1.8.2/themes/smoothness/jquery-ui.css', array(), REAL_MEMBERSHIP_VERSION, 'all' );
		wp_enqueue_style( REAL_MEMBERSHIP_NAME, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), REAL_MEMBERSHIP_VERSION, 'all' );
	}

	/**
	 * Register the js files for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script( REAL_MEMBERSHIP_NAME, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery', 'wp-color-picker' ), REAL_MEMBERSHIP_VERSION, false );
	}

}
