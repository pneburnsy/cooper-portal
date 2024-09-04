<?php

function rentals_count($print){
    global $wpdb;
    global $table_name;
    $table = $table_name['rentals'];
    // VARIABLES

    // ------ QUERY ------
    global $rentals_count;
    $rentals_count = $wpdb->get_var("
        SELECT COUNT(DISTINCT displayid) AS total FROM `$table` WHERE parent_displayid = ''
    "
    );
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($rentals_count);
    }
}