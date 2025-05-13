<?php

function permission_edit($print) {
    if (isset($_POST['permission_edit'])) {
        global $wpdb;

        global $table_name;
        $table = $table_name['permissions'];

        $displayid = safestring($_GET['displayid']);

        $users = get_users(array(
            'meta_key' => 'displayid',
            'meta_value' => $displayid,
            'number' => 1,
            'fields' => 'ID'
        ));
        $user_id = $users[0];

        $permissions = array(
            'contacts' => isset($_POST['permission_contacts']) ? safestring($_POST['permission_contacts']) : 'default',
            'contacts_travel' => isset($_POST['permission_contacts_travel']) ? safestring($_POST['permission_contacts_travel']) : 'default',
            'accounts' => isset($_POST['permission_accounts']) ? safestring($_POST['permission_accounts']) : 'default',
            'surveys' => isset($_POST['permission_surveys']) ? safestring($_POST['permission_surveys']) : 'default',
            'maintenance' => isset($_POST['permission_maintenance']) ? safestring($_POST['permission_maintenance']) : 'default',
            'rental' => isset($_POST['permission_rental']) ? safestring($_POST['permission_rental']) : 'default',
            'examinations' => isset($_POST['permission_examinations']) ? safestring($_POST['permission_examinations']) : 'default',
            'service' => isset($_POST['permission_service']) ? safestring($_POST['permission_service']) : 'default',
            'pipeline_1' => isset($_POST['permission_pipeline_1']) ? safestring($_POST['permission_pipeline_1']) : 'default',
            'pipeline_2' => isset($_POST['permission_pipeline_2']) ? safestring($_POST['permission_pipeline_2']) : 'default',
            'pipeline_3' => isset($_POST['permission_pipeline_3']) ? safestring($_POST['permission_pipeline_3']) : 'default',
        );

        foreach ($permissions as $type => $value) {
            $wpdb->delete(
                $table,
                array(
                    'userid' => $user_id,
                    'type' => $type,
                ),
                array(
                    '%d',
                    '%s',
                )
            );
            $wpdb->replace(
                $table,
                array(
                    'userid' => $user_id,
                    'type' => $type,
                    'value' => $value,
                ),
                array(
                    '%d',
                    '%s',
                    '%s'
                )
            );
        }

        // DEBUG
        if ($print == true) {
            echo "<pre>";
            print_r($permissions);
            echo "</pre>";
        }

        // SUCCESS MESSAGE
        $_SESSION["Permission"] = 'Permissions updated.';
        ?><script>window.location.href = "page_view_users_view?displayid=<?= $_GET['displayid']?>&tab=contacts_permissions";</script><?php
    }
}