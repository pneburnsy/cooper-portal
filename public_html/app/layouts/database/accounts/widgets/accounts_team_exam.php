<?php

function accounts_team_exam($print){
    global $wpdb;
    global $table_name;
    $table = $table_name['thorough_examinations'];
    // ------ VARIABLES ------
    $accountdisplayid = safestring($_GET['displayid']);
    // ------ QUERY ------
    global $accounts_team_exam;
    $accounts_team_exam = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE clientaccount = %s AND status = 0
        ORDER BY creation_date ASC 
    ",
        // ARGUMENTS
        $accountdisplayid
    ));
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_exam);
    }
}