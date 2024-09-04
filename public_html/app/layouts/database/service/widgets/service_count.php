<?php

function service_count($print, $value = 0){
    global $wpdb;
    global $table_name;
    $table = $table_name['service'];
    // VARIABLES
    $status = $value;
    // ------ QUERY ------
    global $service_count;
    $service_count = $wpdb->get_var("
        SELECT COUNT(*) AS total FROM `$table` WHERE status = '$status'
    "
    );
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($service_count);
    }
}