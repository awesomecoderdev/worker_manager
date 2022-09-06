<?php

use AwesomeCoder\Plugin\Controller\Ac_worker_manager_Shortcode;

?>

<div class="worker-manager min-h-full flex justify-center py-4 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900"><?php _e("Sign in to your account", "ac_worker_manager"); ?></h2>
        </div>
        <form class="mt-8 space-y-2" method="POST">
            <?php wp_nonce_field("ac_worker_manager_login_action", "ac_worker_manager_login"); ?>
            <div class="shadow-sm -space-y-px">
                <div>
                    <label for="email-address" class="sr-only"><?php _e("Email address", "ac_worker_manager"); ?></label>
                    <input id="email-address" name="email" type="text" autocomplete="email" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm" placeholder="<?php _e("Email address", "ac_worker_manager"); ?>">
                </div>
                <div>
                    <label for="password" class="sr-only"><?php _e("Password", "ac_worker_manager"); ?></label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm" placeholder="<?php _e("Password", "ac_worker_manager"); ?>">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        <?php _e("Remember me", "ac_worker_manager"); ?>
                    </label>
                </div>

                <div class="text-sm">
                    <a href="<?php echo get_the_permalink(get_option("worker_settings_user_account_reset")); ?>" class="font-medium text-primary-600 hover:text-primary-500">
                        <?php _e("Forgot your password? ", "ac_worker_manager"); ?>
                    </a>
                </div>
            </div>
            <p class="text-red-500 text-sm">
                <?php echo preg_replace('#<a.*?>(.*?)</a>#i', '\1', Ac_worker_manager_Shortcode::$error); ?>
            </p>
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <!-- Heroicon name: solid/lock-closed -->
                        <svg class="h-5 w-5 text-primary-500 group-hover:text-primary-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <?php _e("Sign in", "ac_worker_manager"); ?>
                </button>
            </div>
        </form>
    </div>
</div>