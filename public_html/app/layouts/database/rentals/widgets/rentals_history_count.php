<?php

function rentals_history_count($print){
    global $wpdb;
    global $table_name;
    $table = $table_name['rentals'];
    // VARIABLES
    $displayid = safestring($_GET['displayid']);

    // ------ QUERY ------
    global $rentals_history_count;
    $rentals_history_count = $wpdb->get_var("
        SELECT COUNT(*) AS total FROM `$table` WHERE parent_displayid = '$displayid' AND status = 1
    "
    );
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($rentals_history_count);
    }
}