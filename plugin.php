<?php

namespace AwesomeCoder\Plugin\AcWorkerManager\Core;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_worker_manager
 * @subpackage Ac_worker_manager/admin
 */

// If this file is called directly, abort.
!defined('WPINC') ? die : include(plugin_dir_path(__FILE__) . 'controller/class-ac_worker_manager.php');

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

use AwesomeCoder\Plugin\Controller\Ac_worker_manager;
use AwesomeCoder\Plugin\Controller\Ac_worker_manager_Activator;
use AwesomeCoder\Plugin\Controller\Ac_worker_manager_Deactivator;
use AwesomeCoder\Plugin\Controller\Ac_worker_manager_Duplicator;
use AwesomeCoder\Plugin\Controller\Ac_worker_manager_Shortcode;
use AwesomeCoder\Plugin\Controller\MetaBox;
use AwesomeCoder\Plugin\Controller\WooCommerce;

class Plugin
{

	/**
	 *
	 * The code that runs during plugin activation.
	 * This action is documented in controller/class-ac_worker_manager-activator.php
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		Ac_worker_manager_Activator::activate();
	}

	/**
	 *
	 * The code that runs during plugin deactivation.
	 * This action is documented in controller/class-ac_worker_manager-deactivator.php
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		Ac_worker_manager_Deactivator::deactivate();
	}

	/**
	 *
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 *
	 */
	public static function core()
	{
		$instance = new Ac_worker_manager();
		$instance->run();

		// load shortcodes
		Ac_worker_manager_Shortcode::run();

		// load WooCommerce
		$WooCommerce = new WooCommerce();
		$WooCommerce->run();

		// load metabox
		$MetaBox = new MetaBox();
		$MetaBox->run();

		// duplicator
		new Ac_worker_manager_Duplicator();
	}
}
