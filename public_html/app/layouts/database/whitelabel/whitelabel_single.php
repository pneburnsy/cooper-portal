<?php

function whitelabel_single($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['whitelabel'];

    // ------ VARIABLES ------
    $userid = current_user_id();

    $rowexists = $wpdb->get_row("SELECT * FROM `$table` WHERE userid = '$userid'");

    if ($rowexists->menucolor == 'dark') {
        $result = 'dark';
    } elseif ($rowexists->menucolor == 'light') {
        $result = 'light';
    } else {
        $result = false;
    }
    return $result;

}

function whitelabel_view($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['whitelabel'];

    // ------ VARIABLES ------
    $userid = current_user_id();

    global $whitelabel_view;
    $whitelabel_view = $wpdb->get_row("SELECT * FROM `$table` WHERE userid = '$userid'");

}