<?php

function exam_view($print) {

    global $wpdb;
    global $table_name;
    $table = $table_name['thorough_examinations'];

    // ------ POST/GET (SANITIZE) ------
    $displayid = $_GET['displayid'];

    // ------ QUERY ------
    global $exam_view;
    $exam_view = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE displayid = %s
    ",
        // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($exam_view);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}