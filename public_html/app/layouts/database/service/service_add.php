<?php

function service_add($print){

    /*?><pre><?php print_r($_POST); ?></pre><?php*/

    if (isset($_POST['service_add'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['service'];

        // ------ VARIABLES ------
        $displayid = guid();
        $location = postcode_city_convert($_POST['postcode']);

        $lastservicedate = date('d-m-Y', strtotime($_POST['last_odo_date']));
        $duewithin = $_POST['due_odo_date'];
        $duedate = date('Y-m-d H:i:s', strtotime($duewithin, strtotime($lastservicedate)));

        if ( $_POST['lastest_odo_hours'] == '' && $_POST['lastest_odo_date'] == '' ) {
            $is_latest_data = false;
            $lastest_odo_hours = $_POST['last_odo_hours'];
            $lastest_odo_date = $_POST['last_odo_date'];
        } else {
            $is_latest_data = true;
            $lastest_odo_hours = $_POST['lastest_odo_hours'];
            $lastest_odo_date = $_POST['lastest_odo_date'];
        }

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
            'man_serial_no' => safestring($_POST['man_serial_no']),
            'eng_serial_no' => safestring($_POST['eng_serial_no']),
            'location' => safestring($location),
            'postcode' => safestring($_POST['postcode']),
            'last_odo_hours' => safeinteger($_POST['last_odo_hours']),
            'last_odo_date' => safeinteger($_POST['last_odo_date']),
            'due_odo_date' => safeinteger($duedate),
            'starting_hours' => safeinteger( $_POST['last_odo_hours']),
            'serviceduein' => safeinteger($_POST['serviceduein']),
            'lastest_odo_hours' => safeinteger($lastest_odo_hours),
            'lastest_odo_date' => safeinteger($lastest_odo_date),
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
            '%s',
            '%s',
            '%s',
            '%d',
            '%d',
            '%d',
            '%d',
            '%d',
            '%d',
            '%d',
        );
        // ------ QUERY ------
        $service_add = $wpdb->insert($table, $data, $format);
        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_add);
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }

        // ADD START DATE TO HISTORY
        $table = $table_name['service_hours'];
        // VARIABLES
        $historydisplayid = guid();

        $historyweek = date('W Y', strtotime($_POST['last_odo_date']));
        $historydate = date('Y-m-d H:i:s', strtotime($_POST['last_odo_date']));
        list($week, $year) = explode(' ', $historyweek);
        // CHECK MONTH FOR WEEK NUM
        $currentmonth = date('m', strtotime($_POST['last_odo_date']));
        if ($currentmonth == '01' && $week == '52') {
            $week = '01';
        }

        $data = array(
            // Column => Value
            'userid' => safeinteger(current_user_id()),
            'displayid' => safestring($historydisplayid),
            'servicedisplayid' => safestring($displayid),
            'odo_reading' => safeinteger($_POST['last_odo_hours']),
            'type' => safeinteger(1),
            'submission_week' => safeinteger($week),
            'submission_year' => safeinteger($year),
            'submission_date' => safeinteger($historydate),
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
            '%s',
        );
        // ------ QUERY ------
        $service_start_date = $wpdb->insert($table, $data, $format);
        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_start_date);
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }


        if ($is_latest_data == true) {
            // ADD LATEST DATE TO HISTORY
            $table = $table_name['service_hours'];
            // VARIABLES
            $lastdisplayid = guid();
            $lastweek = date('W', strtotime($_POST['lastest_odo_date']));
            $lastdate = date('Y-m-d H:i:s', strtotime($_POST['lastest_odo_date']));
            // CHECK MONTH FOR WEEK NUM
            $currentmonth = date('m', strtotime($_POST['lastest_odo_date']));
            if ($currentmonth == '01' && $lastweek == '52') {
                $lastweek = '01';
            }
            $lastyear = date('Y', strtotime($_POST['lastest_odo_date']));
            $data = array(
                // Column => Value
                'userid' => safeinteger(current_user_id()),
                'displayid' => safestring($lastdisplayid),
                'servicedisplayid' => safestring($displayid),
                'odo_reading' => safeinteger($_POST['lastest_odo_hours']),
                'submission_week' => safeinteger($lastweek),
                'submission_year' => safeinteger($lastyear),
                'submission_date' => safeinteger($lastdate),
            );
            $format = array(
                // Format
                '%d',
                '%s',
                '%s',
                '%d',
                '%d',
                '%d',
                '%s',
            );
            // ------ QUERY ------
            $service_latest_date = $wpdb->insert($table, $data, $format);
            // ------ BUG CHECKING ------
            if ($print == true) {
                print_r($service_latest_date);
                echo $wpdb->last_error;
                echo $wpdb->last_query;
            }
        }


        // ------ MESSAGE/ACTION ------
        $_SESSION["Service"] = 'Service contract created.';
        ?><script>window.location.reload();</script><?php

    }

}