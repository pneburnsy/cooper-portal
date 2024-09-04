<?php
function contacts_edit($print){

    if (isset($_POST['contacts_edit'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['notes'];

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'contacts_first_name' => ,
            'contacts_last_name' => ,
            'contacts_email' => ,
            'contacts_office_phone' => ,
            'contacts_mobile_phone' => ,
            'your-company' => ,
            'region' => ,
            'contacts_status' => ,
            'contacts_password' => ,
        );
        $where = array(
            'displayid' => safestring($_GET['displayid']),
        );
        $format = array(
            // Format
        );

        // ------ QUERY ------
        $contacts_edit = $wpdb->update($table, $data, $where, $format);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($contacts_edit);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Contact"] = 'Contact updated.';
        ?><script>window.location.href = "page_view_users_view?tab=contacts_settings&displayid=<?= $_GET['displayid']?>";</script><?php

    }

}