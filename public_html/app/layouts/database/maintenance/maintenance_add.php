<?php
function maintenance_add($print){

    if (isset($_POST['maintenance_add'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['maintenance'];

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
            'contract_id' => safestring($_POST['contractid']),
            'main_start' => safeinteger($_POST['start_date']),
            'main_end' => safeinteger($_POST['end_date']),
            'contract_review' => safeinteger($_POST['contract_review']),
            'main_cost' => safefloat($_POST['main_cost']),
            'main_hourly' => safefloat($_POST['main_hourly']),
            'hours_per_annum' => safeinteger($_POST['hours_per_annum']),
            'excess_charge' => safefloat($_POST['main_excess']),
            'only_500' => safefloat($_POST['only_500']),
            'only_1000' => safefloat($_POST['only_1000']),
            'only_2000' => safefloat($_POST['only_2000']),
            'only_3000' => safefloat($_POST['only_3000']),
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
            '%s',
            '%d',
            '%d',
            '%d',
            '%f',
            '%f',
            '%d',
            '%f',
            '%f',
            '%f',
            '%f',
            '%f',
        );

        // ------ QUERY ------
        $maintenance_add = $wpdb->insert($table, $data, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($maintenance_add);
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Maintenance"] = 'Renewal created.';
        ?><script>window.location.reload();</script><?php

    }

}