<?php
function exam_add($print){

    if (isset($_POST['exam_add'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['thorough_examinations'];

        // ------ VARIABLES ------
        $displayid = guid();

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'userid' => safeinteger(current_user_id()),
            'displayid' => safestring($displayid),
            'region' => safeinteger($_POST['region']),
            'clientaccount' => safestring($_POST['your-company']),
            'make' => safestring($_POST['make']),
            'model' => safestring($_POST['model']),
            'fleet_no' => safestring($_POST['fleet_no']),
            'serial_no' => safestring($_POST['serial_no']),
            'year_of_man' => safeinteger($_POST['year_of_man']),
            'hour_reading' => safeinteger($_POST['hour_reading']),
            'renewal_date' => safeinteger($_POST['renewal_date']),
            'issue_date' => safeinteger($_POST['issue_date']),
            'expiry_date' => safeinteger($_POST['expiry_date']),
            'record_number' => safestring($_POST['record_number']),
            'issuing_company' => safestring($_POST['issuing_company']),
        );
        $format = array(
            // Format
            '%d',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        );

        // ------ QUERY ------
        $exam_add = $wpdb->insert($table, $data, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($exam_add);
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Examinations"] = 'Renewal created.';
        ?><script>window.location.reload();</script><?php

    }

}