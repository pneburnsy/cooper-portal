<?php

function exam_count($print, $value = 0){
    global $wpdb;
    global $table_name;
    $table = $table_name['thorough_examinations'];
    // VARIABLES
    $status = $value;
    // ------ QUERY ------
    global $exam_count;
    $exam_count = $wpdb->get_var("
        SELECT COUNT(*) AS total FROM `$table` WHERE status = '$status'
    "
    );
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($exam_count);
    }
}