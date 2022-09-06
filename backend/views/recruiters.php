<!-- Start::wrap -->
<div class="w-full p-4">
    <!-- Start::content -->
    <?php $recruiters = get_users(
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
                    'value' => 'recruiter',
                    'compare' => '=',
                )
            )
        )
    );
    array_map(function ($recruiter) {
        $recruiter->usermeta =  array_map(function ($data) {
            return reset($data);
        }, get_user_meta($recruiter->ID));
        return $recruiter;
    }, $recruiters);
    $dateFormat = get_option('date_format');

    ?>

    <div class="relative w-full">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-white border-b">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <?php _e("Recruiters Name", "ac_worker_manager") ?>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <?php _e("Email", "ac_worker_manager") ?>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <?php _e("Phone", "ac_worker_manager") ?>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <?php _e("Company", "ac_worker_manager") ?>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <?php _e("Registered", "ac_worker_manager") ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recruiters as $key => $recruiter) : ?>
                        <?php
                        $user = isset($recruiter->data) ? $recruiter->data : [];
                        // echo '<pre>';
                        // print_r($recruiter);
                        // echo '</pre>';

                        ?>
                        <?php if (!empty($user)) : ?>
                            <tr class="bg-white border-b cursor-pointer hover:bg-primary-50/20  ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900  whitespace-nowrap">
                                    <?php echo $user->display_name ?? __("Unknown", "ac_worker_manager"); ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $user->user_email ?? __("Unknown", "ac_worker_manager"); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo (isset($user->usermeta["billing_phone"]) && (!empty($user->usermeta["billing_phone"]))) ? $user->usermeta["billing_phone"] :  __("Unknown", "ac_worker_manager"); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo (isset($user->usermeta["billing_company"]) && (!empty($user->usermeta["billing_company"]))) ? $user->usermeta["billing_company"] :  __("Unknown", "ac_worker_manager"); ?>
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
    </div>
    <!-- End::content -->
</div><!-- End::wrap -->