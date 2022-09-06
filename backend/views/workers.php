<!-- Start::wrap -->
<div class="w-full p-4">
    <!-- Start::content -->
    <?php $workers = get_users(
        array(
            'role'    => 'Customer',
            'orderby' => 'ID',
            'order'   => 'ASC',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => 'worker_manager_account_type',
                    'compare' => 'EXISTS',
                ),
                array(
                    'key' => 'worker_manager_account_type',
                    'value' => 'worker',
                    'compare' => '=',
                )
            )
        )
    );
    array_map(function ($worker) {
        $worker->usermeta =  array_map(function ($data) {
            return reset($data);
        }, get_user_meta($worker->ID));
        return $worker;
    }, $workers);
    $dateFormat = get_option('date_format');

    ?>

    <!-- Start::workers -->
    <div class="relative w-full">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-white border-b">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <?php _e("Workers Name", "ac_worker_manager") ?>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <?php
                            // action
                            ?>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <?php _e("Email", "ac_worker_manager") ?>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <?php _e("Phone", "ac_worker_manager") ?>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <?php _e("Registered", "ac_worker_manager") ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($workers as $key => $worker) : ?>
                        <?php

                        $user = isset($worker->data) ? $worker->data : [];
                        // echo '<pre>';
                        // print_r($worker);
                        // echo '</pre>';

                        ?>
                        <?php if (!empty($user)) : ?>
                            <tr class="bg-white border-b cursor-pointer hover:bg-primary-50/20  ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900  whitespace-nowrap">
                                    <?php echo $user->display_name ?? __("Unknown", "ac_worker_manager"); ?>
                                </th>
                                <td class="px-6 py-4">
                                    <div class="relative flex">
                                        <a href="" class="mr-3" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="" class="mr-3" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <a href="<?php echo admin_url("user-edit.php?user_id=" . $user->ID); ?>" class="mr-3" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $user->user_email ?? __("Unknown", "ac_worker_manager"); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo (isset($user->usermeta["billing_phone"]) && (!empty($user->usermeta["billing_phone"]))) ? $user->usermeta["billing_phone"] :  __("Unknown", "ac_worker_manager"); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo sprintf(
                                        '%s',
                                        date($dateFormat, strtotime($user->user_registered)),
                                    ) ?? __("Unknown", "ac_worker_manager"); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
            </table>
        </div>
    </div> <!-- End::workers -->

    <!-- End::content -->
</div><!-- End::wrap -->