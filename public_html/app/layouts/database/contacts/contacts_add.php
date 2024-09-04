<?php

function contacts_add($print) {
    if (isset($_POST['contacts_add'])) {
        global $wpdb;

        // ------ VARIABLES ------
        $displayid = guid();
        // USERNAME
        if (username_exists($_POST['contacts_email'])) {
            return 'Username already exists.';
        }
        // EMAIL
        if (email_exists($_POST['contacts_email'])) {
            return 'Email already exists.';
        }
        // PASSWORD
        if (isset($_POST['contacts_password'])) {
            $password = $_POST['contacts_password'];
        } else {
            $password = guid();
        }
        // ACTIVE
        if (isset($_POST['contacts_password']) && !empty($_POST['contacts_password'])) {
            $active = 1;
        } else {
            $active = 0;
        }
        // ROLE
        if (isset($_POST['contacts_role']) && !empty($_POST['contacts_role'])) {
            if ($_POST['contacts_role'] == 'administrator') {
                $role = 'administrator';
            } elseif ($_POST['contacts_role'] == 'employee_editor') {
                $role = 'employee_editor';
            } elseif ($_POST['contacts_role'] == 'employee') {
                $role = 'employee';
            } else {
                $role = 'customer';
            }
        } else {
            $role = 'customer';
        }

        // Check if user already exists by username or email
        $user_id = username_exists(safestring($_POST['contacts_email'])) ?: email_exists(safestring($_POST['contacts_email']));

        if (!$user_id) {
            $user_id = wp_insert_user(array(
                'user_login'   => safestring($_POST['contacts_email']),
                'user_pass'    => safestring($password),
                'first_name'   => safestring($_POST['contacts_first_name']),
                'last_name'    => safestring($_POST['contacts_last_name']),
                'user_email'   => safestring($_POST['contacts_email']),
                'role'         => safestring($role),
            ));
            if (is_wp_error($user_id)) {
                echo 'Error creating user: ' . $user_id->get_error_message();
            } else {
                echo 'User created successfully.';
            }
        } else {
            $user = new WP_User($user_id);
            if (in_array('administrator', $user->roles)) {
                echo 'User is already an administrator, role retained.';
            } else {
                $user->set_role(safestring($role));
                echo 'User role updated successfully.';
            }
        }
        if (!is_wp_error($user_id)) {
            update_user_meta($user_id, 'user_active', safestring($active));
            update_user_meta($user_id, 'title', get_current_user_id());
            update_user_meta($user_id, 'region', safestring($_POST['contacts_region']));
            update_user_meta($user_id, 'createdby', get_current_user_id());
            update_user_meta($user_id, 'displayid', safestring($displayid));
            update_user_meta($user_id, 'account', safestring($_POST['contacts_account']));
            update_user_meta($user_id, 'mobile_phone', safestring($_POST['contacts_mobile_phone']));
            update_user_meta($user_id, 'office_phone', safestring($_POST['contacts_office_phone']));
            update_user_meta($user_id, 'address_street', safestring($_POST['address_street']));
            update_user_meta($user_id, 'address_city', safestring($_POST['address_city']));
            update_user_meta($user_id, 'address_postcode', safestring($_POST['address_postcode']));
        }

        // GEO CODE
        $postcode = safestring($_POST['contacts_postcode']);
        $api_url = "https://geocode.maps.co/search?q=" . urlencode($postcode) . "&api_key=66d5a1c87be7d126152923dop72193d";

        $response = wp_remote_get($api_url);

        if (is_wp_error($response)) {
            echo 'Error retrieving geolocation data: ' . $response->get_error_message();
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

        // ------ BUG CHECKING ------
        if ($print == true) {
            echo '<pre>';
            print_r($contacts_add);
            echo '</pre>';
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Contact"] = 'Contact created.';
        ?><script>window.location.reload();</script><?php
    }
}