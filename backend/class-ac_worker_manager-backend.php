<?php

namespace AwesomeCoder\Plugin\Backend;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_worker_manager
 * @subpackage Ac_worker_manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ac_worker_manager
 * @subpackage Ac_worker_manager/admin
 * @author     MD Ibrahim Kholil <awesomecoder.org@gmail.com>
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */

class Ac_worker_manager_Backend
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The pages of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $pages    The pages of this plugin.
	 */
	private  $pages;

	/**
	 * The metabox of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $metabox    The metabox of this plugin.
	 */
	private  $metabox;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->pages = [
			"toplevel_page_ac_worker_manager",
			"worker-manager_page_ac_worker_manager_workers",
			"worker-manager_page_ac_worker_manager_recruiters",
			"worker-manager_page_ac_worker_manager_woocommerce",
			"worker-manager_page_ac_worker_manager_settings",
		];

		$this->metabox = [
			"post.php",
			"post-new.php",
		];
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook)
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ac_worker_manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ac_worker_manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// echo $hook;
		// die;

		// view css
		if (in_array($hook, $this->pages)) {
			wp_enqueue_style($this->plugin_name, AC_WORKER_MANAGER_URL . 'backend/css/backend.css', array(), filemtime(AC_WORKER_MANAGER_PATH . "backend/css/backend.css"), 'all');
		}

		// metabox css
		if (in_array($hook, $this->metabox)) {
			wp_enqueue_style("{$this->plugin_name}-metabox", AC_WORKER_MANAGER_URL . 'backend/css/metabox.css', array(), filemtime(AC_WORKER_MANAGER_PATH . "backend/css/metabox.css"), 'all');
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook)
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ac_worker_manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ac_worker_manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// load settings
		wp_enqueue_script("{$this->plugin_name}", AC_WORKER_MANAGER_URL . 'backend/js/settings.js', array('jquery'), filemtime(AC_WORKER_MANAGER_PATH . "backend/js/settings.js"), false);
		// Some local vairable to get ajax url
		wp_localize_script($this->plugin_name, 'ac_worker_manager', array(
			"plugin" => [
				"name"		=> "MD Ibrahim Kholil",
				"author" 	=>	"MD Ibrahim Kholil",
				"email" 	=>	"awesomecoder.org@gmail.com",
				"website" 	=>	"https://awesomecoder.org",
			],
			"url" 		=> get_bloginfo('url'),
			"ajaxurl"	=> admin_url("admin-ajax.php"),
		));

		// only for spesific pages
		if (in_array($hook, $this->pages)) {
			wp_enqueue_script("{$this->plugin_name}-backend", AC_WORKER_MANAGER_URL . 'backend/js/backend.js', array('jquery'), filemtime(AC_WORKER_MANAGER_PATH . "backend/js/backend.js"), true);
			wp_enqueue_script("{$this->plugin_name}-alpine", AC_WORKER_MANAGER_URL . 'assets/js/alpine.min.js', array('jquery'), null, false);

			wp_enqueue_script("{$this->plugin_name}-jquery", AC_WORKER_MANAGER_URL . 'assets/js/jquery.min.js', array('jquery'), null, true);
			wp_enqueue_script("{$this->plugin_name}-admin", AC_WORKER_MANAGER_URL . 'backend/js/admin.js', array('jquery'), filemtime(AC_WORKER_MANAGER_PATH . "backend/js/admin.js"), true);
		}

		// only for metabox
		if (in_array($hook, $this->metabox)) {
			wp_enqueue_script("{$this->plugin_name}-alpine", AC_WORKER_MANAGER_URL . 'assets/js/alpine.min.js', array('jquery'), null, false);
			wp_enqueue_script("{$this->plugin_name}-metabox", AC_WORKER_MANAGER_URL . 'backend/js/metabox.js', array('jquery'), filemtime(AC_WORKER_MANAGER_PATH . "backend/js/metabox.js"), false);
		}
	}

	/**
	 * Define the views of the nav.
	 *
	 * @since    1.0.0
	 */
	public function nav()
	{
		$page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : "ac_worker_manager";
		include_once AC_WORKER_MANAGER_PATH . 'backend/views/nav.php';
	}


	/**
	 * Initialize the main menu and set its properties.
	 *
	 * @since    1.0.0
	 *
	 */
	public function admin_menu()
	{
		add_menu_page(__("Worker Manager", "ac_worker_manager"), __("Worker Manager", "ac_worker_manager"), 'manage_options', 'ac_worker_manager', array($this, 'ac_worker_manager_activator_callback'), 'dashicons-businessman', 50);
		add_submenu_page('ac_worker_manager', __("Dashboard", "ac_worker_manager"), __("Dashboard", "ac_worker_manager"), 'manage_options', 'ac_worker_manager', array($this, 'ac_worker_manager_dashboard_callback'));
		add_submenu_page('ac_worker_manager', __("Workers", "ac_worker_manager"), __("Workers", "ac_worker_manager"), 'manage_options', 'ac_worker_manager_workers', array($this, 'ac_worker_manager_workers_callback'));
		add_submenu_page('ac_worker_manager', __("Recruiters", "ac_worker_manager"), __("Recruiters", "ac_worker_manager"), 'manage_options', 'ac_worker_manager_recruiters', array($this, 'ac_worker_manager_recruiters_callback'));
		add_submenu_page('ac_worker_manager', __("WooCommerce", "ac_worker_manager"), __("WooCommerce", "ac_worker_manager"), 'manage_options', 'ac_worker_manager_woocommerce', array($this, 'ac_worker_manager_woocommerce_callback'));
		add_submenu_page('ac_worker_manager', __("Settings", "ac_worker_manager"), __("Settings", "ac_worker_manager"), 'manage_options', 'ac_worker_manager_settings', array($this, 'ac_worker_manager_settings_callback'));
	}

	/**
	 * Initialize the menu.
	 *
	 * @since    1.0.0
	 *
	 */
	public function ac_worker_manager_activator_callback()
	{
		// activate admin menu
	}

	/**
	 * Initialize the view of dashboard page.
	 *
	 * @since    1.0.0
	 *
	 */
	public function ac_worker_manager_dashboard_callback()
	{
		ob_start();
		$current = "ac_worker_manager";
		$this->nav();
		include_once AC_WORKER_MANAGER_PATH . 'backend/views/index.php';
		$index = ob_get_contents();
		ob_end_clean();
		echo $index;
	}

	/**
	 * Initialize the view of workers page.
	 *
	 * @since    1.0.0
	 *
	 */
	public function ac_worker_manager_workers_callback()
	{
		ob_start();
		$current = "ac_worker_manager_workers";
		$this->nav();
		include_once AC_WORKER_MANAGER_PATH . 'backend/views/workers.php';
		$workers = ob_get_contents();
		ob_end_clean();
		echo $workers;
	}

	/**
	 * Initialize the view of recruiters page.
	 *
	 * @since    1.0.0
	 *
	 */
	public function ac_worker_manager_recruiters_callback()
	{
		ob_start();
		$current = "ac_worker_manager_recruiters";
		$this->nav();
		include_once AC_WORKER_MANAGER_PATH . 'backend/views/recruiters.php';
		$recruiters = ob_get_contents();
		ob_end_clean();
		echo $recruiters;
	}

	/**
	 * Initialize the view of woocommerce page.
	 *
	 * @since    1.0.0
	 *
	 */
	public function ac_worker_manager_woocommerce_callback()
	{
		ob_start();
		$current = "ac_worker_manager_woocommerce";
		$this->nav();
		include_once AC_WORKER_MANAGER_PATH . 'backend/views/woocommerce.php';
		$woocommerce = ob_get_contents();
		ob_end_clean();
		echo $woocommerce;
	}

	/**
	 * Initialize the view of settings page.
	 *
	 * @since    1.0.0
	 *
	 */
	public function ac_worker_manager_settings_callback()
	{
		ob_start();
		$current = "ac_worker_manager_settings";
		$this->nav();
		include_once AC_WORKER_MANAGER_PATH . 'backend/views/settings.php';
		$settings = ob_get_contents();
		ob_end_clean();
		echo $settings;
	}
}
