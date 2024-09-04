<?php
function menu_applications_edit($print){

    if (isset($_POST['menu_applications_edit'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['application'];

        // ------ VARIABLES ------
        // NONE

        // ------ POST/GET (SANITIZE) ------
        for ($x = 0; $x < count($_POST['menu_name']); $x++) {

            $data = array(
                // Column => Value
                'menuname' => safestring($_POST['menu_name'][$x]),
                'menuurl' => safestring($_POST['menu_url'][$x]),
                'menuorder' => safeinteger($_POST['menu_order'][$x])
            );
            $where = array(
                'uid' => safestring($_POST['menu_uid'][$x])
            );
            $format = array(
                // Format
                '%s',
                '%s',
                '%d'
            );

            // ------ QUERY ------
            $menu_applications_edit = $wpdb->update($table, $data, $where, $format);

            // ------ BUG CHECKING ------
            if ($print == true) {
                print_r($menu_applications_edit);
            }

        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Application"] = 'Application Links Updated.';
        ?><script>window.location.reload();</script><?php

    }

}