<?php
function rentals_edit($print){

    if (isset($_POST['rentals_edit'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['rentals'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'clientaccount' => safestring($_POST['your-company']),
            'hire_start' => safestring($_POST['hire_start']),
            'hire_end' => safestring($_POST['hire_end']),
            'region' => safeinteger($_POST['region']),
            'contract_reference' => safeinteger($_POST['contract_reference']),
            'contracted_hours' => safefloat($_POST['contracted_hours']),
            'notes' => safestring($_POST['notes'])
        );
        $format = array(
            // Format
            '%s',
            '%s',
            '%s',
            '%d',
            '%d',
            '%f',
            '%s',
        );
        if ( current_user_can('administrator') ) {
            $data['rent_rate'] = safefloat($_POST['rent_rate']);
            $data['excess_rate'] = safefloat($_POST['excess_rate']);
            $data['excess_rate_min'] = safefloat($_POST['excess_rate_min']);
            array_push($format,
                '%f',
                '%f',
                '%f',
            );
        }

        $where = array(
            'displayid' => safestring($_GET['displayid']),
        );

        // ------ QUERY ------
        $rentals_edit = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($rentals_edit);
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Rentals"] = 'Renewal updated.';
        ?><script>window.location.reload();</script><?php
    }

}