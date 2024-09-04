<?php

/*
 * @DOCUMENT
 *
 * @TEAM SECURITY
 * doif_tlh_admin()
 * doif_tlh_admin_status()
 * doif_tlh_admin_only()
 *
 * @COOPER SECURITY
 * is_coopers_member()
 * doif_owneronlu()
 * doif_adminonly()
 * query_owneronly()
 * query_adminonly()
 * current_user_fleet_manager()
 * online_status_true()
 * online_status_date()
 *
 * @TEAM FUNCTIONS
 * current_user_id()
 * current_user_password()
 * current_user_teamid()
 * other_user_teamid()
 * current_user_teamrole()
 * other_user_teamrole()
 * current_user_displayid()
 * other_user_displayid()
 * current_user_firstname()
 * other_user_firstname()
 * current_user_lastname()
 * other_user_lastname()
 * current_user_fullname()
 * other_user_fullname()
 * current_user_login()
 * other_user_login()
 * current_user_email()
 * other_user_email()
 * current_user_phone()
 * other_user_phone()
 * current_user_url()
 * other_user_url()
 * current_user_account()
 * other_user_account()
 * current_user_profile_picture()
 * other_user_profile_picture()
 * current_user_profile()
 * other_user_profile()
 * current_team_owner()
 * other_team_owner()
 * current_online_status()
 * other_online_status()
 * current_active_status()
 * other_active_status()
 * other_convert_displayid()
 * get_users_for_account()
 * get_region_flag()
 *
 * @TEAM CONVERT
 * display_role()
 *
 * */

