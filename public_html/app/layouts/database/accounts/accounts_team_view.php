<?php

function accounts_team_view($print) {

    global $wpdb;
    global $table_name;
    $table = $table_name['accounts'];

    // ------ POST/GET (SANITIZE) ------
    $displayid = $_GET['displayid'];

    // ------ QUERY ------
    global $accounts_team_view;
    $accounts_team_view = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE displayid = %s
    ",
    // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_view);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}

/* ------------------------------------------------- Account Notes ------------------------------------------------- */
function accounts_team_view_notes($print) {

    global $wpdb;
    global $table_name;
    $table = $table_name['notes'];

    // ------ POST/GET (SANITIZE) ------
    $displayid = $_GET['displayid'];

    // ------ QUERY ------
    global $accounts_team_view_notes;
    $accounts_team_view_notes = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE note_displayid = %s
        ORDER BY note_created DESC
    ",
    // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_view_notes);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}