<?php

function admin_all_users() {
    global $admin_all_users, $locations, $count_contacts, $total_filtered_users;

    // ─── 1) SETUP ─────────────────────────────────────
    $paged            = isset( $_GET['pagenum'] ) ? intval( $_GET['pagenum'] ) : 1;
    $per_page         = isset($_GET['perpage']) ? intval($_GET['perpage']) : 100;
    $offset           = ( $paged - 1 ) * $per_page;
    $search_value     = isset( $_GET['search'] ) ? sanitize_text_field( $_GET['search'] ) : '';
    $selected_tags    = isset( $_GET['tags'] ) ? (array) $_GET['tags'] : [];

    // build any tag‐filter meta_query (AND logic)
    $base_meta_query = [];
    if ( ! empty( $selected_tags ) ) {
        $base_meta_query['relation'] = 'AND';
        foreach ( $selected_tags as $tag ) {
            $base_meta_query[] = [
                'key'     => 'contact_tags',
                'value'   => '"' . $tag . '"',
                'compare' => 'LIKE',
            ];
        }
    }

    // ─── 2) COLLECT ALL MATCHING USER IDs ────────────────
    $matching_ids = [];

    if ( $search_value !== '' ) {
        $like = '*' . esc_attr( $search_value ) . '*';

        // a) query core user columns
        $q1 = new WP_User_Query( [
            'fields'         => 'ID',
            'number'         => -1,
            'search'         => $like,
            'search_columns'=> [ 'user_login','user_nicename','user_email','display_name' ],
            'meta_query'     => $base_meta_query,
        ] );
        $matching_ids = array_merge( $matching_ids, $q1->get_results() );

        // b) query phone meta
        $phone_query = [
            'relation' => 'OR',
            [
                'key'     => 'office_phone',
                'value'   => $search_value,
                'compare' => 'LIKE',
            ],
            [
                'key'     => 'mobile_phone',
                'value'   => $search_value,
                'compare' => 'LIKE',
            ],
        ];

        // append tags filter if any
        if ( ! empty( $base_meta_query ) ) {
            $phone_query = [
                'relation'    => 'AND',
                $base_meta_query,
                $phone_query,
            ];
        }

        $q2 = new WP_User_Query( [
            'fields'     => 'ID',
            'number'     => -1,
            'meta_query' => $phone_query,
        ] );
        $matching_ids = array_merge( $matching_ids, $q2->get_results() );
    } else {
        // no search → just filter by tags if provided
        $q = new WP_User_Query( [
            'fields'     => 'ID',
            'number'     => -1,
            'meta_query' => $base_meta_query,
        ] );
        $matching_ids = $q->get_results();
    }

    // dedupe & count
    $matching_ids      = array_unique( $matching_ids );
    $total_filtered_users = count( $matching_ids );

    // ─── 3) FINAL PAGINATED QUERY ───────────────────────
    // slice out just this page’s IDs
    $page_ids = array_slice( $matching_ids, $offset, $per_page );

    $final_q = new WP_User_Query( [
        'include' => $page_ids,
        'orderby' => 'ID',
        'order'   => 'ASC',
    ] );
    $admin_all_users = $final_q->get_results();

    // ─── 4) BUILD LOCATIONS ARRAY ───────────────────────
    $locations      = [];
    $count_contacts = 0;

    foreach ( $admin_all_users as $user ) {
        $geo_data = get_user_meta( $user->ID, 'geo', true );
        if ( ! empty( $geo_data['lat'] ) && ! empty( $geo_data['lon'] ) ) {
            $count_contacts++;
            $um = get_user_meta( $user->ID );

            // … your existing accounts_team_single logic …

            $locations[] = [
                'lat'               => $geo_data['lat'],
                'lon'               => $geo_data['lon'],
                'user_id'           => $user->ID,
                'account'           => $um['account'][0] ?? '',
                'display_name'      => $user->display_name,
                'displayid'         => $um['displayid'][0] ?? '',
                'address'           => '<a …>' . … . '</a>',
                'email'             => '<a …>' . $user->user_email . '</a>',
                'office_phone'      => '<a href="tel:' . ( $um['office_phone'][0] ?? '' ) . '">'. ( $um['office_phone'][0] ?? '' ) .'</a>',
                'mobile_phone'      => '<a href="tel:' . ( $um['mobile_phone'][0] ?? '' ) . '">'. ( $um['mobile_phone'][0] ?? '' ) .'</a>',
                'account_displayid' => $account_displayid,
                'account_name'      => $account_name,
                'account_array'     => $account_array,
            ];
        }
    }
}
