<?php

function team_view($print) {

    // VARIABLES
    global $wpdb;
    $teamid = current_user_teamid();

    // ARGUMENT
    $args = array(
        'meta_query' => array(
            array(
                'key' => 'teamid',
                'value' => $teamid,
                'compare' => '=',
            )
        ),
        'orderby' => 'meta_value',
        'meta_key' => 'teamrole',
        'order' => 'DESC'
    );
    $wp_user_query = new WP_User_Query( $args );
    global $current_team_member;
    $current_team_member = $wp_user_query->get_results();

    // DEBUGGING
    if ($print == true) {
        ?><pre><?php print_r($current_team_member); ?></pre><?php
    }

}

//%d (integer)
//%f (float)
//%s (string)
