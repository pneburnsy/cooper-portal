<?php

function maintenance_complete($print){

    if (isset($_POST['maintenance_complete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['maintenance'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'status' => safeinteger(1),
            'status_date' => date(get_date_time()),
            'status_userid' => safeinteger(current_user_id())
        );
        $where = array(
            'displayid' => safestring($_POST['maintenance_complete'])
        );
        $format = array(
            // Format
            '%s'
        );

        // ------ QUERY ------
        $maintenance_complete = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($maintenance_complete);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Maintenance"] = 'Renewal completed.';
        ?><script>window.location.reload();</script><?php

    }

}

function maintenance_uncomplete($print){

    if (isset($_POST['maintenance_uncomplete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['maintenance'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'status' => safeinteger(0),
            'status_date' => date(get_date_time()),
            'status_userid' => safeinteger(current_user_id())
        );
        $where = array(
            'displayid' => safestring($_POST['maintenance_uncomplete'])
        );
        $format = array(
            // Format
            '%s'
        );

        // ------ QUERY ------
        $maintenance_uncomplete = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($maintenance_uncomplete);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Maintenance"] = 'Renewal uncompleted.';
        ?><script>window.location.reload();</script><?php

    }

}

function maintenance_bin($print){

    if (isset($_POST['maintenance_bin'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['maintenance'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'status' => safeinteger(2),
            'status_date' => date(get_date_time()),
            'status_userid' => safeinteger(current_user_id())
        );
        $where = array(
            'displayid' => safestring($_POST['maintenance_bin'])
        );
        $format = array(
            // Format
            '%s'
        );

        // ------ QUERY ------
        $maintenance_bin = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($maintenance_bin);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Maintenance"] = 'Renewal deleted.';
        ?><script>window.location.href = "page_maintenance_contracts.php";</script><?php

    }

}