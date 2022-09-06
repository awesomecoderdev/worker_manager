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

class MetaBox
{
    /**
     * The instacne of the metabox.
     *
     * @since    1.0.0
     * @access   private
     * @var      bool    $instance    The instacne of the metabox.
     */
    private $instance = false;

    /**
     * Define the core functionality of the metabox.
     *
     * Check metabox activated or not.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
    }

    /**
     * Define the metabox of the product.
     *
     * @since    1.0.0
     */
    public function product()
    {
        ob_start();
        include_once AC_WORKER_MANAGER_PATH . 'backend/views/metabox/product.php';
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

    /**
     * Define the metabox of the product.
     *
     * @since    1.0.0
     */
    public function save_product($post_id, $post, $update)
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        // update ammos_send_push_notification
        if (isset($_POST['ammos_send_push_notification'])) {
            $ammos_send_push_notification = $_POST['ammos_send_push_notification'];
            update_post_meta($post_id, 'ammos_send_push_notification', $ammos_send_push_notification);
        }
    }

    /**
     * Define the metabox of the page.
     *
     * @since    1.0.0
     */
    public function page()
    {
        ob_start();
        include_once AC_WORKER_MANAGER_PATH . 'backend/views/metabox/page.php';
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

    /**
     * Define the metabox of the page.
     *
     * @since    1.0.0
     */
    public function save_page_metadata($post_id, $post, $update)
    {
        // update ammos_send_push_notification
        if (isset($_POST['ammos_send_push_notification'])) {
            $ammos_send_push_notification = $_POST['ammos_send_push_notification'];
            update_post_meta($post_id, 'ammos_send_push_notification', $ammos_send_push_notification);
        }
    }


    /**
     * Define the metabox of the page.
     *
     * @since    1.0.0
     */
    public function save_product_metadata($post_id, $post, $update)
    {
        // update worker_manager_view_count
        if (isset($_POST['worker_manager_view_count'])) {
            $worker_manager_view_count = $_POST['worker_manager_view_count'];
            update_post_meta($post_id, 'worker_manager_view_count', $worker_manager_view_count);
        }
    }

    /**
     * Define the action of the metabox.
     *
     * @since    1.0.0
     */
    public function action()
    {
        // save pages fields
        add_action("save_post_page",  [$this, 'save_page_metadata'], 10, 3);
        // save products fields
        add_action("save_post_product",  [$this, 'save_product_metadata'], 10, 3);

        // add metabox
        add_action('add_meta_boxes', [$this, 'metabox'], 10, 2);
    }

    /**
     * Define the metabox of the worker manager.
     *
     * @since    1.0.0
     */
    public function metabox($post_type, $post)
    {
        // add page.
        add_meta_box(
            'ac_worker_manager_user',
            __('Worker Manager', 'ac_worker_manager'),
            [$this, 'page'],
            ['page'],
            'normal',
            'high'
        );

        // add product.
        add_meta_box(
            'ac_worker_manager_product',
            __('Worker Manager', 'ac_worker_manager'),
            [$this, 'product'],
            ['product'],
            'normal',
            'high'
        );
    }

    /**
     * Run the loader to execute all of the hooks with woocommerce.
     *
     * @since    1.0.0
     */
    public function run()
    {
        // load all action
        $this->action();
    }
}
