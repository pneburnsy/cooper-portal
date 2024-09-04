<?php

function notes_all($print){

    if ( doif_cooperonly_query() ) {

        global $wpdb;
        global $table_name;
        $table = $table_name['notes'];

        // ------ QUERY ------
        global $notes_all;
        $notes_all = $wpdb->get_results("
                SELECT * FROM `$table` 
            "
        );

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($notes_all);
        }

        // ------ MESSAGE/ACTION ------
        // NONE

    }

}