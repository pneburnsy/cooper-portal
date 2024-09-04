<?php

unset($_SESSION['resetsession']);
$offset = array('20px', '100px', '180px', '260px', '340px', '420px', '500px', '580px', '660px');

$id = current_user_id();
//print_r($_SESSION);

// 1.) DOES EXIST
$exists = $wpdb->get_row($wpdb->prepare("SELECT * FROM `ae_notification` WHERE userid LIKE %d", $id));

// 2.) IF NO CREATE
if (!$exists) {
    $insert = $wpdb->query("INSERT INTO `ae_notification` (`userid`, `status`) VALUES ($id, 1)");
}

// 3.) IS SESSION CHANGE TO 2
if ( $_SESSION && $exists->status == 1 ) {
    $table = 'ae_notification';
    $data = array( 'status' => 2 );
    $where = array( 'userid' => $id );
    $format = array( '%d' );
    $update = $wpdb->update($table, $data, $where, $format);
}

if ($exists->status == 2) { ?>

    <div class="toast-container position-absolute top-0 end-0 p-2 p-lg-3">
        <div class="toast-container-inner">
            <?php $i = 0;
            foreach($_SESSION as $key => $value) { ?>
                <div class="alert Success alert-dismissible alert-label-icon label-arrow fade show" style="bottom:<?= $offset[$i] ?>!important;" role="alert">
                    <i class="mdi mdi-alert-circle-outline label-icon"></i><strong>Notification (<?= $key ?>)</strong>
                    <p><?php echo $value; ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php //unset($_SESSION[$key]);
                $i++; ?>
            <?php }
            session_destroy(); ?>
        </div>
    </div>
    <script> $(".alert").delay(8000).slideUp(200, function() { $(this).alert('close'); });</script><?php

    // 5.) SESSION DONE RESET TO 0
    $table = 'ae_notification';
    $data = array( 'status' => 1 );
    $where = array( 'userid' => $id );
    $format = array( '%d' );
    $update = $wpdb->update($table, $data, $where, $format);

}

