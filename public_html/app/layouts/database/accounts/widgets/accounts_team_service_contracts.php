<?php

function accounts_team_service_contracts($print){
    global $wpdb;
    global $table_name;
    $table = $table_name['service'];
    // ------ VARIABLES ------
    $accountdisplayid = safestring($_GET['displayid']);
    // ------ QUERY ------
    global $accounts_team_service_contracts;
    $accounts_team_service_contracts = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE clientaccount = %s AND status = 0
        ORDER BY creation_date ASC 
    ",
    // ARGUMENTS
        $accountdisplayid
    ));
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_service_contracts);
    }
}