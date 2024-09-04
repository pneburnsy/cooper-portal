<?php

function online_status() {
    
    $userid = current_user_id();
    $date = get_date_time('Y-m-d H:i:s');

    // UPDATE STATUS
    $metas = array(
        'online_status' => $date
    );
    foreach($metas as $key => $value) {
        update_user_meta( $userid, $key, $value );
    }

}