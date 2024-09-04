<?php
function menu_applications_delete($print){

    if (isset($_POST['menu_applications_delete'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['application'];

        // ------ VARIABLES ------
        $teamid = current_user_teamid();

        // ------ QUERY ------
        $data = array(
            'uid' => safestring($_POST['menu_applications_delete'])
        );
        $format = array(
            '%d'
        );
        $menu_applications_delete = $wpdb->delete($table, $data, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($menu_applications_delete);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Application"] = 'Application Link Deleted.';
        ?><script>window.location.reload();</script><?php
    }

}