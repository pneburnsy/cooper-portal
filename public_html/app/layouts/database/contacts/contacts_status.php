<?php
function contacts_status($print){
    if (isset($_POST['contacts_status'])) {
        global $wpdb;

        // ------ POST/GET (SANITIZE) ------
        $displayid = safestring($_POST['contacts_status']);
        $users = get_users(array(
            'meta_key' => 'displayid',
            'meta_value' => $displayid,
            'number' => 1,
            'fields' => 'ID'
        ));
        $user_id = $users[0]; //ID

        $current_status = get_user_meta($user_id, 'user_active', true);
        $new_status = ($current_status == 1) ? 0 : 1;
        update_user_meta($user_id, 'user_active', $new_status);

        if ($print) {
            echo '<pre>';
            print_r(get_user_meta($user_id));
            echo '</pre>';
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Contact"] = 'Contact updated.';
        ?><script>window.location.reload();</script><?php
    }
}
