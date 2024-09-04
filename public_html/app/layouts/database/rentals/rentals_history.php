<?php

function rentals_history($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['rentals'];

    // ------ POST/GET (SANITIZE) ------
    $displayid = safestring($_GET['displayid']);

    // ------ QUERY ------
    global $rentals_history;
    $rentals_history = $wpdb->get_results("
        SELECT * FROM `$table` WHERE parent_displayid = '$displayid' AND status = 1;
    " );

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($rentals_history);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}