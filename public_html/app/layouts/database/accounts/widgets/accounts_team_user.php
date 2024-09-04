<?php

function accounts_team_user() {
    global $accounts_team_user;
    $value = safestring($_GET['displayid']);
    $accounts_team_user = get_users(array(
        'meta_key' => 'account',
        'meta_compare'  =>  '!==',
        'meta_value' => $value,
    ));
}