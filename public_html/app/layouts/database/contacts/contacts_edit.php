<?php

function contacts_edit($print) {
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

        $u = new WP_User($user_id);
        $current_roles = $u->roles;

        if (!empty($_POST['contacts_role'])) {

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

            foreach ($u->roles as $existing_role) {
                $u->remove_role($existing_role);
            }

            $u->add_role($role);
        } elseif (empty($current_roles)) {
            $u->add_role('customer');
        }

        $userdata = array('ID' => $user_id);
        if (!empty($_POST['contacts_first_name'])) {
            $userdata['first_name'] = safestring($_POST['contacts_first_name']);
        }
        if (!empty($_POST['contacts_last_name'])) {
            $userdata['last_name'] = safestring($_POST['contacts_last_name']);
        }
        if (!empty($_POST['contacts_first_name']) && !empty($_POST['contacts_last_name'])) {
            $userdata['display_name'] = safestring($_POST['contacts_first_name']) . ' ' . safestring($_POST['contacts_last_name']);
        }

        if (current_user_can('administrator')) {
            if (!empty($_POST['contacts_email'])) {
                $userdata['user_login'] = safestring($_POST['contacts_email']);
                $userdata['user_email'] = safestring($_POST['contacts_email']);
            }
        }

        if (isset($_POST['contacts_p']) && !empty($_POST['contacts_p'])) {
            $userdata['user_pass'] = safestring($_POST['contacts_p']);
        }

        $user_id = wp_update_user($userdata);

        $fields_to_update = [
            'region' => 'contacts_region',
            'title' => 'contacts_title',
            'account' => 'contacts_account',
            'mobile_phone' => 'contacts_mobile_phone',
            'office_phone' => 'contacts_office_phone',
            'address_street' => 'address_street',
            'address_street_2' => 'address_street_2',
            'address_city' => 'address_city',
            'address_postcode' => 'address_postcode',
            'address_country' => 'address_country'
        ];

        foreach ($fields_to_update as $meta_key => $post_key) {
            if (!empty($_POST[$post_key])) {
                update_user_meta($user_id, $meta_key, safestring($_POST[$post_key]));
            }
        }

        if (!empty($role)) {
            update_user_meta($user_id, 'role', $role);
        }

        // Save Tags
        if (isset($_POST['tags']) && !empty($_POST['tags'])) {
            $tags = json_decode(stripslashes($_POST['tags']), true);
            if (is_array($tags)) {
                update_user_meta($user_id, 'contact_tags', $tags);
            }
        }

        // GEO CODE
        if (!empty($_POST['address_postcode'])) {
            $address_url = $_POST['address_street'];
            $address_2_url = $_POST['address_street_2'];
            $country_url = $_POST['address_country'];
            $postcode = safestring($_POST['address_postcode']);
            $cleaned_postcode = str_replace(' ', '', trim($postcode));

            $cleaned_address = $address_url . '+' . $address_2_url . '+' . $country_url . '+' . $cleaned_postcode;
            $api_url = "https://geocode.maps.co/search?q=" . urlencode($cleaned_postcode) . "&api_key=66d5a1c87be7d126152923dop72193d";

            $response = wp_remote_get($api_url);

            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $data = json_decode($body, true);
                if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
                    $latitude = $data[0]['lat'];
                    $longitude = $data[0]['lon'];
                    $geo = array('lat' => $latitude, 'lon' => $longitude);
                    update_user_meta($user_id, 'geo', $geo);
                } else {
                    update_user_meta($user_id, 'geo', '');
                }
            }
        }

        // STATUS (only update if the user has permission)
        if (current_user_can('manage_options')) { // Adjust to your permission level
            if (isset($_POST['contacts_status'])) {
                $status = $_POST['contacts_status'] == '1' ? '1' : '0';
                update_user_meta($user_id, 'user_active', $status);
            }
        }

        if ($print) {
            echo '<pre>';
            print_r($userdata);
            print_r(get_user_meta($user_id));
            if (is_wp_error($user_id)) {
                echo "Error updating user: " . $user_id->get_error_message() . "\n";
            } else {
                echo "User updated successfully.\n";
            }
            echo '</pre>';
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Contact"] = 'Contact updated.';
        ?><script>window.location.href = "page_view_users_view?displayid=<?= $_GET['displayid']?>&tab=contacts_settings";</script><?php
    }
}

