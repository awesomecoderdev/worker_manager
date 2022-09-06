<!-- Start::wrap -->
<div class="w-full p-4" x-data="Settings()">
    <!-- Start::content -->

    <!-- update data -->
    <?php if (isset($_REQUEST["worker_settings"]) && wp_verify_nonce($_REQUEST['worker_settings'], 'worker_settings_action')) : ?>
        <?php if (isset($_REQUEST["user"]) && !empty($_REQUEST["user"])) : ?>
            <?php
            $update_user = update_option("worker_settings_user", intval($_REQUEST["user"]), true);
            $update_account_page = update_option("worker_settings_user_account_page", intval($_REQUEST["accounPage"]), true);
            $changeLogin = update_option("worker_settings_user_account_login", intval($_REQUEST["changeLogin"]), true);
            $changeRegister = update_option("worker_settings_user_account_register", intval($_REQUEST["changeRegister"]), true);
            $changeReset = update_option("worker_settings_user_account_reset", intval($_REQUEST["changeReset"]), true);
            $singleWorker = update_option("worker_settings_single_user", intval($_REQUEST["singleWorker"]), true);
            $acfGroup = update_option("worker_settings_acf_group", intval($_REQUEST["acfGroup"]), true);

            ?>
            <?php if ($update_user || $update_account_page || $changeLogin || $changeRegister || $changeReset || $singleWorker  || $acfGroup) : ?>
                <div class="flex mb-3 w-full mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 border-gray-300 border">
                    <div class="flex items-center justify-center w-12 bg-emerald-500">
                        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                        </svg>
                    </div>

                    <div class="px-4 py-2 -mx-3">
                        <div class="mx-3">
                            <span class="font-semibold text-emerald-500 dark:text-emerald-400"><?php _e("Success", "ac_worker_manager"); ?></span>
                            <p class="text-sm font-normal text-gray-600 dark:text-gray-200"><?php _e("Successfully updated!", "ac_worker_manager"); ?></p>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="flex mb-3 w-full mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 border-gray-300 border">
                    <div class="flex items-center justify-center w-12 bg-red-500">
                        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z" />
                        </svg>
                    </div>

                    <div class="px-4 py-2 -mx-3">
                        <div class="mx-3">
                            <span class="font-semibold text-red-500 dark:text-red-400"><?php _e("Error", "ac_worker_manager"); ?></span>
                            <p class="text-sm text-gray-600 dark:text-gray-200"><?php _e("Something went wrong!", "ac_worker_manager"); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php

    $worker_settings_user = get_option("worker_settings_user");
    $worker_settings_single_user = get_option("worker_settings_single_user");
    $worker_settings_elemantor_single_user = get_option("worker_settings_elemantor_single_user");
    $worker_settings_user_account_page = get_option("worker_settings_user_account_page");
    $worker_settings_user_account_login = get_option("worker_settings_user_account_login");
    $worker_settings_user_account_register = get_option("worker_settings_user_account_register");
    $worker_settings_user_account_reset = get_option("worker_settings_user_account_reset");
    $worker_settings_acf_group = get_option("worker_settings_acf_group");
    $page = new WP_Query([
        'post_type'         => "page", //all pages
        'posts_per_page'    => 9999,
        'order'             => 'ASC',
        'orderby'        => 'name',
        'meta_query'    => [
            'relation' => 'OR',
            [
                "key" => 'worker_id',
                'compare' => 'NOT EXISTS',
            ],
            // [
            //     'key' => 'worker_id',
            //     'compare' => '=',
            //     'value' => '',
            // ]
        ]
    ]);
    ?>
    <!-- pages dropdown -->
    <p class="ml-1 my-1 italic text-slate-800 text-sm font-light"><?php _e("Select dynamic workers page.", "ac_worker_manager") ?></p>
    <div class="relative inline-block text-left">
        <div>
            <button @click="userDropDown = !userDropDown" type="button" class="flex justify-between w-full min-w-[16rem] max-w-[20rem] rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 " id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span id="userSelect" class="truncate max-w-[12rem]">
                    <?php echo $worker_settings_user ? get_the_title($worker_settings_user) : __("Select Users Page", "ac_worker_manager"); ?>
                </span>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="userDropDown" x-on:click.outside="userDropDown = false" class="z-50 max-h-64 overflow-y-scroll overflow-x-hidden origin-top-right absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <!-- Active: "bg-slate-100 text-slate-900", Not Active: "text-slate-700" -->
                <?php if ($page->have_posts()) : ?>
                    <?php while ($page->have_posts()) : $page->the_post(); ?>
                        <?php if ($worker_settings_user != get_the_ID()) : ?>
                            <span @click="changeUserPage($event)" class="truncate max-w-[15rem] cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-page="<?php the_ID(); ?>">
                                <?php the_title(); ?>
                            </span>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <span @click="userDropDown = !userDropDown" class="cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                        <?php _e("No page available.", "ac_worker_manager"); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- single dropdown -->
    <p class="ml-1 my-1 italic text-slate-800 text-sm font-light"><?php _e("Select single worker page.", "ac_worker_manager") ?></p>
    <div class="relative inline-block text-left">
        <div>
            <button @click="singleWorker = !singleWorker" type="button" class="flex justify-between w-full min-w-[16rem] max-w-[20rem] rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 " id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span id="singleWorkerText" class="truncate max-w-[12rem]">
                    <?php echo $worker_settings_single_user ? ucwords(get_the_title($worker_settings_single_user)) : __("Select Single Worker Page", "ac_worker_manager"); ?>
                </span>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="singleWorker" x-on:click.outside="singleWorker = false" class="z-50 max-h-64 overflow-y-scroll overflow-x-hidden origin-top-right absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <!-- Active: "bg-slate-100 text-slate-900", Not Active: "text-slate-700" -->
                <?php if ($page->have_posts()) : ?>
                    <?php while ($page->have_posts()) : $page->the_post(); ?>
                        <?php if ($worker_settings_single_user != get_the_ID()) : ?>
                            <span @click="changeWorkerPage($event)" class="truncate max-w-[15rem] cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-page="<?php the_ID(); ?>">
                                <?php echo ucwords(get_the_title()); ?>
                            </span>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <span @click="singleWorker = !singleWorker" class="cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                        <?php _e("No page available.", "ac_worker_manager"); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- account dropdown -->
    <p class="ml-1 my-1 italic text-slate-800 text-sm font-light"><?php _e("Select account page.", "ac_worker_manager") ?></p>
    <div class="relative inline-block text-left">
        <div>
            <button @click="accountPageDropDown = !accountPageDropDown" type="button" class="flex justify-between w-full min-w-[16rem] max-w-[20rem] rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 " id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span id="accountPageSelect" class="truncate max-w-[12rem]">
                    <?php echo $worker_settings_user_account_page ? get_the_title($worker_settings_user_account_page) : __("Select Account Page", "ac_worker_manager"); ?>
                </span>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="accountPageDropDown" x-on:click.outside="accountPageDropDown = false" class="z-50 max-h-64 overflow-y-scroll overflow-x-hidden origin-top-right absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <!-- Active: "bg-slate-100 text-slate-900", Not Active: "text-slate-700" -->
                <?php if ($page->have_posts()) : ?>
                    <?php while ($page->have_posts()) : $page->the_post(); ?>
                        <?php if ($worker_settings_user_account_page != get_the_ID()) : ?>
                            <span @click="changeAccountPage($event)" class="truncate max-w-[15rem] cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-page="<?php the_ID(); ?>">
                                <?php the_title(); ?>
                            </span>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <span @click="accountPageDropDown = !accountPageDropDown" class="cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                        <?php _e("No page available.", "ac_worker_manager"); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- login dropdown -->
    <p class="ml-1 my-1 italic text-slate-800 text-sm font-light"><?php _e("Select login page.", "ac_worker_manager") ?></p>
    <div class="relative inline-block text-left">
        <div>
            <button @click="accountLoginPageDropDown = !accountLoginPageDropDown" type="button" class="flex justify-between w-full min-w-[16rem] max-w-[20rem] rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 " id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span id="lgoinText" class="truncate max-w-[12rem]">
                    <?php echo $worker_settings_user_account_login ? get_the_title($worker_settings_user_account_login) : __("Select Login Page", "ac_worker_manager"); ?>
                </span>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="accountLoginPageDropDown" x-on:click.outside="accountLoginPageDropDown = false" class="z-50 max-h-64 overflow-y-scroll overflow-x-hidden origin-top-right absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <!-- Active: "bg-slate-100 text-slate-900", Not Active: "text-slate-700" -->
                <?php if ($page->have_posts()) : ?>
                    <?php while ($page->have_posts()) : $page->the_post(); ?>
                        <?php if ($worker_settings_user_account_login != get_the_ID()) : ?>
                            <span @click="changeLoginPage($event)" class="truncate max-w-[15rem] cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-page="<?php the_ID(); ?>">
                                <?php the_title(); ?>
                            </span>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <span @click="accountLoginPageDropDown = !accountLoginPageDropDown" class="cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                        <?php _e("No page available.", "ac_worker_manager"); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- register dropdown -->
    <p class="ml-1 my-1 italic text-slate-800 text-sm font-light"><?php _e("Select register page.", "ac_worker_manager") ?></p>
    <div class="relative inline-block text-left">
        <div>
            <button @click="accountRegisterPageDropDown = !accountRegisterPageDropDown" type="button" class="flex justify-between w-full min-w-[16rem] max-w-[20rem] rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 " id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span id="registerText" class="truncate max-w-[12rem]">
                    <?php echo $worker_settings_user_account_register ? get_the_title($worker_settings_user_account_register) : __("Select Register Page", "ac_worker_manager"); ?>
                </span>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="accountRegisterPageDropDown" x-on:click.outside="accountRegisterPageDropDown = false" class="z-50 max-h-64 overflow-y-scroll overflow-x-hidden origin-top-right absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <!-- Active: "bg-slate-100 text-slate-900", Not Active: "text-slate-700" -->
                <?php if ($page->have_posts()) : ?>
                    <?php while ($page->have_posts()) : $page->the_post(); ?>
                        <?php if ($worker_settings_user_account_register != get_the_ID()) : ?>
                            <span @click="changeRegisterPage($event)" class="truncate max-w-[15rem] cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-page="<?php the_ID(); ?>">
                                <?php the_title(); ?>
                            </span>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <span @click="accountRegisterPageDropDown = !accountRegisterPageDropDown" class="cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                        <?php _e("No page available.", "ac_worker_manager"); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- reset dropdown -->
    <p class="ml-1 my-1 italic text-slate-800 text-sm font-light"><?php _e("Select reset page.", "ac_worker_manager") ?></p>
    <div class="relative inline-block text-left">
        <div>
            <button @click="accountResetPageDropDown = !accountResetPageDropDown" type="button" class="flex justify-between w-full min-w-[16rem] max-w-[20rem] rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 " id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span id="resetText" class="truncate max-w-[12rem]">
                    <?php echo $worker_settings_user_account_reset ? get_the_title($worker_settings_user_account_reset) : __("Select Reset Page", "ac_worker_manager"); ?>
                </span>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="accountResetPageDropDown" x-on:click.outside="accountResetPageDropDown = false" class="z-50 max-h-64 overflow-y-scroll overflow-x-hidden origin-top-right absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <!-- Active: "bg-slate-100 text-slate-900", Not Active: "text-slate-700" -->
                <?php if ($page->have_posts()) : ?>
                    <?php while ($page->have_posts()) : $page->the_post(); ?>
                        <?php if ($worker_settings_user_account_reset != get_the_ID()) : ?>
                            <span @click="changeResetPage($event)" class="truncate max-w-[15rem] cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-page="<?php the_ID(); ?>">
                                <?php the_title(); ?>
                            </span>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <span @click="accountResetPageDropDown = !accountResetPageDropDown" class="cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                        <?php _e("No page available.", "ac_worker_manager"); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- acf dropdown -->
    <p class="ml-1 my-1 italic text-slate-800 text-sm font-light"><?php _e("Select ACF field groups.", "ac_worker_manager") ?></p>
    <div class="relative inline-block text-left">
        <div>
            <button @click="acfGroup = !acfGroup" type="button" class="flex justify-between w-full min-w-[16rem] max-w-[20rem] rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 " id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span id="acfGroupText" class="truncate max-w-[12rem]">
                    <?php echo $worker_settings_acf_group ? get_the_title($worker_settings_acf_group) : __("Select ACF Field Group.", "ac_worker_manager"); ?>
                </span>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="acfGroup" x-on:click.outside="acfGroup = false" class="z-50 max-h-64 overflow-y-scroll overflow-x-hidden origin-top-right absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <!-- Active: "bg-slate-100 text-slate-900", Not Active: "text-slate-700" -->
                <?php
                $acf =  new WP_Query([
                    'post_type'         => "acf-field-group", //all pages
                    'posts_per_page'    => 9999,
                    'order'             => 'ASC',
                    'orderby'        => 'name',
                ]);

                ?>
                <?php if ($acf->have_posts()) : ?>
                    <?php while ($acf->have_posts()) : $acf->the_post(); ?>
                        <?php if ($worker_settings_acf_group != get_the_ID()) : ?>
                            <span @click="changeAcfGroup($event)" class="truncate max-w-[15rem] cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-page="<?php the_ID(); ?>">
                                <?php the_title(); ?>
                            </span>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <span @click="acfGroup = !acfGroup" class="cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                        <?php _e("No group available.", "ac_worker_manager"); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- settings -->
    <form action="<?php echo admin_url("admin.php?page=ac_worker_manager_settings"); ?>" method="POST" class="relative space-y-1">
        <?php wp_nonce_field("worker_settings_action", "worker_settings"); ?>
        <input type="hidden" name="user" id="selectUser" value="<?php echo get_option("worker_settings_user"); ?>">
        <input type="hidden" name="accounPage" id="selectAccountPage" value="<?php echo get_option("worker_settings_user_account_page"); ?>">
        <input type="hidden" name="acfGroup" id="selectAcfGroup" value="<?php echo get_option("worker_settings_acf_group"); ?>">
        <input type="hidden" name="changeLogin" id="changeLoginInput" value="<?php echo get_option("worker_settings_user_account_login"); ?>">
        <input type="hidden" name="changeRegister" id="changeRegisterInput" value="<?php echo get_option("worker_settings_user_account_register"); ?>">
        <input type="hidden" name="changeReset" id="changeResetInput" value="<?php echo get_option("worker_settings_user_account_reset"); ?>">
        <input type="hidden" name="singleWorker" id="changeSingleWorkerInput" value="<?php echo get_option("worker_settings_single_user"); ?>">
        <?php $ac_woo_minimum_limit = get_option("ac_woo_minimum_limit", 30) ?>
        <!-- <div class="ml-2 rounded-md">
            <p class="-ml-1 mb-1 italic text-slate-800 text-sm font-light">
                <?php //_e("Package price.", "ac_worker_manager")
                ?>
            </p>
            <input placeholder="Minimum Limit" type="number" step="any" value="<?php // echo $ac_woo_minimum_limit;
                                                                                ?>" name="woocommerc_limit" class="block p-3 border-gray-300/10 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md ">
        </div> -->

        <div class="relative block md:inline-block text-left">
            <button type="submit" class=" mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 ">
                <?php _e("Save Changes", "ac_worker_manager"); ?>
            </button>
        </div>

    </form>

    <!-- End::content -->
