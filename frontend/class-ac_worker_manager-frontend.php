<?php

namespace AwesomeCoder\Plugin\Frontend;

use stdClass;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_worker_manager
 * @subpackage Ac_worker_manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ac_worker_manager
 * @subpackage Ac_worker_manager/public
 * @author     MD Ibrahim Kholil <awesomecoder.org@gmail.com>
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */

class Ac_worker_manager_Frontend
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
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

		wp_enqueue_style($this->plugin_name, AC_WORKER_MANAGER_URL . 'frontend/css/frontend.css', array(), filemtime(AC_WORKER_MANAGER_PATH . "frontend/css/frontend.css"), 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script("{$this->plugin_name}", AC_WORKER_MANAGER_URL . 'frontend/js/settings.js', array('jquery'), filemtime(AC_WORKER_MANAGER_PATH . "frontend/js/settings.js"), false);
		wp_enqueue_script("{$this->plugin_name}-frontend", AC_WORKER_MANAGER_URL . 'frontend/js/frontend.js', array('jquery'), filemtime(AC_WORKER_MANAGER_PATH . "frontend/js/frontend.js"), true);
		wp_enqueue_script("{$this->plugin_name}-alpine", AC_WORKER_MANAGER_URL . 'assets/js/alpine.min.js', array('jquery'), null, false);

		// workers
		$workers = get_users(
			array(
				'role'    => 'Customer',
				'orderby' => 'ID',
				'order'   => 'ASC',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key'     => 'worker_manager_account_type',
						'compare' => 'EXISTS',
					),
					array(
						'key' => 'worker_manager_account_type',
						'value' => 'worker',
						'compare' => '=',
					)
				)
			)
		);

		// workers meta
		$workers = array_map(function ($worker) {
			$data = [];
			$data["id"] = $worker->ID;
			$data["name"] = get_user_meta($worker->ID, "first_name", true) . " " . get_user_meta($worker->ID, "last_name", true);

			$page_id = get_user_meta($worker->ID, "worker_manager_page_id", true);
			$profile_pic = get_the_post_thumbnail_url($page_id, "thumbnail");
			$profile_pic = (!empty($profile_pic) || $profile_pic != null || $profile_pic != "") ? $profile_pic : "https://awesomecoder.org/img/profile.jpg";
			$data["profile"] = $profile_pic;
			$data["page_link"] = get_the_permalink($page_id);
			// $data["acf_keys"] = $acf_keys;


			if (function_exists("get_fields") && !empty(get_fields($page_id))) {
				foreach (get_fields($page_id) as $key => $value) {
					$data[$key] = trim($value);
				}
			}

			foreach (get_user_meta($worker->ID) as $key => $value) {
				// $worker->data->$key = reset($value);
				$data[$key] = reset($value);
			}
			return $data;
		}, $workers);

		// orders
		$customer_orders = get_posts(array(
			'numberposts' => -1,
			'meta_key' => '_customer_user',
			'orderby' => 'date',
			'order' => 'DESC',
			'meta_value' => get_current_user_id(),
			'post_type' => wc_get_order_types(),
			'post_status' => array_keys(wc_get_order_statuses()),
			// 'post_status' => array('wc-processing'),
			// 'meta_query' => array(
			// 	'relation' => 'AND',
			// 	array(
			// 		'key'     => 'worker_manager_view_count',
			// 		'compare' => 'EXISTS',
			// 	),
			// )
		));

		// orders data
		$Order_Array = []; //
		foreach ($customer_orders as $customer_order) {
			$orderq = wc_get_order($customer_order);
			$items = $orderq->get_items();
			$view_counts = get_post_meta(current($items)["product_id"], "worker_manager_view_count", true);
			$view_counts = (!empty($view_counts) || $view_counts != null || $view_counts != "") ? intval($view_counts) : null;
			$Order_Array[] = [
				"id" => $orderq->get_id(),
				"value" => wc_price($orderq->get_total()),
				"date" => $orderq->get_date_created()->date('Y-m-d'),
				"item_id" => current($items)["product_id"],
				"view_counts" => $view_counts,
				"name" => current($items)->get_name(),
			];
		}

		// default scripts
		$local_script =  array(
			"hook"	=> get_the_ID(),
			"is_user_logged_in" => is_user_logged_in(),
			"account" => get_option("worker_settings_user_account_page"),
			"plugin" => [
				"name"		=> "MD Ibrahim Kholil",
				"author" 	=>	"MD Ibrahim Kholil",
				"email" 	=>	"awesomecoder.org@gmail.com",
				"website" 	=>	"https://awesomecoder.org",
			],
			"url" 		=> get_bloginfo('url'),
			"ajaxurl"	=> admin_url("admin-ajax.php?action=ac_worker_manager"),
			"workers"	=> $workers,
		);

		// acf fields
		if (function_exists("get_field_object")) {
			$fields = acf_get_fields(get_option("worker_settings_acf_group"));
			if (is_user_logged_in()) {
				$local_script["acf_fields"] = $fields;
				$page_id = get_user_meta(get_current_user_id(), "worker_manager_page_id", true);
				$local_script["acf_user"] = get_fields($page_id);

				// if (function_exists("get_fields") && !empty(get_fields($page_id))) {
				// 	foreach (get_fields($page_id) as $key => $value) {
			} else {
				$local_script["acf_fields"] = [];
			}

			// $fields = wp_list_pluck($fields, "name");
			$acfFields = [];
			foreach ($fields as $key => $field) {
				$choices = isset($field["choices"]) ? $field["choices"] : [];
				$acfFields[$field["name"]] = array_values($choices);
			}
			$local_script["acf"] = $acfFields;
		}

		// user data
		if (is_user_logged_in()) {
			$user =  wp_get_current_user()->data;
			foreach (get_user_meta($user->ID) as $key => $value) {
				$user->$key = reset($value);
			}
			$page_id = get_user_meta($user->ID, "worker_manager_page_id", true);
			$profile_pic = get_the_post_thumbnail_url($page_id, "thumbnail");
			$profile_pic = (!empty($profile_pic) || $profile_pic != null || $profile_pic != "") ? $profile_pic : "https://awesomecoder.org/img/profile.jpg";
			$user->profile = $profile_pic;
			// $user->email = wp_get_current_user()->email;;
			$user->page_link = get_the_permalink($page_id);

			$local_script["type"] = get_user_meta($user->ID, "worker_manager_account_type", true) == "worker" ? true : false;
			$local_script["user"] = base64_encode(json_encode($user));
			$local_script["orders"] = $Order_Array;
			$local_script["logout"] = esc_url(wp_logout_url(get_the_permalink(get_option("worker_settings_user_account_login"))));
		}

		// $dateFormat = get_option('date_format');
		// Some local vairable to get ajax url
		wp_localize_script($this->plugin_name, 'ac_worker_manager', $local_script);
	}
}
