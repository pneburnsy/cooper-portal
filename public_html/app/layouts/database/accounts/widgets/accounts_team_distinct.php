<?php

function accounts_team_distinct($print){

    global $wpdb;
    global $table_name;
    $table = $table_name['accounts'];

    // ------ POST/GET (SANITIZE) ------
    // NONE

    // ------ QUERY ------
    global $accounts_team_distinct;
    $accounts_team_distinct = $wpdb->get_results("
        SELECT * FROM `$table` 
        GROUP BY accountname
    "
    );

    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($accounts_team_distinct);
    }

    // ------ MESSAGE/ACTION ------
    // NONE

}