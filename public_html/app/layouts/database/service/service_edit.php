<?php
function service_edit($print){

    if (isset($_POST['service_edit'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['service'];

        // ------ POST/GET (SANITIZE) ------
        $location = postcode_city_convert($_POST['postcode']);

        $data = array(
            // Column => Value
            'clientaccount' => safestring($_POST['your-company']),
            'make' => safestring($_POST['make']),
            'region' => safeinteger($_POST['region']),
            'model' => safestring($_POST['model']),
            'fleet_no' => safestring($_POST['fleet_no']),
            'man_serial_no' => safestring($_POST['man_serial_no']),
            'eng_serial_no' => safestring($_POST['eng_serial_no']),
            'location' => safestring($location),
            'postcode' => safestring($_POST['postcode']),
        );
        $format = array(
            // Format
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        );
        $where = array(
            'displayid' => safestring($_GET['displayid']),
        );

        // ------ QUERY ------
        $service_edit = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_edit);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Service"] = 'Service contract updated.';
        ?><script>window.location.reload();</script><?php
    }

}