<!-- Start::wrap -->
<div class="w-full p-4">
    <!-- Start::content -->

    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam provident officiis animi praesentium, ipsa accusantium laboriosam ut at excepturi autem fugiat nisi velit a! Natus veritatis molestiae dolore. Repellat, nisi?</p>








    <?php

    // $parent_page = get_option("worker_settings_user");
    // $single_page = get_option("worker_settings_single_user");
    // $elemantor_page = get_option("worker_settings_elemantor_single_user");

    // global $elementor;
    // $meta = $elementor->documents->get_doc_for_frontend($single_page)->get_elements_data();
    // echo '<pre>';
    // print_r($meta);
    // echo '</pre>';



    // Query WP to get a handle on the template were going to copy
    // $query = new WP_Query([
    //     'post_type' => 'elementor_library',
    //     // 'name' => 'my_template_name',
    //     'posts_per_page' => 1
    // ]);

    // $post_meta = array_map(function ($data) {
    //     return reset($data);
    // }, get_post_meta($single_page));
    // if (defined("ELEMENTOR_VERSION")) {
    //     $post_meta['_elementor_version'] = ELEMENTOR_VERSION;
    // }
    // if (defined("ELEMENTOR_PRO_VERSION")) {
    //     $post_meta['_elementor_pro_version'] = ELEMENTOR_PRO_VERSION;
    // }

    // $elemantor_meta = array_map(function ($data) {
    //     return reset($data);
    // }, get_post_meta($elemantor_page));
    // if (defined("ELEMENTOR_VERSION")) {
    //     $elemantor_meta['_elementor_version'] = ELEMENTOR_VERSION;
    // }
    // if (defined("ELEMENTOR_PRO_VERSION")) {
    //     $elemantor_meta['_elementor_pro_version'] = ELEMENTOR_PRO_VERSION;
    // }

    // $meta = array_merge($elemantor_meta, $post_meta);

    // echo '<pre>';
    // print_r($post_meta);
    // echo '</pre>';

    // echo '<pre>';
    // print_r($elemantor_meta);
    // echo '</pre>';

    // echo '<pre>';
    // print_r($meta);
    // echo '</pre>';

    // $content = apply_filters('the_content', get_post_field('post_content', $elemantor_page));

    // No need to set up The Loop - we just want one post
    // $template = $query->found_posts ? $query->posts[0] : false;

    // $page = array(
    //     'post_type' => 'page',
    //     'post_title' => 'My Dynamic Page Title',
    //     'post_name' => 'My Dynamic Page Title',
    //     // Copy the content from the template
    //     'post_content' => $template->post_content,
    //     'post_parent' => $parent_page,
    //     'post_status' => 'publish',
    //     'post_author' => get_current_user_id(),
    // );

    // $pageId = wp_insert_post($page);

    // // Set the WordPress template to use
    // update_post_meta($pageId, '_wp_page_template', 'elementor_canvas');

    // // Make sure you don’t have to click on “Edit With Elementor”
    // //   the first time you access the page
    // update_post_meta($pageId, '_elementor_edit_mode', 'builder');

    // // There are a few other parameters needed to make the page work
    // update_post_meta($pageId, '_elementor_template_type', 'wp-page');
    // if (defined("ELEMENTOR_VERSION")) {
    //     update_post_meta($pageId, '_elementor_version', ELEMENTOR_VERSION);
    // }
    // if (defined("ELEMENTOR_PRO_VERSION")) {
    //     update_post_meta($pageId, '_elementor_pro_version', ELEMENTOR_PRO_VERSION);
    // }
    // update_post_meta($pageId, '_elementor_css', '');

    // // Fetch the Elementor settings, data, assets, and controls from
    // //   the template, so they can be copied to the new page
    // $settings = get_post_meta($template->ID, '_elementor_page_settings', true);
    // $data = json_decode(get_post_meta($template->ID, '_elementor_data', true), true);
    // $assets = get_post_meta($template->ID, '_elementor_page_assets', true);
    // $controls = get_post_meta($template->ID, '_elementor_controls_usage', true);

    // // Copy the Elementor setting, data, assets, and controls into
    // //   the new page
    // update_post_meta($pageId, '_elementor_page_settings', $settings);
    // update_post_meta($pageId, '_elementor_data', $data);
    // update_post_meta($pageId, '_elementor_page_assets', $assets);
    // update_post_meta($pageId, '_elementor_controls_usage', $controls);


    ?>


















    <!-- End::content -->
</div><!-- End::wrap -->