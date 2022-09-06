<?php

$view_counts = get_post_meta(get_the_ID(), "worker_manager_view_count", true);
$view_counts = (!empty($view_counts) || $view_counts != null || $view_counts != "") ? intval($view_counts) : null;

?>
<div class="worker-manager relative w-full" x-data="MetaboxController()">
    <div class=" z-50">
        <!-- <div class="w-full bg-white py-3 pl-4  "> -->
        <div class="w-full bg-white py-2 ">
            <!-- start::tab -->
            <div class="relative flex  items-center ">
                <!-- user -->
                <span @click="changeTab($event)" data-tab="user" class="worker_settings_tab active pl-1 ring-1 ring-slate-900/5 cursor-pointer lg:text-sm lg:leading-6 font-medium text-slate-700 rounded-tl-md rounded-bl-md  hover:text-slate-900 hover:bg-gray-100 transition-colors duration-150">
                    <div class="flex items-center pointer-events-none shadow-sm bg-gray-50/5    ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 m-1 p-0.5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="pr-2"><?php _e("Packages", "ac_worker_manager"); ?></span>
                    </div>
                </span>

                <!-- settings -->
                <span @click="changeTab($event)" data-tab="settings" class="worker_settings_tab  ring-1 ring-slate-900/5 cursor-pointer lg:text-sm lg:leading-6 font-medium text-slate-700 rounded-tr-md rounded-br-md hover:text-slate-900 hover:bg-gray-100 transition-colors duration-150">
                    <div class="flex items-center pointer-events-none shadow-sm bg-gray-50/5    ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 m-1 p-0.5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="pr-2"><?php _e("Settings", "ac_worker_manager"); ?></span>
                    </div>
                </span>

            </div>
            <!-- end::tab -->
        </div>
        <!-- start::view -->
        <div class="full relative my-1">

            <div class="ml-2 rounded-md">
                <p class="-ml-1 mb-1 italic text-slate-800 text-sm font-light">
                    <?php _e("View counts.", "ac_worker_manager") ?>
                </p>
                <input placeholder="<?php _e("View counts.", "ac_worker_manager") ?>" type="number" value="<?php echo $view_counts; ?>" name="worker_manager_view_count" class="block p-3 border-gray-300/10 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md ">
            </div>

            <?php

            // echo '<pre>';

            // $product["meta"] = array_map(function ($data) {
            //     return reset($data);
            // }, get_post_meta(get_the_ID()));


            // print_r($product);
            // echo '</pre>';

            ?>
        </div>
    </div>
</div>