<?php
function menu_applications_add($print){

    if (isset($_POST['menu_applications_add'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['application'];

        // ------ VARIABLES ------
        // NONE

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'menuname' => safestring($_POST['menu_name']),
            'menuurl' => safestring($_POST['menu_url']),
            'menuorder' => safeinteger($_POST['menu_order'])
        );
        $format = array(
            // Format
            '%s',
            '%s',
            '%d'
        );

        // ------ QUERY ------
        $menu_applications_add = $wpdb->insert($table, $data, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($menu_applications_add);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Application"] = 'Application Link Added.';
        ?><script>window.location.reload();</script><?php

    }

}