<?php
function accounts_team_delete($print){

    if (isset($_POST['accounts_team_delete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['accounts'];

        // ------ QUERY ------
        $data = array(
            'displayid' => safestring($_GET['displayid'])
        );
        $format = array(
            '%s'
        );
        $accounts_team_delete = $wpdb->delete($table, $data, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($accounts_team_delete);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Account"] = 'Account deleted.';
        ?><script>window.location.href = "page_accounts";</script><?php

    }

}