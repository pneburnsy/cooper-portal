<?php

function rentals_view($print) {

    global $wpdb;
    global $table_name;
    $table = $table_name['rentals'];

    // ------ POST/GET (SANITIZE) ------
    $displayid = $_GET['displayid'];

    // ------ QUERY ------
    global $rentals_view;
    $rentals_view = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE displayid = %s AND status = 0
    ",
    // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($rentals_view);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}