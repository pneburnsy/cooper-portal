<?php

function notes_view($print) {

    global $wpdb;
    global $table_name;
    $table = $table_name['notes'];

    // ------ POST/GET (SANITIZE) ------
    $displayid = $_GET['displayid'];

    // ------ QUERY ------
    global $notes_view;
    $notes_view = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE displayid = %s AND status = 0 ORDER BY `creation_date` DESC
    ",
        // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($notes_view);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}