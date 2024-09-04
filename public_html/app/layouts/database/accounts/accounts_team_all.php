<?php

function accounts_team_all($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['accounts'];

    // ------ POST/GET (SANITIZE) ------
    // NONE

    // ------ QUERY ------
    if (doif_coopereditoronly_query()) {
        global $accounts_team_all;
        $accounts_team_all = $wpdb->get_results("
            SELECT * FROM `$table`
        ");
    }

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_all);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}