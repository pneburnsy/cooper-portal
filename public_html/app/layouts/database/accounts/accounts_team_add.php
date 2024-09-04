<?php
function accounts_team_add($print){

    if (isset($_POST['accounts_team_add'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['accounts'];

        // ------ VARIABLES ------
        $displayid = guid();
        $rand_color = rand_color();
        $website = clean_website_url($_POST['accountwebsite']);

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'displayid' => safestring($displayid),
            'accountname' => safestring($_POST['accountname']),
            'accountphone' => safestring($_POST['accountphone']), // String to keep first 0
            'accountemail' => safeemail($_POST['accountemail']),
            'accountwebsite' => safestring($website), // Remove slashes, https, http and www
            'accountarray' => safestring($rand_color)
        );
        $format = array(
            // Format
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s'
        );

        // ------ QUERY ------
        $accounts_team_add = $wpdb->insert($table, $data, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($accounts_team_add);
//            echo $wpdb->last_error;
//            echo $wpdb->last_query;
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Account"] = 'Account created.';
        ?><script>window.location.reload();</script><?php

    }

}