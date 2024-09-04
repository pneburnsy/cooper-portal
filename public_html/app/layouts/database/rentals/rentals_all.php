<?php

function rentals_all($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['rentals'];

    // ------ POST/GET (SANITIZE) ------

    // ------ QUERY ------
    global $rentals_team_all;
    $rentals_team_all = $wpdb->get_results("
        SELECT * FROM `$table` WHERE status = 0;
    " );

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($rentals_team_all);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}