</div><!-- End::wrap -->

<?php
// $fields = acf_get_field_groups(336);
// echo '<pre>';
// print_r($fields);
// echo '</pre>';
// $fields = acf_get_fields($worker_settings_acf_group);
// $fields = wp_list_pluck($fields, "name");

// echo '<pre>';
// print_r($fields);
// echo '</pre>';
// 59033
// // $newFields = array_map(function ($field) {
// //     $data = [];
// //     foreach (get_user_meta($field->ID) as $key => $value) {
// //         // $worker->data->$key = reset($value);
// //         $data[$key] = reset($value);
// //     }
// //     return $data;
// // }, $fields);
// $output = [];
// foreach ($fields as $key => $field) {
//     $output[$field["name"]] = $field["choices"];
//     echo '<pre>';
//     print_r($field);
//     echo '</pre>';
// }

// echo '<pre>';
// print_r($output);
// echo '</pre>';

// echo '<pre>';
// print_r($fields);
// echo '</pre>';


// echo '<pre>';
// print_r($newFields);
// echo '</pre>';

// $value = get_field("worker_gender", 336);
// $value = get_field_object("worker_gender", 336)["choices"];
// $value = get_field_object("worker_gender", 336);
// $value = get_field_object(59033);
// Get values from post ID = 1.
// $value = get_fields(59033);
// echo '<pre>';
// print_r($value);
// echo '</pre>';

// $fields = acf_get_fields(get_option("worker_settings_acf_group"));


$fields = acf_get_fields($worker_settings_acf_group);
$fields = wp_list_pluck($fields, "name");

echo '<pre>';
print_r($fields);
echo '</pre>';
