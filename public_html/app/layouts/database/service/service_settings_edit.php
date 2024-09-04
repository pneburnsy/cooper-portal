<?php
function service_settings_edit($print){

    if (isset($_POST['service_settings_edit'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['service'];

        $data = array(
            // Column => Value
            'serviceduein' => safestring($_POST['serviceduein']),
            'due_odo_date' => safestring($_POST['due_odo_date']),
        );
        $format = array(
            // Format
            '%s',
            '%s',
        );
        $where = array(
            'displayid' => safestring($_GET['displayid']),
        );

        // ------ QUERY ------
        $service_settings_edit = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_settings_edit);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Service"] = 'Service contract updated.';
        ?><script>window.location.reload();</script><?php
    }

}