<?php

function maintenance_count($print, $value = 0){
    global $wpdb;
    global $table_name;
    $table = $table_name['maintenance'];
    // VARIABLES
    $status = $value;
    // ------ QUERY ------
    global $maintenance_count;
    $maintenance_count = $wpdb->get_var("
        SELECT COUNT(*) AS total FROM `$table` WHERE status = '$status'
    "
    );
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($maintenance_count);
    }
}