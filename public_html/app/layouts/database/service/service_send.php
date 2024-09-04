<?php

function service_send($print){

    if (isset($_POST['submitservice'])) {

        global $wpdb;

        $displayid = safestring($_GET['displayid']);

        // GET SERVICE ACCOUNT
        $table = $wpdb->prefix . 'service';
        $this_service = $wpdb->get_results($wpdb->prepare("SELECT * FROM `$table` WHERE displayid = %s", $displayid));
        $this_service_clientaccount = $this_service[0]->clientaccount;
        // GET ACCOUNT
        $table = $wpdb->prefix . 'accounts';
        $this_account = $wpdb->get_results($wpdb->prepare("SELECT * FROM `$table` WHERE displayid = %s", $this_service_clientaccount));

        // CLIENT DETAILS
        $clientname = safestring(other_user_fullname(other_convert_displayid($this_account[0]->fleetmanager)));
        $clientemail = safeemail(other_user_email(other_convert_displayid($this_account[0]->fleetmanager)));
        $clientaccount = safestring($this_account[0]->accountname);

        include 'email/service_weekly_outstanding.php';
        fleet_manager_outstanding($clientname, $clientemail, $clientaccount);

        // ------ MESSAGE/ACTION ------
        $_SESSION["Service"] = 'ODO Reading Request Sent.';
        ?><script>window.location.reload();</script><?php

    }

}