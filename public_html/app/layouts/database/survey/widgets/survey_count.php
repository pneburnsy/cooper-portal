<?php

function survey_count($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['survey'];
    
    // ------ QUERY ------
    global $survey_count;
    $survey_count = $wpdb->get_var("
        SELECT COUNT(*) AS total FROM `$table`
    "
    );

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($survey_count);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}