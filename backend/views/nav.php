<?php
$activeClass = "shadow-md";
?>
<div class=" z-50">
    <div class="w-full bg-white py-3 pl-4 shadow-md ">
        <div class="relative flex  items-center ">
            <!-- dashboard -->
            <a href="<?php echo admin_url("admin.php?page=ac_worker_manager"); ?>" class=" lg:text-sm lg:leading-6 font-medium text-slate-700 hover:text-slate-900 ">
                <div class="flex items-center pointer-events-none mx-1 <?php echo ($page == "ac_worker_manager") ? $activeClass : "shadow-sm bg-gray-50/5"; ?> rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 ">
                    <svg class="h-7 w-5 m-1" viewBox="0 0 24 24" fill="none">
                        <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z" class="fill-purple-400 group-hover:fill-purple-500 ">
                        </path>
                        <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z" class="fill-purple-200 group-hover:fill-purple-300 ">
                        </path>
                        <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z" class="fill-purple-400 group-hover:fill-purple-500 ">
                        </path>
                    </svg>
                    <span class="pr-2"><?php _e("Dashboard", "ac_worker_manager"); ?></span>
                </div>
            </a>

            <!-- workers -->
            <a href="<?php echo admin_url("admin.php?page=ac_worker_manager_workers"); ?>" class=" lg:text-sm lg:leading-6  font-medium text-slate-700 hover:text-slate-900 ">
                <div class="flex items-center pointer-events-none mx-1 <?php echo ($page == "ac_worker_manager_workers") ? $activeClass : "shadow-sm bg-gray-50/5"; ?> rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 m-1 p-0.5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="pr-2"><?php _e("Workers", "ac_worker_manager"); ?></span>
                </div>
            </a>

            <!-- recruiters -->
            <a href="<?php echo admin_url("admin.php?page=ac_worker_manager_recruiters"); ?>" class=" lg:text-sm lg:leading-6  font-medium text-slate-700 hover:text-slate-900 ">
                <div class="flex items-center pointer-events-none mx-1 <?php echo ($page == "ac_worker_manager_recruiters") ? $activeClass : "shadow-sm bg-gray-50/5"; ?> rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 m-1 p-0.5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="pr-2"><?php _e("Recruiters", "ac_worker_manager"); ?></span>
                </div>
            </a>

            <!-- woocommerce -->
            <a href="<?php echo admin_url("admin.php?page=ac_worker_manager_woocommerce"); ?>" class=" lg:text-sm lg:leading-6  font-medium text-slate-700 hover:text-slate-900 ">
                <div class="flex items-center pointer-events-none mx-1 <?php echo ($page == "ac_worker_manager_woocommerce") ? $activeClass : "shadow-sm bg-gray-50/5"; ?> rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 m-1 p-0.5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="pr-2"><?php _e("WooCommerce", "ac_worker_manager"); ?></span>
                </div>
            </a>

            <!-- settings -->
            <a href="<?php echo admin_url("admin.php?page=ac_worker_manager_settings"); ?>" class=" lg:text-sm lg:leading-6  font-medium text-slate-700 hover:text-slate-900 ">
                <div class="flex items-center pointer-events-none mx-1 <?php echo ($page == "ac_worker_manager_settings") ? $activeClass : "shadow-sm bg-gray-50/5"; ?> rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 m-1 p-0.5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="pr-2"><?php _e("Settings", "ac_worker_manager"); ?></span>
                </div>
            </a>

        </div>
    </div>
</div>