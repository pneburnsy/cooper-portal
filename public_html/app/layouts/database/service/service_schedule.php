<?php
function service_schedule($print){

    if (isset($_POST['service_schedule'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['service'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'schedule_date' => safestring($_POST['schedule_date']),
        );
        $format = array(
            // Format
            '%s',
        );
        $where = array(
            'displayid' => safestring($_GET['displayid']),
        );

        // ------ QUERY ------
        $service_schedule = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_schedule);
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }



        // ------ ADD HISTORY ------
        $table = $table_name['service_hours'];
        // VARIABLES
        $displayid = guid();
        $week = date('W', strtotime($_POST['schedule_date']));
        $year = date('Y', strtotime($_POST['schedule_date']));
        $date = date('Y-m-d H:i:s', strtotime($_POST['schedule_date']));
        $data = array(
            // Column => Value
            'userid' => safeinteger(current_user_id()),
            'displayid' => safestring($displayid),
            'servicedisplayid' => safestring($_GET['displayid']),
            'type' => safeinteger(7),
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
            '%d',
            '%d',
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
        $_SESSION["Service"] = 'Service scheduled.';
        ?><script>window.location.reload();</script><?php
    }


}