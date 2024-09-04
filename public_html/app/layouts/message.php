<?php
$admintable = $wpdb->prefix . 'admin_options';
$adminoptions = $wpdb->get_results("SELECT * FROM $admintable WHERE uid = 1");
$headermessage = $adminoptions[0]->messageswitch;
if ($headermessage) {
    ?><div class="header_message">
        <span>
            <?php
            echo $adminoptions[0]->message;
            if ($adminoptions[0]->messageurl) {
                $url = $adminoptions[0]->messageurl;
                ?><a href="<?= $url ?>">Click Here</a><?php
            }
            ?>
        </span>
    </div><?php
}
$adminoptions = NULL;
?>