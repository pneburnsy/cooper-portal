<?php

function contacts_view($print) {
    global $wpdb;

    $displayid = isset($_GET['displayid']) ? sanitize_text_field($_GET['displayid']) : '';
    if (empty($displayid)) {
        return 'Display ID is missing.';
    }

    $user_id = $wpdb->get_var($wpdb->prepare("
        SELECT user_id 
        FROM {$wpdb->usermeta} 
        WHERE meta_key = 'displayid' 
        AND meta_value = %s
    ", $displayid));
    if (empty($user_id)) {
        return 'No user found with the given Display ID.';
    }

    $user_data = get_userdata($user_id);

    if (!$user_data) {
        return 'User data could not be retrieved.';
    }
    $user_meta = get_user_meta($user_id);
    $user_roles = $user_data->roles;

    global $contacts_view;
    $contacts_view = array(
        'user_id' => $user_data->ID,
        'user_login' => $user_data->user_login,
        'user_email' => $user_data->user_email,
        'user_registered' => $user_data->user_registered,
        'user_status' => $user_data->user_status,
        'display_name' => $user_data->display_name,
        'user_roles' => $user_roles,
        'user_meta' => $user_meta
    );

    if ($print == true) {
        echo '<pre>';
            print_r($contacts_view);
        echo '</pre>';
    }
}