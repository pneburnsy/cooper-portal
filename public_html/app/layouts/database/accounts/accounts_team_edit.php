<?php
function accounts_team_edit($print){

    if (isset($_POST['accounts_team_edit'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['accounts'];

        // VARIABLES
        $website = clean_website_url($_POST['accountwebsite']);

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'accountname' => safestring($_POST['accountname']),
            'accountphone' => safestring($_POST['accountphone']),
            'accountemail' => safeemail($_POST['accountemail']),
            'accountwebsite' => safestring($website),
            'fleetmanager' => safestring($_POST['accountfleetmanager']),
            'fleetmanageradmin' => safestring($_POST['accountfleetmanageradmin']),
        );
        $where = array(
            'displayid' => safestring($_GET['displayid']),
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
        $accounts_team_edit = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($accounts_team_edit);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Account"] = 'Account updated.';
        ?><script>window.location.href = "page_accounts_view?tab=accounts_settings&displayid=<?= $_GET['displayid']?>";</script><?php

    }

}