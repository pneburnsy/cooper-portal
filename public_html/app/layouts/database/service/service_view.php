<?php

function service_view($print) {

    global $wpdb;
    global $table_name;
    $table = $table_name['service'];

    // ------ POST/GET (SANITIZE) ------
    $displayid = $_GET['displayid'];

    // ------ QUERY ------
    global $service_view;
    $service_view = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE displayid = %s
        AND status = 0  
    ",
    // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($service_view);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}