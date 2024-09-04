<?php

function survey_all($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['survey'];

    // ------ QUERY ------
    global $survey_all;
    $survey_all = $wpdb->get_results("
        SELECT * FROM `$table`
        GROUP BY created
        ORDER BY submitted DESC;
    ");

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($survey_all);
    }

}

function survey_all_3month($print) {

    global $wpdb;
    global $table_name;
    $table = $table_name['survey'];

    // ------ QUERY ------
    global $survey_3month;
    $survey_3month = $wpdb->get_results("
        SELECT * FROM `$table`
        WHERE submitted >= now()-interval 3 month
        ORDER BY created ASC 
    "
    );

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($survey_3month);
    }

}

function survey_all_1month($print) {

    global $wpdb;
    global $table_name;
    $table = $table_name['survey'];

    // ------ QUERY ------
    global $survey_1month;
    $survey_1month = $wpdb->get_results("
        SELECT * FROM `$table`
        WHERE submitted >= now()-interval 1 month
        ORDER BY created ASC 
    "
    );

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($survey_1month);
    }

}


