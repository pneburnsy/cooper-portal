<?php

function service_complete($print){

    if (isset($_POST['service_complete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['service'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'status' => safeinteger(1),
            'status_date' => date(get_date_time()),
            'status_userid' => safeinteger(current_user_id())
        );
        $where = array(
            'displayid' => safestring($_POST['service_complete'])
        );
        $format = array(
            // Format
            '%s'
        );

        // ------ QUERY ------
        $service_complete = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_complete);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Service"] = 'Service contract completed.';
        ?><script>window.location.reload();</script><?php

    }

}

function service_uncomplete($print){

    if (isset($_POST['service_uncomplete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['service'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'status' => safeinteger(0),
            'status_date' => date(get_date_time()),
            'status_userid' => safeinteger(current_user_id())
        );
        $where = array(
            'displayid' => safestring($_POST['service_uncomplete'])
        );
        $format = array(
            // Format
            '%s'
        );

        // ------ QUERY ------
        $service_uncomplete = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_uncomplete);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Service"] = 'Service contract uncompleted.';
        ?><script>window.location.reload();</script><?php

    }

}

function service_bin($print){

    if (isset($_POST['service_bin'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['service'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'status' => safeinteger(2),
            'status_date' => date(get_date_time()),
            'status_userid' => safeinteger(current_user_id())
        );
        $where = array(
            'displayid' => safestring($_POST['service_bin'])
        );
        $format = array(
            // Format
            '%s'
        );

        // ------ QUERY ------
        $service_bin = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_bin);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Service"] = 'Service contract deleted.';
        ?><script>window.location.href = "page_service_contract.php";</script><?php

    }

}