// DO IF TLH ADMIN
function doif_tlh_admin() {
    $user = wp_get_current_user();
    if (current_user_can('administrator')) {
        return true;
    } else {
        return false;
    }
}
function doif_tlh_admin_status() {
    echo '<span class="badge rounded-pill bg-soft-danger text-danger float-end uncomplete">Admin Only</span>';
}
function doif_tlh_admin_only($value) {
    if ($value == true) {
        // GET CURRENT USER ROLE
        $user = wp_get_current_user();
        $roles = ( array ) $user->roles;
        // CHECK USER ROLE
        $isadmin = false;
        for($i = 0; $i < 10; $i++) {
            if ($roles[$i] == 'administrator') {
                $isadmin = true;
            }
        }
        if (!$isadmin) {
            echo "<div class='cooper_access_denied'><span>Sorry only authorised members of staff can access this page. If this is incorrect please contact your Cooper department manager.</span></div>";
            include 'layouts/footer.php';
            exit;
        }
    }
}
// COOPER STAFF SECURITY
function is_email_super_admin($displayid) {
    $email_list = ['natasha@cooperhandling.com', 'chris@cooperhandling.com', 'david@cooperhandling.com', 'mattburns@tlhmarketing.co.uk'];
    $user_email = other_user_email(other_convert_displayid($displayid));
    if ($user_email && in_array($user_email, $email_list)) {
        return true;
    }
    return false;
}
function is_coopers_member($user_id) {
    $user = get_userdata($user_id);
    $roles = (array) $user->roles;

    for ($i = 0; $i < 10; $i++) {
        if (isset($roles[$i]) && ($roles[$i] == 'administrator' || $roles[$i] == 'employee' || $roles[$i] == 'employee_editor')) {
            return true;
        }
    }

    return false;
}
function doif_cooperonly($value, $permissions = false) {
    if ($value == true) {
        $user = wp_get_current_user();
        $roles = (array) $user->roles;

        $isadmin = false;
        for ($i = 0; $i < 10; $i++) {
            if (isset($roles[$i]) && ($roles[$i] == 'administrator' || $roles[$i] == 'employee' || $roles[$i] == 'employee_editor')) {
                $isadmin = true;
                break;
            }
        }

        if ($permissions !== false) {
            global $wpdb;

            $permissions = safestring($permissions);
            $user_id = $user->ID;
            $permission_value = $wpdb->get_var($wpdb->prepare("SELECT value FROM ae_permissions WHERE userid = %d AND type = %s", $user_id, $permissions));

            if ($permission_value == 'blocked') {
                $isadmin = false;
            } elseif ($permission_value == 'granted') {
                $isadmin = true;
            } elseif ($permission_value == 'default') {

            }
        }

        if (!$isadmin) {
            echo "<div class='cooper_access_denied'><span>Sorry only authorised members of staff can access this page. If this is incorrect please contact your Cooper department manager.</span></div>";
            include 'layouts/footer.php';
            exit;
        }
    }
}
//function doif_cooperonly($value) {
//    if ($value == true) {
//        // GET CURRENT USER ROLE
//        $user = wp_get_current_user();
//        $roles = ( array ) $user->roles;
//        // CHECK USER ROLE
//        $isadmin = false;
//        for($i = 0; $i < 10; $i++) {
//            if ($roles[$i] == 'administrator' || $roles[$i] == 'employee' || $roles[$i] == 'employee_editor') {
//                $isadmin = true;
//            }
//        }
//        if (!$isadmin) {
//            echo "<div class='cooper_access_denied'><span>Sorry only authorised members of staff can access this page. If this is incorrect please contact your Cooper department manager.</span></div>";
//            include 'layouts/footer.php';
//            exit;
//        }
//    }
//}
function doif_coopereditoronly($value, $permissions = false) {
    if ($value == true) {
        $user = wp_get_current_user();
        $roles = (array) $user->roles;

        $isadmin = false;
        for ($i = 0; $i < 10; $i++) {
            if (isset($roles[$i]) && ($roles[$i] == 'administrator' || $roles[$i] == 'employee_editor')) {
                $isadmin = true;
                break;
            }
        }

        if ($permissions !== false) {
            global $wpdb;

            $permissions = safestring($permissions);
            $user_id = $user->ID;
            $permission_value = $wpdb->get_var($wpdb->prepare("SELECT value FROM ae_permissions WHERE userid = %d AND type = %s", $user_id, $permissions));

            if ($permission_value == 'blocked') {
                $isadmin = false;
            } elseif ($permission_value == 'granted') {
                $isadmin = true;
            } elseif ($permission_value == 'default') {

            }
        }

        if (!$isadmin) {
            echo "<div class='cooper_access_denied'><span>Sorry only authorised members of staff can access this page. If this is incorrect please contact your Cooper department manager.</span></div>";
            include 'layouts/footer.php';
            exit;
        }
    }
}
//function doif_coopereditoronly($value, $permissions = false) {
//    if ($value == true) {
//        // GET CURRENT USER ROLE
//        $user = wp_get_current_user();
//        $roles = ( array ) $user->roles;
//        // CHECK USER ROLE
//        $isadmin = false;
//        for($i = 0; $i < 10; $i++) {
//            if ($roles[$i] == 'administrator' || $roles[$i] == 'employee_editor') {
//                $isadmin = true;
//            }
//        }
//        if (!$isadmin) {
//            echo "<div class='cooper_access_denied'><span>Sorry only authorised members of staff can access this page. If this is incorrect please contact your Cooper department manager.</span></div>";
//            include 'layouts/footer.php';
//            exit;
//        }
//    }
//}
function doif_cooperonly_query($permissions = false) {
    $user = wp_get_current_user();
    $roles = (array) $user->roles;

    $isadmin = false;
    for ($i = 0; $i < 10; $i++) {
        if (isset($roles[$i]) && ($roles[$i] == 'administrator' || $roles[$i] == 'employee' || $roles[$i] == 'employee_editor')) {
            $isadmin = true;
            break;
        }
    }

    if ($permissions !== false) {
        global $wpdb;

        $permissions = safestring($permissions);
        $user_id = $user->ID;
        $permission_value = $wpdb->get_var($wpdb->prepare("SELECT value FROM ae_permissions WHERE userid = %d AND type = %s", $user_id, $permissions));

        if ($permission_value == 'blocked') {
            return false;
        } elseif ($permission_value == 'granted') {
            return true;
        } elseif ($permission_value == 'default') {
            return $isadmin;
        } else {
            return $isadmin;
        }
    }

    return $isadmin;
}
//function doif_cooperonly_query() {
//    // GET CURRENT USER ROLE
//    $user = wp_get_current_user();
//    $roles = ( array ) $user->roles;
//    // CHECK USER ROLE
//    $isadmin = false;
//    for($i = 0; $i < 10; $i++) {
//        if ($roles[$i] == 'administrator' || $roles[$i] == 'employee' || $roles[$i] == 'employee_editor') {
//            $isadmin = true;
//        }
//    }
//    if (!$isadmin) {
//        return false;
//    } else {
//        return true;
//    }
//}
function doif_coopereditoronly_query($permissions = false) {
    $user = wp_get_current_user();
    $roles = (array) $user->roles;

    $is_admin_or_editor = false;
    for ($i = 0; $i < 10; $i++) {
        if (isset($roles[$i]) && ($roles[$i] == 'administrator' || $roles[$i] == 'employee_editor')) {
            $is_admin_or_editor = true;
            break;
        }
    }

    if ($permissions === false) {
        return $is_admin_or_editor;
    }

    global $wpdb;
    $permissions = safestring($permissions);
    $user_id = $user->ID;
    $permission_value = $wpdb->get_var($wpdb->prepare("SELECT value FROM ae_permissions WHERE userid = %d AND type = %s", $user_id, $permissions));

    if ($permission_value === 'granted') {
        return true;
    } elseif ($permission_value === 'blocked') {
        return false;
    } elseif ($permission_value === 'default') {
        return $is_admin_or_editor;
    } else {
        return $is_admin_or_editor;
    }
}
//function doif_coopereditoronly_query() {
//    // GET CURRENT USER ROLE
//    $user = wp_get_current_user();
//    $roles = ( array ) $user->roles;
//    // CHECK USER ROLE
//    $isadmin = false;
//    for($i = 0; $i < 10; $i++) {
//        if ($roles[$i] == 'administrator' || $roles[$i] == 'employee_editor') {
//            $isadmin = true;
//        }
//    }
//    if (!$isadmin) {
//        return false;
//    } else {
//        return true;
//    }
//}
function doif_cooperadminonly($value, $permissions = false) {
    if ($value == true) {
        $user = wp_get_current_user();
        $roles = (array) $user->roles;

        $isadmin = false;
        for ($i = 0; $i < 10; $i++) {
            if (isset($roles[$i]) && ($roles[$i] == 'administrator')) {
                $isadmin = true;
                break;
            }
        }

        if ($permissions !== false) {
            global $wpdb;

            $permissions = safestring($permissions);
            $user_id = $user->ID;
            $permission_value = $wpdb->get_var($wpdb->prepare("SELECT value FROM ae_permissions WHERE userid = %d AND type = %s", $user_id, $permissions));

            if ($permission_value == 'blocked') {
                $isadmin = false;
            } elseif ($permission_value == 'granted') {
                $isadmin = true;
            } elseif ($permission_value == 'default') {

            }
        }

        if (!$isadmin) {
            echo "<div class='cooper_access_denied'><span>Sorry only authorised members of staff can access this page. If this is incorrect please contact your Cooper department manager.</span></div>";
            include 'layouts/footer.php';
            exit;
        }
    }
}
function doif_cooperadminonly_query($permissions = false) {
    $user = wp_get_current_user();
    $roles = (array) $user->roles;

    $is_admin_or_editor = false;
    for ($i = 0; $i < 10; $i++) {
        if (isset($roles[$i]) && ($roles[$i] == 'administrator')) {
            $is_admin_or_editor = true;
            break;
        }
    }

    if ($permissions === false) {
        return $is_admin_or_editor;
    }

    global $wpdb;
    $permissions = safestring($permissions);
    $user_id = $user->ID;
    $permission_value = $wpdb->get_var($wpdb->prepare("SELECT value FROM ae_permissions WHERE userid = %d AND type = %s", $user_id, $permissions));

    if ($permission_value === 'granted') {
        return true;
    } elseif ($permission_value === 'blocked') {
        return false;
    } elseif ($permission_value === 'default') {
        return $is_admin_or_editor;
    } else {
        return $is_admin_or_editor;
    }
}
// TEAM SECURITY
function doif_owneronly() {
    if (current_user_teamrole() == 3) {
        return true;
    } else {
        return false;
    }
}
function doif_adminonly() {
    if (current_user_teamrole() == 3 || current_user_teamrole() == 2) {
        return true;
    } else {
        return false;
    }
}
function query_owneronly() {
    if (!doif_owneronly()) {
        $_SESSION["message"] = 'Error: You are not the team owner.';
        ?><script>window.location.reload();</script><?php
        exit;
    }
}
function query_adminonly() {
    if (!doif_adminonly()) {
        $_SESSION["message"] = 'Error: You are not an admin or the team owner.';
        ?><script>window.location.reload();</script><?php
        exit;
    }
}

