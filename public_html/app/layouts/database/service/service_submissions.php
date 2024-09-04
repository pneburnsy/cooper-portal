<?php

function service_submissions($print){

    if (isset($_POST['service_submission_page'])) {


        global $wpdb;
        global $table_name;
        $table = $table_name['service'];
        //VARIABLES
        $lastservicedate = date('Y-m-d H:i:s', strtotime($_POST['submitted_last_odo_date']));
        $duewithin = $_POST['due_odo_date'];
        $duedate = date('Y-m-d H:i:s', strtotime($duewithin, strtotime($lastservicedate)));

        if ($_POST['submitted_lastest_odo_hours'] > $_POST['submitted_last_odo_hours']) {
            $data = array(
                // Column => Value
                'last_odo_date' => safestring($lastservicedate),
                'last_odo_hours' => safeinteger($_POST['submitted_last_odo_hours']),
                'serviceduein' => safestring($_POST['serviceduein']),
                'due_odo_date' => safestring($duedate),
                'schedule_date' => '0000-00-00',
            );
            $format = array(
                // Format
                '%s',
                '%d',
                '%s',
                '%s',
                '%s',
            );
        } else {
            $data = array(
                // Column => Value
                'lastest_odo_hours' => safeinteger($_POST['submitted_last_odo_hours']),
                'last_odo_date' => safestring($lastservicedate),
                'last_odo_hours' => safeinteger($_POST['submitted_last_odo_hours']),
                'serviceduein' => safestring($_POST['serviceduein']),
                'due_odo_date' => safestring($duedate),
                'schedule_date' => '0000-00-00',
            );
            $format = array(
                // Format
                '%d',
                '%s',
                '%d',
                '%s',
                '%s',
                '%s',
            );
        }
        $where = array(
            'displayid' => safestring($_GET['displayid']),
        );
        // ------ QUERY ------
        $service_submissions = $wpdb->update($table, $data, $where, $format);
        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_submissions);
        }


        $table = $table_name['service_hours'];
        // VARIABLES
        $displayid = guid();
        $currentservicehours = $_POST['typedata'];
        $week = date('W', strtotime($_POST['submitted_last_odo_date']));
        $year = date('Y', strtotime($_POST['submitted_last_odo_date']));
        $date = date('Y-m-d H:i:s', strtotime($_POST['submitted_last_odo_date']));
        $data = array(
            // Column => Value
            'userid' => safeinteger(current_user_id()),
            'displayid' => safestring($displayid),
            'servicedisplayid' => safestring($_POST['service_submission_page']),
            'odo_reading' => safeinteger($_POST['submitted_last_odo_hours']),
            'type' => safeinteger(2),
            'typedata' => safestring($currentservicehours),
            'submission_week' => safeinteger($week),
            'submission_year' => safeinteger($year),
            'submission_date' => safeinteger($date),
        );
        $format = array(
            // Format
            '%d',
            '%s',
            '%s',
            '%d',
            '%d',
            '%s',
            '%d',
            '%d',
            '%s',
        );
        // ------ QUERY ------
        $service_log_service = $wpdb->insert($table, $data, $format);
        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_log_service);
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }


        // ------ MESSAGE/ACTION ------
        $_SESSION["Service"] = 'Service contract updated.';
        ?><script>window.location.reload();</script><?php
    }

}