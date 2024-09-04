<?php

function accounts_team_single($value, $print){

    global $wpdb;
    global $table_name;
    $table = $table_name['accounts'];
    // ------ VARIABLES ------
    $displayid = $value;

    // ------ POST/GET (SANITIZE) ------
    // NONE

    // ------ QUERY ------
    global $accounts_team_single;
    $accounts_team_single = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table`
        WHERE displayid = '%s'
    ",
    // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_single);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}