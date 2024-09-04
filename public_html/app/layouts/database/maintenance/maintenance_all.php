<?php

function maintenance_all($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['maintenance'];

    // ------ POST/GET (SANITIZE) ------
    if ($_GET['page'] == 'completed') {
        $completestatus = 1;
    } else {
        $completestatus = 0;
    }

    // ------ QUERY ------
    global $maintenance_all;
    $maintenance_all = $wpdb->get_results("
        SELECT * FROM `$table` WHERE status = $completestatus;
    "
    );

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($maintenance_all);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}