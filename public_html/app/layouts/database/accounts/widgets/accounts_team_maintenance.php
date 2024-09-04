<?php

function accounts_team_maintenance($print){
    global $wpdb;
    global $table_name;
    $table = $table_name['maintenance'];
    // ------ VARIABLES ------
    $accountdisplayid = safestring($_GET['displayid']);
    // ------ QUERY ------
    global $accounts_team_maintenance;
    $accounts_team_maintenance = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE clientaccount = %s AND status = 0
        ORDER BY creation_date ASC 
    ",
    // ARGUMENTS
    $accountdisplayid
    ));
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_maintenance);
    }
}