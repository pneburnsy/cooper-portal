<?php

function maintenance_view($print) {

    global $wpdb;
    global $table_name;
    $table = $table_name['maintenance'];

    // ------ POST/GET (SANITIZE) ------
    $displayid = $_GET['displayid'];

    // ------ QUERY ------
    global $maintenance_view;
    $maintenance_view = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE displayid = %s
    ",
    // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($maintenance_view);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}