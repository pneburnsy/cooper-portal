<?php
function contacts_edit($print){
    if (isset($_POST['contacts_edit'])) {
        global $wpdb;

        // ------ POST/GET (SANITIZE) ------
        $displayid = safestring($_GET['displayid']);
        $users = get_users(array(
            'meta_key' => 'displayid',
            'meta_value' => $displayid,
            'number' => 1,
            'fields' => 'ID'
        ));
        $user_id = $users[0]; //ID

        // Initialise role
        $role = null;

        update_user_meta($user_id, 'ae_capabilities', null);

        switch ($_POST['contacts_role']) {
            case 'administrator':
                $role = 'administrator';
                break;
            case 'employee_editor':
                $role = 'employee_editor';
                break;
            case 'employee':
                $role = 'employee';
                break;
            default:
                $role = 'customer';
                break;
        }

        $u = new WP_User($user_id);

        foreach ($u->roles as $existing_role) {
            $u->remove_role($existing_role);
        }

        $u->add_role($role);

        $userdata = array(
            'ID'           => $user_id,
            'user_login'   => safestring($_POST['contacts_email']),
            'first_name'   => safestring($_POST['contacts_first_name']),
            'last_name'    => safestring($_POST['contacts_last_name']),
            'display_name'   => safestring($_POST['contacts_first_name']) . ' ' . SafeString($_POST['contacts_last_name']),
            'user_email'   => safestring($_POST['contacts_email']),
        );

        if (isset($_POST['contacts_p']) && !empty($_POST['contacts_p'])) {
            $userdata['user_pass'] = safestring($_POST['contacts_p']);
        }

        $user_id = wp_update_user($userdata);

        update_user_meta($user_id, 'region', safestring($_POST['contacts_region']));
        update_user_meta($user_id, 'title', safestring($_POST['contacts_title']));
        update_user_meta($user_id, 'account', safestring($_POST['contacts_account']));
        update_user_meta($user_id, 'mobile_phone', safestring($_POST['contacts_mobile_phone']));
        update_user_meta($user_id, 'office_phone', safestring($_POST['contacts_office_phone']));
        update_user_meta($user_id, 'role', $role); // Store the role for reference if needed
        update_user_meta($user_id, 'address_street', safestring($_POST['address_street']));
        update_user_meta($user_id, 'address_city', safestring($_POST['address_city']));
        update_user_meta($user_id, 'address_postcode', safestring($_POST['address_postcode']));

        // GEO CODE
        $postcode = safestring($_POST['address_postcode']);
        $api_url = "https://geocode.maps.co/search?q=" . urlencode($postcode) . "&api_key=66d5a1c87be7d126152923dop72193d";

        $response = wp_remote_get($api_url);

        if (is_wp_error($response)) {
        } else {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
            if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
                $latitude = $data[0]['lat'];
                $longitude = $data[0]['lon'];

                $geo = array('lat' => $latitude, 'lon' => $longitude);

                update_user_meta($user_id, 'geo', $geo);
            }
        }

        // STATUS
        if ($_POST['contacts_status'] == '0' || $_POST['contacts_status'] == 0) {
            update_user_meta($user_id, 'user_active', '0');
        } elseif ($_POST['contacts_status'] == '1' || $_POST['contacts_status'] == 1) {
            update_user_meta($user_id, 'user_active', '1');
        }

        if ($print) {
            echo '<pre>';
            print_r($userdata);
            print_r(get_user_meta($user_id));
            echo '</pre>';
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Contact"] = 'Contact updated.';
        ?><script>window.location.href = "page_view_users_view?displayid=<?= $_GET['displayid']?>&tab=contacts_settings";</script><?php
    }
}
