<?php

function service_all($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['service'];

    // ------ POST/GET (SANITIZE) ------
    if ($_GET['page'] == 'completed') {
        $completestatus = 1;
    } else {
        $completestatus = 0;
    }

    // ------ QUERY ------
    global $service_all;
    $service_all = $wpdb->get_results("
        SELECT * FROM `$table` WHERE status = $completestatus
    ");

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($service_all);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}