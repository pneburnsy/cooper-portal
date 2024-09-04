<?php

function rentals_complete($print) {

    if (isset($_POST['rentals_complete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['rentals'];

        // VARIABLES
        $displayid = safestring($_GET['displayid']);
        $rentals_data = $wpdb->get_results("SELECT * FROM `$table` WHERE displayid = '$displayid' AND status = 0");

        //------------ CREATE NEW ------------ POST/GET (SANITIZE) ------------
        $data = array(
            // Column => Value
            'userid' => safeinteger(current_user_id()),
            'displayid' => guid(),
            'parent_displayid' => $displayid,
            'clientaccount' => safestring($rentals_data[0]->clientaccount),
            'make' => safestring($rentals_data[0]->make),
            'model' => safestring($rentals_data[0]->model),
            'serial_no' => safestring($rentals_data[0]->serial_no),
            'year_of_man' => safeinteger($rentals_data[0]->year_of_man),
            'finance_company' => safestring($rentals_data[0]->finance_company),
            'agreement_number' => safestring($rentals_data[0]->agreement_number),
            'contract_reference' => safeinteger($rentals_data[0]->contract_reference),
            'hire_start' => safestring($rentals_data[0]->hire_start),
            'hire_end' => safestring($rentals_data[0]->hire_end),
            'rent_rate' => safefloat($rentals_data[0]->rent_rate),
            'contracted_hours' => safefloat($rentals_data[0]->contracted_hours),
            'excess_rate' => safefloat($rentals_data[0]->excess_rate),
            'excess_rate_min' => safefloat($rentals_data[0]->excess_rate_min),
            'notes' => $rentals_data[0]->notes,
            'status' => safeinteger(1),
            'status_userid' => safeinteger(current_user_id()),
        );
        $format = array(
            // Format
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%f',
            '%f',
            '%f',
            '%f',
            '%s',
            '%d',
            '%d',
        );
        // ------ QUERY ------
        $rentals_complete = $wpdb->insert($table, $data, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            //print_r($rentals_complete);
            print_r($rentals_data);
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }

    }

}


function rentals_reset($print) {

    if (isset($_POST['rentals_reset']) || isset($_POST['rentals_complete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['rentals'];

        // VARIABLES

        // ------------ EDIT ------------ POST/GET (SANITIZE) ------------
        $data = array(
            // Column => Value
            'clientaccount' => NULL,
            'contract_reference' => NULL,
            'hire_start' => NULL,
            'hire_end' => NULL,
            'notes' => NULL,
        );
        $where = array(
            'displayid' => safestring($_GET['displayid']),
            'status' => 0,
        );
        $format = array(
            // Format
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
        );
        // ------ QUERY ------
        $rentals_reset = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($rentals_reset);
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Rentals"] = 'Rental updated.';
        ?><script>window.location.href = "page_rental_equipment_view?tab=renewal_settings&displayid=<?= $_GET['displayid']?>";</script><?php

    }

}