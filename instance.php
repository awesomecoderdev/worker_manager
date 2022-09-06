<?php

/**
 *
 * This file defines a function that starts the plugin.
 *
 * @link              https://awesomecoder.org/
 * @since             1.0.0
 * @package           Ac_worker_manager
 *
 * @wordpress-plugin
 * Plugin Name:       Worker Manager
 * Plugin URI:        https://awesomecoder.org/
 * Description:       This is a custom plugin that manage workers and recruiters, to view the profile of workers.
 * Version:           1.0.0
 * Author:            MD Ibrahim Kholil
 * Author URI:        https://awesomecoder.org/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ac_worker_manager
 * Domain Path:       /languages
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */

use AwesomeCoder\Plugin\AcWorkerManager\Core\Plugin;
use AwesomeCoder\Plugin\Controller\Ac_worker_manager_Duplicator;
use AwesomeCoder\Plugin\Controller\Ac_worker_manager_Shortcode;

// If this file is called directly, abort.
!defined('WPINC') ? die : include("plugin.php");

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define('AC_WORKER_MANAGER_VERSION', '1.0.0');
define('AC_WORKER_MANAGER_URL', plugin_dir_url(__FILE__));
define('AC_WORKER_MANAGER_PATH', plugin_dir_path(__FILE__));
define('AC_WORKER_MANAGER_BASENAME', plugin_basename(__FILE__));

/**
 * The activate and deactivation action of the plugin.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_worker_manager
 * @subpackage Ac_worker_manager/admin
 */
register_activation_hook(__FILE__, [Plugin::class, 'activate']);
register_deactivation_hook(__FILE__, [Plugin::class, 'deactivate']);


/**
 * Load core of the plugin.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_worker_manager
 * @subpackage Ac_worker_manager/admin
 */
Plugin::core();
