<?php

function exam_complete($print){

    if (isset($_POST['exam_complete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['thorough_examinations'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'status' => safeinteger(1),
            'status_date' => date(get_date_time()),
            'status_userid' => safeinteger(current_user_id())
        );
        $where = array(
            'displayid' => safestring($_POST['exam_complete'])
        );
        $format = array(
            // Format
            '%s'
        );

        // ------ QUERY ------
        $exam_complete = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($exam_complete);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Examinations"] = 'Renewal completed.';
        ?><script>window.location.reload();</script><?php

    }

}

function exam_uncomplete($print){

    if (isset($_POST['exam_uncomplete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['thorough_examinations'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'status' => safeinteger(0),
            'status_date' => date(get_date_time()),
            'status_userid' => safeinteger(current_user_id())
        );
        $where = array(
            'displayid' => safestring($_POST['exam_uncomplete'])
        );
        $format = array(
            // Format
            '%s'
        );

        // ------ QUERY ------
        $exam_uncomplete = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($exam_uncomplete);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Examinations"] = 'Renewal uncompleted.';
        ?><script>window.location.reload();</script><?php

    }

}

function exam_bin($print){

    if (isset($_POST['exam_bin'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['thorough_examinations'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'status' => safeinteger(2),
            'status_date' => date(get_date_time()),
            'status_userid' => safeinteger(current_user_id())
        );
        $where = array(
            'displayid' => safestring($_POST['exam_bin'])
        );
        $format = array(
            // Format
            '%s'
        );

        // ------ QUERY ------
        $exam_bin = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($exam_bin);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Examinations"] = 'Renewal deleted.';
        ?><script>window.location.href = "page_thorough_examinations.php";</script><?php

    }

}