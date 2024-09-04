<?php

if(!isset($_SESSION)) {
    session_start();
}


/* ---- DEVELOPER ENTRY ONLY (MANUAL ONLY) - MAINTENANCE ---- */

//if (get_current_user_id() != 1) {
//    echo '<span style="display:block;width:100%;text-align:center;padding:40px;">
//        <span style="color:#151937;background-color:#f5f5f5;font-family:sans-serif;padding:30px;border-radius:10px;">
//            The portal is currently under maintenance, apologies for any inconvenience caused. Please refresh the page shortly.
//        </span>
//    </span>';
//    exit();
//}

/* ---- ADMIN ENTRY ONLY (PORTAL OPTION ONLY) - MAINTENANCE ---- */



// --- 1.) Maintenance Mode ---
$admin_table = $wpdb->prefix . 'admin_options';
$adminoptions = $wpdb->get_results("SELECT * FROM $admin_table WHERE uid = 1");
$maintenancemode = $adminoptions[0]->maintenanceswitch;
if ($maintenancemode && !current_user_can('administrator')) {
    echo '<span style="display:block;width:100%;text-align:center;padding:40px;">
        <span style="color:#151937;background-color:#f5f5f5;font-family:sans-serif;padding:30px;border-radius:10px;">
            The portal is currently under maintenance, apologies for any inconvenience caused. Please refresh the page shortly.
        </span>
    </span>';
    exit();
}
$adminoptions = NULL;
// ALSO DISPLAYS DIV IN MENU SHOWING MAINTENANCE MODE IS ON FOR ADMINS


/* ---- START - SECURITY ---- */

// AUTH USER LOGIN CHECK
if (is_user_logged_in()) {
    $security_check_userid = get_current_user_id();
    // echo $security_check_userid;
    $security_check_user_active = get_user_meta($security_check_userid, 'user_active', true);
    if ($security_check_user_active != 1) {
        echo '<span style="display:block;width:100%;text-align:center;padding:40px;">
            <span style="color:#151937;background-color:#f5f5f5;font-family:sans-serif;padding:30px;border-radius:10px;">
                Your account is not active, please contact a Cooper Administrator to resolve this issue.
            </span>
        </span>';
        exit();
    }
} else {
    wp_redirect('/wp-login.php');
    exit();
}

// AUTH USER DISABLED CHECK
/*
$security_userid = get_current_user_id();
$security_active_user = get_user_meta($security_userid, 'active_status');
if (!$security_active_user[0]) {
    include 'includes/security/account_status_check.php';
    exit;
}
*/

/* ---- END - SECURITY ---- */

?>

<!DOCTYPE html>
<html lang="en">
