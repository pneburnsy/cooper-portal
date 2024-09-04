<?php

function survey_single($value, $print){

    global $wpdb;
    global $table_name;
    $table = $table_name['survey'];
    // ------ VARIABLES ------
    $displayid = safestring($_POST['displayid']);

    // ------ POST/GET (SANITIZE) ------
    // NONE

    // ------ QUERY ------
    global $survey_single;
    $survey_single = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table`
        WHERE displayid = '%s'
    ",
    // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($survey_single);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}