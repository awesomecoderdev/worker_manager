<?php

namespace AwesomeCoder\Plugin\Controller;

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

class Ac_worker_manager_Shortcode
{
	/**
	 * The array of error registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $error    The error registered with WordPress to fire when the login errors.
	 */
	public static $error = null;

	/**
	 * The array of page_id registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $page_id    The error registered with WordPress to fire when the page_id page.
	 */
	public static $page;

	/**
	 * The instacne of the woocommerce.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      bool    $instance    The instacne of the woocommerce.
	 */
	private static $instance = false;

	/**
	 * Define the core functionality of the woocommerce.
	 *
	 * Check woocommerce activated or not.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		self::$instance = function_exists("WC");
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function ac_worker_manager_users_shortcode($atts = array(), $content = null, $tag = '')
	{
		$users = shortcode_atts(array(
			'post_id' => get_the_ID(),
		), $atts);

		ob_start();
		include_once AC_WORKER_MANAGER_PATH . 'frontend/views/shortcode/users.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function ac_worker_manager_account_shortcode($atts = array(), $content = null, $tag = '')
	{
		$dateFormat = get_option('date_format');
		$user_id = get_post_meta(get_the_ID(), "worker_manager_user_id", true);
		$user = shortcode_atts(array(
			'user_id' => $user_id ?? get_current_user_id(),
			'option' => null,
			'meta' => null,
		), $atts);
		$customer = get_user_by('ID', $user["user_id"]);
		if (isset($customer->ID)) {
			$user_id = $customer->ID;
			$customer->usermeta =  array_map(function ($data) {
				return reset($data);
			}, get_user_meta($customer->ID));

			$data = isset($customer->data) ? $customer->data : [];
			$meta = isset($customer->usermeta) ? $customer->usermeta : [];
		}
		if (!empty($customer) && !empty($data) && !empty($meta)) {
			if ($user["option"] != null) {
				if ($user["option"] == "name") { // name
					return $data->display_name ?? __("Unknown", "ac_worker_manager");
				} else if ($user["option"] == "username") { // username
					return $data->user_login ?? __("Unknown", "ac_worker_manager");
				} else if ($user["option"] == "nicename") { // nicename
					return $data->user_nicename ?? __("Unknown", "ac_worker_manager");
				} else if ($user["option"] == "email") { // email
					return $data->user_email ?? __("Unknown", "ac_worker_manager");
				} else if ($user["option"] == "registered") { // registered
					return sprintf(
						'%s',
						date($dateFormat, strtotime($data->user_registered)),
					) ?? __("Unknown", "ac_worker_manager");
				}
			}
			// show meta
			if ($user["meta"] != null) { // meta
				return $meta[$user["meta"]] ?? __("Unknown", "ac_worker_manager");
			}
		} else {
			// ac_worker_manager_account
			if ($user["option"] != null) {
				if ($user["option"] == "name") { // name
					return '[ac_worker_manager_account option="name"]';
				} else if ($user["option"] == "username") { // username
					return '[ac_worker_manager_account option="username]';
				} else if ($user["option"] == "nicename") { // nicename
					return '[ac_worker_manager_account option="nicename"]';
				} else if ($user["option"] == "email") { // email
					return '[ac_worker_manager_account option="email"]';
				} else if ($user["option"] == "registered") { // registered
					return '[ac_worker_manager_account option="registered"]';
				}
			}
			// show meta
			if ($user["meta"] != null) { // meta
				return '[ac_worker_manager_account meta="' . $user["meta"] . '"]';
			}
		}
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function auth()
	{
		$acc_page = get_option("worker_settings_user_account_page");
		$parent_page = get_option("worker_settings_user");
		$single_page = get_option("worker_settings_single_user");
		$elemantor_page = get_option("worker_settings_elemantor_single_user");

		// echo '<pre>';
		// print_r($_POST);
		// print_r($_FILES);
		// echo '</pre>';
		// $page_id = get_user_meta($worker_id, "worker_manager_page_id", true);
		// // $profile = $request->profile ?? false;
		// // if ($profile) {
		// // 	delete_post_thumbnail($page_id);
		// // 	$upload = wp_upload_bits($_FILES["field1"]["name"], null, file_get_contents($_FILES["field1"]["tmp_name"]));
		// // }

		// $post_meta = array_map(function ($data) {
		// 	return reset($data);
		// }, get_post_meta($single_page));

		if (!is_user_logged_in()) {
			// process login
			if (isset($_POST["ac_worker_manager_login"]) && wp_verify_nonce($_POST['ac_worker_manager_login'], 'ac_worker_manager_login_action')) {

				// echo '<pre>';
				// print_r($_POST);
				// echo '</pre>';

				$creds = array(
					'user_login'    => $_POST["email"],
					'user_password' => $_POST["password"],
					'remember'      => isset($_POST["remember"]) ? 'true' : 'false'
				);
				$user = wp_signon($creds, false);
				$_POST = [];
				if (is_wp_error($user)) {
					self::$error = $user->get_error_message();
				} else {
					exit(wp_redirect(get_the_permalink(get_option("worker_settings_user_account_page"))));
				}
			}

			// process register
			if (function_exists("WC")) {
				if (isset($_POST["ac_worker_manager_customer"]) && wp_verify_nonce($_POST['ac_worker_manager_customer'], 'ac_worker_manager_customer_action')) {
					$userdata = [];
					$email = isset($_POST["email"]) ? sanitize_email($_POST["email"]) : false;
					$password = isset($_POST["password"]) ? $_POST["password"] : "";
					$userdata["email"] = $email;
					$userdata["first_name"] = $_POST["first_name"];
					$userdata["last_name"] = $_POST["last_name"];
					$type = (isset($_POST["type"]) && $_POST["type"] == "worker") ? "worker" : "recruiter";
					// set post empty

					$customer = wc_create_new_customer($email, '', $password, $userdata);
					if (isset($customer->errors)) {
						self::$error = current(current($customer->errors));
					} else {
						// Will return false if the previous value is the same as $new_value.
						$update_user_meta = update_user_meta($customer, 'worker_manager_account_type', $type);
						if ($type == "worker") {
							$meta_input['worker_manager_user_id'] = $customer;
							$single = sanitize_post(get_post($single_page), 'db');
							$duplicated_id = wp_insert_post(array(
								'post_type' => 'page',
								'post_author' => $customer,
								'post_title' => $userdata["first_name"] . " " . $userdata["last_name"],
								'post_content' => $single->post_content,
								'post_excerpt' => $single->post_excerpt,
								'post_status' => 'publish',
								'post_parent' => $parent_page,
								'meta_input' => $meta_input,
								'ping_status'    => $single->ping_status,
								'comment_status' => $single->comment_status,
								'post_password'  => $single->post_password,
								'to_ping'        => $single->to_ping,
								'menu_order'     => $single->menu_order,
							));

							if (!is_wp_error($duplicated_id)) {
								$taxonomies = get_object_taxonomies($single->post_type);
								if (!empty($taxonomies) && is_array($taxonomies)) {
									foreach ($taxonomies as $taxonomy) {
										$post_terms = wp_get_object_terms($single_page, $taxonomy, array('fields' => 'slugs'));
										wp_set_object_terms($duplicated_id, $post_terms, $taxonomy, false);
									}
								}
								global $wpdb;
								$post_meta = $wpdb->get_results($wpdb->prepare("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = %d", $single_page));
								if (!empty($post_meta) && is_array($post_meta)) {
									$duplicate_insert_query = "INSERT INTO $wpdb->postmeta ( post_id, meta_key, meta_value ) VALUES ";
									$insert = '';
									foreach ($post_meta as $meta_info) {
										$meta_key      = sanitize_text_field($meta_info->meta_key);
										$meta_value    =  $meta_info->meta_value;
										if (!empty($insert)) {
											$insert .= ', ';
										}
										$insert .= $wpdb->prepare('(%d, %s, %s)', $duplicated_id, $meta_key, $meta_value);
									}
									$wpdb->query($duplicate_insert_query . $insert);
								}
							}
							update_post_meta($duplicated_id, "worker_manager_user_id", $customer);
							update_user_meta($customer, "worker_manager_page_id", $duplicated_id);

							$creds = array(
								'user_login'    => $email,
								'user_password' => $password,
								'remember'      => 'true'
							);
							$user = wp_signon($creds, false);
							if (is_wp_error($user)) {
								self::$error = $user->get_error_message();
							} else {
								exit(wp_redirect(get_the_permalink(get_option("worker_settings_user_account_page"))));
							}
						} else {
							exit(wp_redirect(get_the_permalink(get_option("worker_settings_user_account_page"))));
						}
					}
				}
			}
		}
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function ac_worker_manager_auth_shortcode($atts = array(), $content = null, $tag = '')
	{
		$auth = shortcode_atts(array(
			'page' => "login",
		), $atts);

		ob_start();
		if ($auth["page"] == "login") {
			include_once AC_WORKER_MANAGER_PATH . 'frontend/views/auth/login.php';
		} else if ($auth["page"] == "register") {
			include_once AC_WORKER_MANAGER_PATH . 'frontend/views/auth/register.php';
		} else if ($auth["page"] == "reset") {
			include_once AC_WORKER_MANAGER_PATH . 'frontend/views/auth/reset.php';
		} else if ($auth["page"] == "account") {
			include_once AC_WORKER_MANAGER_PATH . 'frontend/views/auth/account.php';
		}
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function ac_worker_manager_filter_shortcode($atts = array(), $content = null, $tag = '')
	{
		$auth = shortcode_atts(array(
			'page' => "filter",
		), $atts);

		ob_start();
		include_once AC_WORKER_MANAGER_PATH . 'frontend/views/shortcode/filter.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function redirect_to()
	{
		$pages = [
			get_option("worker_settings_user_account_login"),
			get_option("worker_settings_user_account_register"),
			get_option("worker_settings_user_account_reset"),
		];

		if (is_user_logged_in()) {
			if (in_array(get_the_ID(), $pages)) {
				exit(wp_redirect(get_the_permalink(get_option("worker_settings_user_account_page"))));
			}
		} else {
			if (in_array(get_the_ID(), [
				get_option("worker_settings_user_account_page"),
			])) {
				exit(wp_redirect(get_the_permalink(get_option("worker_settings_user_account_login"))));
			}
		}
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function run()
	{
		add_action('init', [__CLASS__, 'auth']);
		add_action('template_redirect', [__CLASS__, 'redirect_to']);
		add_shortcode('ac_worker_manager_auth', [__CLASS__, 'ac_worker_manager_auth_shortcode']);
		add_shortcode('ac_worker_manager_filter', [__CLASS__, 'ac_worker_manager_filter_shortcode']);
		add_shortcode('ac_worker_manager_users', [__CLASS__, 'ac_worker_manager_users_shortcode']);
		add_shortcode('ac_worker_manager_account', [__CLASS__, 'ac_worker_manager_account_shortcode']);
	}
}
