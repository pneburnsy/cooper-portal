<?php
function exam_edit($print){

    if (isset($_POST['exam_edit'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['thorough_examinations'];

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
            'hour_reading' => safeinteger($_POST['hour_reading']),
            'renewal_date' => safeinteger($_POST['renewal_date']),
            'issue_date' => safeinteger($_POST['issue_date']),
            'expiry_date' => safeinteger($_POST['expiry_date']),
            'record_number' => safestring($_POST['record_number']),
            'issuing_company' => safestring($_POST['issuing_company']),
        );
        $where = array(
            'displayid' => safestring($_GET['displayid']),
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
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        );

        // ------ QUERY ------
        $exam_edit = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($exam_edit);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Examinations"] = 'Renewal updated.';
        ?><script>window.location.reload();</script><?php
    }

}