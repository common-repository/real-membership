<?php
/**
 * Core plugin class
 *
 * This is used to define internationalization, admin-specific hooks, and public-facing site hooks.
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @link       http://exigio.com
 * @since      0.1.0
 *
 * @package    Real_Membership
 * @subpackage Real_Membership/includes
 * @author     Damyan Mirchev <d.mirchev@exigio.com>
 */
class Real_Membership {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.1.0
	 * @access   public
	 * @var      Real_Membership_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	static public $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Loads dependencies, defines the locale, and starts the frontend or backend.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {

		$this->load_dependencies();
		$this->set_locale();

		if(is_admin())
			$this->start_backend();
		else
			$this->start_frontend();

		Real_Membership_Db_Proxy::init();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function load_dependencies() {

		/*
		 * Core Clases.
		 */
		require_once REAL_MEMBERSHIP_INCLUDES_PATH . '/class-db-proxy.php'; // Db Proxy
		require_once REAL_MEMBERSHIP_INCLUDES_PATH . '/class-loader.php'; // Actions and filters
		require_once REAL_MEMBERSHIP_INCLUDES_PATH . '/class-i18n.php'; // Internationalization functionality

		/*
		 * UI Classes
		 */
		require_once REAL_MEMBERSHIP_UI_PATH . '/class-select-list.php'; // General select dropdown
		require_once REAL_MEMBERSHIP_UI_PATH . '/class-select-list-duration-type.php'; // Duration type dropdown
		require_once REAL_MEMBERSHIP_UI_PATH . '/class-select-list-users.php'; // Users dropdown
		require_once REAL_MEMBERSHIP_UI_PATH . '/class-select-list-plans.php'; // Plans dropdown

		/*
		 * Backend Classes
		 */
		if(is_admin()) {
			require_once REAL_MEMBERSHIP_ADMIN_PATH . '/class-admin.php'; // Admin class
			// Screens
			require_once REAL_MEMBERSHIP_ADMIN_PATH . '/class-dashboard.php';
			require_once REAL_MEMBERSHIP_ADMIN_PATH . '/class-plans.php';
			require_once REAL_MEMBERSHIP_ADMIN_PATH . '/class-user-memberships.php';
			require_once REAL_MEMBERSHIP_ADMIN_PATH . '/class-timeline.php';
			require_once REAL_MEMBERSHIP_ADMIN_PATH . '/class-settings.php';
		}

		/*
		 * Frontend Classes
		 */
		if(!is_admin()) {
			require_once REAL_MEMBERSHIP_FRONTEND_PATH . '/class-public.php'; // Frontend class
		}

		/*
		 * Utils Classes
		 */
		require_once REAL_MEMBERSHIP_UTILS_PATH . '/class-notices.php'; // Notices class

		/*
		 * Data Classes
		 */
		require_once REAL_MEMBERSHIP_DATA_PATH . '/class-currencies.php';
		require_once REAL_MEMBERSHIP_DATA_PATH . '/class-plans.php';
		require_once REAL_MEMBERSHIP_DATA_PATH . '/class-user-memberships.php';

		Real_Membership::$loader = new Real_Membership_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Real_Membership_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Real_Membership_i18n();

		Real_Membership::$loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Init the Admin class.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function start_backend() {
		$plugin_admin = new Real_Membership_Admin();
	}

	/**
	 * Init the Frontend class.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function start_frontend() {
		$plugin_frontend = new Real_Membership_Frontend();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function run() {
		Real_Membership::$loader->run();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.1.0
	 * @return    Real_Membership_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return Real_Membership::$loader;
	}
}
