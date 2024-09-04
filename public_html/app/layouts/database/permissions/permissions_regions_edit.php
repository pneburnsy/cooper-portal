<?php

function permission_regions_edit($print = false) {
    if (isset($_POST['permission_regions_edit'])) {
        global $wpdb;
        global $table_name;
        $table = $table_name['regions'];

        $displayid = safestring($_GET['displayid']);

        $users = get_users(array(
            'meta_key' => 'displayid',
            'meta_value' => $displayid,
            'number' => 1,
            'fields' => 'ID'
        ));
        if (empty($users)) {
            return;
        }
        $user_id = $users[0];

        $region_mainland = isset($_POST['region_mainland']) ? 1 : 0;
        $region_ireland = isset($_POST['region_ireland']) ? 1 : 0;

        $existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table` WHERE userid = %d", $user_id));

        if ($existing_row) {
            $wpdb->update(
                $table,
                array(
                    'mainland' => $region_mainland,
                    'ireland' => $region_ireland
                ),
                array('userid' => $user_id),
                array(
                    '%d',
                    '%d'
                ),
                array('%d')
            );
        } else {
            $wpdb->insert(
                $table,
                array(
                    'userid' => $user_id,
                    'mainland' => $region_mainland,
                    'ireland' => $region_ireland
                ),
                array(
                    '%d',
                    '%d',
                    '%d'
                )
            );
        }

        if ($print == true) {
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            echo $wpdb->last_error;
            echo $wpdb->last_query;
        }

        $_SESSION["Permission"] = 'Permissions updated.';
        ?><script>window.location.href = "page_view_users_view?displayid=<?= $_GET['displayid']?>&tab=contacts_permissions";</script><?php
    }
}