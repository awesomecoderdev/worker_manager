<?php
$user_id = get_post_meta(get_the_ID(), "worker_manager_user_id", true);
$profile_pic = get_the_post_thumbnail_url(get_the_ID(), "thumbnail");
$profile_pic = (!empty($profile_pic) || $profile_pic != null || $profile_pic != "") ? $profile_pic : "https://awesomecoder.org/img/profile.jpg";
$dateFormat = get_option('date_format');

?>

<?php if (!empty($user_id) || $user_id != null || $user_id != "") : ?>
    <?php
    $user = get_user_by("ID", $user_id);
    $user->metadata = array_map(function ($data) {
        return reset($data);
    }, get_user_meta($user_id));

    ?>
    <div class="worker-manager relative w-full" x-data="MetaboxController()">
        <!-- start::view -->
        <div class="w-full bg-white py-2 ">
            <!-- start::tab -->
            <div class="relative flex  items-center ">
                <!-- user -->
                <span @click="changeTab($event)" data-tab="user" class="worker_settings_tab active pl-1 ring-1 ring-slate-900/5 cursor-pointer lg:text-sm lg:leading-6 font-medium text-slate-700 rounded-tl-md rounded-bl-md  hover:text-slate-900 hover:bg-gray-100 transition-colors duration-150">
                    <div class="flex items-center pointer-events-none shadow-sm bg-gray-50/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 m-1 p-0.5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="pr-2"><?php _e("User", "ac_worker_manager"); ?></span>
                    </div>
                </span>

                <!-- settings -->
                <a href="<?php echo admin_url("user-edit.php?user_id=" . $user->ID); ?>" class="worker_settings_tab  ring-1 ring-slate-900/5 cursor-pointer lg:text-sm lg:leading-6 font-medium text-slate-700 rounded-tr-md rounded-br-md hover:text-slate-900 hover:bg-gray-100 transition-colors duration-150">
                    <div class="flex items-center pointer-events-none shadow-sm bg-gray-50/5    ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 m-1 p-0.5 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="pr-2"><?php _e("Settings", "ac_worker_manager"); ?></span>
                    </div>
                </a>
            </div>
            <!-- end::tab -->
        </div> <!-- end::tab -->

        <!-- start::view -->
        <div class="full relative">
            <?php
            // echo '<pre>';
            // print_r($user);
            // echo '</pre>';
            // $post_meta = get_post_meta(get_the_ID());
            // $post_meta = array_map(function ($data) {
            //     return current($data);
            // }, get_post_meta(get_the_ID()));
            // $single_page = get_option("worker_settings_single_user");
            // $post_meta = array_map(function ($data) {
            //     return reset($data);
            // }, get_post_meta($single_page));
            // echo '<pre>';
            // print_r($post_meta);
            // echo '</pre>';

            ?>

            <div class="shadow-2xl rounded-lg relative max-w-6xl flex justify-between w-full h-auto flex-wrap mx-auto my-2 mt-20 sm:mt-20 md:mt-16 lg:my-4">
                <div id="profile" class="opacity-75 h-auto w-full lg:w-3/5 lg:mx-0 ">
                    <div class="p-4 md:p-12 text-center lg:text-left">
                        <!-- Image for mobile view-->
                        <div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-16 h-48 w-48 bg-cover bg-center" style="background-image: url('<?php echo $profile_pic; ?>')"></div>
                        <h1 class="text-3xl font-bold pt-8 lg:pt-0"><?php echo $user->metadata["first_name"] . " " . $user->metadata["last_name"] ?? __("Unknown", "ac_worker_manager"); ?></h1>
                        <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-primary-500 opacity-25"></div>
                        <p class="pt-2 text-gray-600 text-xs lg:text-sm flex items-center justify-start lg:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 fill-current text-primary-700 pr-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd" />
                            </svg>
                            <?php echo $user->user_email ?? __("Unknown", "ac_worker_manager"); ?>
                        </p>
                        <p class="pt-2 text-gray-600 text-xs lg:text-sm flex items-center justify-start lg:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 text-primary-700 pr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?php echo $user->user_login ?? __("Unknown", "ac_worker_manager"); ?>
                        </p>
                        <p class="pt-2 text-gray-600 text-xs lg:text-sm flex items-center justify-start lg:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 text-primary-700 pr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <?php
                            echo sprintf(
                                '%s',
                                date($dateFormat, strtotime($user->user_registered)),

                            ) ?? __("Unknown", "ac_worker_manager");
                            ?>
                        </p>
                        <!-- <p class="pt-8 text-sm">Totally optional short description about yourself, what you do and so on.</p> -->
                    </div>
                </div>
                <!--Img Col-->
                <div class="w-full lg:w-2/5 overflow-hidden rounded-none lg:rounded-tr-lg lg:rounded-br-lg">
                    <img src="<?php echo $profile_pic; ?>" class="h-full w-full object-center shadow-2xl hidden lg:block">
                </div>
            </div>
        </div><!-- end::tab -->
    </div>

<?php else : ?>
    <div class="worker-manager relative w-full flex justify-center items-center h-20 bg-gray-50">
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm text-slate-500"><?php _e("This isn't worker page.", "ac_worker_manager"); ?></p>
        </div>
    </div>
<?php endif; ?>