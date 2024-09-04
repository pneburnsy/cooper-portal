<?php

function exam_all($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['thorough_examinations'];

    // ------ POST/GET (SANITIZE) ------
    if ($_GET['page'] == 'completed') {
        $completestatus = 1;
    } else {
        $completestatus = 0;
    }

    // ------ QUERY ------
    global $exam_team_all;
    $exam_team_all = $wpdb->get_results("
        SELECT * FROM `$table` WHERE status = $completestatus;
    "
    );

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($exam_team_all);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}