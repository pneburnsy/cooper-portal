<?php

function permissions_single($displayid, $print = false) {
    global $wpdb;
    global $table_name;
    $table = $table_name['permissions'];
    
    $displayid = safestring($displayid);

    $users = get_users(array(
        'meta_key' => 'displayid',
        'meta_value' => $displayid,
        'number' => 1,
        'fields' => 'ID'
    ));
    if (empty($users)) {
        return array();
    }
    $user_id = $users[0];

    // ------ QUERY ------
    $permissions_single = $wpdb->get_results($wpdb->prepare("SELECT * FROM `$table` WHERE userid = %d", $user_id));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($permissions_single);
    }

    return $permissions_single;
}