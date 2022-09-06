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

class WooCommerce
{
    /**
     * The instacne of the woocommerce.
     *
     * @since    1.0.0
     * @access   private
     * @var      bool    $instance    The instacne of the woocommerce.
     */
    private $instance = false;

    /**
     * Define the core functionality of the woocommerce.
     *
     * Check woocommerce activated or not.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        $this->instance = in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')));
        // $this->instance = function_exists("WC");
    }

    /**
     * Define the status of the woocommerce.
     *
     * Check woocommerce enabled.
     *
     * @since    1.0.0
     */
    public function enabled()
    {
        return $this->instance;
    }

    /**
     * Define the notice of the woocommerce.
     *
     * Check woocommerce and throw notice.
     *
     * @since    1.0.0
     */
    public function notice()
    {
        // add woocommerce action.
        add_action('admin_notices', [$this, 'alert']);
    }

    /**
     * Define the notice of the woocommerce.
     *
     * Check woocommerce and throw notice.
     *
     * @since    1.0.0
     */
    public function alert()
    {
        printf(
            '<div class="notice notice-error notice is-dismissible"><p><strong>%s!</strong> %s.</p></div>',
            __("Worker Manager", "ac_worker_manager"),
            __("requires WooCommerce in order to work. So please ensure that WooCommerce is both installed and activated", "ac_worker_manager")
        );
    }

