<?php

use AwesomeCoder\Plugin\Controller\Ac_worker_manager_Shortcode;

?>


<div class="worker-manager min-h-full flex justify-center py-4 px-4 sm:px-6 lg:px-8" x-data="Settings()">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900"><?php _e("Create new account", "ac_worker_manager"); ?></h2>
        </div>
        <form class="mt-8 space-y-2" method="POST">
            <?php wp_nonce_field("ac_worker_manager_customer_action", "ac_worker_manager_customer"); ?>
            <div class="shadow-sm -space-y-px">
                <div>
                    <label for="first_name" class="sr-only"><?php _e("First Name", "ac_worker_manager"); ?></label>
                    <input id="first_name" name="first_name" type="text" autocomplete="first_name" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm" placeholder="<?php _e("First Name", "ac_worker_manager"); ?>">
                </div>
                <div>
                    <label for="last_name" class="sr-only"><?php _e("Last Name", "ac_worker_manager"); ?></label>
                    <input id="last_name" name="last_name" type="text" autocomplete="last_name" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm" placeholder="<?php _e("Last Name", "ac_worker_manager"); ?>">
                </div>
                <div>
                    <label for="email" class="sr-only"><?php _e("Email address", "ac_worker_manager"); ?></label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm" placeholder="<?php _e("Email address", "ac_worker_manager"); ?>">
                </div>
                <div>
                    <label for="password" class="sr-only"><?php _e("Already have an account.", "ac_worker_manager"); ?>Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm" placeholder="<?php _e("Password", "ac_worker_manager"); ?>">
                </div>

                <input type="hidden" name="type" id="accountTypeInput" value="worker">

                <!-- account type dropdown -->
                <p class="ml-1 py-1 italic text-slate-800 text-sm font-light"><?php _e("Account Type.", "ac_worker_manager") ?></p>
                <div class="worker-select relative inline-block text-left w-full">
                    <div>
                        <button @click="accountType = !accountType" type="button" class="flex justify-between w-full min-w-[16rem]  rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white focus:bg-white text-sm font-medium  hover:bg-white text-slate-600  hover:text-slate-700 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 " id="menu-button" aria-expanded="true" aria-haspopup="true">
                            <span id="accountTypeText" class="truncate max-w-[12rem]">
                                <?php _e("Worker Account", "ac_worker_manager"); ?>
                            </span>
                            <!-- Heroicon name: solid/chevron-down -->
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div x-show="accountType" x-on:click.outside="accountType = false" class="z-50 max-h-64 overflow-y-scroll overflow-x-hidden origin-top-right absolute left-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <!-- Active: "bg-slate-100 text-slate-900", Not Active: max-w-[15rem] "text-slate-700" -->
                            <span @click="changeAccountType($event)" x-bind:class="{ 'bg-slate-50 text-slate-900': worker }" class="truncate w-full cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-type="worker">
                                <?php _e("Worker Account", "ac_worker_manager"); ?>
                            </span>
                            <span @click="changeAccountType($event)" x-bind:class="{ 'bg-slate-50 text-slate-900': !worker }" class="truncate w-full cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-type="recruiter">
                                <?php _e("Recruiters Account", "ac_worker_manager"); ?>
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <p class="ml-2 block text-sm text-gray-900"><?php _e("Already have an account.", "ac_worker_manager"); ?></p>
                </div>

                <div class="text-sm">
                    <a href="<?php echo get_the_permalink(get_option("worker_settings_user_account_login")); ?>" class="font-medium text-primary-600 hover:text-primary-500"><?php _e("Log in", "ac_worker_manager"); ?></a>
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
                    <?php _e("Sign up", "ac_worker_manager"); ?>

                </button>
            </div>
        </form>
    </div>
</div>