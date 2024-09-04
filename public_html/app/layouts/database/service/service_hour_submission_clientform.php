<?php

function service_hour_submission_clientform($print){

    if (isset($_POST['service_hour_submission_clientform'])) {

        global $wpdb;



        // ------ POST/GET (SANITIZE) ------
        for ($x = 0; $x < count($_POST['input']); $x++) {

            if (empty($_POST['input'][$x][0])) {

                continue;

            } else {

                $table = $wpdb->prefix . 'service_hours';
                // ------ VARIABLES ------
                $displayid = guid();
                $hours = $_POST['input'][$x][0];
                $week = $_POST['input'][$x][1];
                $year = $_POST['input'][$x][2];
                $servicedisplayid = $_POST['input'][$x][3];
                // ------ DATA ------
                $data = array(
                    // Column => Value
                    'userid' => safeinteger(current_user_id()),
                    'displayid' => safestring($displayid),
                    'servicedisplayid' => safestring($servicedisplayid),
                    'odo_reading' => safeinteger($hours),
                    'submission_week' => safeinteger($week),
                    'submission_year' => safeinteger($year),
                    'submission_date' => date('Y-m-d H:i:s'),
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
                if ($_POST['input'][$x][0] != NULL) {
                    $service_hour_submission_clientform = $wpdb->insert($table, $data, $format);
                    // ------ BUG CHECKING ------
                    if ($print == true) {
                        print_r($service_hour_submission_clientform);
                        echo $wpdb->last_error;
                        echo $wpdb->last_query;
                    }
                }


                // ------ UPDATE PARENT ------
                $finalHour = $_POST['input'][$x][0];
                $finalDisplayid = $_POST['input'][$x][3];
                $finalDate = date('Y-m-d H:i:s');
                $data = array(
                    // Column => Value
                    'lastest_odo_hours' => safeinteger($finalHour),
                    'lastest_odo_date' => $finalDate,
                );
                $format = array(
                    // Format
                    '%d',
                    '%s',
                );
                $where = array(
                'displayid' => safestring($finalDisplayid),
                );
                // ------ QUERY ------
                $table = $wpdb->prefix . 'service';
                $update_parent = $wpdb->update($table, $data, $where, $format);
                if ($print == true) {
                    print_r($update_parent);
                    echo $wpdb->last_error;
                    echo $wpdb->last_query;
                }

            }

        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Service"] = 'Service hours added.';
        ?><script>window.location.reload();</script><?php

    }

}