    /**
     * Create a new customer.
     *
     * @param  string $email    Customer email.
     * @param  string $username Customer username.
     * @param  string $password Customer password.
     * @param  array  $args     List of arguments to pass to `wp_insert_user()`.
     * @return int|WP_Error Returns WP_Error on failure, Int (user ID) on success.
     */
    function wc_create_new_customer($email, $username = '', $password = '', $args = array())
    {
        if (empty($email) || !is_email($email)) {
            return new WP_Error('registration-error-invalid-email', __('Please provide a valid email address.', 'woocommerce'));
        }
        if (email_exists($email)) {
            return new WP_Error('registration-error-email-exists', apply_filters('woocommerce_registration_error_email_exists', __('An account is already registered with your email address. <a href="#" class="showlogin">Please log in.</a>', 'woocommerce'), $email));
        }
        if ('yes' === get_option('woocommerce_registration_generate_username', 'yes') && empty($username)) {
            $username = wc_create_new_customer_username($email, $args);
        }
        $username = sanitize_user($username);
        if (empty($username) || !validate_username($username)) {
            return new WP_Error('registration-error-invalid-username', __('Please enter a valid account username.', 'woocommerce'));
        }
        if (username_exists($username)) {
            return new WP_Error('registration-error-username-exists', __('An account is already registered with that username. Please choose another.', 'woocommerce'));
        }
        // Handle password creation.
        $password_generated = false;
        if ('yes' === get_option('woocommerce_registration_generate_password') && empty($password)) {
            $password           = wp_generate_password();
            $password_generated = true;
        }

        if (empty($password)) {
            return new WP_Error('registration-error-missing-password', __('Please enter an account password.', 'woocommerce'));
        }

        // Use WP_Error to handle registration errors.
        $errors = new WP_Error();

        do_action('woocommerce_register_post', $username, $email, $errors);

        $errors = apply_filters('woocommerce_registration_errors', $errors, $username, $email);

        if ($errors->get_error_code()) {
            return $errors;
        }

        $new_customer_data = apply_filters(
            'woocommerce_new_customer_data',
            array_merge(
                $args,
                array(
                    'user_login' => $username,
                    'user_pass'  => $password,
                    'user_email' => $email,
                    'role'       => 'customer',
                )
            )
        );
        $customer_id = wp_insert_user($new_customer_data);
        if (is_wp_error($customer_id)) {
            return $customer_id;
        }
        do_action('woocommerce_created_customer', $customer_id, $new_customer_data, $password_generated);
        return $customer_id;



        /**
         * Create a unique username for a new customer.
         *
         * @since 3.6.0
         * @param string $email New customer email address.
         * @param array  $new_user_args Array of new user args, maybe including first and last names.
         * @param string $suffix Append string to username to make it unique.
         * @return string Generated username.
         */
        if (!function_exists("wc_create_new_customer_username")) {
            function wc_create_new_customer_username($email, $new_user_args = array(), $suffix = '')
            {
                $username_parts = array();

                if (isset($new_user_args['first_name'])) {
                    $username_parts[] = sanitize_user($new_user_args['first_name'], true);
                }

                if (isset($new_user_args['last_name'])) {
                    $username_parts[] = sanitize_user($new_user_args['last_name'], true);
                }

                // Remove empty parts.
                $username_parts = array_filter($username_parts);

                // If there are no parts, e.g. name had unicode chars, or was not provided, fallback to email.
                if (empty($username_parts)) {
                    $email_parts    = explode('@', $email);
                    $email_username = $email_parts[0];

                    // Exclude common prefixes.
                    if (in_array(
                        $email_username,
                        array(
                            'sales',
                            'hello',
                            'mail',
                            'contact',
                            'info',
                        ),
                        true
                    )) {
                        // Get the domain part.
                        $email_username = $email_parts[1];
                    }

                    $username_parts[] = sanitize_user($email_username, true);
                }

                $username = wc_strtolower(implode('.', $username_parts));

                if ($suffix) {
                    $username .= $suffix;
                }

                /**
                 * WordPress 4.4 - filters the list of blocked usernames.
                 *
                 * @since 3.7.0
                 * @param array $usernames Array of blocked usernames.
                 */
                $illegal_logins = (array) apply_filters('illegal_user_logins', array());

                // Stop illegal logins and generate a new random username.
                if (in_array(strtolower($username), array_map('strtolower', $illegal_logins), true)) {
                    $new_args = array();

                    /**
                     * Filter generated customer username.
                     *
                     * @since 3.7.0
                     * @param string $username      Generated username.
                     * @param string $email         New customer email address.
                     * @param array  $new_user_args Array of new user args, maybe including first and last names.
                     * @param string $suffix        Append string to username to make it unique.
                     */
                    $new_args['first_name'] = apply_filters(
                        'woocommerce_generated_customer_username',
                        'woo_user_' . zeroise(wp_rand(0, 9999), 4),
                        $email,
                        $new_user_args,
                        $suffix
                    );

                    return wc_create_new_customer_username($email, $new_args, $suffix);
                }

                if (username_exists($username)) {
                    // Generate something unique to append to the username in case of a conflict with another user.
                    $suffix = '-' . zeroise(wp_rand(0, 9999), 4);
                    return wc_create_new_customer_username($email, $new_user_args, $suffix);
                }

                /**
                 * Filter new customer username.
                 *
                 * @since 3.7.0
                 * @param string $username      Customer username.
                 * @param string $email         New customer email address.
                 * @param array  $new_user_args Array of new user args, maybe including first and last names.
                 * @param string $suffix        Append string to username to make it unique.
                 */
                return apply_filters('woocommerce_new_customer_username', $username, $email, $new_user_args, $suffix);
            }
        }
    }

    /**
     * Define the notice of the woocommerce.
     *
     * Check woocommerce and throw notice.
     *
     * @since    1.0.0
     */
    public function add_to_cart()
    {
        if (function_exists("WC")) {
            $product_id = 57468;
            // WC()->cart->add_to_cart($product_id, 50);  // you can also pass a number here
        }
    }


    /**
     * Define the action of the woocommerce.
     *
     * @since    1.0.0
     */
    public function action()
    {
        // add_action('template_redirect', [$this, 'add_to_cart']);

        // add action if woocommerce activated.
        // add_action('woocommerce_checkout_process', [$this, 'check_minimum_order_amount']);
        // add_action('woocommerce_before_cart', [$this, 'check_minimum_order_amount']);
        // add_action('woocommerce_before_checkout', [$this, 'check_minimum_order_amount']);
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

        // throw notice
        !$this->enabled() ? $this->notice() : $this->action();
    }
}
