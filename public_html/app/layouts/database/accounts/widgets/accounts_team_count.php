<?php

function accounts_team_count($print){
    global $wpdb;
    global $table_name;
    $table = $table_name['accounts'];
    // ------ QUERY ------
    global $accounts_team_count;
    $accounts_team_count = $wpdb->get_var("
        SELECT COUNT(*) AS total FROM `$table`
    "
    );
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_count);
    }
}

function accounts_team_survey_count($displayid, $print) {
    global $wpdb;
    global $table_name;
    $table = $table_name['survey'];
    // ------ VARIABLES ------
    $accountdisplayid = safestring($displayid);
    // ------ QUERY ------
    global $accounts_team_survey_count;
    $accounts_team_survey_count = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE clientaccount = %s
        ORDER BY created ASC 
    ",
    // ARGUMENTS
    $accountdisplayid
    ));
    return count($accounts_team_survey_count);
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_survey_count);
    }
}

function accounts_team_maintenance_count($displayid, $print) {
    global $wpdb;
    global $table_name;
    $table = $table_name['maintenance'];
    // ------ VARIABLES ------
    $accountdisplayid = safestring($displayid);
    // ------ QUERY ------
    global $accounts_team_maintenance_count;
    $accounts_team_maintenance_count = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE clientaccount = %s AND status = 0
        ORDER BY creation_date ASC 
    ",
    // ARGUMENTS
        $accountdisplayid
    ));
    return count($accounts_team_maintenance_count);
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_maintenance_count);
    }
}

function accounts_team_rentals_count($displayid, $print) {
    global $wpdb;
    global $table_name;
    $table = $table_name['rentals'];
    // ------ VARIABLES ------
    $accountdisplayid = safestring($displayid);
    // ------ QUERY ------
    global $accounts_team_rentals_count;
    $accounts_team_rentals_count = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE clientaccount = %s AND status = 0
        ORDER BY creation_date ASC 
    ",
    // ARGUMENTS
    $accountdisplayid
    ));
    return count($accounts_team_rentals_count);
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_rentals_count);
    }
}

function accounts_team_service_contracts_count($displayid, $print) {
    global $wpdb;
    global $table_name;
    $table = $table_name['service'];
    // ------ VARIABLES ------
    $accountdisplayid = safestring($displayid);
    // ------ QUERY ------
    global $accounts_team_service_contracts_count;
    $accounts_team_service_contracts_count = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE clientaccount = %s AND status = 0
        ORDER BY creation_date ASC 
    ",
    // ARGUMENTS
        $accountdisplayid
    ));
    return count($accounts_team_service_contracts_count);
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_service_contracts_count);
    }
}

function accounts_team_exam_count($displayid, $print) {
    global $wpdb;
    global $table_name;
    $table = $table_name['thorough_examinations'];
    // ------ VARIABLES ------
    $accountdisplayid = safestring($displayid);
    // ------ QUERY ------
    global $accounts_team_exam_count;
    $accounts_team_exam_count = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE clientaccount = %s AND status = 0
        ORDER BY creation_date ASC 
    ",
        // ARGUMENTS
        $accountdisplayid
    ));
    return count($accounts_team_exam_count);
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_exam_count);
    }
}

function accounts_team_users_count($displayid) {
    global $accounts_team_users_count;
    $value = safestring($displayid);
    $accounts_team_users_count = get_users(array(
        'meta_key' => 'account',
        'meta_compare'  =>  '!==',
        'meta_value' => $value,
    ));
    return count($accounts_team_users_count);
}