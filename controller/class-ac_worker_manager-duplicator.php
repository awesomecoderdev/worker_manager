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

class Ac_worker_manager_Duplicator
{
	public function __construct()
	{
		add_filter('admin_action_ac_duplicate', array($this, 'duplicate'));
		add_action('admin_bar_menu', array($this, 'admin_bar_menu'), 10000);
		add_filter('post_row_actions', array($this, 'row_actions'), 10, 2);
		add_filter('page_row_actions', array($this, 'row_actions'), 10, 2);
	}

	public function admin_bar_menu($wp_admin_bar)
	{

		global $pagenow;
		global $post;

		// $enabled_on = get_option('eael_save_post_duplicator_post_type', 'all');
		$enabled_on = "page";

		if (!is_admin() || $pagenow !== 'post.php' || ($enabled_on != 'all' || $post->post_type != $enabled_on)) {
			return;
		}

		$duplicate_url = admin_url('admin.php?action=ac_duplicate&post=' . $post->ID);
		$duplicate_url = wp_nonce_url($duplicate_url, '_ac_duplicator');
		$wp_admin_bar->add_menu(
			array(
				'id'    => '_ac_duplicator',
				'title' => __('AC Duplicator', 'ac_worker_manager'),
				'href'  => $duplicate_url
			)
		);
	}

	/**
	 * AC Duplicator Button added in table row
	 *
	 * @param array $actions
	 * @param WP_Post $post
	 *
	 * @return array
	 */
	public function row_actions($actions, $post)
	{

		// $enabled_on = get_option('eael_save_post_duplicator_post_type', 'all');
		$enabled_on = "page";

		if (current_user_can('edit_posts') && ($enabled_on == 'all' || $post->post_type == $enabled_on)) {
			$duplicate_url            = admin_url('admin.php?action=ac_duplicate&post=' . $post->ID);
			$duplicate_url            = wp_nonce_url($duplicate_url, '_ac_duplicator');
			$actions['ac_duplicate'] = sprintf('<a href="%s" title="%s">%s</a>', $duplicate_url, __('Duplicate ' . esc_attr($post->post_title), 'ac_worker_manager'), __('AC Duplicator', 'ac_worker_manager'));
		}

		return $actions;
	}

	/**
	 * Duplicate a post
	 * @return void
	 */
	public function duplicate()
	{
		$nonce   = isset($_REQUEST['_wpnonce']) && !empty($_REQUEST['_wpnonce']) ? $_REQUEST['_wpnonce'] : null;
		$post_id = isset($_REQUEST['post']) && !empty($_REQUEST['post']) ? intval($_REQUEST['post']) : null;
		$action  = isset($_REQUEST['action']) && !empty($_REQUEST['action']) ? trim(sanitize_text_field($_REQUEST['action'])) : null;

		if (is_null($nonce) || is_null($post_id) || $action !== 'ac_duplicate') {
			return; // Return if action is not ac_duplicate
		}

		if (!wp_verify_nonce($_REQUEST['_wpnonce'], '_ac_duplicator')) {
			return; // Return if nonce is not valid
		}

		$post = sanitize_post(get_post($post_id), 'db');

		if (is_null($post)) {
			return; // Return if post is not there.
		}

		$current_user        = wp_get_current_user();
		$duplicate_post_args = array(
			'post_author'    => $current_user->ID,
			'post_title'     => $post->post_title,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_parent'    => $post->post_parent,
			'post_status'    => 'publish', //draft
			'ping_status'    => $post->ping_status,
			'comment_status' => $post->comment_status,
			'post_password'  => $post->post_password,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order,
		);
		$duplicated_id       = wp_insert_post($duplicate_post_args);

		if (!is_wp_error($duplicated_id)) {
			$taxonomies = get_object_taxonomies($post->post_type);
			if (!empty($taxonomies) && is_array($taxonomies)) {
				foreach ($taxonomies as $taxonomy) {
					$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
					wp_set_object_terms($duplicated_id, $post_terms, $taxonomy, false);
				}
			}
			global $wpdb;
			$post_meta = $wpdb->get_results($wpdb->prepare("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = %d", $post_id));
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
		$redirect_url = admin_url('edit.php?post_type=' . $post->post_type);
		wp_safe_redirect($redirect_url);
	}
}
