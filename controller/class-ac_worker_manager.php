<?php

namespace AwesomeCoder\Plugin\Controller;

use AwesomeCoder\Plugin\Backend\Ac_worker_manager_Backend;
use AwesomeCoder\Plugin\Frontend\Ac_worker_manager_Frontend;

/**
 * The file that defines the core plugin class
 *
 * A class definition that controller attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_worker_manager
 * @subpackage Ac_worker_manager/controller
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ac_worker_manager
 * @subpackage Ac_worker_manager/controller
 * @author     MD Ibrahim Kholil <awesomecoder.org@gmail.com>
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */

class Ac_worker_manager
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ac_worker_manager_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('AC_WORKER_MANAGER_VERSION')) {
			$this->version = AC_WORKER_MANAGER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'ac_worker_manager';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_backend_hooks();
		$this->define_frontend_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ac_worker_manager_Loader. Orchestrates the hooks of the plugin.
	 * - Ac_worker_manager_i18n. Defines internationalization functionality.
	 * - Ac_worker_manager_backend. Defines all hooks for the admin area.
	 * - Ac_worker_manager_frontend. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{
		/**
		 * The class responsible for orchestrating the main functionality of the
		 * core plugin.
		 */
		// require_once AC_WORKER_MANAGER_PATH . 'plugin.php';

		/**
		 * The class responsible for orchestrating the activate actions of the
		 * core plugin.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'controller/class-ac_worker_manager-activator.php';

		/**
		 * The class responsible for orchestrating the deactivate actions of the
		 * core plugin.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'controller/class-ac_worker_manager-deactivator.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'controller/class-ac_worker_manager-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'controller/class-ac_worker_manager-i18n.php';

		/**
		 * The class responsible for defining shortcode actions that occur in the public-facing
		 * side of the site.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'controller/class-ac_worker_manager-shortcode.php';

		/**
		 * The class responsible for defining shortcode actions that occur in the public-facing
		 * side of the site.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'controller/class-ac_worker_manager-duplicator.php';

		/**
		 * The class responsible for defining woocommerce functionality
		 * of the plugin.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'controller/class-ac_worker_manager-woocommerce.php';

		/**
		 * The class responsible for defining metabox functionality
		 * of the plugin.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'controller/class-ac_worker_manager-metabox.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'backend/class-ac_worker_manager-backend.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once AC_WORKER_MANAGER_PATH . 'frontend/class-ac_worker_manager-frontend.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		if (!function_exists('wp_get_current_user')) {
			require_once(ABSPATH . WPINC . '/pluggable.php');
		}

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		if (!class_exists('WP_List_Table')) {
			require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
		}

		$this->loader = new Ac_worker_manager_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ac_worker_manager_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Ac_worker_manager_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_backend_hooks()
	{

		$plugin_backend = new Ac_worker_manager_Backend($this->get_plugin_name(), $this->get_version());

		// load styles and scripts
		$this->loader->add_action('admin_enqueue_scripts', $plugin_backend, 'enqueue_styles', 99999999);
		$this->loader->add_action('admin_enqueue_scripts', $plugin_backend, 'enqueue_scripts', 99999999);

		// create menu
		$this->loader->add_action('admin_menu', $plugin_backend, 'admin_menu');
		// action hooks for ajax request
		$this->loader->add_action("wp_ajax_ac_worker_manager", $this, 'ajax');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_frontend_hooks()
	{
		$plugin_frontend = new Ac_worker_manager_Frontend($this->get_plugin_name(), $this->get_version());

		// load styles and scripts
		$this->loader->add_action('wp_enqueue_scripts', $plugin_frontend, 'enqueue_styles', 99999999);
		$this->loader->add_action('wp_enqueue_scripts', $plugin_frontend, 'enqueue_scripts', 99999999);

		// action hooks for ajax request
		$this->loader->add_action("wp_ajax_nopriv_ac_worker_manager", $this, 'ajax');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function ajax()
	{
		$request = json_decode(file_get_contents('php://input'));
		$action = isset($request->ac_action) ? $request->ac_action : null;
		$user =  wp_get_current_user()->data;

		// echo json_encode($request);
		// die;

		if ($action != null && isset($user->ID)) {
			if ($action == "schedule") {
				$schedule = is_array($request->schedule) ? $request->schedule : [];
				$prev_schedule = get_user_meta($user->ID, "ac_worker_manager_schedule", true);
				return update_user_meta($user->ID, "ac_worker_manager_schedule", json_encode($schedule), $prev_schedule);
			} else if ($action == "worker_profile") {
				$worker_id = isset($user->ID) ? $user->ID : null;
				$worker = isset($request->worker) ? $request->worker : [];
				$first_name = isset($request->first_name) ? $request->first_name : [];
				$last_name = isset($request->last_name) ? $request->last_name : [];

				// get acf fields
				if (function_exists("acf_get_fields")) {
					$fields = acf_get_fields(get_option("worker_settings_acf_group"));
					$fields = wp_list_pluck($fields, "name");
				} else {
					$fields = [];
				}
				// update fields
				if ($worker_id != null) {
					$page_id = get_user_meta($worker_id, "worker_manager_page_id", true);
					foreach ($worker as $key => $value) {
						if (in_array($key, $fields)) {
							update_field($key, $value, $page_id);
						}
					}
					// update user_meta
					$first_name = $request->first_name ?? get_user_meta($worker_id, "first_name", true);
					$last_name = $request->last_name ?? get_user_meta($worker_id, "last_name", true);
					update_user_meta($worker_id, "first_name", $first_name);
					update_user_meta($last_name, "first_name", $last_name);
				}

				// echo json_encode($fields);
				echo json_encode($worker);
			}
		}

		// echo json_encode($request->schedule);

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// end ajax
		wp_die();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ac_worker_manager_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
