<?php

function accounts_team_surveys($print){
    global $wpdb;
    global $table_name;
    $table = $table_name['survey'];
    // ------ VARIABLES ------
    $accountdisplayid = safestring($_GET['displayid']);
    // ------ QUERY ------
    global $accounts_team_surveys;
    $accounts_team_surveys = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE clientaccount = %s
        ORDER BY created ASC 
    ",
    // ARGUMENTS
        $accountdisplayid
    ));
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_surveys);
    }
}