// FLEET MANAGER CHECK
function current_user_fleet_manager($userdisplayid, $accountdisplayid) {
    global $wpdb;

    // GET FLEET MANAGER DISPLAYID
    $table = $wpdb->prefix . 'accounts';
    $fleetmanager_displayid = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE displayid = %s
    ",
        // ARGUMENTS
        $accountdisplayid
    ));
    if ($fleetmanager_displayid[0]->fleetmanager == $userdisplayid) {
        return true;
    } else {
        return false;
    }
}

// FLEET MANAGER CHECK
function current_user_fleet_contact($userdisplayid, $accountdisplayid, $current_user_email) {
    global $wpdb;

    // GET FLEET MANAGER DISPLAYID
    $table = $wpdb->prefix . 'accounts';
    $fleetmanager_displayid = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE displayid = %s
    ",
        // ARGUMENTS
        $accountdisplayid
    ));

    $emailList = $fleetmanager_displayid[0]->fleetmanageradmin;
    $emails = explode(',', $emailList);
    if (in_array($current_user_email, $emails)) {
        return true;
    } else {
        return false;
    }
}

// STATUS CHECKS
function online_status_true($userid) {
    $user_last_activity = other_online_status($userid);
    if ( strtotime($user_last_activity) > strtotime("-5 minutes") ) {
        $value = array(2, 'Online');
        return $value;
    }
    elseif (strtotime($user_last_activity) > strtotime("-30 minutes")) {
        $value = array(1, 'Away');
        return $value;
    }
    else {
        $value = array(0, 'Offline');
        return $value;
    }
}
function online_status_date($userid) {
    $now = time();
    $user_last_activity = other_online_status($userid);
    if ($user_last_activity) {
        $date = strtotime($user_last_activity);
        $datediff = $now - $date;
        
        $datediffdays = round($datediff / (60 * 60 * 24));
        $datediffhours = round($datediff / (60 * 24));

        if ($datediffdays == 0 && $datediffhours == 0) {
            $result = 'Recently';
        }
        elseif ($datediffdays == 0 && $datediffhours > 0) {
            $result = $datediffhours . ' Hour(s) Ago';
        }
        else {
            $result = $datediffdays . ' Day(s) Ago';
        }
        return $result;
    } else {
        $never = 'Never';
        return $never;
    }
}


