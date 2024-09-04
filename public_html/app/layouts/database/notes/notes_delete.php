<?php
function notes_delete($print){
    if (isset($_POST['notes_delete'])) {
        global $wpdb;
        global $table_name;
        $table = $table_name['notes'];
        // ------ POST/GET (SANITIZE) ------
        $data = array(
            'status' => safeinteger(1),
            'status_date' => date('Y-m-d H:i:s'),
        );
        $where = array(
            'uid' => safestring($_POST['notes_delete']),
        );
        $format = array(
            '%d',
            '%s',
        );
        // ------ QUERY ------
        $accounts_team_edit = $wpdb->update($table, $data, $where, $format);
        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($accounts_team_edit);
        }
        // ------ MESSAGE/ACTION ------
        $_SESSION["Feed"] = 'Feed updated.';
        ?><script>window.location.reload();</script><?php
    }
}