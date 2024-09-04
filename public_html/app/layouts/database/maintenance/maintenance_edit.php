<?php
function maintenance_edit($print){

    if (isset($_POST['maintenance_edit'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['maintenance'];

        // ------ POST/GET (SANITIZE) ------

        $data = array(
            // Column => Value
            'clientaccount' => safestring($_POST['your-company']),
            'make' => safestring($_POST['make']),
            'region' => safeinteger($_POST['region']),
            'model' => safestring($_POST['model']),
            'fleet_no' => safestring($_POST['fleet_no']),
            'serial_no' => safestring($_POST['serial_no']),
            'year_of_man' => safeinteger($_POST['year_of_man']),
            'contract_id' => safestring($_POST['contractid']),
            'main_start' => safeinteger($_POST['start_date']),
            'main_end' => safeinteger($_POST['end_date']),
            'contract_review' => safeinteger($_POST['contract_review']),
            'hours_per_annum' => safeinteger($_POST['hours_per_annum']),
        );
        $format = array(
            // Format
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%d',
            '%d',
            '%d',
            '%d',
        );
        if ( current_user_can('administrator') ) {
            $data['main_cost'] = safefloat($_POST['main_cost']);
            $data['main_hourly'] = safefloat($_POST['main_hourly']);
            $data['excess_charge'] = safefloat($_POST['main_excess']);
            $data['only_500'] = safefloat($_POST['only_500']);
            $data['only_1000'] = safefloat($_POST['only_1000']);
            $data['only_2000'] = safefloat($_POST['only_2000']);
            $data['only_3000'] = safefloat($_POST['only_3000']);
            array_push($format,
                '%f',
                '%f',
                '%f',
                '%f',
                '%f',
                '%f',
                '%f',
            );
        }

        $where = array(
            'displayid' => safestring($_GET['displayid']),
        );

        // ------ QUERY ------
        $maintenance_edit = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($maintenance_edit);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Maintenance"] = 'Renewal updated.';
        ?><script>window.location.reload();</script><?php
    }

}