// TEAM FUNCTIONS
function current_user_id() {
    $userid = get_current_user_id();
    return $userid;
}
function current_user_password() {
    global $current_user;
    $value = $current_user->user_pass;
    return $value;
}
function current_user_teamid() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid, 'teamid' );
    return $value[0];
}
function other_user_teamid( $this_userid ) {
    $value = get_user_meta( $this_userid, 'teamid' );
    return $value[0];
}
function current_user_teamrole() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid, 'teamrole' );
    return $value[0];
}
function other_user_teamrole( $this_userid ) {
    $value = get_user_meta( $this_userid, 'teamrole' );
    return $value[0];
}
function current_user_displayid() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid, 'displayid' );
    return $value[0];
}
function other_user_displayid( $this_userid ) {
    $value = get_user_meta( $this_userid, 'displayid' );
    return $value[0];
}
function current_user_firstname() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid, 'first_name' );
    return $value[0];
}
function other_user_firstname( $this_userid ) {
    $value = get_user_meta( $this_userid, 'first_name' );
    return $value[0];
}
function current_user_lastname() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid, 'last_name' );
    return $value[0];
}
function other_user_lastname( $this_userid ) {
    $value = get_user_meta( $this_userid, 'last_name' );
    return $value[0];
}
function current_user_fullname() {
    $userid = get_current_user_id();
    $first = get_user_meta( $userid, 'first_name' );
    $last = get_user_meta( $userid, 'last_name' );
    $full = $first[0] . ' ' . $last[0];
    return $full;
}
function other_user_fullname( $this_userid ) {
    $first = get_user_meta( $this_userid, 'first_name' );
    $last = get_user_meta( $this_userid, 'last_name' );
    $full = $first[0] . ' ' . $last[0];
    return $full;
}
function current_user_login() {
    global $current_user;
    $value = $current_user->user_login;
    return $value;
}
function other_user_login( $this_userid ) {
    $current_user = get_userdata( $this_userid );
    $value = $current_user->user_login;
    return $value;
}
function current_user_email() {
    global $current_user;
    $value = $current_user->user_email;
    return $value;
}
function other_user_email( $this_userid ) {
    $current_user = get_userdata( $this_userid );
    $value = $current_user->user_email;
    return $value;
}
function current_user_phone() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid, 'phone' );
    return $value[0];
}
function other_user_phone( $this_userid ) {
    $value = get_user_meta( $this_userid, 'phone' );
    return $value[0];
}
function current_user_url() {
    global $current_user;
    $value = $current_user->user_url;
    return $value;
}
function other_user_url( $this_userid ) {
    $current_user = get_userdata( $this_userid );
    $value = $current_user->user_url;
    return $value;
}
function current_user_account() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid, 'account' );
    return $value[0];
}
function other_user_account( $this_userid ) {
    $value = get_user_meta( $this_userid, 'account' );
    return $value[0];
}
function get_current_user_account_name($clientaccount) {
    global $wpdb;

    // GET FLEET MANAGER DISPLAYID
    $table = $wpdb->prefix . 'accounts';
    $account_name = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE displayid = %s
    ",
        // ARGUMENTS
        $clientaccount
    ));
    return $account_name[0]->accountname;
}
function current_user_profile_picture() {
    $userid = get_current_user_id();
    $initialvalue = get_user_meta( $userid, 'profile_picture_url' );
    if ($initialvalue[0] != '') {
        $value = str_replace("/home/sites/2b/e/e885ca320e/public_html", "", $initialvalue[0]);
        return get_site_url() . $value;
    } else {
        return false;
    }
}
function other_user_profile_picture( $this_userid ) {
    $initialvalue = get_user_meta( $this_userid, 'profile_picture_url' );
    if ($initialvalue[0] != '') {
        $value = str_replace("/home/sites/2b/e/e885ca320e/public_html", "", $initialvalue[0]);
        return get_site_url() . $value;
    } else {
        return false;
    }
}
function current_user_profile() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid );
    return $value;
}
function other_user_profile( $this_userid ) {
    $value = get_user_meta( $this_userid );
    return $value;
}
function current_team_owner() {
    $current_team = current_user_teamid();
    $args = array(
        array(
            'relation' => 'AND',
            array(
                'meta_key' => 'teamid',
                'meta_value' => $current_team,
                'meta_compare' => '='
            ),
            array(
                'meta_key' => 'teamrole',
                'meta_value' => 3,
                'meta_compare' => '='
            )
        )
    );
    $wp_user_query = new WP_User_Query( $args );
    $value = $wp_user_query->get_results();
    return $value;
}
function other_team_owner( $this_userid ) {
    $other_team = other_user_teamid($this_userid);
    $args = array(
        array(
            'relation' => 'AND',
            array(
                'meta_key' => 'teamid',
                'meta_value' => $other_team,
                'meta_compare' => '='
            ),
            array(
                'meta_key' => 'teamrole',
                'meta_value' => 3,
                'meta_compare' => '='
            )
        )
    );
    $wp_user_query = new WP_User_Query( $args );
    $value = $wp_user_query->get_results();
    return $value;
}
function current_online_status() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid, 'online_status' );
    return $value[0];
}
function other_online_status( $this_userid ) {
    $value = get_user_meta( $this_userid, 'online_status' );
    return $value[0];
}
function other_convert_displayid( $this_displayid ) {
    $args = array(
        'meta_key' => 'displayid',
        'meta_value' => $this_displayid,
        'meta_compare' => '='
    );
    $wp_user_query = new WP_User_Query( $args );
    $value = $wp_user_query->get_results();
    return $value[0]->id;
}
function current_active_status() {
    $userid = get_current_user_id();
    $value = get_user_meta( $userid, 'active_status' );
    return $value[0];
}
function other_active_status( $this_userid ) {
    $value = get_user_meta( $this_userid, 'active_status' );
    return $value[0];
}

// TEAM CONVERT
function display_role( $value ) {
    if ( $value == 3 ) {
        echo 'Super Admin';
    }
    elseif ( $value == 2 ) {
        echo 'Admin';
    }
    elseif ( $value == 1 && $value == 0 ) {
        echo 'Team Leader';
    }
    else {
        echo 'Team Member';
    }
}

// ACCOUNTS
function get_users_for_account($variable) {
    $args = array(
        'meta_key' => 'account',
        'meta_value' => $variable,
        'meta_compare' => '=',
    );
    global $current_account_users;
    $current_account_users = get_users($args);
}

// REGION
function get_region_flag($region) {
    if ($region == 0) {
        $current_flag = "/app/assets/images/uk.png";
    }
    else {
        $current_flag = "/app/assets/images/ireland.png";
    }
    ?>
    <div class="regionFlag" style="background-image: url(<?= $current_flag ?>)"></div>
    <?php
}
