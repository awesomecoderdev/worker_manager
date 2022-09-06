<!-- Start::wrap -->
<div class="w-full p-4" x-data="Settings()">
    <!-- Start::content -->

    <!-- update data -->
    <?php if (isset($_REQUEST["worker_settings"]) && wp_verify_nonce($_REQUEST['worker_settings'], 'worker_settings_action')) : ?>
        <?php if (isset($_REQUEST["product"]) && !empty($_REQUEST["product"])) : ?>
            <?php
            $update_product = update_option("worker_settings_product", intval($_REQUEST["product"]), true);
            ?>
            <?php if ($update_product) : ?>
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

    <?php $worker_settings_product = get_option("worker_settings_product");
    $product = new WP_Query([
        'post_type'         => "product", //all pages
        'posts_per_page'    => 9999,
        'order'             => 'ASC',
        'orderby'        => 'name',
        // 'meta_query'    => [
        //     'relation' => 'OR',
        //     [
        //         "key" => 'worker_id',
        //         'compare' => 'NOT EXISTS',
        //     ],
        //     // [
        //     //     'key' => 'worker_id',
        //     //     'compare' => '=',
        //     //     'value' => '',
        //     // ]
        // ]
    ]); ?>

    <!-- products dropdown -->
    <p class="ml-1 my-1 italic text-slate-800 text-sm font-light"><?php _e("Select product package.", "ac_worker_manager") ?></p>
    <div class="relative inline-block text-left">
        <div>
            <button @click="productDropDown = !productDropDown" type="button" class="flex justify-between w-full min-w-[16rem] max-w-[20rem] rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 " id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span id="productSelect" class="truncate max-w-[12rem]">
                    <?php echo $worker_settings_product ? get_the_title($worker_settings_product) : __("Select Product Package", "ac_worker_manager"); ?>
                </span>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="productDropDown" x-on:click.outside="productDropDown = false" class="z-50 max-h-64 overflow-y-scroll overflow-x-hidden origin-top-right absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <!-- Active: "bg-slate-100 text-slate-900", Not Active: "text-slate-700" -->
                <?php if ($product->have_posts()) : ?>
                    <?php while ($product->have_posts()) : $product->the_post(); ?>
                        <?php if ($worker_settings_product != get_the_ID()) : ?>
                            <span @click="changeWooProduct($event)" class="truncate max-w-[15rem] cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" data-product="<?php the_ID(); ?>">
                                <?php the_title(); ?>
                            </span>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <span @click="productDropDown = !productDropDown" class="cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                        <?php _e("No page available.", "ac_worker_manager"); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- settings -->
    <form action="<?php echo admin_url("admin.php?page=ac_worker_manager_woocommerce"); ?>" method="POST" class="relative space-y-1">
        <input type="hidden" name="product" id="selectProduct" value="<?php echo get_option("worker_settings_product"); ?>">
        <?php wp_nonce_field("worker_settings_action", "worker_settings"); ?>
        <div class="relative block md:inline-block text-left">
            <button type="submit" class=" mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 ">
                <?php _e("Save Changes", "ac_worker_manager"); ?>
            </button>
        </div>
    </form>


    <!-- End::content -->
</div><!-- End::wrap -->