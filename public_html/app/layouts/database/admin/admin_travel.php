<?php

function admin_all_users_travel() {
    global $admin_all_users, $locations, $count_contacts;
    $admin_all_users = get_users(
        array(
            'orderby' => 'ID',
            'order'   => 'ASC'
        )
    );

    $count_contacts = 0;
    $locations = [];
    foreach ($admin_all_users as $user) {
        $geo_data = get_user_meta($user->ID, 'geo', true);
        if (!empty($geo_data) && isset($geo_data['lat']) && isset($geo_data['lon'])) {
            $count_contacts++;

            $user_meta = get_user_meta($user->ID);

            global $accounts_team_single;
            accounts_team_single($user_meta['account'][0], false);

            if (!empty($accounts_team_single) && is_array($accounts_team_single)) {
                $account_displayid = $accounts_team_single[0]->displayid ?? '';
                $account_name = $accounts_team_single[0]->accountname ?? '';
                $account_array = $accounts_team_single[0]->accountarray ?? '';

            } else {
                $account_displayid = '';
                $account_name = '';
                $account_array = '';
            }

            $locations[] = array(
                'lat' => $geo_data['lat'],
                'lon' => $geo_data['lon'],
                'user_id' => $user->ID,
                'account' => $user_meta['account'][0] ?? '',
                'display_name' => $user->display_name,
                'displayid' => $user_meta['displayid'],
                'address' => '<a target="_blank" class="text-dark" href="https://www.google.com/maps/search/' . $user_meta['address_street'][0] . ',+' . $user_meta['address_city'][0] . ',+' . $user_meta['address_postcode'][0] . '"/>' . $user_meta['address_street'][0] . ' ' . $user_meta['address_city'][0] . ' ' . $user_meta['address_postcode'][0] . '</a>',
                'email' => '<a class="text-dark" href="mailto:' . $user->user_email . '">' . $user->user_email . '</a>',
                'office_phone' => '<a class="text-dark" href="tel:' . $user->office_phone . '">' . $user->office_phone . '</a>',
                'mobile_phone' => '<a class="text-dark" href="tel:' . $user->mobile_phone . '">' . $user->mobile_phone . '</a>',
                'account_displayid' => $account_displayid,
                'account_name' => $account_name,
                'account_array' => $account_array,
            );
        }
    }
}