<?php

function menu_applications_all($print){

    if ( doif_cooperonly_query() ) {

        global $wpdb;
        global $table_name;
        $table = $table_name['application'];
        // ------ VARIABLES ------
        // NONE

        // ------ POST/GET (SANITIZE) ------
        // NONE

        // ------ QUERY ------
        global $menu_applications_all;
        $menu_applications_all = $wpdb->get_results("
                SELECT * FROM `$table` 
                ORDER BY menuorder, menuname ASC
            "
        );

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($menu_applications_all);
        }

        // ------ MESSAGE/ACTION ------
        // NONE

    }

}