<?php

function permissions_all($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['permissions'];
    $displayid = isset($_GET['displayid']) ? sanitize_text_field($_GET['displayid']) : '';

    // ------ POST/GET (SANITIZE) ------
    $user_id = $wpdb->get_var($wpdb->prepare("
        SELECT user_id 
        FROM {$wpdb->usermeta} 
        WHERE meta_key = 'displayid' 
        AND meta_value = %s
    ", $displayid));
    if (empty($user_id)) {
        return 'No user found with the given Display ID.';
    }

    // ------ QUERY ------
    if (doif_coopereditoronly_query()) {
        global $permissions_all;
        $permissions_all = $wpdb->get_results("SELECT * FROM `$table` WHERE userid = $user_id");
    }

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($permissions_all);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}